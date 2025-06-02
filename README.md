# Upsun SDK PHP

Upsun SDK for PHP.  
This SDK maps the Upsun CLI commands. For more information, read [the documentation](https://docs.upsun.com).

## Installation

To install the Upsun SDK, you can use Composer. Run the following command in your terminal:

```bash
composer require upsun/upsun-sdk-php
```

## Usage

To use the Upsun SDK, you need to initialize the `Upsun` class with your API key and connection URL. Here's an example:

```php
require 'vendor/autoload.php';

use Upsun\Upsun;
use Upsun\UpsunConfig;

$config = new UpsunConfig(apiKey: '');
$upsun = new Upsun($config);

// List organizations
$organizations = $upsun->organization->listOrgs();

// List projects for a specific organization
$organizationId = '12345';
$projects = $upsun->organization->listOrgProjects($organizationId);

// Create a project in a specific organization
$organizationId = '12345';
$subscription = $upsun->organization->createOrgSubscription(
  $organizationId,
  [
    'owner' => '<upsunUserId>',
    'project_title' => 'title',
    'project_region' => 'eu-5.platform.sh',
    'default_branch' => 'main',
  ]
);

// Get a specific project
$projectId = $subscription->getProjectId();
$projects = $upsun->project->getProjects($projectId);

// Update a project
$projectId = $subscription->getProjectId();
$projectData = [
  'title' => 'title',
  'description' => 'description' // see vendor/upsun/upsun-sdk-php/apisgen/lib/Model/Project.php for more info
];
$projects = $upsun->project->updateProjects($projectId, $projectData);

// Delete a project
$organizationId = '12345';
$projectId = $subscription->getProjectId();
$projects = $upsun->organization->deleteOrgSubscription($organizationId, $projectId);
```

All CRUD operations respect the same structure.

## Devel

Clone repository:
```bash
git clone git@github.com:upsun/upsun-sdk-php.git
```

Install Dep:
```bash
composer install
```

Generate API Client (Low-level) base on OpenAPI spec.
```bash
./scripts/gen_php.sh
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## License

This project is licensed under the Apache V2 License. See the LICENSE file for more details.
