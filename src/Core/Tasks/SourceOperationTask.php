<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\SourceOperationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentSourceOperationInput;
use Upsun\UpsunClient;

/**
 * SourceOperationTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class SourceOperationTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly SourceOperationsApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Lists source operations
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsSourceOperations($projectId, $environmentId);
    }

    /**
     * Trigger a source operation
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function run(
        string $projectId,
        string $environmentId,
        array $environmentSourceOperationInput
    ): AcceptedResponse {
        $environmentSourceOperationInput = new EnvironmentSourceOperationInput($environmentSourceOperationInput);
        return $this->api->runSourceOperation($projectId, $environmentId, $environmentSourceOperationInput);
    }
}
