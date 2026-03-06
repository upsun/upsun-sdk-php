<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Model\ServicesValue;
use Upsun\UpsunClient;

/**
 * ServicesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ServicesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
    ) {
        parent::__construct($client);
    }

    /**
     * List services for an environment.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     *
     * @return array<string, ServicesValue>
     */
    public function list(string $projectId, string $environmentId): array
    {
        parent::checkProjectId($projectId);
        parent::checkEnvironmentId($environmentId);

        $currentDeployment = $this->client->environments->getDeployment(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: 'current'
        );

        return $currentDeployment->getServices();
    }
}
