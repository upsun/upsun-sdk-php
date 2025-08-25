<?php

namespace Upsun\Core\Tasks;

use Upsun\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Backup;
use Upsun\Model\EnvironmentBackupInput;
use Upsun\Model\EnvironmentRestoreInput;
use Upsun\UpsunClient;

/**
 * BackupTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class BackupTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly EnvironmentBackupsApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Creates snapshot of environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function backup(
        string $projectId,
        string $environmentId,
        array $environmentBackupInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentBackupInput = new EnvironmentBackupInput($environmentBackupInput);
        return $this->api->backupEnvironment($projectId, $environmentId, $environmentBackupInput);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId, string $backupId): Backup
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsBackups($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function restore(
        string $projectId,
        string $environmentId,
        string $backupId,
        array $environmentRestoreInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentRestoreInput = new EnvironmentRestoreInput($environmentRestoreInput);
        return $this->api->restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput);
    }
}
