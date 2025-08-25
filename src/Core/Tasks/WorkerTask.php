<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\Deployment;
use Upsun\UpsunClient;

/**
 * WorkerTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
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
     * @throws ApiException|Exception
     */
    public function list(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        /** @var Deployment $deployments */
        $deployments = reset($deployments);

        return !empty($deployments) ? $deployments->getWorkers() : [];
    }
}
