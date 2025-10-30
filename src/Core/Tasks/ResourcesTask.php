<?php

namespace Upsun\Core\Tasks;

use Upsun\Api\DeploymentApi;
use Upsun\ApiException;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest;
use Upsun\UpsunClient;

/**
 * ResourcesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ResourcesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly DeploymentApi $api,
    ) {
        parent::__construct($client);
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
     * @throws ApiException
     */
    public function update(
        string $projectId,
        string $environmentId,
        array $resourcesData
    ): void {
        $data = new UpdateProjectsEnvironmentsDeploymentsNextRequest(
            webapps: $resourcesData['webapps'] ?? null,
            services: $resourcesData['services'] ?? null,
            workers: $resourcesData['workers'] ?? null,
        );

        $this->api->updateProjectsEnvironmentsDeploymentsNext(
            $projectId,
            $environmentId,
            $data
        );
    }
}
