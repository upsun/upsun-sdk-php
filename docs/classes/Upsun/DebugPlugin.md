# DebugPlugin

DebugPlugin Class Doc

***

* Full name: `\Upsun\DebugPlugin`
* This class implements:
  `Plugin`

**See Also:**

* https://docs.upsun.com

## Properties

### output

```php
private resource $output
```

***

## Methods

### __construct

DebuggingPlugin constructor.

```php
public __construct(resource $output): mixed
```

**Parameters:**

| Parameter | Type         | Description |
|-----------|--------------|-------------|
| `$output` | **resource** |             |

***

### handleRequest

```php
public handleRequest(\Psr\Http\Message\RequestInterface $request, callable $next, callable $first): \Http\Promise\Promise
```

**Parameters:**

| Parameter  | Type                                   | Description |
|------------|----------------------------------------|-------------|
| `$request` | **\Psr\Http\Message\RequestInterface** |             |
| `$next`    | **callable**                           |             |
| `$first`   | **callable**                           |             |

***

### logSuccess

```php
private logSuccess(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): void
```

**Parameters:**

| Parameter   | Type                                    | Description |
|-------------|-----------------------------------------|-------------|
| `$request`  | **\Psr\Http\Message\RequestInterface**  |             |
| `$response` | **\Psr\Http\Message\ResponseInterface** |             |

***

### logError

```php
private logError(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Client\ClientExceptionInterface $exception): void
```

**Parameters:**

| Parameter    | Type                                          | Description |
|--------------|-----------------------------------------------|-------------|
| `$request`   | **\Psr\Http\Message\RequestInterface**        |             |
| `$exception` | **\Psr\Http\Client\ClientExceptionInterface** |             |

***
