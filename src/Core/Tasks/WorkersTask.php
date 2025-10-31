<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Model\Deployment;
use Upsun\Model\WorkersValue;
use Upsun\UpsunClient;

/**
 * WorkersTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class WorkersTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly DeploymentApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Lists workers of an environment
     *
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     * @return WorkersValue[]
     */
    public function list(string $projectId, string $environmentId): array
    {
        $allDeployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        /** @var Deployment|false $deployment */
        $deployment = reset($allDeployments);

        return $deployment?->getWorkers() ?? [];
    }
}
