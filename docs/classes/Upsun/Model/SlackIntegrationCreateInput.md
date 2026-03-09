# SlackIntegrationCreateInput

Low level SlackIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\SlackIntegrationCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationCreateInput`](./IntegrationCreateInput.md)

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### token

```php
private string $token
```

***

### channel

```php
private string $channel
```

***

## Methods

### __construct

```php
public __construct(string $type, string $token, string $channel): mixed
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$type`    | **string** |             |
| `$token`   | **string** |             |
| `$channel` | **string** |             |

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

### getToken

The Slack token to use

```php
public getToken(): string
```

***

### getChannel

The Slack channel to post messages to

```php
public getChannel(): string
```

***
