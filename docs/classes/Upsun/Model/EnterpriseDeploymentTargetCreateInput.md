# EnterpriseDeploymentTargetCreateInput

Low level EnterpriseDeploymentTargetCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\EnterpriseDeploymentTargetCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### name

```php
private string $name
```

***

### siteUrls

```php
private ?object $siteUrls
```

***

### sshHosts

```php
private ?array $sshHosts
```

***

### enterpriseEnvironmentsMapping

```php
private ?object $enterpriseEnvironmentsMapping
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, ?object $siteUrls = null, ?array $sshHosts = [], ?object $enterpriseEnvironmentsMapping = null): mixed
```

**Parameters:**

| Parameter                        | Type        | Description |
|----------------------------------|-------------|-------------|
| `$type`                          | **string**  |             |
| `$name`                          | **string**  |             |
| `$siteUrls`                      | **?object** |             |
| `$sshHosts`                      | **?array**  |             |
| `$enterpriseEnvironmentsMapping` | **?object** |             |

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

### getType

The type of the deployment target.

```php
public getType(): string
```

***

### getName

The name of the deployment target.

```php
public getName(): string
```

***

### getSiteUrls

```php
public getSiteUrls(): ?object
```

***

### getSshHosts

```php
public getSshHosts(): ?array
```

***

### getEnterpriseEnvironmentsMapping

Mapping of clusters to Enterprise applications

```php
public getEnterpriseEnvironmentsMapping(): ?object
```

***
