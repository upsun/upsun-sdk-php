# EnvironmentInitializeInput

Low level EnvironmentInitializeInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentInitializeInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### profile

```php
private string $profile
```

***

### repository

```php
private string $repository
```

***

### files

```php
private array $files
```

***

### config

```php
private ?string $config
```

***

### resources

```php
private ?\Upsun\Model\Resources4 $resources
```

***

## Methods

### __construct

```php
public __construct(string $profile, string $repository, array $files, ?string $config, ?\Upsun\Model\Resources4 $resources): mixed
```

**Parameters:**

| Parameter     | Type                         | Description |
|---------------|------------------------------|-------------|
| `$profile`    | **string**                   |             |
| `$repository` | **string**                   |             |
| `$files`      | **array**                    |             |
| `$config`     | **?string**                  |             |
| `$resources`  | **?\Upsun\Model\Resources4** |             |

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

### getProfile

Name of the profile to show in the UI

```php
public getProfile(): string
```

***

### getRepository

Repository to clone from

```php
public getRepository(): string
```

***

### getConfig

Repository to clone the configuration files from

```php
public getConfig(): ?string
```

***

### getFiles

A list of files to add to the repository during initialization

```php
public getFiles(): \Upsun\Model\FilesInner[]
```

***

### getResources

```php
public getResources(): ?\Upsun\Model\Resources4
```

***
