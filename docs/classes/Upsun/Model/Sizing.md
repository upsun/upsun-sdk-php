# Sizing

Low level Sizing (auto-generated)

The environment sizing configuration

***

* Full name: `\Upsun\Model\Sizing`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### services

```php
private array $services
```

***

### webapps

```php
private array $webapps
```

***

### workers

```php
private array $workers
```

***

## Methods

### __construct

```php
public __construct(array $services, array $webapps, array $workers): mixed
```

**Parameters:**

| Parameter   | Type      | Description |
|-------------|-----------|-------------|
| `$services` | **array** |             |
| `$webapps`  | **array** |             |
| `$workers`  | **array** |             |

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

### getServices

```php
public getServices(): \Upsun\Model\ServicesValue1[]
```

***

### getWebapps

```php
public getWebapps(): \Upsun\Model\ServicesValue1[]
```

***

### getWorkers

```php
public getWorkers(): \Upsun\Model\ServicesValue1[]
```

***
