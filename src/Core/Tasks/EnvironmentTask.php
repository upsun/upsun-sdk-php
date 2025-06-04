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
use OpenAPI\Client\Model\EnvironmentSourceOperation;
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
    public readonly EnvironmentApi $api;
    public readonly EnvironmentTypeApi $typeApi;
    public readonly DeploymentApi $deploymentApi;

    public function __construct(
        public readonly UpsunClient $client
    ) {
        $this->api = new EnvironmentApi($this->client->apiClient, $this->client->apiConfig);
        $this->typeApi = new EnvironmentTypeApi($this->client->apiClient, $this->client->apiConfig);
        $this->deploymentApi = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************/
    /********* EnvironmentApi ****************/
    /************** **************************/

    /**
     * Operation activateEnvironment
     *
     * Activate an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_activate_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function activate(
        string $project_id,
        string $environment_id,
        array $environment_activate_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_activate_input = new EnvironmentActivateInput($environment_activate_input);
        return $this->api->activateEnvironment($project_id, $environment_id, $environment_activate_input);
    }

    /**
     * Operation branchEnvironment
     *
     * Branch an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_branch_input (required)
     *
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function branch(
        string $project_id,
        string $environment_id,
        array $environment_branch_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_branch_input = new EnvironmentBranchInput($environment_branch_input);
        return $this->api->branchEnvironment($project_id, $environment_id, $environment_branch_input);
    }

    /**
     * Operation createProjectsEnvironmentsVersions
     *
     * Create versions associated with the environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $version_create_input (required)
     *
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVersions(
        string $project_id,
        string $environment_id,
        array $version_create_input
    ): AcceptedResponse {
        $this->refreshToken();
        $version_create_input = new VersionCreateInput($version_create_input);
        return $this->api->createProjectsEnvironmentsVersions($project_id, $environment_id, $version_create_input);
    }

    /**
     * Operation deactivateEnvironment
     *
     * Deactivate an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     *
     * @return AcceptedResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deactivate(string $project_id, string $environment_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deactivateEnvironment($project_id, $environment_id);
    }

    /**
     * Operation deleteEnvironment
     *
     * Delete an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id, string $environment_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteEnvironment($project_id, $environment_id);
    }

    /**
     * Operation deleteProjectsEnvironmentsVersions
     *
     * Delete the version
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $version_id version_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVersions(string $project_id, string $environment_id, string $version_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsVersions($project_id, $environment_id, $version_id);
    }

    /**
     * Operation getEnvironment
     *
     * Get an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Environment
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $environment_id): Environment
    {
        $this->refreshToken();
        return $this->api->getEnvironment($project_id, $environment_id);
    }

    /**
     * Operation getProjectsEnvironmentsVersions
     *
     * List the version
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $version_id version_id (required)
     * @return Version
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getVersions(string $project_id, string $environment_id, string $version_id): Version
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsVersions($project_id, $environment_id, $version_id);
    }

    /**
     * Operation initializeEnvironment
     *
     * Initialize a new environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_initialize_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function initialize(
        string $project_id,
        string $environment_id,
        array $environment_initialize_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_initialize_input = new EnvironmentInitializeInput($environment_initialize_input);
        return $this->api->initializeEnvironment($project_id, $environment_id, $environment_initialize_input);
    }

    /**
     * Operation listProjectsEnvironments
     *
     * Get list of project environments
     *
     * @param string $project_id project_id (required)
     * @return Environment[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironments($project_id);
    }

    /**
     * Operation listProjectsEnvironmentsVersions
     *
     * List versions associated with the environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Version[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVersions(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsVersions($project_id, $environment_id);
    }

    /**
     * Operation mergeEnvironment
     *
     * Merge an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_merge_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function merge(string $project_id, string $environment_id, array $environment_merge_input): AcceptedResponse
    {
        $this->refreshToken();
        $environment_merge_input = new EnvironmentMergeInput($environment_merge_input);
        return $this->api->mergeEnvironment($project_id, $environment_id, $environment_merge_input);
    }

    /**
     * Operation pauseEnvironment
     *
     * Pause an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function pause(string $project_id, string $environment_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->pauseEnvironment($project_id, $environment_id);
    }

    /**
     * Operation redeployEnvironment
     *
     * Redeploy an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function redeploy(string $project_id, string $environment_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->redeployEnvironment($project_id, $environment_id);
    }

    /**
     * Operation resumeEnvironment
     *
     * Resume a paused environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     *
     * @return AcceptedResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function resume(string $project_id, string $environment_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->resumeEnvironment($project_id, $environment_id);
    }

    /**
     * Operation synchronizeEnvironment
     *
     * Synchronize a child environment with its parent
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_synchronize_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function synchronize(
        string $project_id,
        string $environment_id,
        array $environment_synchronize_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_synchronize_input = new EnvironmentSynchronizeInput($environment_synchronize_input);
        return $this->api->synchronizeEnvironment($project_id, $environment_id, $environment_synchronize_input);
    }

    /**
     * Operation updateEnvironment
     *
     * Update an environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_patch (required)
     *
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $project_id, string $environment_id, array $environment_patch): AcceptedResponse
    {
        $this->refreshToken();
        $environment_patch = new EnvironmentPatch($environment_patch);
        return $this->api->updateEnvironment($project_id, $environment_id, $environment_patch);
    }

    /**
     * Operation updateProjectsEnvironmentsVersions
     *
     * Update the version
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $version_id version_id (required)
     * @param array $version_patch (required)
     *
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateVersions(
        string $project_id,
        string $environment_id,
        string $version_id,
        array $version_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $version_patch = new VersionPatch($version_patch);
        return $this->api->updateProjectsEnvironmentsVersions(
            $project_id,
            $environment_id,
            $version_id,
            $version_patch
        );
    }

    /************** **********************************/
    /********* ActivityTask shortcuts ****************/
    /************** **********************************/

    /**
     * Operation actionProjectsEnvironmentsActivitiesCancel
     *
     * Cancel an environment activity
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $activity_id activity_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function activitiesCancel(string $project_id, string $environment_id, string $activity_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->client->activity->environmentCancel($project_id, $environment_id, $activity_id);
    }

    /**
     * Operation getProjectsEnvironmentsActivities
     *
     * Get an environment activity log entry
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $activity_id activity_id (required)
     * @return Activity
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getActivities(string $project_id, string $environment_id, string $activity_id): Activity
    {
        $this->refreshToken();
        return $this->client->activity->environmentGet($project_id, $environment_id, $activity_id);
    }

    /**
     * Operation listProjectsEnvironmentsActivities
     *
     * Get environment activity log
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Activity[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listActivities(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->client->activity->environmentList($project_id, $environment_id);
    }

    /************** ********************************/
    /********* BackupTask shortcuts ****************/
    /************** ********************************/

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
        return $this->client->backup->backup($project_id, $environment_id, $environment_backup_input);
    }

    /**
     * Operation deleteBackup
     *
     * Delete an environment snapshot
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteBackup(string $project_id, string $environment_id, string $backup_id): AcceptedResponse
    {
        return $this->client->backup->delete($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation getBackup
     *
     * Get an environment snapshot's info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return Backup
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getBackup(string $project_id, string $environment_id, string $backup_id): Backup
    {
        return $this->client->backup->get($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation listBackups
     *
     * Get an environment's snapshot list
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Backup[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listBackups(string $project_id, string $environment_id): array
    {
        return $this->client->backup->list($project_id, $environment_id);
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
    public function restoreBackup(
        string $project_id,
        string $environment_id,
        string $backup_id,
        array $environment_restore_input
    ): AcceptedResponse {
        return $this->client->backup->restore($project_id, $environment_id, $backup_id, $environment_restore_input);
    }

    /************** *******************************/
    /********* EnvironmentTypesApi ****************/
    /************** *******************************/

    /**
     * Operation getEnvironmentType
     *
     * Get environment type links
     *
     * @param string $project_id project_id (required)
     * @param string $environment_type_id environment_type_id (required)
     * @return EnvironmentType
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getType(string $project_id, string $environment_type_id): EnvironmentType
    {
        $this->refreshToken();
        return $this->typeApi->getEnvironmentType($project_id, $environment_type_id);
    }

    /**
     * Operation listProjectsEnvironmentTypes
     *
     * Get environment types
     *
     * @param string $project_id project_id (required)
     * @return EnvironmentType[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTypes(string $project_id): array
    {
        $this->refreshToken();
        return $this->typeApi->listProjectsEnvironmentTypes($project_id);
    }

    /************** ***********************************/
    /********* VariableTask shortcuts ****************/
    /************** ***********************************/

    /**
     * Operation createVariable
     *
     * Add an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(
        string $project_id,
        string $environment_id,
        array $environment_variable_create_input
    ): AcceptedResponse {
        return $this->client->variables->createEnvironmentVariable(
            $project_id,
            $environment_id,
            $environment_variable_create_input
        );
    }

    /**
     * Operation deleteVariable
     *
     * Delete an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $project_id, string $environment_id, string $variable_id): AcceptedResponse
    {
        return $this->client->variables->deleteEnvironmentVariable($project_id, $environment_id, $variable_id);
    }

    /**
     * Operation getVariable
     *
     * Get an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return EnvironmentVariable
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getVariable(string $project_id, string $environment_id, string $variable_id): EnvironmentVariable
    {
        return $this->client->variables->getEnvironmentVariable($project_id, $environment_id, $variable_id);
    }

    /**
     * Operation listVariables
     *
     * Get list of environment variables
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVariables(string $project_id, string $environment_id): array
    {
        return $this->client->variables->listEnvironmentVariables($project_id, $environment_id);
    }

    /**
     * Operation updateVariable
     *
     * Update an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @param array $environment_variable_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateVariable(
        string $project_id,
        string $environment_id,
        string $variable_id,
        array $environment_variable_patch
    ): AcceptedResponse {
        return $this->client->variables->updateEnvironmentVariable(
            $project_id,
            $environment_id,
            $variable_id,
            $environment_variable_patch
        );
    }

    /************** ********************************/
    /********* RouteTask shortcuts  ****************/
    /************** ********************************/

    /**
     * Operation createRoute
     *
     * Create a new route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $route_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createRoute(string $project_id, string $environment_id, array $route_create_input): AcceptedResponse
    {
        return $this->client->route->create($project_id, $environment_id, $route_create_input);
    }

    /**
     * Operation deleteRoute
     *
     * Delete a route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteRoute(string $project_id, string $environment_id, string $route_id): AcceptedResponse
    {
        return $this->client->route->delete($project_id, $environment_id, $route_id);
    }

    /**
     * Operation getRoute
     *
     * Get a route's info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return Route
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getRoute(string $project_id, string $environment_id, string $route_id): Route
    {
        return $this->client->route->get($project_id, $environment_id, $route_id);
    }

    /**
     * Operation listProjectsEnvironmentsRoutes
     *
     * Get list of routes
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Route[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listRoutes(string $project_id, string $environment_id): array
    {
        return $this->client->route->list($project_id, $environment_id);
    }

    /**
     * Operation updateRoute
     *
     * Update a route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @param array $route_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateRoute(
        string $project_id,
        string $environment_id,
        string $route_id,
        array $route_patch
    ): AcceptedResponse {
        return $this->client->route->update($project_id, $environment_id, $route_id, $route_patch);
    }

    /************** *********************************/
    /********* DomainTask shortcuts  ****************/
    /************** *********************************/

    /**
     * Operation createDomain
     *
     * Add an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createDomain(
        string $project_id,
        string $environment_id,
        array $domain_create_input
    ): AcceptedResponse {
        return $this->client->domain->createEnvironmentDomain($project_id, $environment_id, $domain_create_input);
    }

    /**
     * Operation deleteDomain
     *
     * Delete an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $project_id, string $environment_id, string $domain_id): AcceptedResponse
    {
        return $this->client->domain->deleteEnvironmentDomain($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation getDomain
     *
     * Get an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $project_id, string $environment_id, string $domain_id): Domain
    {
        return $this->client->domain->getEnvironmentDomain($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation listProjectsEnvironmentsDomains
     *
     * Get a list of environment domains
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDomains(string $project_id, string $environment_id): array
    {
        return $this->client->domain->listEnvironmentDomains($project_id, $environment_id);
    }

    /**
     * Operation updateDomain
     *
     * Update an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDomain(
        string $project_id,
        string $environment_id,
        string $domain_id,
        array $domain_patch
    ): AcceptedResponse {
        return $this->client->domain->updateEnvironmentDomain($project_id, $environment_id, $domain_id, $domain_patch);
    }

    /************** *************************/
    /********* DeploymentApi ****************/
    /************** *************************/

    /**
     * Operation getDeployment
     *
     * Get a single environment deployment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $deployment_id deployment_id (required)
     * @return Deployment
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $project_id, string $environment_id, string $deployment_id): Deployment
    {
        $this->refreshToken();
        return $this->deploymentApi->getProjectsEnvironmentsDeployments($project_id, $environment_id, $deployment_id);
    }

    /**
     * Operation listDeployments
     *
     * Get an environment's deployment information
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Deployment[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDeployments(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->deploymentApi->listProjectsEnvironmentsDeployments($project_id, $environment_id);
    }

    /************** *****************************************/
    /********* SourceOperationTask shortcuts ****************/
    /************** *****************************************/

    /**
     * Operation listSourceOperations
     *
     * List source operations
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentSourceOperation[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listSourceOperations(string $project_id, string $environment_id): array
    {
        return $this->client->sourceOperation->list($project_id, $environment_id);
    }

    /**
     * Operation runSourceOperation
     *
     * Trigger a source operation
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_source_operation_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function runSourceOperation(
        string $project_id,
        string $environment_id,
        array $environment_source_operation_input
    ): AcceptedResponse {
        return $this->client->sourceOperation->run($project_id, $environment_id, $environment_source_operation_input);
    }

    /************** ****************************/
    /********* Custom function  ****************/
    /************** ****************************/
}
