<?php

namespace Upsun\Core\Tasks;

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
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $environmentId, string $routeId): Route
    {
        return $this->api->getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    }

    /**
     * Lists routes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function list(string $projectId, string $environmentId): ?array
    {
        return $this->api->listProjectsEnvironmentsRoutes($projectId, $environmentId);
    }
}
