<?php

namespace Upsun\Core\Tasks;

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
        $projectVariableCreateInput = new ProjectVariableCreateInput(
            name: $name,
            value: $value,
            attributes: $attributes,
            isJson: $isJson,
            isSensitive: $isSensitive,
            visibleBuild: $visibleBuild,
            visibleRuntime: $visibleRuntime,
            applicationScope: $applicationScope
        );
        return $this->projectVariablesApi->createProjectsVariables($projectId, $projectVariableCreateInput);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteProjectVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->projectVariablesApi->deleteProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        return $this->projectVariablesApi->getProjectsVariables($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectVariable[]
     */
    public function listProjectVariables(string $projectId): array
    {
        return $this->projectVariablesApi->listProjectsVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
        $projectVariablePatch = new ProjectVariablePatch(
            name: $name,
            attributes: $attributes,
            value: $value,
            isJson: $isJson,
            isSensitive: $isSensitive,
            visibleBuild: $visibleBuild,
            visibleRuntime: $visibleRuntime,
            applicationScope: $applicationScope,
        );
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
     * @throws ClientExceptionInterface
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
        $environmentVariableCreateInput = new EnvironmentVariableCreateInput(
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
        );
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
     * @throws ClientExceptionInterface
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return EnvironmentVariable[]
     */
    public function listEnvironmentVariables(string $projectId, string $environmentId): array
    {
        return $this->environmentVariablesApi->listProjectsEnvironmentsVariables($projectId, $environmentId);
    }

    /**
     * Updates an environment variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
        $environmentVariablePatch = new EnvironmentVariablePatch(
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
        );
        return $this->environmentVariablesApi->updateProjectsEnvironmentsVariables(
            $projectId,
            $environmentId,
            $variableId,
            $environmentVariablePatch
        );
    }
}
