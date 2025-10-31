<?php

namespace Upsun\Core\Tasks;

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
