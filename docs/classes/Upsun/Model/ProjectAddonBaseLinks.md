# ProjectAddonBaseLinks

Low level ProjectAddonBaseLinks (auto-generated)

***

* Full name: `\Upsun\Model\ProjectAddonBaseLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### update

```php
private ?\Upsun\Model\ProjectAddonBaseLinksUpdate $update
```

***

### delete

```php
private ?\Upsun\Model\ProjectAddonBaseLinksDelete $delete
```

***

### self

```php
private ?\Upsun\Model\ProjectAddonBaseLinksSelf $self
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\ProjectAddonBaseLinksUpdate $update = null, ?\Upsun\Model\ProjectAddonBaseLinksDelete $delete = null, ?\Upsun\Model\ProjectAddonBaseLinksSelf $self = null): mixed
```

**Parameters:**

| Parameter | Type                                          | Description |
|-----------|-----------------------------------------------|-------------|
| `$update` | **?\Upsun\Model\ProjectAddonBaseLinksUpdate** |             |
| `$delete` | **?\Upsun\Model\ProjectAddonBaseLinksDelete** |             |
| `$self`   | **?\Upsun\Model\ProjectAddonBaseLinksSelf**   |             |

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

Link to the current add-on.

```php
public getSelf(): ?\Upsun\Model\ProjectAddonBaseLinksSelf
```

***

### getUpdate

Link for updating the current add-on.

```php
public getUpdate(): ?\Upsun\Model\ProjectAddonBaseLinksUpdate
```

***

### getDelete

Link for deleting the current add-on.

```php
public getDelete(): ?\Upsun\Model\ProjectAddonBaseLinksDelete
```

***
