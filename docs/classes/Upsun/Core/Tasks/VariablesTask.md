# VariablesTask

VariablesTask class.

***

* Full name: `\Upsun\Core\Tasks\VariablesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### projectVariablesApi

```php
private \Upsun\Api\ProjectVariablesApi $projectVariablesApi
```

***

### environmentVariablesApi

```php
private \Upsun\Api\EnvironmentVariablesApi $environmentVariablesApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ProjectVariablesApi $projectVariablesApi, \Upsun\Api\EnvironmentVariablesApi $environmentVariablesApi): mixed
```

**Parameters:**

| Parameter                  | Type                                   | Description |
|----------------------------|----------------------------------------|-------------|
| `$client`                  | **\Upsun\UpsunClient**                 |             |
| `$projectVariablesApi`     | **\Upsun\Api\ProjectVariablesApi**     |             |
| `$environmentVariablesApi` | **\Upsun\Api\EnvironmentVariablesApi** |             |

***

### createProjectVariable

Adds a project variable

```php
public createProjectVariable(string $projectId, string $name, string $value, ?array $attributes = [], ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = []): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$name`             | **string** |             |
| `$value`            | **string** |             |
| `$attributes`       | **?array** |             |
| `$isJson`           | **?bool**  |             |
| `$isSensitive`      | **?bool**  |             |
| `$visibleBuild`     | **?bool**  |             |
| `$visibleRuntime`   | **?bool**  |             |
| `$applicationScope` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectVariable

Deletes a project variable

```php
public deleteProjectVariable(string $projectId, string $projectVariableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectVariable

Gets a project variable

```php
public getProjectVariable(string $projectId, string $projectVariableId): \Upsun\Model\ProjectVariable
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectVariables

Gets list of project variables

```php
public listProjectVariables(string $projectId): \Upsun\Model\ProjectVariable[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateProjectVariable

Updates a project variable

```php
public updateProjectVariable(string $projectId, string $projectVariableId, ?string $name = null, ?string $value = null, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$projectId`         | **string**  |             |
| `$projectVariableId` | **string**  |             |
| `$name`              | **?string** |             |
| `$value`             | **?string** |             |
| `$attributes`        | **?array**  |             |
| `$isJson`            | **?bool**   |             |
| `$isSensitive`       | **?bool**   |             |
| `$visibleBuild`      | **?bool**   |             |
| `$visibleRuntime`    | **?bool**   |             |
| `$applicationScope`  | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createEnvironmentVariable

Adds an environment variable

```php
public createEnvironmentVariable(string $projectId, string $environmentId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$environmentId`    | **string** |             |
| `$name`             | **string** |             |
| `$value`            | **string** |             |
| `$attributes`       | **?array** |             |
| `$isJson`           | **?bool**  |             |
| `$isSensitive`      | **?bool**  |             |
| `$visibleBuild`     | **?bool**  |             |
| `$visibleRuntime`   | **?bool**  |             |
| `$applicationScope` | **?array** |             |
| `$isEnabled`        | **?bool**  |             |
| `$isInheritable`    | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteEnvironmentVariable

Deletes an environment variable

```php
public deleteEnvironmentVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getEnvironmentVariable

Gets an environment variable

```php
public getEnvironmentVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\EnvironmentVariable
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listEnvironmentVariables

Lists environment variables

```php
public listEnvironmentVariables(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateEnvironmentVariable

Updates an environment variable

```php
public updateEnvironmentVariable(string $projectId, string $environmentId, string $variableId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$environmentId`    | **string** |             |
| `$variableId`       | **string** |             |
| `$name`             | **string** |             |
| `$value`            | **string** |             |
| `$attributes`       | **?array** |             |
| `$isJson`           | **?bool**  |             |
| `$isSensitive`      | **?bool**  |             |
| `$visibleBuild`     | **?bool**  |             |
| `$visibleRuntime`   | **?bool**  |             |
| `$applicationScope` | **?array** |             |
| `$isEnabled`        | **?bool**  |             |
| `$isInheritable`    | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client): mixed
```

**Parameters:**

| Parameter | Type                   | Description |
|-----------|------------------------|-------------|
| `$client` | **\Upsun\UpsunClient** |             |

***

### normalizeFilter

```php
protected normalizeFilter(array|string|int|\DateTime|null $value): array
```

**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **array\|string\|int\|\DateTime\|null** |             |

***

### extractSubscriptionId

Get SubscriptionId of a Project Licence Uri

```php
protected extractSubscriptionId(string $projectLicenceUri): string
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectLicenceUri` | **string** |             |

***
