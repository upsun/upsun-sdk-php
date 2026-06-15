<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Model\WebApplicationsValue;
use Upsun\UpsunClient;

/**
 * ApplicationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://developer.upsun.com
 */
class ApplicationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client
    ) {
        parent::__construct($client);
    }

    /**
     * Get an environment's application
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function configGet(string $projectId, string $environmentId, string $applicationId): ?WebApplicationsValue
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkApplicationId($applicationId);

        $applicationList = $this->list(projectId: $projectId, environmentId: $environmentId);
        return $applicationList[$applicationId] ?? null;
    }

    /**
     * List applications of an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return array<string, WebApplicationsValue>
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

        return $currentDeployment?->getWebapps() ?? [];
    }
}
