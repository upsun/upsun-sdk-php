<?php

require __DIR__ . '/vendor/autoload.php';

use Upsun\UpsunConfig;
use Upsun\UpsunClient;

$config = new UpsunConfig(apiToken: getenv('UPSUN_API_TOKEN'));
$client = new UpsunClient($config);

$organizations = $client->organizations->list();

$projects = $client->organizations->listProjects('<organizationId>');

$project = $client->projects->get('<projectId>');

// without explicit parameters
$project = $client->projects->create(
    '<organizationId>',
    'eu-5.platform.sh',
    'Project title',
    'main',
);

// with explicit parameters
$response = $client->projects->update(
    projectId: '<projectId>',
    title: 'new Title',
    description: 'Description'
);

$client->projects->delete('<projectId>');
