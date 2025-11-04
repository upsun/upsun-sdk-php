<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\WebApplicationsValue;
use Upsun\UpsunClient;

/**
 * ApplicationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ApplicationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly DeploymentApi $api
    ) {
        parent::__construct($client);
    }

    /**
     * Lists applications of an environment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return WebApplicationsValue[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments(
            projectId: $projectId,
            environmentId: $environmentId
        );

        $deployments = reset($deployments);

        return !empty($deployments) ? $deployments->getWebapps() : [];
    }

    /**
     * Gets an environment's application
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId, string $applicationId): ?WebApplicationsValue
    {
        $applicationList = $this->list(projectId: $projectId, environmentId: $environmentId);
        return $applicationList[$applicationId] ?? null;
    }
}
