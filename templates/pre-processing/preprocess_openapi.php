<?php

$specFile = __DIR__ . '/../../schema/openapispec-platformsh.json';
$outputFile = __DIR__ . '/../../schema/openapispec-platformsh-xreturn.json';

$spec = json_decode(file_get_contents($specFile), true);

// FIXME temp removal
// remove /projects/{projectId}.delete from the action
// (use /organizations/{organization_id}/subscriptions/{subscription_id}.delete instead)
if (isset($spec['paths']['/projects/{projectId}']['delete'])) {
    unset($spec['paths']['/projects/{projectId}']['delete']);
}

foreach ($spec['paths'] as $path => &$methods) {
    preg_match_all('/\{([^\}]+)\}/', $path, $matches);
    $pathParams = $matches[1] ?? [];

    foreach ($methods as $httpMethod => &$operation) {
        if (!is_array($operation) || $httpMethod == "parameters") {
            continue;
        }

        // --- Remove "default": null if $ref exists in requestBody schema ---
        if (isset($operation['requestBody']['content']['application/json']['schema']['properties'])) {
            foreach (
                $operation['requestBody']['content']['application/json']['schema']['properties'] as $key => &$prop
            ) {
                if (isset($prop['$ref']) && array_key_exists('default', $prop)) {
                    unset($prop['default']);
                }
            }
        }

        // --- Auto x-return-types ---
        $returnTypes = [];
        $operation['x-return-types-displayReturn'] = false;
        if (isset($operation['responses']) && is_array($operation['responses'])) {
            foreach ($operation['responses'] as $statusCode => $resp) {
                // Only process success codes (2xx)
                if ((!is_numeric($statusCode) || $statusCode < 200 || $statusCode > 299) && $statusCode !== 'default') {
                    continue;
                }

                $contentTypes = array_keys($resp['content'] ?? []);

                // JSON
                if (isset($resp['content']['application/json']['schema'])) {
                    $schema = $resp['content']['application/json']['schema'];
                } elseif (isset($resp['content']['application/problem+json']['schema'])) {
                    $schema = $resp['content']['application/problem+json']['schema'];
                } elseif (
                    isset($resp['content']['application/pdf']['schema'])
                    || in_array('application/pdf', $contentTypes)
                ) {
                    $schema = ['type' => 'string', 'format' => 'binary'];
                }

                if ($schema && is_array($schema)) {
                    $has2xxWithSchema = true;
                    $refs = collectMainRefs($schema);
                    foreach ($refs as $ref) {
                        $returnTypes[] = $ref;
                    }
                } else {
                    // Si pas de schema, déterminer type via content-type
                    $contentTypes = array_keys($resp['content'] ?? []);
                    if (in_array('application/pdf', $contentTypes)) {
                        $returnTypes[] = 'string';
                    } else {
                        $returnTypes[] = 'void';
                    }
                }
            }
        }

        // convert void|Error to null|Error
        if (in_array('void', $returnTypes, true) && count($returnTypes) > 1) {
            $returnTypes = array_map(function ($t) {
                return $t === 'void' ? 'null' : $t;
            }, $returnTypes);
        }

        $operation['x-return-types'] = array_values(array_unique($returnTypes));
        // Convert `Model[]` to `array` for union type
        $unionTypes = array_map(function ($t) {
            // If it's a model array like \Upsun\Model\Something[], convert to 'array'
            if (str_ends_with($t, '[]')) {
                return 'array';
            }
            return $t;
        }, $returnTypes);

        $returnTypeUnion = implode('|', array_values(array_unique($unionTypes)));
        if ($returnTypeUnion) {
            $operation['x-return-types-union'] = $returnTypeUnion;
        }
        foreach ($returnTypes as $t) {
            if (str_ends_with($t, '[]')) {
                $operation['x-return-types-displayReturn'] = true;
                break; // one match is enough
            }
        }

        // Determine if the operation has a real return type
        $hasReturn = isset($operation['responses']['200']['content']);
        foreach ($returnTypes as $t) {
            if ($t !== 'null') {
                $hasReturn = true;
                break;
            }
        }
        $operation['x-returnable'] = $hasReturn;
        $operation['x-hasMultipleResponses'] = count($operation['responses']) > 1;
    }
}

$processedSpec = forceEmptyObjects($spec);
file_put_contents(
    $outputFile,
    json_encode($processedSpec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
);

echo "OpenAPI spec preprocessed and cleaned in $outputFile\n";

// Helper function: collect only main $ref (not those in properties/_links/etc.)
function collectMainRefs(array $schema, array &$refs = [])
{
    $refs = [];
    if (isset($schema['$ref'])) {
        // Only add model refs with namespace
        $parts = explode('/', $schema['$ref']);
        $refs[] = '\\Upsun\\Model\\' . end($parts);
    } elseif (isset($schema['type'])) {
        switch ($schema['type']) {
            case 'array':
                if (isset($schema['items']['$ref'])) {
                    $parts = explode('/', $schema['items']['$ref']);
                    $refs[] = '\\Upsun\\Model\\' . end($parts) . '[]';
                } else {
                    $refs[] = 'array';
                }
                return $refs;
            case 'object':
                $refs[] = 'array'; // inline object treated as array
                return $refs; // stop recursion into properties
            case 'boolean':
            case 'string':
            case 'integer':
            case 'number':
                $refs[] = $schema['type'];
                return $refs;
        }
    }

    return $refs;
}



// Helper function: convert empty arrays to stdClass to preserve object types
function forceEmptyObjects($data)
{
    if (is_array($data)) {
        if (empty($data)) {
            return new stdClass();
        }

        $result = [];
        $isAssociative = array_keys($data) !== range(0, count($data) - 1);

        foreach ($data as $key => $value) {
            $result[$key] = forceEmptyObjects($value);
        }

        return $isAssociative && empty($result) ? new stdClass() : $result;
    }

    return $data;
}
