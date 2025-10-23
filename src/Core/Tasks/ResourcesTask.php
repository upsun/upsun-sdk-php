<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Upsun\Api\DeploymentApi;
use Upsun\ApiException;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest;
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
     * @throws ApiException|Exception|InvalidArgumentException
     */
    public function update(
        string $projectId,
        string $environmentId,
        array $resourcesData
    ): void {
        // ✅ Validate before building request
        $this->validateResourcesData($resourcesData);

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

    /**
     * Validate the structure of $resourcesData before sending it to the API.
     *
     * @throws InvalidArgumentException
     */
    private function validateResourcesData(array $resourcesData): void
    {
        $allowedTopKeys = ['webapps', 'services', 'workers'];
        foreach (array_keys($resourcesData) as $topKey) {
            if (!in_array($topKey, $allowedTopKeys, true)) {
                throw new InvalidArgumentException(sprintf(
                    'Unexpected top-level key "%s". Allowed keys: %s',
                    $topKey,
                    implode(', ', $allowedTopKeys)
                ));
            }

            foreach ($resourcesData[$topKey] as $name => $config) {
                if (!is_array($config)) {
                    throw new InvalidArgumentException(sprintf(
                        'Invalid value for "%s.%s". Expected an object (array), got %s.',
                        $topKey,
                        $name,
                        gettype($config)
                    ));
                }

                $allowedKeys = ['resources', 'disk', 'instance_count'];
                foreach (array_keys($config) as $key) {
                    if (!in_array($key, $allowedKeys, true)) {
                        throw new InvalidArgumentException(sprintf(
                            'Unexpected key "%s" in %s.%s. Allowed keys: %s',
                            $key,
                            $topKey,
                            $name,
                            implode(', ', $allowedKeys)
                        ));
                    }
                }

                if (isset($config['resources'])) {
                    if (!is_array($config['resources'])) {
                        throw new InvalidArgumentException(sprintf(
                            'Invalid value for "%s.%s.resources". Expected an object (array), got %s.',
                            $topKey,
                            $name,
                            gettype($config['resources'])
                        ));
                    }

                    $allowedResourceKeys = ['profile_size'];
                    foreach (array_keys($config['resources']) as $resKey) {
                        if (!in_array($resKey, $allowedResourceKeys, true)) {
                            throw new InvalidArgumentException(sprintf(
                                'Unexpected key "%s" in %s.%s.resources. Allowed keys: %s',
                                $resKey,
                                $topKey,
                                $name,
                                implode(', ', $allowedResourceKeys)
                            ));
                        }
                    }
                }
            }
        }
    }
}
