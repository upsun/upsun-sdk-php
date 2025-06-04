<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\WebApplicationsValue;
use Upsun\UpsunClient;

class ApplicationTask extends TaskBase
{
    public readonly DeploymentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * list applications of an environment
     *
     * @param string $projectId
     * @param string $environmentId
     * @return WebApplicationsValue[]
     * @throws ApiException
     */
    public function list(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);

        return $deployments[0]->getWebapps() ?? [];
    }

    /**
     * list applications of an environment
     *
     * @param string $projectId
     * @param string $environmentId
     * @return WebApplicationsValue|Error
     * @throws ApiException
     */
    public function get(string $projectId, string $environmentId, string $app_id): WebApplicationsValue
    {
        $deployment = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        $deployment = reset($deployment);

        return $deployment[$app_id] ?? new Error(['message' => 'Application ' . $app_id . ' does not exist']);

        dd($deployments[0]->getWebapps());
        return $deployments[0]->getWebapps() ?? [];
    }


}
