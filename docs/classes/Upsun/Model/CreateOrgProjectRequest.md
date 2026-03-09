# CreateOrgProjectRequest

Low level CreateOrgProjectRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateOrgProjectRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### region

```php
private string $region
```

***

### organizationId

```php
private ?string $organizationId
```

***

### title

```php
private ?string $title
```

***

### type

```php
private ?\Upsun\Model\ProjectType $type
```

***

### plan

```php
private ?string $plan
```

***

### defaultBranch

```php
private ?string $defaultBranch
```

***

## Methods

### __construct

```php
public __construct(string $region, ?string $organizationId = null, ?string $title = null, ?\Upsun\Model\ProjectType $type = null, ?string $plan = null, ?string $defaultBranch = null): mixed
```

**Parameters:**

| Parameter         | Type                          | Description |
|-------------------|-------------------------------|-------------|
| `$region`         | **string**                    |             |
| `$organizationId` | **?string**                   |             |
| `$title`          | **?string**                   |             |
| `$type`           | **?\Upsun\Model\ProjectType** |             |
| `$plan`           | **?string**                   |             |
| `$defaultBranch`  | **?string**                   |             |

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

### getRegion

The machine name of the region where the project is located.

```php
public getRegion(): string
```

***

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
```

***

### getTitle

The title of the project.

```php
public getTitle(): ?string
```

***

### getType

The type of projects.

```php
public getType(): ?\Upsun\Model\ProjectType
```

***

### getPlan

The project plan.

```php
public getPlan(): ?string
```

***

### getDefaultBranch

Default branch.

```php
public getDefaultBranch(): ?string
```

***
