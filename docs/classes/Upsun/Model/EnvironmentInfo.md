# EnvironmentInfo

Low level EnvironmentInfo (auto-generated)

The environment information

***

* Full name: `\Upsun\Model\EnvironmentInfo`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private string $name
```

***

### status

```php
private string $status
```

***

### isMain

```php
private bool $isMain
```

***

### isProduction

```php
private bool $isProduction
```

***

### constraints

```php
private object $constraints
```

***

### reference

```php
private string $reference
```

***

### machineName

```php
private string $machineName
```

***

### environmentType

```php
private string $environmentType
```

***

### links

```php
private object $links
```

***

## Methods

### __construct

```php
public __construct(string $name, string $status, bool $isMain, bool $isProduction, object $constraints, string $reference, string $machineName, string $environmentType, object $links): mixed
```

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$name`            | **string** |             |
| `$status`          | **string** |             |
| `$isMain`          | **bool**   |             |
| `$isProduction`    | **bool**   |             |
| `$constraints`     | **object** |             |
| `$reference`       | **string** |             |
| `$machineName`     | **string** |             |
| `$environmentType` | **string** |             |
| `$links`           | **object** |             |

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

### getName

The machine name of the environment

```php
public getName(): string
```

***

### getStatus

The enviroment status

```php
public getStatus(): string
```

***

### getIsMain

Is this environment the main environment

```php
public getIsMain(): bool
```

***

### getIsProduction

Is this environment a production environment

```php
public getIsProduction(): bool
```

***

### getConstraints

Constraints of the environment's deployment

```php
public getConstraints(): object
```

***

### getReference

The reference in Git for this environment

```php
public getReference(): string
```

***

### getMachineName

The machine name of the environment

```php
public getMachineName(): string
```

***

### getEnvironmentType

The type of environment (Production, Staging or Development)

```php
public getEnvironmentType(): string
```

***

### getLinks

```php
public getLinks(): object
```

***
