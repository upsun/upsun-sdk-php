<?php

namespace Upsun\Core\Tasks;

use Upsun\ApiException;
use Upsun\API\DeploymentApi;
use Upsun\Model\Deployment;
use Upsun\Model\WebApplicationsValue;
use Upsun\UpsunClient;

class ApplicationTask extends TaskBase
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
     * @throws ApiException
     */
    public function list(string $projectId, string $environmentId): array
    {
        $this->refreshToken();
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        $deployments = reset($deployments);

        return !empty($deployments) ? $deployments->getWebapps() : [];
    }

    /**
     * Gets an environment's application
     *
     * @throws ApiException
     */
    public function get(string $projectId, string $environmentId, string $app_id): WebApplicationsValue|null
    {
        $this->refreshToken();
        $environment = $this->client->environment->get($projectId, $environmentId);
        if ($environment->getDeploymentState() && $environment->getDeploymentState()->getLastDeploymentSuccessful()) {
            $deployment = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
            $deployment = reset($deployment);
            /** @var Deployment $deployment */

            return !(empty($deployment->getWebapps())) ? ($deployment->getWebapps())[$app_id] ?? null : null;
        } else {
            return null;
        }
    }
}
