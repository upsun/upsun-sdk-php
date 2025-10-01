<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;

/**
 * OperationTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class OperationTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly RuntimeOperationsApi $api
    ) {
        parent::__construct($this->client);
    }

    /**
     * Executes a runtime operation
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     service: string,
     *     operation: string,
     *     parameters: array
     * } $data
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        array $data
    ): AcceptedResponse {
        $environmentOperationInput = new EnvironmentOperationInput(...$data);
        return $this->api->runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput);
    }
}
