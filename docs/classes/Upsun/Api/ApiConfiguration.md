# ApiConfiguration

APIConfiguration holder for the Upsun API Client.

This class holds API token and other runtime options
used by the generated client classes.

***

* Full name: `\Upsun\Api\ApiConfiguration`
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Constants

| Constant             | Visibility | Type | Value |
|----------------------|------------|------|-------|
| `BOOLEAN_FORMAT_INT` | public     |      | 'int' |

## Properties

### defaultConfiguration

```php
private static ?\Upsun\Api\ApiConfiguration $defaultConfiguration
```

* This property is **static**.

***

### accessToken

Access token for OAuth/Bearer authentication

```php
protected string $accessToken
```

***

### booleanFormatForQueryString

Boolean format for query string

```php
protected string $booleanFormatForQueryString
```

***

### username

Username for HTTP basic authentication

```php
protected string $username
```

***

### password

Password for HTTP basic authentication

```php
protected string $password
```

***

### host

The host

```php
protected string $host
```

***

### userAgent

User agent of the HTTP request, set to "OpenAPI-Generator/{version}/PHP" by default

```php
protected string $userAgent
```

***

### debug

Debug switch (default set to false)

```php
protected bool $debug
```

***

### tempFolderPath

Debug file location (log to STDOUT by default)

```php
protected string $tempFolderPath
```

***

## Methods

### __construct

```php
public __construct(): mixed
```

***

### getAccessToken

Gets the access token for OAuth

```php
public getAccessToken(): string
```

***

### getBooleanFormatForQueryString

Gets boolean format for query string.

```php
public getBooleanFormatForQueryString(): string
```

***

### getUsername

Gets the username for HTTP basic authentication

```php
public getUsername(): string
```

***

### setPassword

Sets the password for HTTP basic authentication

```php
public setPassword(string $password): self
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$password` | **string** |             |

***

### setHost

Sets the host

```php
public setHost(string $host): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$host`   | **string** |             |

***

### getHost

Gets the host

```php
public getHost(): string
```

***

### getUserAgent

Gets the user agent of the api client

```php
public getUserAgent(): string
```

***

### setDebug

Sets debug flag

```php
public setDebug(bool $debug): self
```

**Parameters:**

| Parameter | Type     | Description |
|-----------|----------|-------------|
| `$debug`  | **bool** |             |

***

### getTempFolderPath

Gets the temp folder path

```php
public getTempFolderPath(): string
```

***

### getDefaultConfiguration

Gets the default configuration instance

```php
public static getDefaultConfiguration(): \Upsun\Api\ApiConfiguration
```

* This method is **static**.
***
