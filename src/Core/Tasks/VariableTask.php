<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\EnvironmentVariableCreateInput;
use Upsun\Model\EnvironmentVariablePatch;
use Upsun\Model\ProjectVariable;
use Upsun\Model\ProjectVariableCreateInput;
use Upsun\Model\ProjectVariablePatch;
use Upsun\UpsunClient;

/**
 * VariableTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     name: string,
     *     value: string,
     *     attributes?: array,
     *     isJson?: bool,
     *     isSensitive?: bool,
     *     visibleBuild?: bool,
     *     visibleRuntime?: bool,
     * } $data
     */
    public function createProjectVariable(string $projectId, array $data): AcceptedResponse
    {
        $projectVariableCreateInput = new ProjectVariableCreateInput(...$data);
        return $this->projectVariablesApi->createProjectsVariables($projectId, $projectVariableCreateInput);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->projectVariablesApi->deleteProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        return $this->projectVariablesApi->getProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @return ProjectVariable[]
     */
    public function listProjectVariables(string $projectId): array
    {
        return $this->projectVariablesApi->listProjectsVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     name?: string,
     *     attributes?: array,
     *     value?: string,
     *     isJson?: bool,
     *     isSensitive?: bool,
     *     visibleBuild?: bool,
     *     visibleRuntime?: bool,
     * } $data
     */
    public function updateProjectVariable(
        string $projectId,
        string $projectVariableId,
        array $data
    ): AcceptedResponse {
        $projectVariablePatch = new ProjectVariablePatch(...$data);
        return $this->projectVariablesApi->updateProjectsVariables(
            $projectId,
            $projectVariableId,
            $projectVariablePatch
        );
    }

    /**
     * Adds an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     name: string,
     *     value: string,
     *     attributes?: array,
     *     isJson?: bool,
     *     isSensitive?: bool,
     *     visibleBuild?: bool,
     *     visibleRuntime?: bool,
     *     isEnabled?: bool,
     *     isInheritable?: bool,
     * } $data
     */
    public function createEnvironmentVariable(
        string $projectId,
        string $environmentId,
        array $data
    ): AcceptedResponse {
        $environmentVariableCreateInput = new EnvironmentVariableCreateInput(...$data);
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $environmentVariableCreateInput
        );
    }

    /**
     * Deletes an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): AcceptedResponse {
        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId
        );
    }

    /**
     * Gets an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): EnvironmentVariable {
        return $this->environmentVariablesApi->getProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId
        );
    }

    /**
     * Lists environment variables
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @return EnvironmentVariable[]
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        return $this->environmentVariablesApi->listProjectsEnvironmentsVariables($projectId, $environmentId);
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     */
    public function updateEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
        array $data
    ): AcceptedResponse {
        $environmentVariablePatch = new EnvironmentVariablePatch(...$data);
        return $this->environmentVariablesApi->updateProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId,
            $environmentVariablePatch
        );
    }
}
