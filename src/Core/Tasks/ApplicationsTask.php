<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\WebApplicationsValue;
use Upsun\UpsunClient;

/**
 * ApplicationsTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class ApplicationsTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly DeploymentApi $api
    ) {
        parent::__construct($this->client);
    }

    /**
     * Lists applications of an environment
     *
     * @throws ApiException|Exception
     * @return WebApplicationsValue[]
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
     * @throws ApiException|Exception
     */
    public function get(string $projectId, string $environmentId, string $appId): ?WebApplicationsValue
    {
        $appList = $this->list($projectId, $environmentId);
        return $appList[$appId] ?? null;
    }
}
