# VPNConfiguration

Low level VPNConfiguration (auto-generated)
The configuration of the VPN

***

* Full name: `\Upsun\Model\VPNConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant           | Visibility | Type | Value  |
|--------------------|------------|------|--------|
| `VERSION_NUMBER_1` | public     |      | 1      |
| `VERSION_NUMBER_2` | public     |      | 2      |
| `AGGRESSIVE_NO`    | public     |      | 'no'   |
| `AGGRESSIVE_YES`   | public     |      | 'yes'  |
| `MODECONFIG_PULL`  | public     |      | 'pull' |
| `MODECONFIG_PUSH`  | public     |      | 'push' |

## Properties

### version

```php
private int $version
```

***

### aggressive

```php
private string $aggressive
```

***

### modeconfig

```php
private string $modeconfig
```

***

### authentication

```php
private string $authentication
```

***

### gatewayIp

```php
private string $gatewayIp
```

***

### remoteSubnets

```php
private array $remoteSubnets
```

***

### ike

```php
private string $ike
```

***

### esp

```php
private string $esp
```

***

### ikelifetime

```php
private string $ikelifetime
```

***

### lifetime

```php
private string $lifetime
```

***

### margintime

```php
private string $margintime
```

***

### identity

```php
private ?string $identity
```

***

### secondIdentity

```php
private ?string $secondIdentity
```

***

### remoteIdentity

```php
private ?string $remoteIdentity
```

***

## Methods

### __construct

```php
public __construct(int $version, string $aggressive, string $modeconfig, string $authentication, string $gatewayIp, array $remoteSubnets, string $ike, string $esp, string $ikelifetime, string $lifetime, string $margintime, ?string $identity, ?string $secondIdentity, ?string $remoteIdentity): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$version`        | **int**     |             |
| `$aggressive`     | **string**  |             |
| `$modeconfig`     | **string**  |             |
| `$authentication` | **string**  |             |
| `$gatewayIp`      | **string**  |             |
| `$remoteSubnets`  | **array**   |             |
| `$ike`            | **string**  |             |
| `$esp`            | **string**  |             |
| `$ikelifetime`    | **string**  |             |
| `$lifetime`       | **string**  |             |
| `$margintime`     | **string**  |             |
| `$identity`       | **?string** |             |
| `$secondIdentity` | **?string** |             |
| `$remoteIdentity` | **?string** |             |

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

### getVersion

The IKE version to use (1 or 2)

```php
public getVersion(): int
```

***

### getAggressive

Whether to use IKEv1 Aggressive or Main Mode

```php
public getAggressive(): string
```

***

### getModeconfig

Defines which mode is used to assign a virtual IP (must be the same on both sides)

```php
public getModeconfig(): string
```

***

### getAuthentication

The authentication scheme

```php
public getAuthentication(): string
```

***

### getGatewayIp

```php
public getGatewayIp(): string
```

***

### getIdentity

The identity of the ipsec participant

```php
public getIdentity(): ?string
```

***

### getSecondIdentity

The second identity of the ipsec participant

```php
public getSecondIdentity(): ?string
```

***

### getRemoteIdentity

The identity of the remote ipsec participant

```php
public getRemoteIdentity(): ?string
```

***

### getRemoteSubnets

```php
public getRemoteSubnets(): array
```

***

### getIke

The IKE algorithms to negotiate for this VPN connection.

```php
public getIke(): string
```

***

### getEsp

The ESP algorithms to negotiate for this VPN connection.

```php
public getEsp(): string
```

***

### getIkelifetime

The lifetime of the IKE exchange.

```php
public getIkelifetime(): string
```

***

### getLifetime

The lifetime of the ESP exchange.

```php
public getLifetime(): string
```

***

### getMargintime

The margin time for re-keying.

```php
public getMargintime(): string
```

***
