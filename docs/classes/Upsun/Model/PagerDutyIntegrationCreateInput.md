# PagerDutyIntegrationCreateInput

Low level PagerDutyIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\PagerDutyIntegrationCreateInput`
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

### routingKey

```php
private string $routingKey
```

***

## Methods

### __construct

```php
public __construct(string $type, string $routingKey): mixed
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$type`       | **string** |             |
| `$routingKey` | **string** |             |

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

```php
public getType(): string
```

***

### getRoutingKey

The PagerDuty routing key

```php
public getRoutingKey(): string
```

***
