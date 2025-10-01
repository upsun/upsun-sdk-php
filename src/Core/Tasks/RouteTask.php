<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\RoutingApi;
use Upsun\Model\Route;
use Upsun\UpsunClient;

/**
 * RouteTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class RouteTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly RoutingApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Gets a route info
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId, string $routeId): Route
    {
        return $this->api->getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Lists routes
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): ?array
    {
        return $this->api->listProjectsEnvironmentsRoutes($projectId, $environmentId);
    }
}
