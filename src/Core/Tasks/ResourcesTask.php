<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\Api\DeploymentApi;
use Upsun\ApiException;
use Upsun\Model\UpdateProjectsEnvironmentsDeployments200Response;
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
     * @param string $projectId
     * @param string $environmentId
     * @param array{
     *     webapps?: array<string, array{
     *         resources?: array{
     *             profile_size?: string,
     *             container_profile?: string,
     *             instance_count?: int
     *         }
     *     }>,
     *     services?: array<string, array{
     *         resources?: array{
     *             profile_size?: string,
     *             container_profile?: string,
     *             instance_count?: int
     *         }
     *     }>,
     *     workers?: array<string, array{
     *         resources?: array{
     *             profile_size?: string,
     *             container_profile?: string,
     *             instance_count?: int
     *         }
     *     }>
     * } $resourcesData Data specifying the new resources configuration for webapps, services, or workers
     *
     * @return UpdateProjectsEnvironmentsDeployments200Response
     *@throws ApiException|Exception
     */
    public function updateDeploymentResources(
        string $projectId,
        string $environmentId,
        array $resourcesData
    ): UpdateProjectsEnvironmentsDeployments200Response {
        // Get the current deployment (usually the first one in the list)
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        $deployment = reset($deployments);
        if (!$deployment) {
            throw new Exception("No deployment found for environment $environmentId");
        }

        $deploymentId = $deployment->getId();

        $data = new UpdateProjectsEnvironmentsDeploymentsRequest(...$resourcesData);

        return $this->api->updateProjectsEnvironmentsDeployments(
            $projectId,
            $environmentId,
            $deploymentId,
            $data
        );
    }
}
