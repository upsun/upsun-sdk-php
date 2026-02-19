<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
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
 * VariablesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class VariablesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly ProjectVariablesApi $projectVariablesApi,
        private readonly EnvironmentVariablesApi $environmentVariablesApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Adds a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createProjectVariable(
        string $projectId,
        string $name,
        string $value,
        ?array $attributes = [],
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = [],
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        if( empty($name) ) { throw new InvalidArgumentException("Variable name is required"); }
        if( empty($value) ) { throw new InvalidArgumentException("Variable value is required"); }
    
        return $this->projectVariablesApi->createProjectsVariables(
            projectId: $projectId, 
            projectVariableCreateInput: new ProjectVariableCreateInput(
                name: $name,
                value: $value,
                attributes: $attributes,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope
            )
        );
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function deleteProjectVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        $this->checkProjectId($projectId);
        $this->checkVariableId($projectVariableId);

        return $this->projectVariablesApi->deleteProjectsVariables(
            projectId: $projectId,
            projectVariableId: $projectVariableId
        );
    }

    /**
     * Gets a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getProjectVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        $this->checkProjectId($projectId);
        $this->checkVariableId($projectVariableId);

        return $this->projectVariablesApi->getProjectsVariables(
            projectId: $projectId,
            projectVariableId: $projectVariableId
        );
    }

    /**
     * Gets list of project variables
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return ProjectVariable[]
     */
    public function listProjectVariables(string $projectId): array
    {
        $this->checkProjectId($projectId);

        return $this->projectVariablesApi->listProjectsVariables(projectId: $projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateProjectVariable(
        string $projectId,
        string $projectVariableId,
        ?string $name = null,
        ?string $value = null,
        ?array $attributes = null,
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = null,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkVariableId($projectVariableId);

        return $this->projectVariablesApi->updateProjectsVariables(
            projectId: $projectId,
            projectVariableId: $projectVariableId,
            projectVariablePatch: new ProjectVariablePatch(
                name: $name,
                attributes: $attributes,
                value: $value,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope,
            )
        );
    }

    /**
     * Adds an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createEnvironmentVariable(
        string $projectId,
        string $environmentId,
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
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if( empty($name) ) { throw new InvalidArgumentException("Variable name is required"); }
        if( empty($value) ) { throw new InvalidArgumentException("Variable value is required"); }

        return $this->environmentVariablesApi->createProjectsEnvironmentsVariables(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentVariableCreateInput: new EnvironmentVariableCreateInput(
                name: $name,
                value: $value,
                attributes: $attributes,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope,
                isEnabled: $isEnabled,
                isInheritable: $isInheritable
            )
        );
    }

    /**
     * Deletes an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function deleteEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkVariableId($variableId);

        return $this->environmentVariablesApi->deleteProjectsEnvironmentsVariables(
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
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId
    ): EnvironmentVariable {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkVariableId($variableId);

        return $this->environmentVariablesApi->getProjectsEnvironmentsVariables(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
    }

    /**
     * Lists environment variables
     *
     * @return EnvironmentVariable[]
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->environmentVariablesApi->listProjectsEnvironmentsVariables(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateEnvironmentVariable(
        string $projectId,
        string $environmentId,
        string $variableId,
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
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkVariableId($variableId);
        if( empty($name) ) { throw new InvalidArgumentException("Variable name is required"); }
        if( empty($value) ) { throw new InvalidArgumentException("Variable value is required"); }

        return $this->environmentVariablesApi->updateProjectsEnvironmentsVariables(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId,
            environmentVariablePatch: new EnvironmentVariablePatch(
                name: $name,
                attributes: $attributes,
                value: $value,
                isJson: $isJson,
                isSensitive: $isSensitive,
                visibleBuild: $visibleBuild,
                visibleRuntime: $visibleRuntime,
                applicationScope: $applicationScope,
                isEnabled: $isEnabled,
                isInheritable: $isInheritable
            )
        );
    }
}
