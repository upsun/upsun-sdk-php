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

### cseNotes

```php
private ?string $cseNotes
```

***

### dedicatedTag

```php
private ?string $dedicatedTag
```

***

## Methods

### __construct

```php
public __construct(?string $title = null, ?string $plan = null, ?string $timezone = null, ?string $cseNotes = null, ?string $dedicatedTag = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$title`        | **?string** |             |
| `$plan`         | **?string** |             |
| `$timezone`     | **?string** |             |
| `$cseNotes`     | **?string** |             |
| `$dedicatedTag` | **?string** |             |

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

### getCseNotes

CSE notes.

```php
public getCseNotes(): ?string
```

***

### getDedicatedTag

Dedicated tag.

```php
public getDedicatedTag(): ?string
```

***
