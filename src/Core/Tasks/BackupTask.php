<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Backup;
use Upsun\Model\EnvironmentBackupInput;
use Upsun\Model\EnvironmentRestoreInput;
use Upsun\Model\Resources5;
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws Exception
     */
    public function delete(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->api->deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws Exception
     */
    public function get(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->api->getProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws Exception
     */
    public function list(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsBackups($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws Exception
     *
     * @param array{
     *     environmentName: string,
     *     branchFrom: string,
     *     restoreCode: bool,
     *     restoreResources: bool,
     *     init: string
     * } $options Configuration options for environment restoration
     *
     * @see EnvironmentRestoreInput For detailed parameter descriptions
     */
    public function restore(
        string $projectId,
        string $environmentId,
        string $backupId,
        array $options
    ): AcceptedResponse {
        $environmentRestoreInput = new EnvironmentRestoreInput(
            environmentName: $options['environmentName'],
            branchFrom: $options['branchFrom'],
            restoreCode: $options['restoreCode'],
            restoreResources: $options['restoreResources'],
            resources: new Resources5(init: $options['init']),
        );
        return $this->api->restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput);
    }
}
