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
 * BackupsTask class.
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
     * Create snapshot of environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(
        string $projectId,
        string $environmentId,
        bool $isSafe = true,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->api->backupEnvironment(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentBackupInput: new EnvironmentBackupInput(safe: $isSafe)
        );
    }

    /**
     * Delete an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkBackupId($backupId);

        return $this->api->deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    }

    /**
     * Get an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId, string $backupId): Backup
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkBackupId($backupId);

        return $this->api->getProjectsEnvironmentsBackups(
            $projectId,
            $environmentId,
            $backupId
        );
    }

    /**
     * Get an environment's snapshot list
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Backup[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->api->listProjectsEnvironmentsBackups(projectId: $projectId, environmentId: $environmentId);
    }

    /**
     * Restore an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function restore(
        string $projectId,
        string $environmentId,
        string $backupId,
        bool $restoreCode = true,
        bool $restoreResources = true,
        ?string $environmentName = null,
        ?string $branchFrom = null,
        ?string $init = Resources6::INIT__DEFAULT,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkBackupId($backupId);

        return $this->api->restoreBackup(
            $projectId,
            $environmentId,
            $backupId,
            environmentRestoreInput: new EnvironmentRestoreInput(
                environmentName: $environmentName,
                branchFrom: $branchFrom,
                resources: new Resources6($init),
                restoreCode: $restoreCode,
                restoreResources: $restoreResources,
            )
        );
    }
}
