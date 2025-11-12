# ObjectSerializer

ObjectSerializer Class Doc Comment

***

* Full name: `\Upsun\Api\Serializer\ObjectSerializer`

**See Also:**

* https://docs.upsun.com

## Properties

### dateTimeFormat

```php
private static string $dateTimeFormat
```

* This property is **static**.

***

## Methods

### sanitizeForSerialization

Serialize data

```php
public static sanitizeForSerialization(mixed $data, ?string $type = null, ?string $format = null): float|object|array|bool|int|string|null
```

* This method is **static**.
**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$data`   | **mixed**   |             |
| `$type`   | **?string** |             |
| `$format` | **?string** |             |

***

### sanitizeFilename

Sanitize filename by removing path.

```php
public static sanitizeFilename(string $filename): string
```

e.g. ../../sun.gif becomes sun.gif

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$filename` | **string** |             |

***

### toPathValue

Take value and turn it into a string suitable for inclusion in
the path, by url-encoding.

```php
public static toPathValue(string $value): string
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description                             |
|-----------|------------|-----------------------------------------|
| `$value`  | **string** | a string which will be part of the path |

**Return Value:**

the serialized object

***

### toString

Take value and turn it into a string suitable for inclusion in
the parameter. If it's a string, pass through unchanged
If it's a datetime object, format it in ISO8601
If it's a boolean, convert it to "true" or "false".

```php
public static toString(float|\DateTime|bool|int|string $value): string
```

* This method is **static**.
**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **float\|\DateTime\|bool\|int\|string** |             |

***

### deserializeSimplifiedModel

Simple deserializer for new models with parameterized constructors

```php
private static deserializeSimplifiedModel(mixed $data, string $class): mixed
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$data`   | **mixed**  |             |
| `$class`  | **string** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserialize

```php
public static deserialize(mixed $data, string $class, mixed $httpHeaders = null): mixed
```

* This method is **static**.
**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$data`        | **mixed**  |             |
| `$class`       | **string** |             |
| `$httpHeaders` | **mixed**  |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### preprocessArrayProperties

Preprocess array properties to deserialize models

```php
private static preprocessArrayProperties(array $data, string $class): array
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$data`   | **array**  |             |
| `$class`  | **string** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### buildQuery

Build a query string from an array of key value pairs.

```php
public static buildQuery(array $params, mixed $encoding = PHP_QUERY_RFC3986): string
```

This function can use the return value of `parse()` to build a query
string. This function does not modify the provided keys when an array is
encountered (like `http_build_query()` would).

The function is copied from
https://github.com/guzzle/psr7/blob/a243f80a1ca7fe8ceed4deee17f12c1930efe662/src/Query.php#L59-L112
with a modification which is described in https://github.com/guzzle/psr7/pull/603

* This method is **static**.
**Parameters:**

| Parameter   | Type      | Description |
|-------------|-----------|-------------|
| `$params`   | **array** |             |
| `$encoding` | **mixed** |             |

***
