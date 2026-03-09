# ProjectPatch

Low level ProjectPatch (auto-generated)

***

* Full name: `\Upsun\Model\ProjectPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### defaultBranch

```php
private ?string $defaultBranch
```

***

### defaultDomain

```php
private ?string $defaultDomain
```

***

### attributes

```php
private ?array $attributes
```

***

### title

```php
private ?string $title
```

***

### description

```php
private ?string $description
```

***

### timezone

```php
private ?string $timezone
```

***

### region

```php
private ?string $region
```

***

## Methods

### __construct

```php
public __construct(?string $defaultBranch = null, ?string $defaultDomain = null, ?array $attributes = [], ?string $title = null, ?string $description = null, ?string $timezone = null, ?string $region = null): mixed
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$defaultBranch` | **?string** |             |
| `$defaultDomain` | **?string** |             |
| `$attributes`    | **?array**  |             |
| `$title`         | **?string** |             |
| `$description`   | **?string** |             |
| `$timezone`      | **?string** |             |
| `$region`        | **?string** |             |

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

### getAttributes

```php
public getAttributes(): ?array
```

***

### getTitle

The title of the project

```php
public getTitle(): ?string
```

***

### getDescription

The description of the project

```php
public getDescription(): ?string
```

***

### getDefaultBranch

The default branch of the project

```php
public getDefaultBranch(): ?string
```

***

### getTimezone

Timezone of the project

```php
public getTimezone(): ?string
```

***

### getRegion

The region of the project

```php
public getRegion(): ?string
```

***

### getDefaultDomain

The default domain of the project

```php
public getDefaultDomain(): ?string
```

***
