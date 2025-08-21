> [!CAUTION]
> **This project is owned by the Upsun Advocacy team. It is in an early stage of development [experimental] and should be used with caution by Upsun customers/community. <br /><br />
> This project is not officially supported by Upsun and does not fall under any Support plans. Use this repository at your own risk — it is provided without guarantees or warranties!**
>
> Don’t hesitate to join our [Discord](https://discord.com/invite/platformsh) to share your thoughts about this project.

# Upsun SDK PHP

The official **Upsun SDK for PHP**.  
This SDK provides a PHP interface that maps to the Upsun CLI commands. For more information, see the [Upsun documentation](https://docs.upsun.com).

## Installation

Install the Upsun SDK with Composer:

```bash
composer require upsun/upsun-sdk-php
```

Then, require it in your PHP application.

## Usage

To use this Upsun SDK, you first need to [create an Upsun API Token](https://docs.upsun.com/administration/cli/api-tokens.html#2-create-an-api-token)
and store it securely (we recommend using environment variables).

In your PHP code:
1. Initialize an `UpsunConfig` object with your Upsun API token.
1. Pass it to an `UpsunClient` instance.
1. Interact with your Upsun entities according to your permissions.

Example:

```php
require __DIR__ . '/../vendor/autoload.php';

use Upsun\UpsunClient;
use Upsun\UpsunConfig;

$config = new UpsunConfig(apiToken: '<UPSUN_API_TOKEN>'); // Ideally use an environment variable
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
    'description' => 'description' // see vendor/upsun/upsun-sdk-php/src/Model/Project.php for more option
];
$response = $upsun->project->update($projectId, $projectData);

// Delete a project
$organizationId = '12345';
$projectId = $project->getId();
$upsun->project->delete($projectId);
// OR
$upsun->organization->deleteProject($organizationId, $projectId);
```

All CRUD operations follow the same structure.

## Development

Clone repository:
```bash
git clone git@github.com:upsun/upsun-sdk-php.git
```

Install Dependencies:
```bash
cd upsun-sdk-php
composer install
```

## Rules: 
 - all classes inside the ``src/Tasks/`` folder **can be modified**.
 - all classes inside the ``src/Model/`` and ``src/API`` folders are **auto-generated** from the [Upsun API Specs](https://proxy.upsun.com/docs/openapispec-platformsh.json), stored in `schema/`. 
   These are generated using [``@openapitools/openapi-generator-cli``](https://www.npmjs.com/package/%40openapitools/openapi-generator-cli) with the following commands:
   ```shell
   PKG="."
   npm install @openapitools/openapi-generator-cli --save-dev
   npx openapi-generator-cli generate \
     -i ./schema/openapispec-platformsh.json \
     -g php \
     -o "$PKG" \
     --additional-properties="apiPackage=$PKG,invokerPackage=Upsun,apiPackage=Api,modelPackage=Model,srcBasePath=src,testPath=tests" &> /dev/null \
     --library="psr-18" 
   ```

## Architecture of this SDK

The SDK is built as follows:

* From the [JSON specs of our API](https://proxy.upsun.com/docs/openapispec-platformsh.json)
* Using [``@openapitools/openapi-generator-cli``](https://www.npmjs.com/package/%40openapitools/openapi-generator-cli)
* Which generates:
  * PHP **Models** (in `src/Model/`)
  * PHP **APIs** (in `src/Api/`)
* Higher-level PHP **Tasks** (in `src/Tasks/`)

![Architecture of the SDK](./assets/images/sdk-schema.png)

## OpenApiGenerator README
For the full OpenAPI generator documentation, see [the offical documentation page](https://www.npmjs.com/package/%40openapitools/openapi-generator-cli).

## Contributing

Contributions are welcome!<br>
Please open a [pull request](https://github.com/upsun/upsun-sdk-php/compare) or an [issue](https://github.com/upsun/upsun-sdk-php/issues/new)
for any improvements, bug fixes, or new features.

## License

This project is licensed under the Apache 2.0 License.<br>
See the [LICENSE](./LICENSE) file for more details.