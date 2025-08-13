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
    public function __construct(
        public UpsunClient $client,
        private readonly ProjectVariablesApi $projectVariablesApi,
        private readonly EnvironmentVariablesApi $environmentVariablesApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Adds a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectVariable(string $projectId, array $projectVariableCreateInput): AcceptedResponse
    {
        $this->refreshToken();
        $projectVariableCreateInput = new ProjectVariableCreateInput($projectVariableCreateInput);
        return $this->projectVariablesApi->createProjectsVariables($projectId, $projectVariableCreateInput);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->projectVariablesApi->deleteProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        $this->refreshToken();
        return $this->projectVariablesApi->getProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectVariables(string $projectId): array
    {
        $this->refreshToken();
        return $this->projectVariablesApi->listProjectsVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectVariable(
        string $projectId,
        string $projectVariableId,
        array $projectVariablePatch
    ): AcceptedResponse {
        $this->refreshToken();
        $projectVariablePatch = new ProjectVariablePatch($projectVariablePatch);
        return $this->projectVariablesApi->updateProjectsVariables(
            $projectId,
            $projectVariableId,
            $projectVariablePatch
        );
    }

    /**
     * Adds an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createEnvironmentVariable(
        string $projectId,
        string $environmentId,
        array $environmentVariableCreateInput
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentVariableCreateInput = new EnvironmentVariableCreateInput($environmentVariableCreateInput);
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
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
    public function deleteEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): AcceptedResponse {
        $this->refreshToken();
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId
        );
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): EnvironmentVariable {
        $this->refreshToken();
        return $this->environmentVariablesApi->getProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId
        );
    }

    /**
     * Lists environment variables
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->environmentVariablesApi->listProjectsEnvironmentsVariables($projectId, $environmentId);
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
        array $environmentVariablePatch
    ): AcceptedResponse {
        $this->refreshToken();
        $environmentVariablePatch = new EnvironmentVariablePatch($environmentVariablePatch);
        return $this->environmentVariablesApi->updateProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId,
            $environmentVariablePatch
        );
    }
}
