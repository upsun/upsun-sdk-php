<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\apisgen\EnvironmentTypeApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\Backup;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\EnvironmentActivateInput;
use OpenAPI\Client\Model\EnvironmentBranchInput;
use OpenAPI\Client\Model\EnvironmentInitializeInput;
use OpenAPI\Client\Model\EnvironmentMergeInput;
use OpenAPI\Client\Model\EnvironmentPatch;
use OpenAPI\Client\Model\EnvironmentSynchronizeInput;
use OpenAPI\Client\Model\EnvironmentType;
use OpenAPI\Client\Model\EnvironmentVariable;
use OpenAPI\Client\Model\Route;
use OpenAPI\Client\Model\Version;
use OpenAPI\Client\Model\VersionCreateInput;
use OpenAPI\Client\Model\VersionPatch;
use Upsun\UpsunClient;

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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function activate(
        string $projectId,
        string $environmentId,
        array $environmentActivateInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentActivateInput = new EnvironmentActivateInput($environmentActivateInput);
        return $this->api->activateEnvironment($projectId, $environmentId, $environmentActivateInput);
    }

    /**
     * Branchs an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function branch(
        string $projectId,
        string $environmentId,
        array $environmentBranchInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentBranchInput = new EnvironmentBranchInput($environmentBranchInput);
        return $this->api->branchEnvironment($projectId, $environmentId, $environmentBranchInput);
    }

    /**
     * Creates versions associated with the environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVersions(
        string $projectId,
        string $environmentId,
        array $versionCreateInput
    ): AcceptedResponse {
        $this->refreshToken();
        $versionCreateInput = new VersionCreateInput($versionCreateInput);
        return $this->api->createProjectsEnvironmentsVersions($projectId, $environmentId, $versionCreateInput);
    }

    /**
     * Deactivates an environment
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deactivate(string $projectId, string $environmentId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deactivateEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteEnvironment($projectId, $environmentId);
    }

    /**
     * Deletes the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVersions(string $projectId, string $environmentId, string $versionId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Gets an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId): Environment
    {
        $this->refreshToken();
        return $this->api->getEnvironment($projectId, $environmentId);
    }

    /**
     * Lists the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getVersions(string $projectId, string $environmentId, string $versionId): Version
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    }

    /**
     * Initializes a new environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function initialize(
        string $projectId,
        string $environmentId,
        array $environmentInitializeInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentInitializeInput = new EnvironmentInitializeInput($environmentInitializeInput);
        return $this->api->initializeEnvironment($projectId, $environmentId, $environmentInitializeInput);
    }

    /**
     * Gets list of project environments
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironments($projectId);
    }

    /**
     * Lists versions associated with the environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVersions(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsVersions($projectId, $environmentId);
    }

    /**
     * Merges an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function merge(string $projectId, string $environmentId, array $environmentMergeInput): AcceptedResponse
    {
        $this->refreshToken();
        $environmentMergeInput = new EnvironmentMergeInput($environmentMergeInput);
        return $this->api->mergeEnvironment($projectId, $environmentId, $environmentMergeInput);
    }

    /**
     * Pauses an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function pause(string $projectId, string $environmentId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->pauseEnvironment($projectId, $environmentId);
    }

    /**
     * Redeploys an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function redeploy(string $projectId, string $environmentId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->redeployEnvironment($projectId, $environmentId);
    }

    /**
     * Resume a paused environment
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function resume(string $projectId, string $environmentId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->resumeEnvironment($projectId, $environmentId);
    }

    /**
     * Synchronizes a child environment with its parent
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function synchronize(
        string $projectId,
        string $environmentId,
        array $environmentSynchronizeInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentSynchronizeInput = new EnvironmentSynchronizeInput($environmentSynchronizeInput);
        return $this->api->synchronizeEnvironment($projectId, $environmentId, $environmentSynchronizeInput);
    }

    /**
     * Updates an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, string $environmentId, array $environmentPatch): AcceptedResponse
    {
        $this->refreshToken();
        $environmentPatch = new EnvironmentPatch($environmentPatch);
        return $this->api->updateEnvironment($projectId, $environmentId, $environmentPatch);
    }

    /**
     * Updates the version
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateVersions(
        string $projectId,
        string $environmentId,
        string $versionId,
        array $versionPatch
    ): AcceptedResponse {
        $this->refreshToken();
        $versionPatch = new VersionPatch($versionPatch);
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
     */
    public function activitiesCancel(string $projectId, string $environmentId, string $activityId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->client->activity->cancel($projectId, $activityId, $environmentId);
    }

    /**
     * Gets an environment activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getActivities(string $projectId, string $environmentId, string $activityId): Activity
    {
        $this->refreshToken();
        return $this->client->activity->get($projectId, $activityId, $environmentId);
    }

    /**
     * Gets environment activity log
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listActivities(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->client->activity->list($projectId, $environmentId);
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
        return $this->client->backup->backup($projectId, $environmentId, $environmentBackupInput);
    }

    /**
     * Deletes an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteBackup(string $projectId, string $environmentId, string $backupId): AcceptedResponse
    {
        return $this->client->backup->delete($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment snapshot's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getBackup(string $projectId, string $environmentId, string $backupId): Backup
    {
        return $this->client->backup->get($projectId, $environmentId, $backupId);
    }

    /**
     * Gets an environment's snapshot list
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listBackups(string $projectId, string $environmentId): array
    {
        return $this->client->backup->list($projectId, $environmentId);
    }

    /**
     * Restores an environment snapshot
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function restoreBackup(
        string $projectId,
        string $environmentId,
        string $backupId,
        array $environmentRestoreInput
    ): AcceptedResponse {
        return $this->client->backup->restore($projectId, $environmentId, $backupId, $environmentRestoreInput);
    }

    /**
     * Gets environment type links
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getType(string $projectId, string $environment_type_id): EnvironmentType
    {
        $this->refreshToken();
        return $this->typeApi->getEnvironmentType($projectId, $environment_type_id);
    }

    /**
     * Gets environment types
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTypes(string $projectId): array
    {
        $this->refreshToken();
        return $this->typeApi->listProjectsEnvironmentTypes($projectId);
    }

    /**
     * Adds an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(
        string $projectId,
        string $environmentId,
        array $environmentVariableCreateInput
    ): AcceptedResponse {
        return $this->client->variables->createEnvironmentVariable(
            $projectId,
            $environmentId,
            $environmentVariableCreateInput
        );
    }

    /**
     * Deletes an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $projectId, string $environmentId, string $variableId): AcceptedResponse
    {
        return $this->client->variables->deleteEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getVariable(string $projectId, string $environmentId, string $variableId): EnvironmentVariable
    {
        return $this->client->variables->getEnvironmentVariable($projectId, $environmentId, $variableId);
    }

    /**
     * Gets list of environment variables
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVariables(string $projectId, string $environmentId): array
    {
        return $this->client->variables->listEnvironmentVariables($projectId, $environmentId);
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
        array $environmentVariablePatch
    ): AcceptedResponse {
        return $this->client->variables->updateEnvironmentVariable(
            $projectId,
            $environmentId,
            $variableId,
            $environmentVariablePatch
        );
    }

    /**
     * Creates a new route
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createRoute(string $projectId, string $environmentId, array $routeCreateInput): AcceptedResponse
    {
        return $this->client->route->create($projectId, $environmentId, $routeCreateInput);
    }

    /**
     * Deletes a route
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteRoute(string $projectId, string $environmentId, string $routeId): AcceptedResponse
    {
        return $this->client->route->delete($projectId, $environmentId, $routeId);
    }

    /**
     * Gets a route's info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getRoute(string $projectId, string $environmentId, string $routeId): Route
    {
        return $this->client->route->get($projectId, $environmentId, $routeId);
    }

    /**
     * Gets list of routes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listRoutes(string $projectId, string $environmentId): array
    {
        return $this->client->route->list($projectId, $environmentId);
    }

    /**
     * Updates a route
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateRoute(
        string $projectId,
        string $environmentId,
        string $routeId,
        array $routePatch
    ): AcceptedResponse {
        return $this->client->route->update($projectId, $environmentId, $routeId, $routePatch);
    }

    /**
     * Adds an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createDomain(
        string $projectId,
        string $environmentId,
        array $domainCreateInput
    ): AcceptedResponse {
        return $this->client->domain->create($projectId, $domainCreateInput, $environmentId);
    }

    /**
     * Deletes an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $projectId, string $environmentId, string $domainId): AcceptedResponse
    {
        return $this->client->domain->delete($projectId, $domainId, $environmentId);
    }

    /**
     * Gets an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $projectId, string $environmentId, string $domainId): Domain
    {
        return $this->client->domain->get($projectId, $environmentId, $domainId);
    }

    /**
     * Gets a list of environment domains
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDomains(string $projectId, string $environmentId): array
    {
        return $this->client->domain->list($projectId, $environmentId);
    }

    /**
     * Updates an environment domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDomain(
        string $projectId,
        string $environmentId,
        string $domainId,
        array $domainPatch
    ): AcceptedResponse {
        return $this->client->domain->update($projectId, $domainId, $domainPatch, $environmentId);
    }

    /**
     * Gets a single environment deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $projectId, string $environmentId, string $deploymentId): Deployment
    {
        $this->refreshToken();
        return $this->deploymentApi->getProjectsEnvironmentsDeployments($projectId, $environmentId, $deploymentId);
    }

    /**
     * Gets an environment's deployment information
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDeployments(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->deploymentApi->listProjectsEnvironmentsDeployments($projectId, $environmentId);
    }

    /**
     * Lists source operations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listSourceOperations(string $projectId, string $environmentId): array
    {
        return $this->client->sourceOperation->list($projectId, $environmentId);
    }

    /**
     * Triggers a source operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function runSourceOperation(
        string $projectId,
        string $environmentId,
        array $environmentSourceOperationInput
    ): AcceptedResponse {
        return $this->client->sourceOperation->run($projectId, $environmentId, $environmentSourceOperationInput);
    }
}
