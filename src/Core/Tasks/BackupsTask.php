<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Backup;
use Upsun\Model\EnvironmentBackupInput;
use Upsun\Model\EnvironmentRestoreInput;
use Upsun\Model\Resources6;
use Upsun\UpsunClient;

/**
 * BackupTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class BackupsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly EnvironmentBackupsApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Creates snapshot of environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function backup(
        string $projectId,
        string $environmentId,
        bool $safe
    ): AcceptedResponse {
        $environmentBackupInput = new EnvironmentBackupInput($safe);
        return $this->api->backupEnvironment($projectId, $environmentId, $environmentBackupInput);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->api->deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->api->getProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Backup[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsBackups($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     *
     * @throws ClientExceptionInterface
     * @return AcceptedResponse
     */
    public function restore(
        string $projectId,
        string $environmentId,
        string $backupId,
        bool $restoreCode,
        bool $restoreResources,
        ?string $environmentName = null,
        ?string $branchFrom = null,
        ?string $init = null,
    ): AcceptedResponse {
        $environmentRestoreInput = new EnvironmentRestoreInput(
            restoreCode: $restoreCode,
            restoreResources: $restoreResources,
            environmentName: $environmentName,
            branchFrom: $branchFrom,
            resources: new Resources6(init: $init),
        );
        return $this->api->restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput);
    }
}
