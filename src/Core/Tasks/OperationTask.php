<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;

class OperationTask extends TaskBase
{

    public function __construct(
        public UpsunClient           $client,
        private readonly RuntimeOperationsApi $api
    )
    {
        parent::__construct($this->client);
    }

    /**
     * Executes a runtime operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        array  $environmentOperationInput
    ): AcceptedResponse
    {
        $this->refreshToken();
        $environmentOperationInput = new EnvironmentOperationInput($environmentOperationInput);
        return $this->api->runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput);
    }
}
