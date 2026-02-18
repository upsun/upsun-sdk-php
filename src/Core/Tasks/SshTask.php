<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\SshKeysApi;
use Upsun\Model\CreateSshKeyRequest;
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
        private readonly SshKeysApi $sshKeysApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Add a new SSH key for a user.
     *
     * @throws InvalidArgumentException if the SSH key value or user ID is invalid
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function add(string $value, string $userId, ?string $title = null): SshKey
    {
        $this->checkUserId($userId);

        if ($value === '') {
            throw new InvalidArgumentException('SSH key value is required');
        }

        return $this->sshKeysApi->createSshKey(
            createSshKeyRequest: new CreateSshKeyRequest(
                value: $value,
                title: $title,
                uuid: $userId
            )
        );
    }

    /**
     * Get the details of an SSH key by ID.
     *
     * @throws InvalidArgumentException if the key ID is invalid
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(int $keyId): SshKey
    {
        $this->checkSshKeyId($keyId);

        return $this->sshKeysApi->getSshKey(keyId: $keyId);
    }

    /**
     * Delete an SSH key by ID.
     *
     * @throws InvalidArgumentException if the key ID is invalid
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(int $keyId): void
    {
        $this->checkSshKeyId($keyId);

        $this->sshKeysApi->deleteSshKey(keyId: $keyId);
    }
}
