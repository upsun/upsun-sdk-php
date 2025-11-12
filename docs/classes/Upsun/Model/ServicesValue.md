# ServicesValue

Low level ServicesValue (auto-generated)

***

* Full name: `\Upsun\Model\ServicesValue`
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

### size

```php
private string $size
```

***

### access

```php
private object $access
```

***

### configuration

```php
private object $configuration
```

***

### relationships

```php
private array $relationships
```

***

### disk

```php
private ?int $disk
```

***

### firewall

```php
private ?\Upsun\Model\Firewall $firewall
```

***

### resources

```php
private ?\Upsun\Model\Resources $resources
```

***

### containerProfile

```php
private ?string $containerProfile
```

***

### endpoints

```php
private ?object $endpoints
```

***

### instanceCount

```php
private ?int $instanceCount
```

***

## Methods

### __construct

```php
public __construct(string $type, string $size, object $access, object $configuration, array $relationships, ?int $disk, ?\Upsun\Model\Firewall $firewall, ?\Upsun\Model\Resources $resources, ?string $containerProfile, ?object $endpoints, ?int $instanceCount): mixed
```

**Parameters:**

| Parameter           | Type                        | Description |
|---------------------|-----------------------------|-------------|
| `$type`             | **string**                  |             |
| `$size`             | **string**                  |             |
| `$access`           | **object**                  |             |
| `$configuration`    | **object**                  |             |
| `$relationships`    | **array**                   |             |
| `$disk`             | **?int**                    |             |
| `$firewall`         | **?\Upsun\Model\Firewall**  |             |
| `$resources`        | **?\Upsun\Model\Resources** |             |
| `$containerProfile` | **?string**                 |             |
| `$endpoints`        | **?object**                 |             |
| `$instanceCount`    | **?int**                    |             |

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

### getSize

```php
public getSize(): string
```

***

### getDisk

```php
public getDisk(): ?int
```

***

### getAccess

```php
public getAccess(): object
```

***

### getConfiguration

```php
public getConfiguration(): object
```

***

### getRelationships

```php
public getRelationships(): array
```

***

### getFirewall

```php
public getFirewall(): ?\Upsun\Model\Firewall
```

***

### getResources

```php
public getResources(): ?\Upsun\Model\Resources
```

***

### getContainerProfile

```php
public getContainerProfile(): ?string
```

***

### getEndpoints

```php
public getEndpoints(): ?object
```

***

### getInstanceCount

```php
public getInstanceCount(): ?int
```

***
