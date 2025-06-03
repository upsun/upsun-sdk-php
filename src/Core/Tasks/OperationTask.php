<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;

class OperationTask extends TaskBase
{
    public readonly RuntimeOperationsApi $api;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new RuntimeOperationsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** *********************************/
    /********* RuntimeOperationsApi  ****************/
    /************** *********************************/

    /**
     * Operation runOperation
     *
     * Execute a runtime operation
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $deployment_id deployment_id (required)
     * @param array $environment_operation_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function run(string $project_id, string $environment_id, string $deployment_id, array $environment_operation_input): AcceptedResponse
    {
        $this->refreshToken();
        $environment_operation_input = new EnvironmentOperationInput($environment_operation_input);
        return $this->api->runOperation($project_id, $environment_id, $deployment_id, $environment_operation_input);
    }
}