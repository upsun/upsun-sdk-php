# ApiException

Low level  (auto-generated)

***

* Full name: `\Upsun\Api\ApiException`
* Parent class: [`RequestException`](../../Http/Client/Exception/RequestException.md)

**See Also:**

* https://docs.upsun.com

## Properties

### responseBody

The HTTP body of the server response either as Json or string.

```php
private ?string $responseBody
```

***

### responseHeaders

The HTTP header of the server response.

```php
private ?array $responseHeaders
```

***

### responseObject

The deserialized response object

```php
private mixed $responseObject
```

***

## Methods

### __construct

```php
public __construct(mixed $message, \Psr\Http\Message\RequestInterface $request, ?\Psr\Http\Message\ResponseInterface $response = null, ?\Throwable $previous = null): mixed
```

**Parameters:**

| Parameter   | Type                                     | Description |
|-------------|------------------------------------------|-------------|
| `$message`  | **mixed**                                |             |
| `$request`  | **\Psr\Http\Message\RequestInterface**   |             |
| `$response` | **?\Psr\Http\Message\ResponseInterface** |             |
| `$previous` | **?\Throwable**                          |             |

***

### getResponseHeaders

Gets the HTTP response header

```php
public getResponseHeaders(): ?array
```

***

### getResponseBody

Gets the HTTP body of the server response either as Json or string

```php
public getResponseBody(): ?string
```

***

### setResponseObject

Sets the deserialized response object (during deserialization)

```php
public setResponseObject(mixed $obj): void
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$obj`    | **mixed** |             |

***

### getResponseObject

Gets the deserialized response object (during deserialization)

```php
public getResponseObject(): mixed
```

***

### getError

Gets the Error object if the response object is an Error

```php
public getError(): ?\Upsun\Model\Error
```

***

### getApiStatus

Gets the API error status

```php
public getApiStatus(): ?string
```

***

### getApiMessage

Gets the API error message (different from exception message)

```php
public getApiMessage(): ?string
```

***

### getApiCode

Gets the API error code (different from HTTP status code)

```php
public getApiCode(): ?float
```

***

### getApiDetail

Gets the API error detail

```php
public getApiDetail(): ?object
```

***

### getApiTitle

Gets the API error title

```php
public getApiTitle(): ?string
```

***

### hasStructuredError

Check if the response contains a structured Error object

```php
public hasStructuredError(): bool
```

***
