<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\Model\Deployment;
use Upsun\UpsunClient;

class WorkerTask extends TaskBase
{

    public function __construct(
        public readonly UpsunClient    $client, // used in TaskBase
        private readonly DeploymentApi $api,
    )
    {
        parent::__construct($this->client);
    }

    /**
     * Lists workers of an environment
     *
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
