<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\SourceOperationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentSourceOperation;
use OpenAPI\Client\Model\EnvironmentSourceOperationInput;
use Upsun\UpsunClient;

class SourceOperationTask extends TaskBase
{
    public readonly SourceOperationsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new SourceOperationsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ********************************/
    /********* SourceOperationsApi  ****************/
    /************** ********************************/

    /**
     * Operation list
     *
     * List source operations
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return EnvironmentSourceOperation[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsSourceOperations($project_id, $environment_id);
    }

    /**
     * Operation run
     *
     * Trigger a source operation
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $environment_source_operation_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function run(
        string $project_id,
        string $environment_id,
        array $environment_source_operation_input
    ): AcceptedResponse {
        $this->refreshToken();
        $environment_source_operation_input = new EnvironmentSourceOperationInput($environment_source_operation_input);
        return $this->api->runSourceOperation($project_id, $environment_id, $environment_source_operation_input);
    }
}
