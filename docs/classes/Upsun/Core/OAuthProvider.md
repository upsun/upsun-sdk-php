# OAuthProvider

class (auto-generated)

***

* Full name: `\Upsun\Core\OAuthProvider`

**See Also:**

* https://docs.upsun.com

## Properties

### accessToken

```php
private ?string $accessToken
```

***

### tokenExpiry

```php
private int $tokenExpiry
```

***

### httpClient

```php
private \Psr\Http\Client\ClientInterface $httpClient
```

***

### requestFactory

```php
private \Psr\Http\Message\RequestFactoryInterface $requestFactory
```

***

### tokenEndpoint

```php
private string $tokenEndpoint
```

***

### clientId

```php
private string $clientId
```

***

### clientSecret

```php
private string $clientSecret
```

***

## Methods

### __construct

```php
public __construct(\Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $tokenEndpoint, string $clientId, string $clientSecret): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$tokenEndpoint`  | **string**                                    |             |
| `$clientId`       | **string**                                    |             |
| `$clientSecret`   | **string**                                    |             |

***

### exchangeCodeForToken

```php
public exchangeCodeForToken(): bool
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### storeTokenData

```php
private storeTokenData(array $data): void
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$data`   | **array** |             |

***

### ensureValidToken

```php
public ensureValidToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### getAuthorization

```php
public getAuthorization(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
