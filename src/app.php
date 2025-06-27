<?php
require __DIR__ . '/../vendor/autoload.php';

use Upsun\UpsunClient;
use Upsun\UpsunConfig;

$config = new UpsunConfig(apiKey: '');
$upsun = new UpsunClient($config);

// List organizations
$organizations = $upsun->organization->list();

// List projects for a specific organization
$organizationId = '12345';
$projects = $upsun->organization->listProjects($organizationId);

// Create a project in a specific organization
$organizationId = '12345';
$project = $upsun->project->create(
    $organizationId,
    [
        'owner' => '<upsunUserId>',
        'project_title' => 'title',
        'project_region' => 'eu-5.platform.sh',
        'default_branch' => 'main',
    ]
);

// Get a specific project
$projectId = $project->getId();
$project = $upsun->project->get($projectId);

// Update a project
$projectId = $project->getId();
$projectData = [
    'title' => 'title',
    'description' => 'description' // see vendor/upsun/upsun-sdk-php/apisgen/lib/Model/Project.php for more info
];
$response = $upsun->project->update($projectId, $projectData);

// Delete a project
$organizationId = '12345';
$projectId = $project->getId();
$upsun->project->delete($projectId);
// OR
$upsun->organization->deleteProject($organizationId, $projectId);
