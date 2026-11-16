<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\SshApi;
use Upsun\Model\CreateUserSshKeyRequest;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\ListUserSshKeys200Response;
use Upsun\Model\SshKey;
use Upsun\UpsunClient;

/**
 * SshTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class SshTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly SshApi $sshApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Add an SSH public key to a user.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if the user ID or the SSH key value is empty
     */
    public function add(string $userId, string $value, ?string $label = null): SshKey
    {
        $this->checkUserId($userId);

        if ($value === '') {
            throw new InvalidArgumentException('SSH key value is required');
        }

        return $this->sshApi->createUserSshKey(
            userId: $userId,
            createUserSshKeyRequest: new CreateUserSshKeyRequest(
                value: $value,
                label: $label
            )
        );
    }

    /**
     * Get an SSH key of a user.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if the user ID or the key ID is empty
     */
    public function get(string $userId, string $keyId): SshKey
    {
        $this->checkUserId($userId);
        $this->checkSshKeyId($keyId);

        return $this->sshApi->getUserSshKey(userId: $userId, keyId: $keyId);
    }

    /**
     * List the SSH keys of a user.
     *
     * @param array{eq?: string}|null $filterCreatedAt
     * @param array{eq?: string}|null $filterUpdatedAt
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if the user ID is empty, or if a date filter uses an operator other than `eq`
     */
    public function list(
        string $userId,
        ?array $filterCreatedAt = [],
        ?array $filterUpdatedAt = [],
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListUserSshKeys200Response {
        $this->checkUserId($userId);

        return $this->sshApi->listUserSshKeys(
            userId: $userId,
            filterCreatedAt: $this->eqDateTimeFilter('filterCreatedAt', $filterCreatedAt),
            filterUpdatedAt: $this->eqDateTimeFilter('filterUpdatedAt', $filterUpdatedAt),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Delete an SSH key of a user. The API requires a recent authentication.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if the user ID or the key ID is empty
     */
    public function delete(string $userId, string $keyId): void
    {
        $this->checkUserId($userId);
        $this->checkSshKeyId($keyId);

        $this->sshApi->deleteUserSshKey(userId: $userId, keyId: $keyId);
    }

    // SshApi serializes only the `eq` operator of a DateTimeFilter and drops the others.
    private function eqDateTimeFilter(string $name, ?array $filter): ?DateTimeFilter
    {
        $filter = $this->normalizeFilter($filter);
        if ($filter === []) {
            return null;
        }

        $unsupported = array_diff(array_keys($filter), ['eq']);
        if ($unsupported !== []) {
            throw new InvalidArgumentException(sprintf(
                '%s supports only the "eq" operator, got: %s',
                $name,
                implode(', ', $unsupported)
            ));
        }

        return new DateTimeFilter(...$filter);
    }
}
