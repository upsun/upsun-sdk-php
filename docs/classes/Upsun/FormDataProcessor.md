# FormDataProcessor

FormDataProcessor Class Doc Comment

***

* Full name: `\Upsun\FormDataProcessor`

**See Also:**

* https://openapi-generator.tech

## Properties

### has_file

Tags whether payload passed to ::prepare() contains one or more
SplFileObject or stream values.

```php
public bool $has_file
```

***

## Methods

### prepare

Take value and turn it into an array suitable for inclusion in
the http body (form parameter). If it's a string, pass through unchanged
If it's a datetime object, format it in ISO8601

```php
public prepare((string|bool|array|\DateTime|\ArrayAccess|\SplFileObject)[] $values): array
```

**Parameters:**

| Parameter | Type                                                                 | Description                     |
|-----------|----------------------------------------------------------------------|---------------------------------|
| `$values` | **(string\|bool\|array\|\DateTime\|\ArrayAccess\|\SplFileObject)[]** | the value of the form parameter |

**Return Value:**

[key => value] of formdata

***

### flatten

Flattens a multi-level array of data and generates a single-level array
compatible with formdata - a single-level array where the keys use bracket
notation to signify nested data.

```php
public static flatten(array $source, string $start = ''): array
```

credit: https://github.com/FranBar1966/FlatPHP

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$source` | **array**  |             |
| `$start`  | **string** |             |

***

### makeFormSafe

formdata must be limited to scalars or arrays of scalar values,
or a resource for a file upload. Here we iterate through all available
data and identify how to handle each scenario

```php
protected makeFormSafe(mixed $value): mixed
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$value`  | **mixed** |             |

***

### processModel

We are able to handle nested ModelInterface. We do not simply call
json_decode(json_encode()) because any given model may have binary data
or other data that cannot be serialized to a JSON string

```php
protected processModel(\Upsun\Model\ModelInterface $model): array
```

**Parameters:**

| Parameter | Type                            | Description |
|-----------|---------------------------------|-------------|
| `$model`  | **\Upsun\Model\ModelInterface** |             |

***

### processFiles

Handle file data

```php
protected processFiles(array $files): array
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$files`  | **array** |             |

***

### tryFopen

```php
private tryFopen(\SplFileObject $file): mixed
```

**Parameters:**

| Parameter | Type               | Description |
|-----------|--------------------|-------------|
| `$file`   | **\SplFileObject** |             |

***
