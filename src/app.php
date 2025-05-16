<?php
require __DIR__ . '/../vendor/autoload.php';

use Upsun\UpsunClient;
use Upsun\UpsunConfig;

$config = new UpsunConfig(apiKey: '');
$upsun = new UpsunClient($config);

// // List organizations
$orgs = $upsun->organization->list();

//$proj = $upsun->project->get('qxnhlj2qfqfhg');

// $organizations = $upsun->organization->list();

// // List projects for a specific organization
// $organizationId = '12345';
// $projects = $upsun->project->list($organizationId);<