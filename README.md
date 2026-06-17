# Upsun SDK PHP

The official **Upsun SDK for PHP**. This SDK provides a PHP interface that maps to the Upsun CLI commands.

For more information, read [the documentation](https://docs.upsun.com/api).


> **CAUTION**:
> This project is currently in **Beta**, meaning features and APIs may evolve over time.
>
> Please report bugs or request new features by creating a GitHub issue.

## Installation

Install the SDK via Composer:

```bash
composer require upsun/upsun-sdk-php
```

> **Important**:
> This SDK relies on PSR interfaces and requires a **PSR-18 HTTP client** implementation at runtime.
> If your project does not already provide one, install a compatible client, for example:
>
> ```bash
> composer require symfony/http-client
> ```

Then include Composer's autoloader in your PHP application:

```php
require __DIR__ . '/vendor/autoload.php';
```

## Authentication

You will need an [Upsun API token](https://developer.upsun.com/cli/api-tokens) to use this SDK.
Store it securely, preferably in an environment variable.

### With an API token (default)

Use this outside of an Upsun runtime, authenticating with your API token.

```php
use Upsun\UpsunConfig;
use Upsun\UpsunClient;

$config = new UpsunConfig(apiToken: getenv('UPSUN_API_TOKEN'));
$upsunClient = new UpsunClient($config);
```

### With the local token service (inside an Upsun container)

Inside an Upsun runtime container, a local token service is exposed on
`http://localhost:8200`. Point `auth_url` to `UpsunConfig::LOCAL_AUTH` and the SDK
authenticates with the `client_credentials` grant automatically (no API token
required). You may optionally request a token lifetime via `tokenTtl` (60-900 seconds).

```php
use Upsun\UpsunConfig;
use Upsun\UpsunClient;

$config = new UpsunConfig(
    auth_url: UpsunConfig::LOCAL_AUTH,
    tokenTtl: 900, // optional, 60-900 seconds
);
$upsunClient = new UpsunClient($config);
```

## Usage

### Example: List organizations

```php
$organizations = $upsunClient->organizations->list();
```

### Example: List projects in an organization

```php
$projects = $upsunClient->projects->list('<organizationId>');
```

### Example: Redeploy an environment

```php
$response = $upsunClient->environments->redeploy('<projectId>', '<environmentId>');
```

---

## Development

Clone the repository and install dependencies:

```bash
git clone git@github.com:upsun/upsun-sdk-php.git
composer install
```

## Architecture of this SDK

The SDK is built as follows:

* From the [JSON specs of our API](https://meta.upsun.com/openapi-spec)
* Using [``@openapitools/openapi-generator-cli``](https://www.npmjs.com/package/%40openapitools/openapi-generator-cli)
* Which generates:
  * PHP **Models** (in `src/Model/`)
  * PHP **APIs** (in `src/Api/`)
* Higher-level PHP (Facade) oriented **Tasks** (in `src/Core/Tasks/`)

### Regenerating API & Model classes

API and Model classes are generated using [openapi-generator-cli](https://openapi-generator.tech)
from the [Upsun OpenAPI spec](https://meta.upsun.com/openapi-spec).

```bash
composer run spec:install
composer run spec:full
```

## Contributing

Contributions are welcome!<br>
Please open a [pull request](https://github.com/upsun/upsun-sdk-php/compare) or an [issue](https://github.com/upsun/upsun-sdk-php/issues/new)
for any improvements, bug fixes, or new features.

## Publishing
To generate a new version of the Upsun SDK PHP and automatically publish it on https://packagist.org

1. update your local
```bash
git fetch
git checkout main
git pull
```
2. check existing tags on https://github.com/upsun/upsun-sdk-php/tags
3. create a new tag from your local
```bash
git tag v<x.y.z>
git push --tag
```
4. Go on release page: https://github.com/upsun/upsun-sdk-php/releases
5. create a new release based on the previously created tag (Do not forget to autogenerate description in the form)
6. check publishing action status: https://github.com/upsun/upsun-sdk-php/actions 
7. check new release version on https://packagist.org/packages/upsun/upsun-sdk-php 

## Tests

To run the tests, use:

```bash
composer install
composer run test
```

## License

This project is licensed under the Apache License 2.0. See the [LICENSE](https://github.com/upsun/upsun-sdk-php/blob/main/LICENSE) and [NOTICE](https://github.com/upsun/upsun-sdk-php/blob/main/NOTICE) files for details.
