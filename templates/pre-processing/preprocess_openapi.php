<?php

$specFile = __DIR__ . '/../../schema/openapispec-platformsh-with-resources.json';
$outputFile = __DIR__ . '/../../schema/openapispec-platformsh-xreturn.json';

$content = file_get_contents($specFile);
$content = str_replace('HTTP access permissions', 'Http access permissions', $content);

$spec = json_decode($content, true);

// FIXME temp removal
// remove /projects/{projectId}.delete from the action
// (use /organizations/{organization_id}/subscriptions/{subscription_id}.delete instead)
if (isset($spec['paths']['/projects/{projectId}']['delete'])) {
    unset($spec['paths']['/projects/{projectId}']['delete']);
}

// FIXME adding Activity.id field if not exist yet
// check https://lab.plat.farm/sdk/git/-/merge_requests/4006#note_2218419
if (!isset($spec['components']['schemas']['Activity']['properties']['id'])) {
    $spec['components']['schemas']['Activity']['properties']['id'] = [
        'type' => 'string',
        'title' => 'ID'
    ];
    $spec['components']['schemas']['Activity']['required'][] = "id";
}

// FIXME adding Deployment.id field if not exist yet
// check https://lab.plat.farm/sdk/git/-/merge_requests/4006#note_2218419
if (!isset($spec['components']['schemas']['Deployment']['properties']['id'])) {
    $spec['components']['schemas']['Deployment']['properties']['id'] = [
        'type' => 'string',
        'title' => 'ID'
    ];
    $spec['components']['schemas']['Deployment']['required'][] = "id";
}

// Adding x-return info for better processing in the mustache template
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
        $phpDoc = [];
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
                } else {
                    continue;
                }

                if ($schema && is_array($schema)) {
                    $has2xxWithSchema = true;

                    if (
                        isset($schema['type'])
                        && $schema['type'] === 'object' && isset($schema['properties']['items'])
                    ) {
                        $itemsSchema = $schema['properties']['items'];
                        $refs = collectMainRefs($itemsSchema, $spec);
                    } else {
                        $refs = collectMainRefs($schema, $spec);
                        $returnTypes = array_merge($returnTypes, $refs['refs'] ?? []);
                    }
                    $phpDoc = $refs['phpdoc'] ?? null;
                } else {
                    // If no schema, guess type via content-type
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

        $operation['x-phpdoc'] = $phpDoc;
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

// Helper function: collect only main $ref (not those in _links/etc.)
function collectMainRefs(array $schema, array $spec)
{
    //var_dump('schema', $schema);
    $refs = [];
    if (isset($schema['$ref'])) {
        $resolved = resolveRef($spec, $schema['$ref']);
        if (
            $resolved && isset($resolved['type'])
            && $resolved['type'] === 'array' && isset($resolved['items']['$ref'])
        ) {
            $parts = explode('/', $resolved['items']['$ref']);
            $refs['refs'][] = '\\Upsun\\Model\\' . end($parts) . '[]';
        } else {
            $parts = explode('/', $schema['$ref']);
            $refs['refs'][] = '\\Upsun\\Model\\' . end($parts);
        }
        return $refs;
    }

    if (isset($schema['type'])) {
        switch ($schema['type']) {
            case 'array':
            case 'object':
                if (isset($schema['items']['$ref'])) {
                    $parts = explode('/', $schema['items']['$ref']);
                    $refs['refs'][] = '\\Upsun\\Model\\' . end($parts) . '[]';
                    $refs['phpdoc']['items'] = '\\Upsun\\Model\\' . end($parts) . '[]';
                } elseif (isset($schema['additionalProperties']['$ref'])) {
                    $parts = explode('/', $schema['additionalProperties']['$ref']);
                    $refs['refs'][] = '\\Upsun\\Model\\' . end($parts);
                    $refs['phpdoc']['items'] = '\\Upsun\\Model\\' . end($parts);
                } elseif (isset($schema['properties'])) {
                    //$refs['refs'] = []; //'array';
                    foreach ($schema['properties'] as $propertyName => $propertyValue) {
                        $refs['phpdoc']['array'][] = [$propertyName => $propertyValue['type'] ?? null];
                    }
                }
                return $refs;

            case 'boolean':
            case 'string':
            case 'integer':
            case 'number':
                $refs['refs'][] = $schema['type'];
                return $refs;
        }
    }

    return $refs;
}



function resolveRef(array $spec, string $ref)
{
    // Ex : $ref = "#/components/schemas/ActivityCollection"
    $parts = explode('/', $ref);
    $current = $spec;
    foreach ($parts as $part) {
        if ($part === '#' || $part === '') {
            continue;
        }
        if (!isset($current[$part])) {
            return null;
        }
        $current = $current[$part];
    }
    return $current;
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
