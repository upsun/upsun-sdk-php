<?php
require __DIR__ . '/../vendor/autoload.php';

use Upsun\Upsun;
use Upsun\UpsunConfig;

$config = new UpsunConfig(apiKey: '');
$upsun = new Upsun($config);

// List organizations
$organizations = $upsun->organization->list();

// List projects for a specific organization
$organizationId = '12345';
$projects = $upsun->project->list($organizationId);