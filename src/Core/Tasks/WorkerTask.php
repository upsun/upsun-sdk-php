<?php

namespace Upsun\Core\Tasks;

use Upsun\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\Deployment;
use Upsun\UpsunClient;

class WorkerTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly DeploymentApi $api,
    ) {
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
