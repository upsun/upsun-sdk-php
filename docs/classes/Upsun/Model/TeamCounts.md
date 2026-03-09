# TeamCounts

Low level TeamCounts (auto-generated)

***

* Full name: `\Upsun\Model\TeamCounts`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### memberCount

```php
private ?int $memberCount
```

***

### projectCount

```php
private ?int $projectCount
```

***

## Methods

### __construct

```php
public __construct(?int $memberCount = null, ?int $projectCount = null): mixed
```

**Parameters:**

| Parameter       | Type     | Description |
|-----------------|----------|-------------|
| `$memberCount`  | **?int** |             |
| `$projectCount` | **?int** |             |

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

### getMemberCount

Total count of members of the team.

```php
public getMemberCount(): ?int
```

***

### getProjectCount

Total count of projects that the team has access to.

```php
public getProjectCount(): ?int
```

***
