<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;

/**
 * OperationTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class OperationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly RuntimeOperationsApi $api
    ) {
        parent::__construct($client);
    }

    /**
     * Executes a runtime operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        string $service,
        string $operation,
        array $parameters
    ): AcceptedResponse {
        $environmentOperationInput = new EnvironmentOperationInput(
            service: $service,
            operation: $operation,
            parameters: $parameters
        );
        return $this->api->runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput);
    }
}
