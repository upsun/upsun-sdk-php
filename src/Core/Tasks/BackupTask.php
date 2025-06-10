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
    public EnvironmentBackupsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new EnvironmentBackupsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************/
    /********* Getter ************************/
    /************** **************************/

    public function getApi(): EnvironmentBackupsApi
    {
        return $this->api;
    }

    /************** *****************************************/
    /********* EnvironmentBackupsApi ************************/
    /************** *****************************************/

    /**
     * Operation backup
     *
     * Create snapshot of environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_backup_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function backup(
        string $project_id,
        string $environment_id,
        array $environment_backup_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_backup_input = new EnvironmentBackupInput($environment_backup_input);
        return $this->getApi()->backupEnvironment($project_id, $environment_id, $environment_backup_input);
    }

    /**
     * Operation delete
     *
     * Delete an environment snapshot
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id, string $environment_id, string $backup_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->getApi()->deleteProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation get
     *
     * Get an environment snapshot's info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return Backup|null
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $environment_id, string $backup_id): ?Backup
    {
        $this->refreshToken();
        return $this->getApi()->getProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation list
     *
     * Get an environment's snapshot list
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Backup[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->getApi()->listProjectsEnvironmentsBackups($project_id, $environment_id);
    }

    /**
     * Operation restoreBackup
     *
     * Restore an environment snapshot
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @param array $environment_restore_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function restore(
        string $project_id,
        string $environment_id,
        string $backup_id,
        array $environment_restore_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_restore_input = new EnvironmentRestoreInput($environment_restore_input);
        return $this->getApi()->restoreBackup($project_id, $environment_id, $backup_id, $environment_restore_input);
    }
}
