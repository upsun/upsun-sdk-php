<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\WebApplicationsValue;
use Upsun\UpsunClient;

class ApplicationTask extends TaskBase
{
    private readonly DeploymentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************/
    /********* Getter ************************/
    /************** **************************/

    public function getApi(): DeploymentApi
    {
        return $this->api;
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
        $deployments = $this->getApi()->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        $deployments = reset($deployments);

        return !empty($deployments) ? $deployments->getWebapps() : [];
    }

    /**
     * get an environment's application
     *
     * @param string $projectId
     * @param string $environmentId
     * @param string $app_id
     * @return WebApplicationsValue|null
     * @throws ApiException
     */
    public function get(string $projectId, string $environmentId, string $app_id): WebApplicationsValue|null
    {
        $environment = $this->client->environment->get($projectId, $environmentId);
        if ($environment->getDeploymentState() && $environment->getDeploymentState()->getLastDeploymentSuccessful()) {
            $deployment = $this->getApi()->listProjectsEnvironmentsDeployments($projectId, $environmentId);
            $deployment = reset($deployment);
            /** @var Deployment $deployment */

            return !(empty($deployment->getWebapps())) ? ($deployment->getWebapps())[$app_id] ?? null : null;
        } else {
            return null;
        }
    }
}
