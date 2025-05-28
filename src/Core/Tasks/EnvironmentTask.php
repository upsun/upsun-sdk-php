<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\EnvironmentActivateInput;
use OpenAPI\Client\Model\EnvironmentBranchInput;
use OpenAPI\Client\Model\EnvironmentInitializeInput;
use OpenAPI\Client\Model\EnvironmentMergeInput;
use OpenAPI\Client\Model\EnvironmentPatch;
use OpenAPI\Client\Model\EnvironmentSynchronizeInput;
use OpenAPI\Client\Model\Version;
use OpenAPI\Client\Model\VersionCreateInput;
use OpenAPI\Client\Model\VersionPatch;
use Upsun\UpsunClient;

class EnvironmentTask extends TaskBase
{
    public EnvironmentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new EnvironmentApi($this->client->apiClient, $this->client->apiConfig);
    }

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
}