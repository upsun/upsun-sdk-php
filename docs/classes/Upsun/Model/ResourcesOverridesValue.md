# ResourcesOverridesValue

Low level ResourcesOverridesValue (auto-generated)

***

* Full name: `\Upsun\Model\ResourcesOverridesValue`
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

### redeployedStart

```php
private bool $redeployedStart
```

***

### redeployedEnd

```php
private bool $redeployedEnd
```

***

### startsAt

```php
private ?\DateTime $startsAt
```

***

### endsAt

```php
private ?\DateTime $endsAt
```

***

## Methods

### __construct

```php
public __construct(array $services, bool $redeployedStart, bool $redeployedEnd, ?\DateTime $startsAt, ?\DateTime $endsAt): mixed
```

**Parameters:**

| Parameter          | Type           | Description |
|--------------------|----------------|-------------|
| `$services`        | **array**      |             |
| `$redeployedStart` | **bool**       |             |
| `$redeployedEnd`   | **bool**       |             |
| `$startsAt`        | **?\DateTime** |             |
| `$endsAt`          | **?\DateTime** |             |

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
public getServices(): \Upsun\Model\PreServiceResourcesOverridesValue[]
```

***

### getStartsAt

```php
public getStartsAt(): ?\DateTime
```

***

### getEndsAt

```php
public getEndsAt(): ?\DateTime
```

***

### getRedeployedStart

```php
public getRedeployedStart(): bool
```

***

### getRedeployedEnd

```php
public getRedeployedEnd(): bool
```

***
