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
    public readonly RoutingApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new RoutingApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ***********************/
    /********* RoutingApi  ****************/
    /************** ***********************/

    /**
     * Operation create
     *
     * Create a new route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $route_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $project_id, string $environment_id, array $route_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $route_create_input = new RouteCreateInput($route_create_input);
        return $this->api->createProjectsEnvironmentsRoutes($project_id, $environment_id, $route_create_input);
    }

    /**
     * Operation delete
     *
     * Delete a route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id, string $environment_id, string $route_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
    }

    /**
     * Operation get
     *
     * Get a routes info
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @return Route
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $environment_id, string $route_id): Route
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
    }

    /**
     * Operation list
     *
     * Get list of routes
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return array|null
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id, string $environment_id): ?array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsRoutes($project_id, $environment_id);
    }

    /**
     * Operation update
     *
     * Update a route
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $route_id route_id (required)
     * @param array $route_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(
        string $project_id,
        string $environment_id,
        string $route_id,
        array $route_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $route_patch = new RoutePatch($route_patch);
        return $this->api->updateProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id, $route_patch);
    }
}
