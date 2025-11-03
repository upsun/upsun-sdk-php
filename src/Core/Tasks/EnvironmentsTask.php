<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Backup;
use Upsun\Model\Deployment;
use Upsun\Model\Domain;
use Upsun\Model\Environment;
use Upsun\Model\EnvironmentActivateInput;
use Upsun\Model\EnvironmentBranchInput;
use Upsun\Model\EnvironmentInitializeInput;
use Upsun\Model\EnvironmentMergeInput;
use Upsun\Model\EnvironmentPatch;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\Model\EnvironmentSynchronizeInput;
use Upsun\Model\EnvironmentType;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\HttpAccessPermissions1;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Resources2;
use Upsun\Model\Resources3;
use Upsun\Model\Resources4;
use Upsun\Model\Resources5;
use Upsun\Model\Route;
use Upsun\Model\Routing1;
use Upsun\Model\Version;
use Upsun\Model\VersionCreateInput;
use Upsun\Model\VersionPatch;
use Upsun\UpsunClient;

/**
 * EnvironmentTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class EnvironmentsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly EnvironmentApi $api,
        private readonly EnvironmentTypeApi $typeApi,
        private readonly DeploymentApi $deploymentApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Activates an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function activate(
        string $projectId,
        string $environmentId,
        string $init
    ): AcceptedResponse {
        $environmentActivateInput = new EnvironmentActivateInput(
            new Resources2(init: $init)
        );
        return $this->api->activateEnvironment($projectId, $environmentId, $environmentActivateInput);
    }

    /**
     * Branchs an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function branch(
        string $projectId,
        string $environmentId,
        string $title,
        string $name,
        bool $cloneParent,
        string $type,
        ?string $init = null,
    ): AcceptedResponse {
        $environmentBranchInput = new EnvironmentBranchInput(
            title: $title,
            name: $name,
            cloneParent: $cloneParent,
            type: $type,
            resources: new Resources3($init),
        );
        return $this->api->branchEnvironment($projectId, $environmentId, $environmentBranchInput);
    }

    /**
     * Creates versions associated with the environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createVersions(
        string $projectId,
        string $environmentId,
        ?int $percentage = null
    ): AcceptedResponse {
        $versionCreateInput = new VersionCreateInput(
            new Routing1(percentage: $percentage)
        );
        return $this->api->createProjectsEnvironmentsVersions($projectId, $environmentId, $versionCreateInput);
    }

    /**
     * Deactivates an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deactivate(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deactivateEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deleteEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteVersions(string $projectId, string $environmentId, string $versionId): AcceptedResponse
    {
        return $this->api->deleteProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Gets an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId): Environment
    {
        return $this->api->getEnvironment($projectId, $environmentId);
    }

    /**
     * Lists the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getVersions(string $projectId, string $environmentId, string $versionId): Version
    {
        return $this->api->getProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Initializes a new environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function initialize(
        string $projectId,
        string $environmentId,
        string $profile,
        string $repository,
        string $fileMode,
        string $filePath,
        string $fileContents,
        ?string $config = null,
        ?int $init = null,
    ): AcceptedResponse {
        $environmentInitializeInput = new EnvironmentInitializeInput(
            profile: $profile,
            repository: $repository,
            files: [
                $fileMode,
                $filePath,
                $fileContents
            ],
            config: $config,
            resources: new Resources4(init: $init),
        );
        return $this->api->initializeEnvironment($projectId, $environmentId, $environmentInitializeInput);
    }

    /**
     * Gets list of project environments
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Environment[]
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsEnvironments($projectId);
    }

    /**
     * Lists versions associated with the environment
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Version[]
     */
    public function listVersions(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsVersions($projectId, $environmentId);
    }

    /**
     * Merges an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function merge(string $projectId, string $environmentId, ?int $init = null): AcceptedResponse
    {
        $environmentMergeInput = new EnvironmentMergeInput(
            new Resources5(init: $init)
        );
        return $this->api->mergeEnvironment($projectId, $environmentId, $environmentMergeInput);
    }

    /**
     * Pauses an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function pause(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->pauseEnvironment($projectId, $environmentId);
    }

    /**
     * Redeploys an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function redeploy(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->redeployEnvironment($projectId, $environmentId);
    }

    /**
     * Resume a paused environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function resume(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->resumeEnvironment($projectId, $environmentId);
    }

    /**
     * Synchronizes a child environment with its parent
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function synchronize(
        string $projectId,
        string $environmentId,
        bool $synchronizeCode,
        bool $rebase,
        bool $synchronizeData,
        bool $synchronizeResources,
    ): AcceptedResponse {
        $environmentSynchronizeInput = new EnvironmentSynchronizeInput(
            synchronizeCode: $synchronizeCode,
            rebase: $rebase,
            synchronizeData: $synchronizeData,
            synchronizeResources: $synchronizeResources
        );
        return $this->api->synchronizeEnvironment($projectId, $environmentId, $environmentSynchronizeInput);
    }

    /**
     * Updates an environment
     *
     * @param null|array{
     *   isEnabled?: bool,
     *   addresses?: array{
     *     permission: string,
     *     address: string,
     *   },
     *   basicAuth?: array
     * } $httpAccess
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $projectId,
        string $environmentId,
        ?string $parent = null,
        ?string $name = null,
        ?string $title = null,
        ?array $attributes = null,
        ?string $type = null,
        ?bool $cloneParentOnCreate = null,
        ?array $httpAccess = null,
        ?bool $enableSmtp = null,
        ?bool $restrictRobots = null,
    ): AcceptedResponse {
        $environmentPatch = new EnvironmentPatch(
            parent: $parent,
            name: $name,
            title: $title,
            attributes: $attributes,
            type: $type,
            cloneParentOnCreate: $cloneParentOnCreate,
            httpAccess: isset($httpAccess) ? new HttpAccessPermissions1(
                isEnabled: $httpAccess['isEnabled'] ?? null,
                addresses: $httpAccess['addresses'] ?? null,
                basicAuth: $httpAccess['basicAuth'] ?? null
            ) : null,
            enableSmtp: $enableSmtp,
            restrictRobots: $restrictRobots
        );
        return $this->api->updateEnvironment($projectId, $environmentId, $environmentPatch);
    }

    /**
     * Updates the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateVersions(
        string $projectId,
        string $environmentId,
        string $versionId,
        ?int $percentage = null
    ): AcceptedResponse {
        $versionPatch = new VersionPatch(
            $percentage ? new Routing1(percentage: $percentage) : null
        );
        return $this->api->updateProjectsEnvironmentsVersions(
            $projectId,
            $environmentId,
            $versionId,
            $versionPatch
        );
    }

    /**
     * Cancels an environment activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function activityCancel(string $projectId, string $environmentId, string $activityId): AcceptedResponse
    {
        return $this->client->activities->cancel($projectId, $activityId, $environmentId);
    }

    /**
     * Gets an environment activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getActivities(string $projectId, string $environmentId, string $activityId): Activity
    {
        return $this->client->activities->get($projectId, $activityId, $environmentId);
    }

    /**
     * Gets environment activity log
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Activity[]
     */
    public function listActivities(string $projectId, string $environmentId): array
    {
        return $this->client->activities->list($projectId, $environmentId);
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
        return $this->client->backups->backup($projectId, $environmentId, $safe);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteBackup(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->client->backups->delete($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getBackup(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->client->backups->get($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Backup[]
     */
    public function listBackups(string $projectId, string $environmentId): array
    {
        return $this->client->backups->list($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @throws ClientExceptionInterface
     */
    public function restoreBackup(
        string $projectId,
        string $environmentId,
        string $backupId,
        bool $restoreCode,
        bool $restoreResources,
        ?string $environmentName = null,
        ?string $branchFrom = null,
        ?string $init = null,
    ): AcceptedResponse {
        return $this->client->backups->restore(
            $projectId,
            $environmentId,
            $backupId,
            $restoreCode,
            $restoreResources,
            $environmentName,
            $branchFrom,
            $init
        );
    }

    /**
     * Gets environment type links
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getType(string $projectId, string $environmentTypeId): EnvironmentType
    {
        return $this->typeApi->getEnvironmentType($projectId, $environmentTypeId);
    }

    /**
     * Gets environment types
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentType[]
     */
    public function listTypes(string $projectId): array
    {
        return $this->typeApi->listProjectsEnvironmentTypes($projectId);
    }

    /**
     * Adds an Environment or Project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createVariable(
        string $projectId,
        string $name,
        string $value,
        ?array $attributes = null,
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = null,
        ?bool $isEnabled = null,
        ?bool $isInheritable = null,
        ?string $environmentId = null
    ): AcceptedResponse {
        return ($environmentId ?
            $this->client->variables->createEnvironmentVariable(
                $projectId,
                $environmentId,
                $name,
                $value,
                $attributes,
                $isJson,
                $isSensitive,
                $visibleBuild,
                $visibleRuntime,
                $applicationScope,
                $isEnabled,
                $isInheritable,
            ) : $this->client->variables->createProjectVariable(
                $projectId,
                $name,
                $value,
                $attributes,
                $isJson,
                $isSensitive,
                $visibleBuild,
                $visibleRuntime,
                $applicationScope,
            )
        );
    }

    /**
     * Deletes an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteVariable(string $projectId, string $environmentId, string $variableId): AcceptedResponse
    {
        return $this->client->variables->deleteEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getVariable(string $projectId, string $environmentId, string $variableId): EnvironmentVariable
    {
        return $this->client->variables->getEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets list of Environment variables
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentVariable[]
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        return $this->client->variables->listEnvironmentVariables($projectId, $environmentId);
    }

    /**
     * Gets list of Project variables
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectVariable[]
     */
    public function listProjectVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
        ?string $name = null,
        ?string $value = null,
        ?array $attributes = null,
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = null,
    ): AcceptedResponse {
        return $this->client->variables->updateEnvironmentVariable(
            $projectId,
            $environmentId,
            $variableId,
            $name,
            $value,
            $attributes,
            $isJson,
            $isSensitive,
            $visibleBuild,
            $visibleRuntime,
            $applicationScope,
        );
    }

    /**
     * Gets a route's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getRoute(string $projectId, string $environmentId, string $routeId): Route
    {
        return $this->client->routes->get($projectId, $environmentId, $routeId);
    }

    /**
     * Gets list of routes
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Route[]
     */
    public function listRoutes(string $projectId, string $environmentId): array
    {
        return $this->client->routes->list($projectId, $environmentId);
    }

    /**
     * Adds an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createDomain(
        string $projectId,
        string $name,
        ?array $attributes = null,
        ?bool $isDefault = null,
        ?string $replacementFor = null,
        ?string $environmentId = null,
    ): AcceptedResponse {
        return $this->client->domains->create(
            $projectId,
            $name,
            $attributes,
            $isDefault,
            $replacementFor,
            $environmentId
        );
    }

    /**
     * Deletes an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteDomain(string $projectId, string $environmentId, string $domainId): AcceptedResponse
    {
        return $this->client->domains->delete($projectId, $domainId, $environmentId);
    }

    /**
     * Gets an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDomain(string $projectId, string $environmentId, string $domainId): Domain
    {
        return $this->client->domains->get($projectId, $environmentId, $domainId);
    }

    /**
     * Gets a list of environment domains
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Domain[]
     */
    public function listDomains(string $projectId, string $environmentId): array
    {
        return $this->client->domains->list($projectId, $environmentId);
    }

    /**
     * Updates an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateDomain(
        string $projectId,
        string $environmentId,
        string $domainId,
        ?array $attributes = null,
        ?bool $isDefault = null,
    ): AcceptedResponse {
        return $this->client->domains->update($projectId, $domainId, $attributes, $isDefault, $environmentId);
    }

    /**
     * Gets a single environment deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDeployment(string $projectId, string $environmentId, string $deploymentId): Deployment
    {
        return $this->deploymentApi->getProjectsEnvironmentsDeployments($projectId, $environmentId, $deploymentId);
    }

    /**
     * Gets an environment's deployment information
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Deployment[]
     */
    public function listDeployments(string $projectId, string $environmentId): array
    {
        return $this->deploymentApi->listProjectsEnvironmentsDeployments($projectId, $environmentId);
    }

    /**
     * Lists source operations
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentSourceOperation[]
     */
    public function listSourceOperations(string $projectId, string $environmentId): array
    {
        return $this->client->sourceOperations->list($projectId, $environmentId);
    }

    /**
     * Triggers a source operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function runSourceOperation(
        string $projectId,
        string $environmentId,
        string $operation,
        array $variables,
    ): AcceptedResponse {
        return $this->client->sourceOperations->run($projectId, $environmentId, $operation, $variables);
    }
}
