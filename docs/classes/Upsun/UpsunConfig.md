# UpsunConfig

Upsun Configuration class.

Holds the default API and authentication endpoints, as well as the API token
used for authenticating with the Upsun API.

***

* Full name: `\Upsun\UpsunConfig`
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### base_url

```php
public string $base_url
```

***

### auth_url

```php
public string $auth_url
```

***

### apiToken

```php
public string $apiToken
```

***

### token_endpoint

```php
public string $token_endpoint
```

***

### refresh_endpoint

```php
public string $refresh_endpoint
```

***

### clientId

```php
public string $clientId
```

***

## Methods

### __construct

```php
public __construct(string $base_url = "https://api.upsun.com", string $auth_url = "https://auth.upsun.com", string $apiToken = "UPSUN_API_TOKEN is not defined!", string $token_endpoint = "oauth2/token", string $refresh_endpoint = "oauth2/token", string $clientId = "sdk-php-client-id"): mixed
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$base_url`         | **string** |             |
| `$auth_url`         | **string** |             |
| `$apiToken`         | **string** |             |
| `$token_endpoint`   | **string** |             |
| `$refresh_endpoint` | **string** |             |
| `$clientId`         | **string** |             |

***
