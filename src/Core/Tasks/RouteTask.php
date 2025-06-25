<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\RoutingApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Route;
use OpenAPI\Client\Model\RouteCreateInput;
use OpenAPI\Client\Model\RoutePatch;
use Upsun\UpsunClient;

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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId, string $routeId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Gets a route info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $environmentId, string $routeId): Route
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Lists routes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, string $environmentId): ?array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsRoutes($projectId, $environmentId);
    }

    /**
     * Updates a route
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
