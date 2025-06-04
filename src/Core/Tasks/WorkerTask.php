<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\WorkersValue;
use Upsun\UpsunClient;

class WorkerTask extends TaskBase
{
    public readonly DeploymentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * list workers of an environment
     *
     * @param string $projectId
     * @param string $environmentId
     * @return WorkersValue[]
     * @throws ApiException
     */
    public function list(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        $deployments = reset($deployments);
        /** @var Deployment $deployments */
        
        return !empty($deployments) ? $deployments->getWorkers() : [];
    }
}
