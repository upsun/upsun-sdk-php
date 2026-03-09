# MfaApi

Low level MfaApi (auto-generated)

***

* Full name: `\Upsun\Api\MfaApi`
* Parent class: [`\Upsun\Api\AbstractApi`](./AbstractApi.md)
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### headerSelector

```php
private \Upsun\Api\ApiHeaderSelector $headerSelector
```

***

### config

```php
private \Upsun\Api\APIConfiguration $config
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, ?\Psr\Http\Client\ClientInterface $httpClient = null, ?\Psr\Http\Message\RequestFactoryInterface $requestFactory = null, ?\Upsun\Api\APIConfiguration $config = null, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null, ?\Upsun\Api\ApiHeaderSelector $selector = null): mixed
```

**Parameters:**

| Parameter         | Type                                           | Description |
|-------------------|------------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                  |             |
| `$httpClient`     | **?\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **?\Psr\Http\Message\RequestFactoryInterface** |             |
| `$config`         | **?\Upsun\Api\APIConfiguration**               |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface**  |             |
| `$selector`       | **?\Upsun\Api\ApiHeaderSelector**              |             |

***

### confirmTotpEnrollment

Confirm TOTP enrollment

```php
public confirmTotpEnrollment(string $userId, \Upsun\Model\ConfirmTotpEnrollmentRequest|null $confirmTotpEnrollmentRequest = null): \Upsun\Model\ConfirmTotpEnrollment200Response
```

Confirms the given TOTP enrollment.

**Parameters:**

| Parameter                       | Type                                                | Description                    |
|---------------------------------|-----------------------------------------------------|--------------------------------|
| `$userId`                       | **string**                                          | The ID of the user. (required) |
| `$confirmTotpEnrollmentRequest` | **\Upsun\Model\ConfirmTotpEnrollmentRequest\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/confirm-totp-enrollment

***

### confirmTotpEnrollmentWithHttpInfo

Confirm TOTP enrollment with HTTP Info

```php
private confirmTotpEnrollmentWithHttpInfo(string $userId, \Upsun\Model\ConfirmTotpEnrollmentRequest|null $confirmTotpEnrollmentRequest = null): \Upsun\Model\ConfirmTotpEnrollment200Response
```

**Parameters:**

| Parameter                       | Type                                                | Description                    |
|---------------------------------|-----------------------------------------------------|--------------------------------|
| `$userId`                       | **string**                                          | The ID of the user. (required) |
| `$confirmTotpEnrollmentRequest` | **\Upsun\Model\ConfirmTotpEnrollmentRequest\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### confirmTotpEnrollmentRequest

Create request for operation 'confirmTotpEnrollment'

```php
private confirmTotpEnrollmentRequest(string $userId, \Upsun\Model\ConfirmTotpEnrollmentRequest|null $confirmTotpEnrollmentRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                       | Type                                                | Description                    |
|---------------------------------|-----------------------------------------------------|--------------------------------|
| `$userId`                       | **string**                                          | The ID of the user. (required) |
| `$confirmTotpEnrollmentRequest` | **\Upsun\Model\ConfirmTotpEnrollmentRequest\|null** | (optional)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### disableOrgMfaEnforcement

Disable organization MFA enforcement

```php
public disableOrgMfaEnforcement(string $organizationId): void
```

Disables MFA enforcement for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/disable-org-mfa-enforcement

***

### disableOrgMfaEnforcementWithHttpInfo

Disable organization MFA enforcement with HTTP Info

```php
private disableOrgMfaEnforcementWithHttpInfo(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### disableOrgMfaEnforcementRequest

Create request for operation 'disableOrgMfaEnforcement'

```php
private disableOrgMfaEnforcementRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### enableOrgMfaEnforcement

Enable organization MFA enforcement

```php
public enableOrgMfaEnforcement(string $organizationId): void
```

Enables MFA enforcement for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/enable-org-mfa-enforcement

***

### enableOrgMfaEnforcementWithHttpInfo

Enable organization MFA enforcement with HTTP Info

```php
private enableOrgMfaEnforcementWithHttpInfo(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### enableOrgMfaEnforcementRequest

Create request for operation 'enableOrgMfaEnforcement'

```php
private enableOrgMfaEnforcementRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgMfaEnforcement

Get organization MFA settings

```php
public getOrgMfaEnforcement(string $organizationId): \Upsun\Model\OrganizationMfaEnforcement
```

Retrieves MFA settings for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/get-org-mfa-enforcement

***

### getOrgMfaEnforcementWithHttpInfo

Get organization MFA settings with HTTP Info

```php
private getOrgMfaEnforcementWithHttpInfo(string $organizationId): \Upsun\Model\OrganizationMfaEnforcement
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgMfaEnforcementRequest

Create request for operation 'getOrgMfaEnforcement'

```php
private getOrgMfaEnforcementRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getTotpEnrollment

Get information about TOTP enrollment

```php
public getTotpEnrollment(string $userId): \Upsun\Model\GetTotpEnrollment200Response
```

Retrieves TOTP enrollment information.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/get-totp-enrollment

***

### getTotpEnrollmentWithHttpInfo

Get information about TOTP enrollment with HTTP Info

```php
private getTotpEnrollmentWithHttpInfo(string $userId): \Upsun\Model\GetTotpEnrollment200Response
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTotpEnrollmentRequest

Create request for operation 'getTotpEnrollment'

```php
private getTotpEnrollmentRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### recreateRecoveryCodes

Re-create recovery codes

```php
public recreateRecoveryCodes(string $userId): \Upsun\Model\ConfirmTotpEnrollment200Response
```

Re-creates recovery codes for the MFA enrollment.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/recreate-recovery-codes

***

### recreateRecoveryCodesWithHttpInfo

Re-create recovery codes with HTTP Info

```php
private recreateRecoveryCodesWithHttpInfo(string $userId): \Upsun\Model\ConfirmTotpEnrollment200Response
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### recreateRecoveryCodesRequest

Create request for operation 'recreateRecoveryCodes'

```php
private recreateRecoveryCodesRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### sendOrgMfaReminders

Send MFA reminders to organization members

```php
public sendOrgMfaReminders(string $organizationId, ?\Upsun\Model\SendOrgMfaRemindersRequest $sendOrgMfaRemindersRequest = null): array
```

Sends a reminder about setting up MFA to the specified organization members.

**Parameters:**

| Parameter                     | Type                                         | Description                            |
|-------------------------------|----------------------------------------------|----------------------------------------|
| `$organizationId`             | **string**                                   | The ID of the organization. (required) |
| `$sendOrgMfaRemindersRequest` | **?\Upsun\Model\SendOrgMfaRemindersRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/send-org-mfa-reminders

***

### sendOrgMfaRemindersWithHttpInfo

Send MFA reminders to organization members with HTTP Info

```php
private sendOrgMfaRemindersWithHttpInfo(string $organizationId, ?\Upsun\Model\SendOrgMfaRemindersRequest $sendOrgMfaRemindersRequest = null): array
```

**Parameters:**

| Parameter                     | Type                                         | Description                            |
|-------------------------------|----------------------------------------------|----------------------------------------|
| `$organizationId`             | **string**                                   | The ID of the organization. (required) |
| `$sendOrgMfaRemindersRequest` | **?\Upsun\Model\SendOrgMfaRemindersRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### sendOrgMfaRemindersRequest

Create request for operation 'sendOrgMfaReminders'

```php
private sendOrgMfaRemindersRequest(string $organizationId, ?\Upsun\Model\SendOrgMfaRemindersRequest $sendOrgMfaRemindersRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                     | Type                                         | Description                            |
|-------------------------------|----------------------------------------------|----------------------------------------|
| `$organizationId`             | **string**                                   | The ID of the organization. (required) |
| `$sendOrgMfaRemindersRequest` | **?\Upsun\Model\SendOrgMfaRemindersRequest** |                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### withdrawTotpEnrollment

Withdraw TOTP enrollment

```php
public withdrawTotpEnrollment(string $userId): void
```

Withdraws from the TOTP enrollment.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Mfa/operation/withdraw-totp-enrollment

***

### withdrawTotpEnrollmentWithHttpInfo

Withdraw TOTP enrollment with HTTP Info

```php
private withdrawTotpEnrollmentWithHttpInfo(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### withdrawTotpEnrollmentRequest

Create request for operation 'withdrawTotpEnrollment'

```php
private withdrawTotpEnrollmentRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, \Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $baseUri, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                 |             |
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$baseUri`        | **string**                                    |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface** |             |

***

### getAuthorizationHeader

```php
protected getAuthorizationHeader(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createAuthenticatedRequest

```php
protected createAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### sendAuthenticatedRequest

```php
protected sendAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\ResponseInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### refreshToken

```php
public refreshToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createRequest

Create request

```php
protected createRequest(string $method, string|\Psr\Http\Message\UriInterface $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string\|\Psr\Http\Message\UriInterface**          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

***

### createUri

```php
protected createUri(string $operationHost, string $resourcePath, array $queryParams): \Psr\Http\Message\UriInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$operationHost` | **string** |             |
| `$resourcePath`  | **string** |             |
| `$queryParams`   | **array**  |             |

***

### handleResponseWithDataType

```php
protected handleResponseWithDataType(class-string<\Upsun\Api\T>|string $dataType, \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Upsun\Api\T
```

**Parameters:**

| Parameter   | Type                                    | Description                                                       |
|-------------|-----------------------------------------|-------------------------------------------------------------------|
| `$dataType` | **class-string<\Upsun\Api\T>\|string**  | Fully-qualified class name, or scalar type like "string", "array" |
| `$request`  | **\Psr\Http\Message\RequestInterface**  |                                                                   |
| `$response` | **\Psr\Http\Message\ResponseInterface** |                                                                   |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserializeGenericArray

Deserialize generic types array<key,value>

```php
protected deserializeGenericArray(mixed $content, string $dataType, \Psr\Http\Message\RequestInterface $request): array
```

**Parameters:**

| Parameter   | Type                                   | Description |
|-------------|----------------------------------------|-------------|
| `$content`  | **mixed**                              |             |
| `$dataType` | **string**                             |             |
| `$request`  | **\Psr\Http\Message\RequestInterface** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
