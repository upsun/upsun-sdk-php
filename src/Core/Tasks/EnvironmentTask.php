<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\apisgen\EnvironmentActivityApi;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\apisgen\EnvironmentBackupsApi;
use OpenAPI\Client\apisgen\EnvironmentTypeApi;
use OpenAPI\Client\apisgen\EnvironmentVariablesApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\Backup;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\EnvironmentActivateInput;
use OpenAPI\Client\Model\EnvironmentBackupInput;
use OpenAPI\Client\Model\EnvironmentBranchInput;
use OpenAPI\Client\Model\EnvironmentInitializeInput;
use OpenAPI\Client\Model\EnvironmentMergeInput;
use OpenAPI\Client\Model\EnvironmentPatch;
use OpenAPI\Client\Model\EnvironmentRestoreInput;
use OpenAPI\Client\Model\EnvironmentSourceOperation;
use OpenAPI\Client\Model\EnvironmentSynchronizeInput;
use OpenAPI\Client\Model\EnvironmentType;
use OpenAPI\Client\Model\EnvironmentVariable;
use OpenAPI\Client\Model\EnvironmentVariableCreateInput;
use OpenAPI\Client\Model\EnvironmentVariablePatch;
use OpenAPI\Client\Model\Route;
use OpenAPI\Client\Model\Version;
use OpenAPI\Client\Model\VersionCreateInput;
use OpenAPI\Client\Model\VersionPatch;
use Upsun\UpsunClient;

class EnvironmentTask extends TaskBase
{
    public readonly EnvironmentApi $api;
    public readonly EnvironmentActivityApi $activityApi;
    public readonly EnvironmentBackupsApi $backupsApi;
    public readonly EnvironmentTypeApi $typeApi;
    public readonly EnvironmentVariablesApi $variablesApi;
    public readonly DeploymentApi $deploymentApi;
    public readonly RouteTask   $routeTask;
    public readonly DomainTask  $domainTask;
    public readonly SourceOperationTask $sourceOperationTask;

    public function __construct(
        public readonly UpsunClient $client
    )
    {
        $this->api = new EnvironmentApi($this->client->apiClient, $this->client->apiConfig);
        $this->activityApi = new EnvironmentActivityApi($this->client->apiClient, $this->client->apiConfig);
        $this->backupsApi = new EnvironmentBackupsApi($this->client->apiClient, $this->client->apiConfig);
        $this->typeApi = new EnvironmentTypeApi($this->client->apiClient, $this->client->apiConfig);
        $this->variablesApi = new EnvironmentVariablesApi($this->client->apiClient, $this->client->apiConfig);
        $this->deploymentApi = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
        $this->routeTask = new RouteTask($this->client);
        $this->domainTask = new DomainTask($this->client);
        $this->sourceOperationTask = new SourceOperationTask($this->client);
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
    public function activateEnvironment(string $project_id, string $environment_id, array $environment_activate_input): AcceptedResponse
    {
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
    public function branchEnvironment(string $project_id, string $environment_id, array $environment_branch_input): AcceptedResponse
    {
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
    public function createProjectsEnvironmentsVersions(string $project_id, string $environment_id, array $version_create_input): AcceptedResponse
    {
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
    public function deactivateEnvironment(string $project_id, string $environment_id): AcceptedResponse
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
    public function deleteEnvironment(string $project_id, string $environment_id): AcceptedResponse
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
    public function deleteProjectsEnvironmentsVersions(string $project_id, string $environment_id, string $version_id): AcceptedResponse
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
    public function getEnvironment(string $project_id, string $environment_id): Environment
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
    public function getProjectsEnvironmentsVersions(string $project_id, string $environment_id, string $version_id): Version
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
    public function initializeEnvironment(string $project_id, string $environment_id, array $environment_initialize_input): AcceptedResponse
    {
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
    public function listProjectsEnvironments(string $project_id): array
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
    public function listProjectsEnvironmentsVersions(string $project_id, string $environment_id): array
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
    public function mergeEnvironment(string $project_id, string $environment_id, array $environment_merge_input): AcceptedResponse
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
    public function pauseEnvironment(string $project_id, string $environment_id): AcceptedResponse
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
    public function redeployEnvironment(string $project_id, string $environment_id): AcceptedResponse
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
    public function resumeEnvironment(string $project_id, string $environment_id): AcceptedResponse
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
    public function synchronizeEnvironment(string $project_id, string $environment_id, array $environment_synchronize_input): AcceptedResponse
    {
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
    public function updateEnvironment(string $project_id, string $environment_id, array $environment_patch): AcceptedResponse
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
    public function updateProjectsEnvironmentsVersions(string $project_id, string $environment_id, string $version_id, array $version_patch): AcceptedResponse
    {
        $this->refreshToken();
        $version_patch = new VersionPatch($version_patch);
        return $this->api->updateProjectsEnvironmentsVersions($project_id, $environment_id, $version_id, $version_patch);
    }

    /************** **********************************/
    /********* EnvironmentActivityApi ****************/
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
    public function actionProjectsEnvironmentsActivitiesCancel(string $project_id, string $environment_id, string $activity_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->activityApi->actionProjectsEnvironmentsActivitiesCancel($project_id, $environment_id, $activity_id);
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
    public function getProjectsEnvironmentsActivities(string $project_id, string $environment_id, string $activity_id): Activity
    {
        $this->refreshToken();
        return $this->activityApi->getProjectsEnvironmentsActivities($project_id, $environment_id, $activity_id);
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
    public function listProjectsEnvironmentsActivities(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->activityApi->listProjectsEnvironmentsActivities($project_id, $environment_id);
    }

    /************** *********************************/
    /********* EnvironmentBackupsApi ****************/
    /************** *********************************/

    /**
     * Operation backupEnvironment
     *
     * Create snapshot of environment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_backup_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function backupEnvironment(string $project_id, string $environment_id, array $environment_backup_input): AcceptedResponse
    {
        $this->refreshToken();
        $environment_backup_input = new EnvironmentBackupInput($environment_backup_input);
        return $this->backupsApi->backupEnvironment($project_id, $environment_id, $environment_backup_input);
    }

    /**
     * Operation deleteProjectsEnvironmentsBackups
     *
     * Delete an environment snapshot
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsEnvironmentsBackups(string $project_id, string $environment_id, string $backup_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->backupsApi->deleteProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation getProjectsEnvironmentsBackups
     *
     * Get an environment snapshot&#39;s info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $backup_id backup_id (required)
     * @return Backup
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsBackups(string $project_id, string $environment_id, string $backup_id): Backup
    {
        $this->refreshToken();
        return $this->backupsApi->getProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    }

    /**
     * Operation listProjectsEnvironmentsBackups
     *
     * Get an environment&#39;s snapshot list
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Backup[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsEnvironmentsBackups(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->backupsApi->listProjectsEnvironmentsBackups($project_id, $environment_id);
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
    public function restoreBackup(string $project_id, string $environment_id, string $backup_id, array $environment_restore_input): AcceptedResponse
    {
        $this->refreshToken();
        $environment_restore_input = new EnvironmentRestoreInput($environment_restore_input);
        return $this->backupsApi->restoreBackup($project_id, $environment_id, $backup_id, $environment_restore_input);
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
    public function getEnvironmentType(string $project_id, string $environment_type_id): EnvironmentType
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
    public function listProjectsEnvironmentTypes(string $project_id): array
    {
        $this->refreshToken();
        return $this->typeApi->listProjectsEnvironmentTypes($project_id);
    }

    /************** ***********************************/
    /********* EnvironmentVariablesApi ****************/
    /************** ***********************************/

    /**
     * Operation createProjectsEnvironmentsVariables
     *
     * Add an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsEnvironmentsVariables(string $project_id, string $environment_id, array $environment_variable_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $environment_variable_create_input = new EnvironmentVariableCreateInput($environment_variable_create_input);
        return $this->variablesApi->createProjectsEnvironmentsVariables($project_id, $environment_id, $environment_variable_create_input);
    }

    /**
     * Operation deleteProjectsEnvironmentsVariables
     *
     * Delete an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsEnvironmentsVariables(string $project_id, string $environment_id, string $variable_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->variablesApi->deleteProjectsEnvironmentsVariables($project_id, $environment_id, $variable_id);
    }

    /**
     * Operation getProjectsEnvironmentsVariables
     *
     * Get an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return EnvironmentVariable
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsVariables(string $project_id, string $environment_id, string $variable_id): EnvironmentVariable
    {
        $this->refreshToken();
        return $this->variablesApi->getProjectsEnvironmentsVariables($project_id, $environment_id, $variable_id);
    }

    /**
     * Operation listProjectsEnvironmentsVariables
     *
     * Get list of environment variables
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsEnvironmentsVariables(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->variablesApi->listProjectsEnvironmentsVariables($project_id, $environment_id);
    }

    /**
     * Operation updateProjectsEnvironmentsVariables
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
    public function updateProjectsEnvironmentsVariables(string $project_id, string $environment_id, string $variable_id, array $environment_variable_patch): AcceptedResponse
    {
        $this->refreshToken();
        $environment_variable_patch = new EnvironmentVariablePatch($environment_variable_patch);
        return $this->variablesApi->updateProjectsEnvironmentsVariables($project_id, $environment_id, $variable_id, $environment_variable_patch);
    }

    /************** **********************************/
    /********* RoutingTask shortcuts  ****************/
    /************** **********************************/

    /**
     * Operation createProjectsEnvironmentsRoutes
     *
     * Create a new route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $route_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsEnvironmentsRoutes(string $project_id, string $environment_id, array $route_create_input): AcceptedResponse
    {
        return $this->routeTask->createProjectsEnvironmentsRoutes($project_id, $environment_id, $route_create_input);
    }

    /**
     * Operation deleteProjectsEnvironmentsRoutes
     *
     * Delete a route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsEnvironmentsRoutes(string $project_id, string $environment_id, string $route_id): AcceptedResponse
    {
        return $this->routeTask->deleteProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
    }

    /**
     * Operation getProjectsEnvironmentsRoutes
     *
     * Get a route&#39;s info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return Route
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsRoutes(string $project_id, string $environment_id, string $route_id): Route
    {
        return $this->routeTask->getProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
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
    public function listProjectsEnvironmentsRoutes(string $project_id, string $environment_id): array
    {
        return $this->routeTask->listProjectsEnvironmentsRoutes($project_id, $environment_id);
    }

    /**
     * Operation updateProjectsEnvironmentsRoutes
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
    public function updateProjectsEnvironmentsRoutes(string $project_id, string $environment_id, string $route_id, array $route_patch): AcceptedResponse
    {
        return $this->routeTask->updateProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id, $route_patch);
    }

    /************** *********************************/
    /********* DomainTask shortcuts  ****************/
    /************** *********************************/

    /**
     * Operation createProjectsEnvironmentsDomains
     *
     * Add an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsEnvironmentsDomains(string $project_id, string $environment_id, array $domain_create_input): AcceptedResponse
    {
        return $this->domainTask->createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input);
    }

    /**
     * Operation deleteProjectsEnvironmentsDomains
     *
     * Delete an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id): AcceptedResponse
    {
        return $this->domainTask->deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation getProjectsEnvironmentsDomains
     *
     * Get an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id): Domain
    {
        return $this->domainTask->getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
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
    public function listProjectsEnvironmentsDomains(string $project_id, string $environment_id): array
    {
        return $this->domainTask->listProjectsEnvironmentsDomains($project_id, $environment_id);
    }

    /**
     * Operation updateProjectsEnvironmentsDomains
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
    public function updateProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        return $this->domainTask->updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch);
    }

    /************** *************************/
    /********* DeploymentApi ****************/
    /************** *************************/

    /**
     * Operation getProjectsEnvironmentsDeployments
     *
     * Get a single environment deployment
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $deployment_id deployment_id (required)
     * @return Deployment
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsDeployments(string $project_id, string $environment_id, string $deployment_id): Deployment
    {
        $this->refreshToken();
        return $this->deploymentApi->getProjectsEnvironmentsDeployments($project_id, $environment_id, $deployment_id);
    }

    /**
     * Operation listProjectsEnvironmentsDeployments
     *
     * Get an environment&#39;s deployment information
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Deployment[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsEnvironmentsDeployments(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->deploymentApi->listProjectsEnvironmentsDeployments($project_id, $environment_id);
    }

    /************** *****************************************/
    /********* SourceOperationTask shortcuts ****************/
    /************** *****************************************/

    /**
     * Operation listProjectsEnvironmentsSourceOperations
     *
     * List source operations
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentSourceOperation[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsEnvironmentsSourceOperations(string $project_id, string $environment_id): array
    {
        return $this->sourceOperationTask->listProjectsEnvironmentsSourceOperations($project_id, $environment_id);
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
    public function runSourceOperation(string $project_id, string $environment_id, array $environment_source_operation_input): AcceptedResponse
    {
        return $this->sourceOperationTask->runSourceOperation($project_id, $environment_id, $environment_source_operation_input);
    }
    
    /************** ****************************/
    /********* Custom function  ****************/
    /************** ****************************/


}