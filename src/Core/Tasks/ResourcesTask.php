<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\Api\DeploymentApi;
use Upsun\ApiException;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\UpdateDeploymentsNextRequest;
use Upsun\Model\UpdateProjectsEnvironmentsDeployments200Response;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNext200Response;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsRequest;
use Upsun\UpsunClient;

/**
 * ResourcesTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class ResourcesTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly DeploymentApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Update resources for a deployment
     *
     * @param array{
     *     webapps?: array<string, array{
     *         resources?: array{
     *             profile_size?: string
     *         },
     *         disk?: int,
     *         instance_count?: int
     *     }>,
     *     services?: array<string, array{
     *         resources?: array{
     *             profile_size?: string,
     *         },
     *         disk?: int,
     *         instance_count?: int
     *     }>,
     *     workers?: array<string, array{
     *         resources?: array{
     *             profile_size?: string,
     *         },
     *         disk?: int,
     *         instance_count?: int
     *     }>
     * } $resourcesData Data specifying the new resources configuration for webapps, services, or workers
     *
     * @throws ApiException|Exception
     */
    public function update(
        string $projectId,
        string $environmentId,
        array $resourcesData
    ): AcceptedResponse {
        $data = new UpdateProjectsEnvironmentsDeploymentsNextRequest(
            webapps: $resourcesData['webapps'] ?? null,
            services: $resourcesData['services'] ?? null,
            workers: $resourcesData['workers'] ?? null,
        );

        return $this->api->updateProjectsEnvironmentsDeploymentsNext(
            $projectId,
            $environmentId,
            $data
        );
    }
}
