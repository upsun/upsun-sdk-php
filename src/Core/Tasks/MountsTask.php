<?php

namespace Upsun\Core\Tasks;

use RuntimeException;
use Upsun\UpsunClient;

/**
 * MountsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class MountsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
    ) {
        parent::__construct($client);
    }

    /**
     * List the mounts for a specific application in the current deployment of an environment.
     * 
     * @param string $filterType - optional filter for resource type, e.g. "webapps", "services", or "workers"
     * @return array<array>
     */
    public function list(
        string $projectId,
        string $environmentId = 'main',
        ?string $filterType = null,
    ): array {
        $currentDeployment = $this->client->environments->getDeployment(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: 'current',
        );

        $result = [];

        $resourceTypes = $filterType !== null
            ? [$filterType]
            : ['webapps', 'services', 'workers'];

        foreach ($resourceTypes as $resourceType) {
            $group = $this->readField($currentDeployment, $resourceType) ?? [];
            if (!\is_array($group) && !\is_object($group)) {
                continue;
            }

            foreach ((array) $group as $app) {
                $appName = $this->readField($app, 'name') ?? $this->readField($app, 'id');
                if (!\is_string($appName) || $appName === '') {
                    continue;
                }

                $mounts = $this->readField($app, 'mounts');
                $result[$appName] = \is_array($mounts) ? $mounts : [];
            }
        }

        return $result;
    }

    public function download(string $projectId, string $mountId): never
    {
        throw new RuntimeException('Cannot be implemented');
    }

    public function upload(string $projectId, string $mountId, array $params = []): never
    {
        throw new RuntimeException('Cannot be implemented');
    }

    /**
     * Helper method to read a field from an object or array, trying both getter method and direct property access.
     */
    private function readField(mixed $source, string $field): ?array
    {
        if (\is_array($source)) {
            return $source[$field] ?? null;
        }

        if (\is_object($source)) {
            $getter = 'get' . ucfirst($field);
            if (method_exists($source, $getter)) {
                return $source->{$getter}();
            }

            if (isset($source->{$field})) {
                return $source->{$field};
            }
        }

        return null;
    }
}
