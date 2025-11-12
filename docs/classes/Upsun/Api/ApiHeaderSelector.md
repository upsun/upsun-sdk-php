# ApiHeaderSelector

HeaderSelector Class Doc Comment

***

* Full name: `\Upsun\Api\ApiHeaderSelector`

**See Also:**

* https://docs.upsun.com

## Methods

### selectHeaders

```php
public selectHeaders(array $accept, string $contentType, bool $isMultipart): array
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$accept`      | **array**  |             |
| `$contentType` | **string** |             |
| `$isMultipart` | **bool**   |             |

***

### selectAcceptHeader

Return the header 'Accept' based on an array of Accept provided.

```php
private selectAcceptHeader(array $accept): ?string
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$accept` | **array** |             |

***

### isJsonMime

Detects whether a string contains a valid JSON mime type

```php
public isJsonMime(string $searchString): bool
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$searchString` | **string** |             |

***

### selectJsonMimeList

Select all items from a list containing a JSON mime type

```php
private selectJsonMimeList(array $mimeList): array
```

**Parameters:**

| Parameter   | Type      | Description |
|-------------|-----------|-------------|
| `$mimeList` | **array** |             |

***

### getAcceptHeaderWithAdjustedWeight

Create an Accept header string from the given "Accept" headers array, recalculating all weights

```php
private getAcceptHeaderWithAdjustedWeight(array $accept, array $headersWithJson): string
```

**Parameters:**

| Parameter          | Type      | Description |
|--------------------|-----------|-------------|
| `$accept`          | **array** |             |
| `$headersWithJson` | **array** |             |

***

### getHeaderAndWeight

Given an Accept header, returns an associative array splitting the header and its weight

```php
private getHeaderAndWeight(string $header): array
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$header` | **string** |             |

***

### adjustWeight

```php
private adjustWeight(array $headers, float& $currentWeight, bool $hasMoreThan28Headers): array
```

**Parameters:**

| Parameter               | Type      | Description |
|-------------------------|-----------|-------------|
| `$headers`              | **array** |             |
| `$currentWeight`        | **float** |             |
| `$hasMoreThan28Headers` | **bool**  |             |

***

### buildAcceptHeader

```php
private buildAcceptHeader(string $header, int $weight): string
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$header` | **string** |             |
| `$weight` | **int**    |             |

***

### getNextWeight

Calculate the next weight, based on the current one.

```php
public getNextWeight(int $currentWeight, bool $hasMoreThan28Headers): int
```

If there are less than 28 "Accept" headers, the weights will be decreased by 1 on its highest significant digit,
using the following formula:

   next weight = current weight - 10 ^ (floor(log(current weight - 1)))

   ( current weight minus (
      10 raised to the power of ( floor of (log to the base 10 of ( current weight minus 1 ) ) ) )
   )

Starting from 1000, this generates the following series:

1000, 900, 800, 700, 600, 500, 400, 300, 200, 100, 90, 80, 70, 60, 50, 40, 30, 20, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1

The resulting quality codes are closer to the average "normal" usage of them (like "q=0.9", "q=0.8" and so on),
but it only works if there is a maximum of 28 "Accept" headers. If we have more than that
(which is extremely unlikely), then we fall back to a 1-by-1
decrement rule, which will result in quality codes like "q=0.999", "q=0.998" etc.

**Parameters:**

| Parameter               | Type     | Description |
|-------------------------|----------|-------------|
| `$currentWeight`        | **int**  |             |
| `$hasMoreThan28Headers` | **bool** |             |

***
