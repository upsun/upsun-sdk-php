# CurrentUser

Low level CurrentUser (auto-generated)

The user object.

***

* Full name: `\Upsun\Model\CurrentUser`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### uuid

```php
private ?string $uuid
```

***

### username

```php
private ?string $username
```

***

### displayName

```php
private ?string $displayName
```

***

### status

```php
private ?int $status
```

***

### mail

```php
private ?string $mail
```

***

### sshKeys

```php
private ?array $sshKeys
```

***

### hasKey

```php
private ?bool $hasKey
```

***

### projects

```php
private ?array $projects
```

***

### sequence

```php
private ?int $sequence
```

***

### roles

```php
private ?array $roles
```

***

### picture

```php
private ?string $picture
```

***

### tickets

```php
private ?object $tickets
```

***

### trial

```php
private ?bool $trial
```

***

### currentTrial

```php
private ?array $currentTrial
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $uuid = null, ?string $username = null, ?string $displayName = null, ?int $status = null, ?string $mail = null, ?array $sshKeys = [], ?bool $hasKey = null, ?array $projects = [], ?int $sequence = null, ?array $roles = [], ?string $picture = null, ?object $tickets = null, ?bool $trial = null, ?array $currentTrial = []): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$id`           | **?string** |             |
| `$uuid`         | **?string** |             |
| `$username`     | **?string** |             |
| `$displayName`  | **?string** |             |
| `$status`       | **?int**    |             |
| `$mail`         | **?string** |             |
| `$sshKeys`      | **?array**  |             |
| `$hasKey`       | **?bool**   |             |
| `$projects`     | **?array**  |             |
| `$sequence`     | **?int**    |             |
| `$roles`        | **?array**  |             |
| `$picture`      | **?string** |             |
| `$tickets`      | **?object** |             |
| `$trial`        | **?bool**   |             |
| `$currentTrial` | **?array**  |             |

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

### getId

The UUID of the owner.

```php
public getId(): ?string
```

***

### getUuid

The UUID of the owner.

```php
public getUuid(): ?string
```

***

### getUsername

The username of the owner.

```php
public getUsername(): ?string
```

***

### getDisplayName

The full name of the owner.

```php
public getDisplayName(): ?string
```

***

### getStatus

Status of the user. 0 = blocked; 1 = active.

```php
public getStatus(): ?int
```

***

### getMail

The email address of the owner.

```php
public getMail(): ?string
```

***

### getSshKeys

The list of user's public SSH keys.

```php
public getSshKeys(): \Upsun\Model\SshKey[]|null
```

***

### getHasKey

The indicator whether the user has a public ssh key on file or not.

```php
public getHasKey(): ?bool
```

***

### getProjects

```php
public getProjects(): \Upsun\Model\CurrentUserProjectsInner[]|null
```

***

### getSequence

The sequential ID of the user.

```php
public getSequence(): ?int
```

***

### getRoles

```php
public getRoles(): ?array
```

***

### getPicture

The URL of the user image.

```php
public getPicture(): ?string
```

***

### getTickets

Number of support tickets by status.

```php
public getTickets(): ?object
```

***

### getTrial

The indicator whether the user is in trial or not.

```php
public getTrial(): ?bool
```

***

### getCurrentTrial

```php
public getCurrentTrial(): \Upsun\Model\CurrentUserCurrentTrialInner[]|null
```

***
