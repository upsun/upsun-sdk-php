# UpdateOrgProjectRequest

Low level UpdateOrgProjectRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateOrgProjectRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### title

```php
private ?string $title
```

***

### plan

```php
private ?string $plan
```

***

### timezone

```php
private ?string $timezone
```

***

## Methods

### __construct

```php
public __construct(?string $title = null, ?string $plan = null, ?string $timezone = null): mixed
```

**Parameters:**

| Parameter   | Type        | Description |
|-------------|-------------|-------------|
| `$title`    | **?string** |             |
| `$plan`     | **?string** |             |
| `$timezone` | **?string** |             |

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

### getTitle

The title of the project.

```php
public getTitle(): ?string
```

***

### getPlan

The project plan.

```php
public getPlan(): ?string
```

***

### getTimezone

Timezone of the project.

```php
public getTimezone(): ?string
```

***
