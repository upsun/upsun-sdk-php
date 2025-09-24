<?php

namespace Upsun;

use Exception;
use InvalidArgumentException;
use RuntimeException;

/**
 * Preprocessing script to make missing properties nullable
 * in OpenAPI oneOf schemas
 */
class OpenApiPreprocessor
{
    private array $schema;
    private array $routeTypes = ['ProxyRoute', 'RedirectRoute', 'UpstreamRoute'];

    public function __construct(string $schemaPath)
    {
        if (!file_exists($schemaPath)) {
            throw new InvalidArgumentException("Schema file does not exist: {$schemaPath}");
        }

        $content = file_get_contents($schemaPath);
        $content = $this->replaceHTTPAccessPermission($content);
        $this->schema = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        $this->fixAllRefsWithAllOf($this->schema);

        if (!$this->schema) {
            throw new InvalidArgumentException("Unable to parse schema JSON");
        }
    }

    /**
     * Collect all properties of all route types
     */
    private function collectAllRouteProperties(): array
    {
        $allProperties = [];

        foreach ($this->routeTypes as $routeType) {
            if (!isset($this->schema['components']['schemas'][$routeType])) {
                echo "⚠️  Schema '{$routeType}' not found, skipped.\n";
                continue;
            }

            $properties = $this->schema['components']['schemas'][$routeType]['properties'] ?? [];

            foreach ($properties as $propName => $propDefinition) {
                if (!isset($allProperties[$propName])) {
                    $allProperties[$propName] = $propDefinition;
                    echo "✓ Found property: {$propName} (from {$routeType})\n";
                }
            }
        }

        return $allProperties;
    }

    /**
     * Make missing properties nullable for each route type
     */
    public function makePropertiesNullable(): void
    {
        echo "🔍 Collecting properties from all route types...\n";
        $allProperties = $this->collectAllRouteProperties();

        echo "\n📝 Processing route schemas...\n";

        foreach ($this->routeTypes as $routeType) {
            if (!isset($this->schema['components']['schemas'][$routeType])) {
                continue;
            }

            $route = &$this->schema['components']['schemas'][$routeType];
            $existingProperties = $route['properties'] ?? [];
            $addedProperties = [];

            foreach ($allProperties as $propName => $propDefinition) {
                if (!isset($existingProperties[$propName])) {
                    // Create a nullable version of the property
                    $nullableProp = $this->createNullableProperty($propDefinition);
                    $route['properties'][$propName] = $nullableProp;
                    $addedProperties[] = $propName;
                } else {
                    // Check if this property is nullable in any other route type
                    foreach ($this->routeTypes as $otherRouteType) {
                        if ($otherRouteType === $routeType) {
                            continue;
                        }
                        $otherProperties = $this->schema['components']['schemas'][$otherRouteType]['properties'] ?? [];
                        if (isset($otherProperties[$propName]) && ($otherProperties[$propName]['nullable'] ?? false)) {
                            // Make current property nullable if it's not already
                            if (!($existingProperties[$propName]['nullable'] ?? false)) {
                                $route['properties'][$propName]['nullable'] = true;
                                $addedProperties[] =
                                    $propName . " (made nullable because nullable in {$otherRouteType})";
                            }
                            break;
                        }
                    }
                }
            }

            if (!empty($addedProperties)) {
                echo "  → {$routeType}: added " . count($addedProperties) . " nullable properties: " .
                    implode(', ', $addedProperties) . "\n";
            } else {
                echo "  → {$routeType}: no properties added\n";
            }
        }
    }

    /**
     * Create a nullable version of a property
     */
    private function createNullableProperty(array $originalProperty): array
    {
        $nullableProp = $originalProperty;

        // If it's a reference, make it nullable
        if (isset($nullableProp['$ref'])) {
            return [
                'anyOf' => [
                    ['$ref' => $nullableProp['$ref']],
                    ['type' => 'null']
                ],
                'nullable' => true
            ];
        }

        // Otherwise, simply add nullable: true
        $nullableProp['nullable'] = true;

        return $nullableProp;
    }

    /**
     * Optional: Clean required properties that may cause issues
     */
    public function cleanRequiredProperties(): void
    {
        echo "\n🧹 Cleaning required properties...\n";

        foreach ($this->routeTypes as $routeType) {
            if (!isset($this->schema['components']['schemas'][$routeType]['required'])) {
                continue;
            }

            $route = &$this->schema['components']['schemas'][$routeType];
            $required = $route['required'] ?? [];
            $properties = $route['properties'] ?? [];

            // Keep only required properties that are not nullable
            $cleanRequired = array_filter($required, function ($propName) use ($properties) {
                $prop = $properties[$propName] ?? null;
                return $prop && !($prop['nullable'] ?? false);
            });

            $removedCount = count($required) - count($cleanRequired);

            if ($removedCount > 0) {
                $route['required'] = array_values($cleanRequired);
                echo "  → {$routeType}: removed {$removedCount} required properties that became nullable\n";
            }
        }
    }

    /**
     * Save the modified schema
     */
    public function save(string $outputPath): void
    {
        // Transform empty arrays to objects before encoding
        $data = $this->forceEmptyObjects($this->schema);

        // Encode to JSON
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if (file_put_contents($outputPath, $json) === false) {
            throw new RuntimeException("Unable to write file: {$outputPath}");
        }

        echo "\n✅ Modified schema saved: {$outputPath}\n";
    }

    /**
     * Show a report of modifications
     */
    public function showReport(): void
    {
        echo "\n📊 Modification report:\n";

        foreach ($this->routeTypes as $routeType) {
            if (!isset($this->schema['components']['schemas'][$routeType])) {
                continue;
            }

            $properties = $this->schema['components']['schemas'][$routeType]['properties'] ?? [];
            $nullableCount = 0;

            foreach ($properties as $prop) {
                if ($prop['nullable'] ?? false) {
                    $nullableCount++;
                }
            }

            echo "  → {$routeType}: " . count($properties) . " total properties, {$nullableCount} nullable\n";
        }
    }

    /**
     * Add Activity.id field if not exist yet
     * @todo remove if solved: https://lab.plat.farm/sdk/git/-/merge_requests/4006#note_2218419
     */
    public function fixActivityId(): void
    {
        $activity = &$this->schema['components']['schemas']['Activity'];

        // Ensure properties array exists
        if (!isset($activity['properties']) || !is_array($activity['properties'])) {
            $activity['properties'] = [];
        }

        // Add id property if missing
        if (!isset($activity['properties']['id'])) {
            $activity['properties']['id'] = [
                'type' => 'string',
                'title' => 'ID',
            ];
        }

        // Ensure required is an array
        if (!isset($activity['required']) || !is_array($activity['required'])) {
            $activity['required'] = [];
        }

        // Add id to required if not already there
        if (!in_array('id', $activity['required'], true)) {
            $activity['required'][] = 'id';
        }
    }


    /**
     * Add Deployment.id field if not exist yet
     * @todo remove if solved: https://lab.plat.farm/sdk/git/-/merge_requests/4006#note_2218419
     */
    public function fixDeploymentId(): void
    {
        $deployment = &$this->schema['components']['schemas']['Deployment'];

        // Ensure properties array exists
        if (!isset($deployment['properties']) || !is_array($deployment['properties'])) {
            $deployment['properties'] = [];
        }

        // Add id if missing
        if (!isset($deployment['properties']['id'])) {
            $deployment['properties']['id'] = [
                'type' => 'string',
                'title' => 'ID',
            ];
        }

        // Ensure required is an array
        if (!isset($deployment['required']) || !is_array($deployment['required'])) {
            $deployment['required'] = [];
        }

        // Add id in required if not already there
        if (!in_array('id', $deployment['required'], true)) {
            $deployment['required'][] = 'id';
        }
    }

    /**
     * Remove Project->Delete path till it's not exposed public (x-internal: true)
     * @return void
     */
    public function removeProjectDeletePath()
    {
        if (isset($this->schema['paths']['/projects/{projectId}']['delete'])) {
            unset($this->schema['paths']['/projects/{projectId}']['delete']);
        }
    }

    private function replaceHTTPAccessPermission(string $content): string
    {
        return str_replace('HTTP access permissions', 'Http access permissions', $content);
    }

    public function addXReturn(): void
    {
        // Adding x-return info for better processing in the mustache template
        foreach ($this->schema['paths'] as $path => &$methods) {
            preg_match_all('/\{([^\}]+)\}/', $path, $matches);

            foreach ($methods as $httpMethod => &$operation) {
                if (!is_array($operation) || $httpMethod === "parameters") {
                    continue;
                }

                // --- Remove "default": null if $ref exists in requestBody schema ---
                if (isset($operation['requestBody']['content']['application/json']['schema']['properties'])) {
                    $properties = $operation['requestBody']['content']['application/json']['schema']['properties'];
                    foreach ($properties as $key => &$prop) {
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
                        // Only process success codes (2xx or default)
                        if (
                            (!is_numeric($statusCode)
                                || $statusCode < 200
                                || $statusCode > 299
                            ) && $statusCode !== 'default'
                        ) {
                            continue;
                        }

                        $schema = null;
                        $contentTypes = array_keys($resp['content'] ?? []);

                        if (isset($resp['content']['application/json']['schema'])) {
                            $schema = $resp['content']['application/json']['schema'];
                        } elseif (isset($resp['content']['application/problem+json']['schema'])) {
                            $schema = $resp['content']['application/problem+json']['schema'];
                        } elseif (
                            isset($resp['content']['application/pdf']['schema'])
                            || in_array('application/pdf', $contentTypes, true)
                        ) {
                            $schema = ['type' => 'string', 'format' => 'binary'];
                        }

                        if ($schema && is_array($schema)) {
                            if (
                                isset($schema['type'])
                                && $schema['type'] === 'object'
                                && isset($schema['properties']['items']['$ref'])  // <-- Condition plus précise
                            ) {
                                $ref = $schema['properties']['items']['$ref'];
                                $parts = explode('/', $ref);
                                $class = '\\Upsun\\Model\\' . end($parts);
                                $refs = ['refs' => [$class . '[]']];
                            } else {
                                $refs = $this->collectMainRefs($schema, $this->schema);
                            }

                            $returnTypes = array_merge($returnTypes, $refs['refs'] ?? []);
                            $phpDoc = $refs['phpdoc'] ?? null;
                        } else {
                            // If no schema, guess type via content-type
                            if (in_array('application/pdf', $contentTypes, true)) {
                                $returnTypes[] = 'string';
                            } else {
                                $returnTypes[] = 'void';
                            }
                        }
                    }
                }

                // convert void|Error to null|Error
                if (in_array('void', $returnTypes, true) && count($returnTypes) > 1) {
                    $returnTypes = array_map(fn($t) => $t === 'void' ? 'null' : $t, $returnTypes);
                }

                $operation['x-return-types'] = array_values(array_unique($returnTypes));

                // Convert `Model[]` to `array` for union type
                $unionTypes = array_map(function ($t) {
                    return str_ends_with($t, '[]') ? 'array' : $t;
                }, $returnTypes);

                $returnTypeUnion = implode('|', array_values(array_unique($unionTypes)));
                if ($returnTypeUnion) {
                    $operation['x-return-types-union'] = $returnTypeUnion;
                }

                foreach ($returnTypes as $t) {
                    if (str_ends_with($t, '[]') || str_contains($t, 'array<')) {
                        $operation['x-return-types-displayReturn'] = true;
                        break;
                    }
                }

                // Determine if the operation has a real return type
                // Determine if the operation has a real return type
                $hasReturn = false;
                foreach ($operation['responses'] as $statusCode => $resp) {
                    if (
                        (is_numeric($statusCode) && $statusCode >= 200 && $statusCode < 300)
                        || $statusCode === 'default'
                    ) {
                        $content = $resp['content'] ?? [];
                        if (!empty($content)) {
                            $hasReturn = true;
                            break;
                        }
                    }
                }

                $operation['x-phpdoc'] = $phpDoc;
                $operation['x-returnable'] = $hasReturn;
                $operation['x-hasMultipleResponses'] = count($operation['responses'] ?? []) > 1;
            }
        }
    }

    private function collectMainRefs(array $schema, array $spec): array
    {
        $refs = [
            'refs' => [],
            'phpdoc' => [],
        ];

        // Handle $ref directly
        if (isset($schema['$ref'])) {
            $resolved = $this->resolveRef($spec, $schema['$ref']);
            if (
                $resolved
                && isset($resolved['type']) && $resolved['type'] === 'array' && isset($resolved['items']['$ref'])
            ) {
                $parts = explode('/', $resolved['items']['$ref']);
                $class = '\\Upsun\\Model\\' . end($parts);
                $refs['refs'][] = $class . '[]';
                $refs['phpdoc']['return'] = $class . '[]';
            } else {
                $parts = explode('/', $schema['$ref']);
                $class = '\\Upsun\\Model\\' . end($parts);
                $refs['refs'][] = $class;
                $refs['phpdoc']['return'] = $class;
            }
            return $refs;
        }

        // Handle explicit type
        if (isset($schema['type'])) {
            switch ($schema['type']) {
                case 'array':
                    if (isset($schema['items']['$ref'])) {
                        $parts = explode('/', $schema['items']['$ref']);
                        $class = '\\Upsun\\Model\\' . end($parts);
                        $refs['refs'][] = $class . '[]';
                        $refs['phpdoc']['return'] = $class . '[]';
                    } elseif (isset($schema['items']['type'])) {
                        $type = $schema['items']['type'];
                        $refs['refs'][] = $type . '[]';
                        $refs['phpdoc']['return'] = $type . '[]';
                    }
                    return $refs;

                case 'object':
                    // Handle additionalProperties (key-value mapping)
                    if (isset($schema['additionalProperties'])) {
                        $additionalProps = $schema['additionalProperties'];

                        if (isset($additionalProps['$ref'])) {
                            // Case: additionalProperties with $ref
                            $parts = explode('/', $additionalProps['$ref']);
                            $class = '\\Upsun\\Model\\' . end($parts);
                            $refs['refs'][] = "array<string,$class>";
                            $refs['phpdoc']['return'] = "array<string,$class>";
                        } elseif (
                            isset($additionalProps['type'])
                            && $additionalProps['type'] === 'object'
                            && isset($additionalProps['properties'])
                        ) {
                            $refs['phpdoc']['return'] = true;
                        } elseif (isset($additionalProps['type'])) {
                            // Case: additionalProperties with primitive type
                            $type = $additionalProps['type'];
                            $refs['refs'][] = "array<string,$type>";
                            $refs['phpdoc']['return'] = "array<string,$type>";
                        }
                    } elseif (isset($schema['properties'])) {
                        // Handle regular object with defined properties
                        $refs['refs'][] = 'object';
                        $refs['phpdoc']['return'] = 'object';
                    } else {
                        // Generic object
                        $refs['refs'][] = 'object';
                        $refs['phpdoc']['return'] = 'object';
                    }
                    return $refs;

                case 'boolean':
                case 'string':
                case 'integer':
                    $refs['refs'][] = $schema['type'];
                    $refs['phpdoc']['return'] = false;
                    return $refs;
                case 'number':
                    $refs['refs'][] = 'float';
                    $refs['phpdoc']['return'] = false;
                    return $refs;
            }
        }

        return $refs;
    }

    private function resolveRef(array $spec, string $ref)
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
    private function forceEmptyObjects($data)
    {
        if (is_array($data)) {
            if (empty($data)) {
                return new \stdClass();
            }

            $result = [];
            $isAssociative = array_keys($data) !== range(0, count($data) - 1);

            foreach ($data as $key => $value) {
                $result[$key] = $this->forceEmptyObjects($value);
            }

            return $isAssociative && empty($result) ? new \stdClass() : $result;
        }

        return $data;
    }

    public function addResourcePath()
    {
        // ✅ New route
        $path = '/projects/{projectId}/environments/{environmentId}/deployments/next';

        // Check if path does not exist yet
        if (isset($this->schema['paths'][$path])) {
            echo "ℹ️ The path $path already exists — no changes made.\n";
            return;
        }

        if (isset($this->schema['paths'][$path]['patch'])) {
            echo "ℹ️ The PATCH already exists on $path — no changes made.\n";
            return;
        }

        // Add/Update Deployment PATCH
        $this->schema['paths'][$path]['patch'] = [
            'summary' => 'Update the next deployment',
            'description' => 'Update resources for either webapps, services, or workers in the next deployment.',
            'parameters' => [
                [
                    'name' => 'projectId',
                    'in' => 'path',
                    'required' => true,
                    'schema' => ['type' => 'string']
                ],
                [
                    'name' => 'environmentId',
                    'in' => 'path',
                    'required' => true,
                    'schema' => ['type' => 'string']
                ]
            ],
            'requestBody' => [
                'required' => true,
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'webapps' => [
                                    'type' => 'object',
                                    'additionalProperties' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'resources' => [
                                                '$ref' => '#/components/schemas/ResourceConfig'
                                            ],
                                            'instance_count' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'description' => 'Number of instances to run',
                                                'example' => 2
                                            ],
                                            'disk' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'title' => 'Disk Size',
                                                'description' => 'Size of the disk in Bytes',
                                                'example' => 1024
                                            ]
                                        ]
                                    ]
                                ],
                                'services' => [
                                    'type' => 'object',
                                    'additionalProperties' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'resources' => [
                                                '$ref' => '#/components/schemas/ResourceConfig'
                                            ],
                                            'instance_count' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'description' => 'Number of instances to run',
                                                'example' => 1
                                            ],
                                            'disk' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'title' => 'Disk Size',
                                                'description' => 'Size of the disk in Bytes',
                                                'example' => 1024
                                            ]
                                        ]
                                    ]
                                ],
                                'workers' => [
                                    'type' => 'object',
                                    'additionalProperties' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'resources' => [
                                                '$ref' => '#/components/schemas/ResourceConfig'
                                            ],
                                            'instance_count' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'description' => 'Number of instances to run',
                                                'example' => 1
                                            ],
                                            'disk' => [
                                                'type' => 'integer',
                                                'nullable' => true,
                                                'title' => 'Disk Size',
                                                'description' => 'Size of the disk in Bytes',
                                                'example' => 1024
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'responses' => [
                'default' => [
                    'description' => 'Deployment successfully updated',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                '$ref' => "#/components/schemas/AcceptedResponse"
                            ]
                        ]
                    ]
                ]
            ],
            'tags' => ['Deployment'],
            'operationId' => 'update-projects-environments-deployments-next'
        ];

        // ✅ Simplified ResourceConfig
        $this->schema['components']['schemas']['ResourceConfig'] = [
            'type' => 'object',
            'properties' => [
                'profile_size' => [
                    'type' => 'string',
                    'nullable' => true,
                    'description' => 'Profile size (e.g. "0.5", "1", "2")',
                    'example' => '2'
                ]
            ]
        ];
    }

    public function fixAllRefsWithAllOf(mixed &$node): void
    {
        if (is_array($node)) {
            // If this node has a $ref and extra keys, wrap in allOf
            if (isset($node['$ref'])) {
                $extraKeys = array_diff_key($node, ['$ref' => true]);
                if (!empty($extraKeys)) {
                    $refPart = ['$ref' => $node['$ref']];
                    $node = [
                        'allOf' => [
                            $refPart,
                            $extraKeys
                        ]
                    ];
                }
            }

            // Recurse into children
            foreach ($node as &$child) {
                $this->fixAllRefsWithAllOf($child);
            }
        }
        // If scalar (string, number, etc.), do nothing
    }

    public function fixNullableRequired(): void
    {
        foreach ($this->schema['components']['schemas'] as &$schema) {
            foreach ($schema['properties'] ?? [] as $propName => &$prop) {
                if (($prop['nullable'] ?? false) && isset($prop['required'])) {
                    // Remove required fields from nullable objects
                    unset($prop['required']);
                }
            }
        }
    }

    /**
     * Mark properties as DateTime if their OpenAPI format is "date-time"
     */
    public function markDateTimeProperties(): void
    {
        echo "🔍 Marking all date-time properties in all schemas...\n";

        foreach ($this->schema['components']['schemas'] as $schemaName => &$schema) {
            if (array_key_exists('properties', $schema)) {
                foreach ($schema['properties'] as $propName => &$propDefinition) {
                    // Add flag isDateTime if type is string and format is date-time
                    if (
                        ($propDefinition['type'] ?? '') === 'string'
                        && ($propDefinition['format'] ?? '') === 'date-time'
                    ) {
                        $propDefinition['x-isDateTime'] = true;
                        echo "  → {$schemaName}.{$propName} marked as DateTime\n";
                    } else {
                        if (!array_key_exists('$ref', $propDefinition) && $propName != '_links') {
                            $propDefinition['x-isDateTime'] = false;
                        }
                    }
                }
            }
        }

        echo "✅ DateTime marking completed for all schemas.\n";
    }

    public function addRequestBodyExamples(): void
    {
        foreach ($this->schema['paths'] as $path => &$methods) {
            foreach ($methods as $httpMethod => &$operation) {
                if (!is_array($operation) || $httpMethod === 'parameters') {
                    continue;
                }

                $bodySchema = $operation['requestBody']['content']['application/json']['schema'] ?? null;
                if (!$bodySchema) {
                    continue;
                }

                $example = $this->generateExampleFromSchema($bodySchema);
                if ($example === null) {
                    continue;
                }

                // JSON pretty print
                $bodyExample = json_encode($example, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

                // Préparer le format pour PHPDoc : première ligne sans indentation
                $lines = explode("\n", $bodyExample);
                foreach ($lines as $i => &$line) {
                    if ($i > 0) { // do not indent first line
                        $line = '     *      ' . $line;
                    }
                }
                unset($line);

                $operation['x-body-example'] = implode("\n", $lines);
            }
        }
    }


    private function generateExampleFromSchema(array $schema)
    {
        if (isset($schema['example'])) {
            return $schema['example'];
        }

        if (isset($schema['$ref'])) {
            $resolved = $this->resolveRef($this->schema, $schema['$ref']);
            return $this->generateExampleFromSchema($resolved);
        }

        if (($schema['type'] ?? null) === 'object') {
            $result = [];
            foreach ($schema['properties'] ?? [] as $propName => $propSchema) {
                $result[$propName] = $this->generateExampleFromSchema($propSchema);
            }
            return $result;
        }

        if (($schema['type'] ?? null) === 'array') {
            return [
                $this->generateExampleFromSchema($schema['items'] ?? [])
            ];
        }

        return match ($schema['type'] ?? null) {
            'string' => $schema['example'] ?? 'string',
            'integer' => $schema['example'] ?? 0,
            'number' => $schema['example'] ?? 0.0,
            'boolean' => $schema['example'] ?? false,
            default => null,
        };
    }

    public function addOrgAddonsPatch(): void
    {
        $path = '/organizations/{organization_id}/addons';

        // Check if the path already exists
        if (!isset($this->schema['paths'][$path])) {
            echo "⚠️ The path $path does not exist, creating it completely.\n";
            $this->schema['paths'][$path] = [];
        }

        // Add the PATCH operation
        $this->schema['paths'][$path]['patch'] = [
            'summary' => 'Update organization add-ons',
            'description' => 'Updates the add-ons configuration for an organization.',
            'operationId' => 'update-org-addons',
            'tags' => ['Add-ons'],
            'parameters' => [
                [
                    '$ref' => '#/components/parameters/OrganizationIDName'
                ]
            ],
            'requestBody' => [
                'required' => true,
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'user_management' => [
                                    'type' => 'string',
                                    'description' => 'The user management level to apply.',
                                    'enum' => ['standard', 'enhanced'],
                                    'example' => 'standard'
                                ],
                                'support_level' => [
                                    'type' => 'string',
                                    'description' => 'The support level to apply.',
                                    'enum' => ['basic', 'premium'],
                                    'example' => 'basic'
                                ]
                            ],
                            'additionalProperties' => false,
                            'minProperties' => 1 // at least one of the properties must be present
                        ]
                    ]
                ]
            ],
            'responses' => [
                '200' => [
                    'description' => 'Add-ons updated successfully',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/OrganizationAddonsObject'
                            ]
                        ]
                    ]
                ],
                '400' => [
                    'description' => 'Bad Request',
                    'content' => [
                        'application/problem+json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Error'
                            ]
                        ]
                    ]
                ],
                '403' => [
                    'description' => 'Forbidden',
                    'content' => [
                        'application/problem+json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Error'
                            ]
                        ]
                    ]
                ],
                '404' => [
                    'description' => 'Not Found',
                    'content' => [
                        'application/problem+json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Error'
                            ]
                        ]
                    ]
                ]
            ],
            'x-vendor' => 'upsun'
        ];

        echo "✅ PATCH operation added for $path\n";
    }
}


# Main script
try {
    echo "Usage: php preprocess-schema.php <path-to-schema.json> [output-path]\n";
    echo "Example: php preprocess-schema.php ./openapi.json ./openapi-processed.json\n";

    $inputPath = $argv[1] ?? './schema/openapispec-platformsh.json';
    $outputPath = $argv[2] ?? str_replace('.json', '-processed.json', $inputPath);

    echo "🚀 Starting OpenAPI schema preprocessing\n";
    echo "📁 Input: {$inputPath}\n";
    echo "📁 Output: {$outputPath}\n\n";

    $preprocessor = new OpenApiPreprocessor($inputPath);

    // Main processing
    $preprocessor->makePropertiesNullable();

    // Set DateTime flag on properties
    $preprocessor->markDateTimeProperties();

    // Optional: clean required properties
    $preprocessor->cleanRequiredProperties();

    // Add Activity.id
    $preprocessor->fixActivityId();

    // Add Deployment.id
    $preprocessor->fixDeploymentId();

    // Add addons update path (PATCH)
    $preprocessor->addOrgAddonsPatch();

    // Remove Project->delete path
    $preprocessor->removeProjectDeletePath();

    // Add x-return-* properties
    $preprocessor->addXReturn();

    // Add deployment/next path for managing resources
    $preprocessor->addResourcePath();

    // Fix nullable/required
    $preprocessor->fixNullableRequired();


    // Add bodyParam examples for curl docs (need to be the last)
    $preprocessor->addRequestBodyExamples();

    // Save
    $preprocessor->save($outputPath);

    // Report
    $preprocessor->showReport();

    echo "\n🎉 Preprocessing completed successfully!\n";
    echo "You can now use '{$outputPath}' with openapi-generator-cli\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
