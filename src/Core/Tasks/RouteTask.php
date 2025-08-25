<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\RoutingApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Route;
use Upsun\Model\RouteCreateInput;
use Upsun\Model\RoutePatch;
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
     * Creates a new route
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $projectId, string $environmentId, array $routeCreateInput): AcceptedResponse
    {
        $this->refreshToken();
        $routeCreateInput = new RouteCreateInput($routeCreateInput);
        return $this->api->createProjectsEnvironmentsRoutes($projectId, $environmentId, $routeCreateInput);
    }

    /**
     * Deletes a route
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId, string $routeId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Gets a route info
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId, string $routeId): Route
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Lists routes
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): ?array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsRoutes($projectId, $environmentId);
    }

    /**
     * Updates a route
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(
        string $projectId,
        string $environmentId,
        string $routeId,
        array $routePatch
    ): AcceptedResponse {
        $this->refreshToken();
        $routePatch = new RoutePatch($routePatch);
        return $this->api->updateProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId, $routePatch);
    }
}
