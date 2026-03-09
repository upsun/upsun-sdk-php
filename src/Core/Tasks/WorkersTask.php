<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Model\WorkersValue;
use Upsun\UpsunClient;

/**
 * WorkersTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class WorkersTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
    ) {
        parent::__construct($client);
    }

    /**
     * Lists workers of an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return array<string, WorkersValue>
     */
    public function list(string $projectId, string $environmentId): array
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        $currentDeployment = $this->client->environments->getDeployment(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: 'current'
        );

        return $currentDeployment?->getWorkers() ?? [];
    }
}
