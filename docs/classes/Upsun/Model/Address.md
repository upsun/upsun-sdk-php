# Address

Low level Address (auto-generated)
The address of the user.

***

* Full name: `\Upsun\Model\Address`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### country

```php
private ?string $country
```

***

### nameLine

```php
private ?string $nameLine
```

***

### premise

```php
private ?string $premise
```

***

### subPremise

```php
private ?string $subPremise
```

***

### thoroughfare

```php
private ?string $thoroughfare
```

***

### administrativeArea

```php
private ?string $administrativeArea
```

***

### subAdministrativeArea

```php
private ?string $subAdministrativeArea
```

***

### locality

```php
private ?string $locality
```

***

### dependentLocality

```php
private ?string $dependentLocality
```

***

### postalCode

```php
private ?string $postalCode
```

***

## Methods

### __construct

```php
public __construct(?string $country = null, ?string $nameLine = null, ?string $premise = null, ?string $subPremise = null, ?string $thoroughfare = null, ?string $administrativeArea = null, ?string $subAdministrativeArea = null, ?string $locality = null, ?string $dependentLocality = null, ?string $postalCode = null): mixed
```

**Parameters:**

| Parameter                | Type        | Description |
|--------------------------|-------------|-------------|
| `$country`               | **?string** |             |
| `$nameLine`              | **?string** |             |
| `$premise`               | **?string** |             |
| `$subPremise`            | **?string** |             |
| `$thoroughfare`          | **?string** |             |
| `$administrativeArea`    | **?string** |             |
| `$subAdministrativeArea` | **?string** |             |
| `$locality`              | **?string** |             |
| `$dependentLocality`     | **?string** |             |
| `$postalCode`            | **?string** |             |

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

### getCountry

Two-letter country codes are used to represent countries and states

```php
public getCountry(): ?string
```

***

### getNameLine

The full name of the user

```php
public getNameLine(): ?string
```

***

### getPremise

Premise (i.e. Apt, Suite, Bldg.)

```php
public getPremise(): ?string
```

***

### getSubPremise

Sub Premise (i.e. Suite, Apartment, Floor, Unknown.

```php
public getSubPremise(): ?string
```

***

### getThoroughfare

The address of the user

```php
public getThoroughfare(): ?string
```

***

### getAdministrativeArea

The administrative area of the user address

```php
public getAdministrativeArea(): ?string
```

***

### getSubAdministrativeArea

The sub-administrative area of the user address

```php
public getSubAdministrativeArea(): ?string
```

***

### getLocality

The locality of the user address

```php
public getLocality(): ?string
```

***

### getDependentLocality

The dependant_locality area of the user address

```php
public getDependentLocality(): ?string
```

***

### getPostalCode

The postal code area of the user address

```php
public getPostalCode(): ?string
```

***
