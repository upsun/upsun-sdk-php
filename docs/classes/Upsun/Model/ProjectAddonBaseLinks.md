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

### self

```php
private ?\Upsun\Model\ProjectAddonBaseLinksSelf $self
```

***

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

## Methods

### __construct

```php
public __construct(?\Upsun\Model\ProjectAddonBaseLinksSelf $self = null, ?\Upsun\Model\ProjectAddonBaseLinksUpdate $update = null, ?\Upsun\Model\ProjectAddonBaseLinksDelete $delete = null): mixed
```

**Parameters:**

| Parameter | Type                                          | Description |
|-----------|-----------------------------------------------|-------------|
| `$self`   | **?\Upsun\Model\ProjectAddonBaseLinksSelf**   |             |
| `$update` | **?\Upsun\Model\ProjectAddonBaseLinksUpdate** |             |
| `$delete` | **?\Upsun\Model\ProjectAddonBaseLinksDelete** |             |

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
