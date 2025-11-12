# TeamProjectAccessLinks

Low level TeamProjectAccessLinks (auto-generated)

***

* Full name: `\Upsun\Model\TeamProjectAccessLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\TeamProjectAccessLinksSelf $self
```

***

### update

```php
private ?\Upsun\Model\TeamProjectAccessLinksUpdate $update
```

***

### delete

```php
private ?\Upsun\Model\TeamProjectAccessLinksDelete $delete
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\TeamProjectAccessLinksSelf $self = null, ?\Upsun\Model\TeamProjectAccessLinksUpdate $update = null, ?\Upsun\Model\TeamProjectAccessLinksDelete $delete = null): mixed
```

**Parameters:**

| Parameter | Type                                           | Description |
|-----------|------------------------------------------------|-------------|
| `$self`   | **?\Upsun\Model\TeamProjectAccessLinksSelf**   |             |
| `$update` | **?\Upsun\Model\TeamProjectAccessLinksUpdate** |             |
| `$delete` | **?\Upsun\Model\TeamProjectAccessLinksDelete** |             |

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

### getSelf

Link to the current access item.

```php
public getSelf(): ?\Upsun\Model\TeamProjectAccessLinksSelf
```

***

### getUpdate

Link for updating the current access item.

```php
public getUpdate(): ?\Upsun\Model\TeamProjectAccessLinksUpdate
```

***

### getDelete

Link for deleting the current access item.

```php
public getDelete(): ?\Upsun\Model\TeamProjectAccessLinksDelete
```

***
