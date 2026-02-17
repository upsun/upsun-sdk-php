<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\AutoscalingApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\AutoscalerSettings;
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
use Upsun\Model\EnvironmentTypeEnum;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\HttpAccessPermissions2;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Resources2;
use Upsun\Model\Resources3;
use Upsun\Model\Resources4;
use Upsun\Model\Resources5;
use Upsun\Model\Route;
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
        private readonly AutoscalingApi $autoscalingApi,
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
        ?string $init = null
    ): AcceptedResponse {
        return $this->api->activateEnvironment(
            $projectId,
            $environmentId,
            new EnvironmentActivateInput(
                resources: new Resources2($init)
            )
        );
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
        bool $cloneParent = true,
        string $type = EnvironmentTypeEnum::DEVELOPMENT,
        ?string $init = null,
    ): AcceptedResponse {
        return $this->api->branchEnvironment(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentBranchInput: new EnvironmentBranchInput(
                title: $title,
                name: $name,
                cloneParent: $cloneParent,
                type: $type,
                resources: new Resources3(init: $init),
            )
        );
    }

    /**
     * Deactivates an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deactivate(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deactivateEnvironment(
            $projectId,
            $environmentId
        );
    }

    /**
     * Deletes an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deleteEnvironment(
            $projectId,
            $environmentId
        );
    }

    //TODO HTTPACCESS

    /**
     * Gets an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId): Environment
    {
        return $this->api->getEnvironment(
            $projectId,
            $environmentId
        );
    }

    //TODO review files as done in sdk node
    /**
     * Initializes a new environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function init(
        string $projectId,
        string $environmentId,
        string $profile,
        string $repository,
        string $fileMode,
        string $filePath,
        string $fileContents,
        ?string $config = null,
        ?string $init = null,
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
        return $this->api->initializeEnvironment(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentInitializeInput: $environmentInitializeInput
        );
    }

    /**
     * Gets list of project environments
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Environment[]
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsEnvironments(projectId: $projectId);
    }

    //TODO logs

    /**
     * Merges an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function merge(string $projectId, string $environmentId, ?int $init = null): AcceptedResponse
    {
        return $this->api->mergeEnvironment(
            $projectId,
            $environmentId,
            environmentMergeInput: new EnvironmentMergeInput(
                resources: new Resources5(init: $init)
            )
        );
    }

    /**
     * Pauses an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function pause(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->pauseEnvironment(projectId: $projectId, environmentId: $environmentId);
    }

    /**
     * Redeploys an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function redeploy(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->redeployEnvironment(projectId: $projectId, environmentId: $environmentId);
    }

    //TODO relationships

    /**
     * Resume a paused environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function resume(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->resumeEnvironment(projectId: $projectId, environmentId: $environmentId);
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
        bool $synchronizeCode = true,
        bool $rebase = true,
        bool $synchronizeData = true,
        bool $synchronizeResources = true,
    ): AcceptedResponse {
        return $this->api->synchronizeEnvironment(
            $projectId,
            $environmentId,
            environmentSynchronizeInput: new EnvironmentSynchronizeInput(
                synchronizeCode: $synchronizeCode,
                rebase: $rebase,
                synchronizeData: $synchronizeData,
                synchronizeResources: $synchronizeResources
            )
        );
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
     *   basicAuth?: array{
     *    login: string,
     *    password: string,
     *   }
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
            httpAccess: isset($httpAccess) ? new HttpAccessPermissions2(
                isEnabled: $httpAccess['isEnabled'] ?? null,
                addresses: $httpAccess['addresses'] ?? null,
                basicAuth: $httpAccess['basicAuth'] ?? null
            ) : null,
            enableSmtp: $enableSmtp,
            restrictRobots: $restrictRobots
        );
        return $this->api->updateEnvironment(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentPatch: $environmentPatch
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
        return $this->client->activities->cancel(
            projectId: $projectId,
            activityId: $activityId,
            environmentId: $environmentId
        );
    }

    /**
     * Gets an environment activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getActivities(string $projectId, string $environmentId, string $activityId): Activity
    {
        return $this->client->activities->get(
            projectId: $projectId,
            activityId: $activityId,
            environmentId: $environmentId
        );
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
        return $this->client->activities->list(projectId: $projectId, environmentId: $environmentId);
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
        bool $isSafe
    ): AcceptedResponse {
        return $this->client->backups->create(projectId: $projectId, environmentId: $environmentId, isSafe: $isSafe);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteBackup(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->client->backups->delete(
            projectId: $projectId,
            environmentId: $environmentId,
            backupId: $backupId
        );
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getBackup(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->client->backups->get(
            projectId: $projectId,
            environmentId: $environmentId,
            backupId: $backupId
        );
    }

    /**
     * Gets an environment's snapshot list
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Backup[]
     */
    public function listBackups(string $projectId, string $environmentId): array
    {
        return $this->client->backups->list(projectId: $projectId, environmentId: $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
            projectId: $projectId,
            environmentId: $environmentId,
            backupId: $backupId,
            restoreCode: $restoreCode,
            restoreResources: $restoreResources,
            environmentName: $environmentName,
            branchFrom: $branchFrom,
            init: $init
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
        return $this->typeApi->getEnvironmentType(projectId: $projectId, environmentTypeId: $environmentTypeId);
    }

    /**
     * Gets environment types
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentType[]
     */
    public function listTypes(string $projectId): array
    {
        return $this->typeApi->listProjectsEnvironmentTypes(projectId: $projectId);
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
                projectId: $projectId,
                environmentId: $environmentId,
                name: $name,
                value: $value,
                attributes: $attributes,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope,
                isEnabled: $isEnabled,
                isInheritable: $isInheritable,
            ) : $this->client->variables->createProjectVariable(
                projectId: $projectId,
                name: $name,
                value: $value,
                attributes: $attributes,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope,
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
        return $this->client->variables->deleteEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getVariable(string $projectId, string $environmentId, string $variableId): EnvironmentVariable
    {
        return $this->client->variables->getEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
    }

    /**
     * Gets list of Environment variables
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentVariable[]
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        return $this->client->variables->listEnvironmentVariables(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Gets list of Project variables
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectVariable[]
     */
    public function listProjectVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables(projectId: $projectId);
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
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId,
            name: $name,
            value: $value,
            attributes: $attributes,
            isJson: $isJson,
            isSensitive: $isSensitive,
            visibleBuild: $visibleBuild,
            visibleRuntime: $visibleRuntime,
            applicationScope: $applicationScope,
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
        return $this->client->routes->get(projectId: $projectId, environmentId: $environmentId, routeId: $routeId);
    }

    /**
     * Gets list of routes
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Route[]
     */
    public function listRoutes(string $projectId, string $environmentId): array
    {
        return $this->client->routes->list(projectId: $projectId, environmentId: $environmentId);
    }

    /**
     * Adds an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function addDomain(
        string $projectId,
        string $domain,
        ?array $attributes = null,
        ?bool $isDefault = null,
        ?string $replacementFor = null,
        ?string $environmentId = null,
    ): AcceptedResponse {
        return $this->client->domains->add(
            projectId: $projectId,
            domain: $domain,
            attributes: $attributes,
            isDefault: $isDefault,
            replacementFor: $replacementFor,
            environmentId: $environmentId
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
        return $this->client->domains->delete(
            projectId: $projectId,
            domainId: $domainId,
            environmentId: $environmentId
        );
    }

    /**
     * Gets an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDomain(string $projectId, string $environmentId, string $domainId): Domain
    {
        return $this->client->domains->get(projectId: $projectId, environmentId: $environmentId, domainId: $domainId);
    }

    /**
     * Gets a list of environment domains
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Domain[]
     */
    public function listDomains(string $projectId, string $environmentId): array
    {
        return $this->client->domains->list(projectId: $projectId, environmentId: $environmentId);
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
        return $this->client->domains->update(
            projectId: $projectId,
            domainId: $domainId,
            attributes: $attributes,
            isDefault: $isDefault,
            environmentId: $environmentId
        );
    }

    /**
     * Gets a single environment deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDeployment(string $projectId, string $environmentId, string $deploymentId): Deployment
    {
        return $this->deploymentApi->getProjectsEnvironmentsDeployments(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: $deploymentId
        );
    }

    /**
     * Gets an environment's deployment information
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Deployment[]
     */
    public function listDeployments(string $projectId, string $environmentId): array
    {
        return $this->deploymentApi->listProjectsEnvironmentsDeployments(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Gets the autoscaling configuration for an environment
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getAutoscaling(string $projectId, string $environmentId)
    {
        return $this->autoscalingApi->getAutoscalerSettings(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Updates the autoscaling configuration for an environment
     *
     * @param array{
     *   isEnabled?: bool,
     *   addresses?: array{
     *     permission: string,
     *     address: string,
     *   },
     *   basicAuth?: array
     * } $data
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateAutoscaling(string $projectId, string $environmentId, array $data): AutoscalerSettings
    {
        $autoscalingPatch = new AutoscalerSettings(
            services: $data
        );
        return $this->autoscalingApi->patchAutoscalerSettings(
            projectId: $projectId,
            environmentId: $environmentId,
            autoscalerSettings: $autoscalingPatch
        );
    }

    /**
     * Lists source operations
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentSourceOperation[]
     */
    public function listSourceOperations(string $projectId, string $environmentId): array
    {
        return $this->client->sourceOperations->list(projectId: $projectId, environmentId: $environmentId);
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
        return $this->client->sourceOperations->run(
            projectId: $projectId,
            environmentId: $environmentId,
            operation: $operation,
            variables: $variables
        );
    }
}
