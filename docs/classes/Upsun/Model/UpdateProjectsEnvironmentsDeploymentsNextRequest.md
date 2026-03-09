# UpdateProjectsEnvironmentsDeploymentsNextRequest

Low level UpdateProjectsEnvironmentsDeploymentsNextRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### webapps

```php
private ?array $webapps
```

***

### services

```php
private ?array $services
```

***

### workers

```php
private ?array $workers
```

***

## Methods

### __construct

```php
public __construct(?array $webapps = [], ?array $services = [], ?array $workers = []): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$webapps`  | **?array** |             |
| `$services` | **?array** |             |
| `$workers`  | **?array** |             |

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getWebapps

```php
public getWebapps(): \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestWebappsValue[]|null
```

***

### getServices

```php
public getServices(): \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestServicesValue[]|null
```

***

### getWorkers

```php
public getWorkers(): \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestWorkersValue[]|null
```

***
