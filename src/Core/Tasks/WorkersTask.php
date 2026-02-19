<?php

namespace Upsun\Core\Tasks;

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
     * @throws ApiException
     * @throws ClientExceptionInterface
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
