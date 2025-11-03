<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\SourceOperationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\Model\EnvironmentSourceOperationInput;
use Upsun\UpsunClient;

/**
 * SourceOperationTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class SourceOperationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly SourceOperationsApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Lists source operations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return EnvironmentSourceOperation[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsSourceOperations($projectId, $environmentId);
    }

    /**
     * Trigger a source operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $operation,
        array $variables
    ): AcceptedResponse {
        $environmentSourceOperationInput = new EnvironmentSourceOperationInput(
            operation: $operation,
            variables: $variables
        );
        return $this->api->runSourceOperation($projectId, $environmentId, $environmentSourceOperationInput);
    }
}
