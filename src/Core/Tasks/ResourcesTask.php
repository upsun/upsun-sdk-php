<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\AutoscalingApi;
use Upsun\Api\DeploymentApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\AutoscalerSettings;
use Upsun\Model\Resources;
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
        private readonly DeploymentApi $deploymentApi,
        private readonly AutoscalingApi $autoscalingApi
    ) {
        parent::__construct($client);
    }

    /**
     * Get the resource configuration for a specific application in the current deployment of an environment.
     * This method retrieves the resource configuration for a specific application (webapp, service, or worker) in the
     * current deployment of an environment.
     * 
     * @param string $type - the application type, e.g. "webapps", "services", or "workers"
     * @param string $app - the application name, e.g. "app" for webapps, or the service/worker name for 
     *  services/workers
     * @return Resources|null
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function get(
        string $projectId, 
        string $environmentId, 
        string $type = "webapps", 
        string $app = 'app'
        ): ?Resources {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        $currentDeployment = $this->client->environments->getDeployment(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: 'current'
        );

        if (!$currentDeployment) {
            return null;
        }

        $group = match ($type) {
            'webapps' => $currentDeployment->getWebapps()[$app] ?? null,
            'services' => $currentDeployment->getServices()[$app] ?? null,
            'workers' => $currentDeployment->getWorkers()[$app] ?? null,
            default => null
        };

        return $group?->getResources() ?? null;
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
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function set(
        string $projectId,
        string $environmentId,
        ?array $webapps = [],
        ?array $services = [],
        ?array $workers = [],
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->deploymentApi->updateProjectsEnvironmentsDeploymentsNext(
            projectId: $projectId,
            environmentId: $environmentId,
            updateProjectsEnvironmentsDeploymentsNextRequest: new UpdateProjectsEnvironmentsDeploymentsNextRequest(
                webapps: $webapps,
                services: $services,
                workers: $workers,
            )
        );
    }

    /**
     * @deprecated use set() instead
     */
    public function update(
        string $projectId,
        string $environmentId,
        ?array $webapps = [],
        ?array $services = [],
        ?array $workers = [],
    ): AcceptedResponse {
        return $this->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps,
            services: $services,
            workers: $workers
         );
    }

    /**
     * Get the autoscaler settings for the environment. Autoscaling allows the environment to automatically scale its
     * resources up or down based on the current load and traffic. The autoscaler settings include information about
     * whether autoscaling is enabled, the addresses that are being autoscaled, and any authentication settings for the
     * autoscaler services.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function getAutoscalerSettings(
        string $projectId,
        string $environmentId,
    ): AutoscalerSettings {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->autoscalingApi->getAutoscalerSettings(
            projectId: $projectId,
            environmentId: $environmentId,
        );
    }

    /**
     * Update the autoscaler settings for the environment. Autoscaling allows the environment to automatically scale its
     * resources up or down based on the current load and traffic. The autoscaler settings include information about
     * whether autoscaling is enabled, the addresses that are being autoscaled, and any authentication settings for the
     * autoscaler services. Updating the autoscaler settings will allow you to enable or disable autoscaling, change the
     * addresses that are being autoscaled, and update the authentication settings for the autoscaler services.
     * 
     * @param array{
     *   services?: array<string, (array<string, array{
     *     triggers?: array{
     *       cpu?: array<string, array<string, mixed>>|null,
     *       memory?: array<string, array<string, mixed>>|null,
     *       cpuPressure?: array<string, array<string, mixed>>|null,
     *       memoryPressure?: array<string, array<string, mixed>>|null
     *     },
     *     instances?: array{
     *       min?: int|float,
     *       max?: int|float
     *     },
     *     resources?: array{
     *       cpu?: array<string, array<string, mixed>>|null,
     *       memory?: array<string, array<string, mixed>>|null
     *     },
     *     scaleFactor?: array{
     *       up?: int|float,
     *       down?: int|float
     *     },
     *     scaleCooldown?: array{
     *       up?: int|float,
     *       down?: int|float
     *     }
     *   }> | null)> | null
     * } $services
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function updateAutoscalerSettings(
        string $projectId,
        string $environmentId,
        array $services,
    ): AutoscalerSettings {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->autoscalingApi->postAutoscalerSettings(
            projectId: $projectId,
            environmentId: $environmentId,
            autoscalerSettings: new AutoscalerSettings(...$services),
        );
    }
}
