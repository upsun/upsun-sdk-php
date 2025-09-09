<?php

$file = __DIR__ . '/../../schema/openapispec-platformsh.json';
$outputFile = __DIR__ . '/../../schema/openapispec-platformsh-with-resources.json';

// Charger le JSON
$spec = json_decode(file_get_contents($file), true);
if ($spec === null) {
    die("Error : JSON $file is not valid\n");
}

$path = '/projects/{projectId}/environments/{environmentId}/deployments/{deploymentId}';

// check path does not exist yet
if (!isset($spec['paths'][$path])) {
    die("Erreur : endpoint $path does not exist\n");
}

if (isset($spec['paths'][$path]['patch'])) {
    echo "ℹ️ The PATCH already exists on $path — no changes made.\n";
    exit(0);
}

// add/update Deployment PATCH
$spec['paths'][$path]['patch'] = [
    'summary' => 'Update a deployment',
    'description' => 'Update resources for either webapps, services, or workers.',
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
        ],
        [
            'name' => 'deploymentId',
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
                    'oneOf' => [
                        ['$ref' => '#/components/schemas/WebappsUpdate'],
                        ['$ref' => '#/components/schemas/ServicesUpdate'],
                        ['$ref' => '#/components/schemas/WorkersUpdate'],
                    ],
                    'example' => [
                        'webapps' => [
                            'app' => [
                                'resources' => [
                                    'profile_size' => '2',
                                    'container_profile' => 'CPU-optimized',
                                    'instance_count' => 3
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'responses' => [
        '200' => [
            'description' => 'Deployment successfully updated',
            'content' => [
                'application/json' => [
                    'schema' => [
                        'type' => 'object',
                        'properties' => [
                            'status' => ['type' => 'string', 'example' => 'OK'],
                            'code'   => ['type' => 'integer', 'example' => 200],
                        ]
                    ]
                ]
            ]
        ]
    ],
    'tags' => ['Deployment'],
    'operationId' => 'update-projects-environments-deployments'
];


// Add schema
$spec['components']['schemas']['ResourceConfig'] ??= [
    'type' => 'object',
    'properties' => [
        'profile_size' => [
            'type' => 'string',
            'description' => 'Profile size (e.g. "0.5", "1", "2")',
            'example' => '2'
        ],
        'container_profile' => [
            'type' => 'string',
            'description' => 'Container profile (e.g. "CPU-optimized", "Memory-optimized")',
            'example' => 'CPU-optimized'
        ],
        'instance_count' => [
            'type' => 'integer',
            'description' => 'Number of instances to run',
            'example' => 3
        ]
    ]
];

$spec['components']['schemas']['WebappsUpdate'] ??= [
    'type' => 'object',
    'properties' => [
        'webapps' => [
            'type' => 'object',
            'additionalProperties' => [
                'type' => 'object',
                'properties' => [
                    'resources' => ['$ref' => '#/components/schemas/ResourceConfig']
                ]
            ]
        ]
    ]
];

$spec['components']['schemas']['ServicesUpdate'] ??= [
    'type' => 'object',
    'properties' => [
        'services' => [
            'type' => 'object',
            'additionalProperties' => [
                'type' => 'object',
                'properties' => [
                    'resources' => ['$ref' => '#/components/schemas/ResourceConfig']
                ]
            ]
        ]
    ]
];

$spec['components']['schemas']['WorkersUpdate'] ??= [
    'type' => 'object',
    'properties' => [
        'workers' => [
            'type' => 'object',
            'additionalProperties' => [
                'type' => 'object',
                'properties' => [
                    'resources' => ['$ref' => '#/components/schemas/ResourceConfig']
                ]
            ]
        ]
    ]
];

// save file
file_put_contents($outputFile, json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "✅ PATCH ajouté à $path dans $file\n";
