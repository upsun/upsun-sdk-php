<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\RoutingApi;
use Upsun\Model\Route;
use Upsun\UpsunClient;

/**
 * RouteTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class RoutesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly RoutingApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Gets a route info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function get(string $projectId, string $environmentId, string $routeId): Route
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkRouteId($routeId);

        return $this->api->getProjectsEnvironmentsRoutes(
            projectId: $projectId,
            environmentId: $environmentId,
            routeId: $routeId
        );
    }

    /**
     * Lists routes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function list(string $projectId, string $environmentId): ?array
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->api->listProjectsEnvironmentsRoutes(projectId: $projectId, environmentId: $environmentId);
    }
}
