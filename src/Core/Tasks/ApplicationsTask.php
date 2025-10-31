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
     * @return WebApplicationsValue[]
     *
     * @throws ClientExceptionInterface
     * @throws ApiException
     */
    public function list(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);

        $deployments = reset($deployments);

        return !empty($deployments) ? $deployments->getWebapps() : [];
    }

    /**
     * Gets an environment's application
     *
     * @throws ApiException
     */
    public function get(string $projectId, string $environmentId, string $appId): ?WebApplicationsValue
    {
        $appList = $this->list($projectId, $environmentId);
        return $appList[$appId] ?? null;
    }
}
