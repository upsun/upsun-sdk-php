> [!CAUTION]
> **This project is owned by the Upsun Advocacy team. It is in early stage of development [experimental] and only intended to be used with caution by Upsun customers/community.   <br /><br />This project is not supported by Upsun and does not qualify for Support plans. Use this repository at your own risks, it is provided without guarantee or warranty!**
> Don’t hesitate to join our [Discord](https://discord.com/invite/platformsh) to share your thoughts about this project.

# Upsun SDK PHP

Upsun SDK for PHP.
This SDK maps the Upsun CLI commands. For more information, read [the documentation](https://docs.upsun.com).

## Installation

To install the Upsun SDK, you can use Composer. Run the following command in your terminal:

```bash
composer require upsun/upsun-sdk-php
```

Then add in your `composer.json` call to `gen_php.sh` script:

```json {location="composer.json"}
{
  "scripts": {
    "post-install-cmd": [
      "@gen-open-api-sdk"
    ],
    "post-update-cmd": [
      "@gen-open-api-sdk"
    ],
    "gen-open-api-sdk": "cd ./vendor/upsun/upsun-sdk-php && bash ./scripts/gen_php.sh"
  }
}

```

## Usage

To use the Upsun SDK, you need to initialize the `Upsun` class with your API key and connection URL. Here's an example:

```php
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
