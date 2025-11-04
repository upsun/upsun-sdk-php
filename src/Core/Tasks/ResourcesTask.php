<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\AcceptedResponse;
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
     * @param null|array{
     *   webapps?: array<string, array{
     *     resources?: array{
     *       profile_size?: string
     *     },
     *     disk?: int,
     *     instance_count?: int
     *   }> $webapps
     *
     * @param null|array<string, array{
     *   resources?: array{
     *     profile_size?: string,
     *   },
     *   disk?: int,
     *   instance_count?: int
     * }> $services
     *
     * @param null|array<string, array{
     *   resources?: array{
     *     profile_size?: string,
     *   },
     *   disk?: int,
     *   instance_count?: int
     * }> $workers
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $projectId,
        string $environmentId,
        ?array $webapps = [],
        ?array $services = [],
        ?array $workers = [],
    ): AcceptedResponse {
        $data = new UpdateProjectsEnvironmentsDeploymentsNextRequest(
            webapps: $webapps,
            services: $services,
            workers: $workers,
        );

        return $this->api->updateProjectsEnvironmentsDeploymentsNext(
            projectId: $projectId,
            environmentId: $environmentId,
            updateProjectsEnvironmentsDeploymentsNextRequest: $data
        );
    }
}
