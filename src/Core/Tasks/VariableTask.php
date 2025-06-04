<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentVariablesApi;
use OpenAPI\Client\apisgen\ProjectVariablesApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentVariable;
use OpenAPI\Client\Model\EnvironmentVariableCreateInput;
use OpenAPI\Client\Model\EnvironmentVariablePatch;
use OpenAPI\Client\Model\ProjectVariable;
use OpenAPI\Client\Model\ProjectVariableCreateInput;
use OpenAPI\Client\Model\ProjectVariablePatch;
use Upsun\UpsunClient;

class VariableTask extends TaskBase
{
    public readonly ProjectVariablesApi $projectVariablesApi;

    public readonly EnvironmentVariablesApi $environmentVariablesApi;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->projectVariablesApi = new ProjectVariablesApi($this->client->apiClient, $this->client->apiConfig);
        $this->environmentVariablesApi = new EnvironmentVariablesApi(
            $this->client->apiClient,
            $this->client->apiConfig
        );
    }

    /************** *******************************/
    /********* ProjectVariablesApi ****************/
    /************** *******************************/

    /**
     * Operation createProjectVariable
     *
     * Add a project variable
     *
     * @param string $project_id project_id (required)
     * @param array $project_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectVariable(string $project_id, array $project_variable_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $project_variable_create_input = new ProjectVariableCreateInput($project_variable_create_input);
        return $this->projectVariablesApi->createProjectsVariables($project_id, $project_variable_create_input);
    }

    /**
     * Operation deleteProjectVariable
     *
     * Delete a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectVariable(string $project_id, string $project_variable_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->projectVariablesApi->deleteProjectsVariables($project_id, $project_variable_id);
    }

    /**
     * Operation getProjectVariable
     *
     * Get a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @return ProjectVariable
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectVariable(string $project_id, string $project_variable_id): ProjectVariable
    {
        $this->refreshToken();
        return $this->projectVariablesApi->getProjectsVariables($project_id, $project_variable_id);
    }

    /**
     * Operation listProjectVariables
     *
     * Get list of project variables
     *
     * @param string $project_id project_id (required)
     * @return ProjectVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectVariables(string $project_id): array
    {
        $this->refreshToken();
        return $this->projectVariablesApi->listProjectsVariables($project_id);
    }

    /**
     * Operation updateProjectVariable
     *
     * Update a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @param array $project_variable_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectVariable(
        string $project_id,
        string $project_variable_id,
        array $project_variable_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $project_variable_patch = new ProjectVariablePatch($project_variable_patch);
        return $this->projectVariablesApi->updateProjectsVariables(
            $project_id,
            $project_variable_id,
            $project_variable_patch
        );
    }

    /************** ***********************************/
    /********* EnvironmentVariablesApi ****************/
    /************** ***********************************/

    /**
     * Operation createEnvironmentVariable
     *
     * Add an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createEnvironmentVariable(
        string $project_id,
        string $environment_id,
        array $environment_variable_create_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_variable_create_input = new EnvironmentVariableCreateInput($environment_variable_create_input);
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
            $project_id,
            $environment_id,
            $environment_variable_create_input
        );
    }

    /**
     * Operation deleteEnvironmentVariable
     *
     * Delete an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteEnvironmentVariable(
        string $project_id,
        string $environment_id,
        string $variable_id
    ): AcceptedResponse {
        $this->refreshToken();
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
            $project_id,
            $environment_id,
            $variable_id
        );
    }

    /**
     * Operation getEnvironmentVariable
     *
     * Get an environment variable
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $variable_id variable_id (required)
     * @return EnvironmentVariable
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getEnvironmentVariable(
        string $project_id,
        string $environment_id,
        string $variable_id
    ): EnvironmentVariable {
        $this->refreshToken();
        return $this->environmentVariablesApi->getProjectsEnvironmentsVariables(
            $project_id,
            $environment_id,
            $variable_id
        );
    }

    /**
     * Operation listEnvironmentVariables
     *
     * Get list of environment variables
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listEnvironmentVariables(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->environmentVariablesApi->listProjectsEnvironmentsVariables($project_id, $environment_id);
    }

    /**
     * Operation updateEnvironmentVariable
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
    public function updateEnvironmentVariable(
        string $project_id,
        string $environment_id,
        string $variable_id,
        array $environment_variable_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_variable_patch = new EnvironmentVariablePatch($environment_variable_patch);
        return $this->environmentVariablesApi->updateProjectsEnvironmentsVariables(
            $project_id,
            $environment_id,
            $variable_id,
            $environment_variable_patch
        );
    }
}
