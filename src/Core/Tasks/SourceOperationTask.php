<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\SourceOperationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentSourceOperationInput;
use Upsun\UpsunClient;

class SourceOperationTask extends TaskBase
{

    public function __construct(
        public readonly UpsunClient $client,
        private readonly SourceOperationsApi $api,
    )
    {
    }

    /**
     * Lists source operations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsSourceOperations($projectId, $environmentId);
    }

    /**
     * Trigger a source operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function run(
        string $projectId,
        string $environmentId,
        array  $environmentSourceOperationInput
    ): AcceptedResponse
    {
        $this->refreshToken();
        $environmentSourceOperationInput = new EnvironmentSourceOperationInput($environmentSourceOperationInput);
        return $this->api->runSourceOperation($projectId, $environmentId, $environmentSourceOperationInput);
    }
}
