<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentBackupsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Backup;
use OpenAPI\Client\Model\EnvironmentBackupInput;
use OpenAPI\Client\Model\EnvironmentRestoreInput;
use Upsun\UpsunClient;

class BackupTask extends TaskBase
{

    public function __construct(
        public UpsunClient            $client,
        private readonly EnvironmentBackupsApi $api,
    )
    {
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
        array  $environmentBackupInput
    ): AcceptedResponse
    {
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
        array  $environmentRestoreInput
    ): AcceptedResponse
    {
        $this->refreshToken();
        $environmentRestoreInput = new EnvironmentRestoreInput($environmentRestoreInput);
        return $this->api->restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput);
    }
}
