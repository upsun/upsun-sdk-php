# CustomDomains

Low level CustomDomains (auto-generated)

***

* Full name: `\Upsun\Model\CustomDomains`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private bool $enabled
```

***

### environmentsWithDomainsLimit

```php
private int $environmentsWithDomainsLimit
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, int $environmentsWithDomainsLimit): mixed
```

**Parameters:**

| Parameter                       | Type     | Description |
|---------------------------------|----------|-------------|
| `$enabled`                      | **bool** |             |
| `$environmentsWithDomainsLimit` | **int**  |             |

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

### getEnabled

If true, custom domains can be added to the project.

```php
public getEnabled(): bool
```

***

### getEnvironmentsWithDomainsLimit

Limit on the amount of non-production environments that can have domains set

```php
public getEnvironmentsWithDomainsLimit(): int
```

***
