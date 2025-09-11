<?php

$file = __DIR__ . '/../../schema/openapispec-platformsh.json';
$outputFile = __DIR__ . '/../../schema/openapispec-platformsh-with-resources.json';

// Charger le JSON
$spec = json_decode(file_get_contents($file), true);
if ($spec === null) {
    die("Error : JSON $file is not valid\n");
}

// ✅ Nouvelle route
$path = '/projects/{projectId}/environments/{environmentId}/deployments/next';

// check path does not exist encore
if (!isset($spec['paths'][$path])) {
    $spec['paths'][$path] = [];
}

if (isset($spec['paths'][$path]['patch'])) {
    echo "ℹ️ The PATCH already exists on $path — no changes made.\n";
    exit(0);
}

// add/update Deployment PATCH
$spec['paths'][$path]['patch'] = [
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
                                        'description' => 'Size of the disk.',
                                        'example' => 1
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
                                        'description' => 'Size of the disk.',
                                        'example' => 1
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
                                        'description' => 'Size of the disk.',
                                        'example' => 1
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

// Initialiser components/schemas s'il n'existe pas
if (!isset($spec['components'])) {
    $spec['components'] = [];
}
if (!isset($spec['components']['schemas'])) {
    $spec['components']['schemas'] = [];
}

// ✅ ResourceConfig simplifié
$spec['components']['schemas']['ResourceConfig'] = [
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

// save file
file_put_contents($outputFile, json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "✅ PATCH ajouté à $path dans $outputFile\n";
