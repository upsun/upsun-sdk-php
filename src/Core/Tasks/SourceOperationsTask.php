<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
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
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * 
     * @return EnvironmentSourceOperation[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        return $this->api->listProjectsEnvironmentsSourceOperations(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Trigger a source operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $operation,
        array $variables
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->api->runSourceOperation(
            projectId: $projectId,
            environmentId: $environmentId,
            environmentSourceOperationInput: new EnvironmentSourceOperationInput(
                operation: $operation,
                variables: $variables
            )
        );
    }
}
