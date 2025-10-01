<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Backup;
use Upsun\Model\ConfigurationAboutTheTrafficRoutedToThisVersion1;
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
use Upsun\Model\Version;
use Upsun\Model\VersionCreateInput;
use Upsun\Model\VersionPatch;
use Upsun\UpsunClient;

/**
 * EnvironmentTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class EnvironmentTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly EnvironmentApi $api,
        private readonly EnvironmentTypeApi $typeApi,
        private readonly DeploymentApi $deploymentApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Activates an environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @param array{
     *     title: string,
     *     name: string,
     *     cloneParent: bool,
     *     type: string,
     *     init?: string,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function branch(
        string $projectId,
        string $environmentId,
        array $data
    ): AcceptedResponse {
        $environmentBranchInput = new EnvironmentBranchInput(
            title: $data['title'],
            name: $data['name'],
            cloneParent: $data['cloneParent'],
            type: $data['type'],
            resources: new Resources3($data['init'] ?? null),
        );
        return $this->api->branchEnvironment($projectId, $environmentId, $environmentBranchInput);
    }

    /**
     * Creates versions associated with the environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createVersions(
        string $projectId,
        string $environmentId,
        ?int $percentage = null
    ): AcceptedResponse {
        $versionCreateInput = new VersionCreateInput(
            new ConfigurationAboutTheTrafficRoutedToThisVersion1(percentage: $percentage)
        );
        return $this->api->createProjectsEnvironmentsVersions($projectId, $environmentId, $versionCreateInput);
    }

    /**
     * Deactivates an environment
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deactivate(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deactivateEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes an environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->deleteEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes the version
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVersions(string $projectId, string $environmentId, string $versionId): AcceptedResponse
    {
        return $this->api->deleteProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Gets an environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId): Environment
    {
        return $this->api->getEnvironment($projectId, $environmentId);
    }

    /**
     * Lists the version
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getVersions(string $projectId, string $environmentId, string $versionId): Version
    {
        return $this->api->getProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Initializes a new environment
     *
     * @param array{
     *     profile: string,
     *     repository: string,
     *     files: array{
     *       mode: string,
     *       path: string,
     *       contents: string
     *     },
     *     config?: string,
     *     init?: int,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function initialize(
        string $projectId,
        string $environmentId,
        array $data
    ): AcceptedResponse {
        $environmentInitializeInput = new EnvironmentInitializeInput(
            profile: $data['profile'],
            repository: $data['repository'],
            files: $data['files'],
            config: $data['config'] ?? null,
            resources: new Resources4(init: $data['init'] ?? null),
        );
        return $this->api->initializeEnvironment($projectId, $environmentId, $environmentInitializeInput);
    }

    /**
     * Gets list of project environments
     *
     * @return Environment[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsEnvironments($projectId);
    }

    /**
     * Lists versions associated with the environment
     *
     * @return Version[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listVersions(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsVersions($projectId, $environmentId);
    }

    /**
     * Merges an environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function pause(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->pauseEnvironment($projectId, $environmentId);
    }

    /**
     * Redeploys an environment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function redeploy(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->redeployEnvironment($projectId, $environmentId);
    }

    /**
     * Resume a paused environment
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function resume(string $projectId, string $environmentId): AcceptedResponse
    {
        return $this->api->resumeEnvironment($projectId, $environmentId);
    }

    /**
     * Synchronizes a child environment with its parent
     *
     * @param array{
     *     synchronizeCode: bool,
     *     rebase: bool,
     *     synchronizeData: bool,
     *     synchronizeResources: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function synchronize(
        string $projectId,
        string $environmentId,
        array $data
    ): AcceptedResponse {
        $environmentSynchronizeInput = new EnvironmentSynchronizeInput(...$data);
        return $this->api->synchronizeEnvironment($projectId, $environmentId, $environmentSynchronizeInput);
    }

    /**
     * Updates an environment
     *
     * @param array{
     *     parent?: string,
     *     name?: string,
     *     title?: string,
     *     attributes?: array,
     *     type?: string,
     *     cloneParentOnCreate?: bool,
     *     httpAccess?: array{
     *        isEnabled?: bool,
     *        addresses?: array{
     *          permission: string,
     *          address: string,
     *        },
     *        basicAuth?: array
     *     },
     *     enableSmtp?: bool,
     *     restrictRobots?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, string $environmentId, array $data): AcceptedResponse
    {
        $environmentPatch = new EnvironmentPatch(
            parent: $data['parent'] ?? null,
            name: $data['name'] ?? null,
            title: $data['title'] ?? null,
            attributes: $data['attributes'] ?? [],
            type: $data['type'] ?? null,
            cloneParentOnCreate: $data['cloneParentOnCreate'] ?? null,
            httpAccess: isset($data['httpAccess']) ? new HttpAccessPermissions1(
                isEnabled: $data['httpAccess']['isEnabled'] ?? null,
                addresses: $data['httpAccess']['addresses'] ?? null,
                basicAuth: $data['httpAccess']['basicAuth'] ?? null
            ) : null,
            enableSmtp: $data['enableSmtp'] ?? null,
            restrictRobots: $data['restrictRobots'] ?? null
        );
        return $this->api->updateEnvironment($projectId, $environmentId, $environmentPatch);
    }

    /**
     * Updates the version
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateVersions(
        string $projectId,
        string $environmentId,
        string $versionId,
        ?int $percentage = null
    ): AcceptedResponse {
        $versionPatch = new VersionPatch(
            $percentage ? new ConfigurationAboutTheTrafficRoutedToThisVersion1(percentage: $percentage) : null
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function activityCancel(string $projectId, string $environmentId, string $activityId): AcceptedResponse
    {
        return $this->client->activity->cancel($projectId, $activityId, $environmentId);
    }

    /**
     * Gets an environment activity log entry
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getActivities(string $projectId, string $environmentId, string $activityId): Activity
    {
        return $this->client->activity->get($projectId, $activityId, $environmentId);
    }

    /**
     * Gets environment activity log
     *
     * @return Activity[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listActivities(string $projectId, string $environmentId): array
    {
        return $this->client->activity->list($projectId, $environmentId);
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
        return $this->client->backup->backup($projectId, $environmentId, $safe);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteBackup(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->client->backup->delete($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getBackup(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->client->backup->get($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     * @return Backup[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listBackups(string $projectId, string $environmentId): array
    {
        return $this->client->backup->list($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @param array{
     *     restoreCode: bool,
     *     restoreResources: bool,
     *     environmentName?: string,
     *     branchFrom?: string,
     *     init?: string
     * } $options Configuration options for environment restoration
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function restoreBackup(
        string $projectId,
        string $environmentId,
        string $backupId,
        array $options
    ): AcceptedResponse {
        return $this->client->backup->restore($projectId, $environmentId, $backupId, $options);
    }

    /**
     * Gets environment type links
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getType(string $projectId, string $environment_type_id): EnvironmentType
    {
        return $this->typeApi->getEnvironmentType($projectId, $environment_type_id);
    }

    /**
     * Gets environment types
     *
     * @return EnvironmentType[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listTypes(string $projectId): array
    {
        return $this->typeApi->listProjectsEnvironmentTypes($projectId);
    }

    /**
     * Adds an Environment or Project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(
        string $projectId,
        array $environmentVariableCreateInput,
        ?string $environmentId = null
    ): AcceptedResponse {
        return ($environmentId ? $this->client->variables->createEnvironmentVariable(
            $projectId,
            $environmentId,
            $environmentVariableCreateInput
        ) : $this->client->variables->createProjectVariable(
            $projectId,
            $environmentVariableCreateInput
        )
        );
    }

    /**
     * Deletes an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $projectId, string $environmentId, string $variableId): AcceptedResponse
    {
        return $this->client->variables->deleteEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getVariable(string $projectId, string $environmentId, string $variableId): EnvironmentVariable
    {
        return $this->client->variables->getEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets list of Environment variables
     *
     * @return EnvironmentVariable[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        return $this->client->variables->listEnvironmentVariables($projectId, $environmentId);
    }

    /**
     * Gets list of Project variables
     *
     * @return ProjectVariable[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listProjectVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates an environment variable
     *
     * @param array{
     *     name?: string,
     *     value?: string,
     *     attributes?: array,
     *     isJson?: bool,
     *     isSensitive?: bool,
     *     visibleBuild?: bool,
     *     visibleRuntime?: bool,
     *     isEnabled?: bool,
     *     isInheritable?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
        array $data
    ): AcceptedResponse {
        return $this->client->variables->updateEnvironmentVariable(
            $projectId,
            $environmentId,
            $variableId,
            $data
        );
    }

    /**
     * Gets a route's info
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getRoute(string $projectId, string $environmentId, string $routeId): Route
    {
        return $this->client->route->get($projectId, $environmentId, $routeId);
    }

    /**
     * Gets list of routes
     *
     * @return Route[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listRoutes(string $projectId, string $environmentId): array
    {
        return $this->client->route->list($projectId, $environmentId);
    }

    /**
     * Adds an environment domain
     *
     * @param array{
     *     name: string,
     *     attributes?: array,
     *     isDefault?: bool,
     *     replacementFor?: string,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function createDomain(
        string $projectId,
        array $data,
        ?string $environmentId = null,
    ): AcceptedResponse {
        return $this->client->domain->create($projectId, $data, $environmentId);
    }

    /**
     * Deletes an environment domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $projectId, string $environmentId, string $domainId): AcceptedResponse
    {
        return $this->client->domain->delete($projectId, $domainId, $environmentId);
    }

    /**
     * Gets an environment domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $projectId, string $environmentId, string $domainId): Domain
    {
        return $this->client->domain->get($projectId, $environmentId, $domainId);
    }

    /**
     * Gets a list of environment domains
     *
     * @return Domain[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listDomains(string $projectId, string $environmentId): array
    {
        return $this->client->domain->list($projectId, $environmentId);
    }

    /**
     * Updates an environment domain
     *
     * @param array{
     *     attributes?: array,
     *     isDefault?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateDomain(
        string $projectId,
        string $environmentId,
        string $domainId,
        array $data
    ): AcceptedResponse {
        return $this->client->domain->update($projectId, $domainId, $data, $environmentId);
    }

    /**
     * Gets a single environment deployment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $projectId, string $environmentId, string $deploymentId): Deployment
    {
        return $this->deploymentApi->getProjectsEnvironmentsDeployments($projectId, $environmentId, $deploymentId);
    }

    /**
     * Gets an environment's deployment information
     *
     * @return Deployment[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listDeployments(string $projectId, string $environmentId): array
    {
        return $this->deploymentApi->listProjectsEnvironmentsDeployments($projectId, $environmentId);
    }

    /**
     * Lists source operations
     *
     * @return EnvironmentSourceOperation[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listSourceOperations(string $projectId, string $environmentId): array
    {
        return $this->client->sourceOperation->list($projectId, $environmentId);
    }

    /**
     * Triggers a source operation
     *
     * @param array{
     *     operation: string,
     *     variables: array,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function runSourceOperation(
        string $projectId,
        string $environmentId,
        array $data
    ): AcceptedResponse {
        return $this->client->sourceOperation->run($projectId, $environmentId, $data);
    }
}
