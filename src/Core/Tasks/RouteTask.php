<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\RoutingApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\CacheConfiguration1;
use Upsun\Model\Route;
use Upsun\Model\RouteCreateInput;
use Upsun\Model\RoutePatch;
use Upsun\Model\ServerSideIncludeConfiguration1;
use Upsun\Model\StrictTransportSecurityOptions1;
use Upsun\Model\TheConfigurationOfTheRedirects1;
use Upsun\Model\TLSSettingsForTheRoute1;
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
     *
     * @param array{
     *     type: string,
     *     to: string,
     *     upstream: string,
     *     primary?: bool,
     *     id?: string,
     *     productionUrl?: string,
     *     attributes?: bool,
     *     tls?: array{
     *       minVersion?: string,
     *       clientAuthentication?: string,
     *       clientCertificateAuthorities?: array,
     *       strictTransportSecurity?: array{
     *         enabled?: bool,
     *         includeSubdomains?: bool,
     *         preload?: bool,
     *       },
     *     },
     *     redirects?: array{
     *       expires?: string,
     *       paths: array,
     *     },
     *     cache?: array{
     *       enabled: bool,
     *       defaultTtl?: int,
     *       cookies?: array,
     *       headers?: array
     *     },
     *     ssi_enabled?: bool,
     * } $data
     */
    public function create(string $projectId, string $environmentId, array $data): AcceptedResponse
    {
        $routeCreateInput = new RouteCreateInput(
            type: $data['type'],
            to: $data['to'],
            upstream: $data['upstream'],
            primary: $data['primary'] ?? null,
            id: $data['id'] ?? null,
            productionUrl: $data['productionUrl'] ?? null,
            attributes: $data['attributes'] ?? null,
            tls: $data['tls'] ? new TLSSettingsForTheRoute1(
                minVersion: $data['tls']['minVersion'] ?? null,
                clientAuthentication: $data['tls']['clientAuthentication'] ?? null,
                strictTransportSecurity: ($data['tls']['strictTransportSecurity'] ?
                    new StrictTransportSecurityOptions1(...$data['tls']['strictTransportSecurity'])
                    : null
                ),
                clientCertificateAuthorities: $data['tls']['clientCertificateAuthorities'] ?? null,
            ) : null,
            redirects: $data['redirects'] ? new TheConfigurationOfTheRedirects1(...$data['redirects']) : null,
            cache: $data['cache'] ? new CacheConfiguration1(...$data['cache']) : null,
            ssi: $data['ssi_enabled'] ? new ServerSideIncludeConfiguration1(enabled: $data['ssi_enabled']) : null,
        );
        return $this->api->createProjectsEnvironmentsRoutes($projectId, $environmentId, $routeCreateInput);
    }

    /**
     * Deletes a route
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $environmentId, string $routeId): AcceptedResponse
    {
        return $this->api->deleteProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
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

    /**
     * Updates a route
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     type: string,
     *     to: string,
     *     upstream: string,
     *     primary?: bool,
     *     id?: string,
     *     productionUrl?: string,
     *     attributes?: bool,
     *     tls?: array{
     *       minVersion?: string,
     *       clientAuthentication?: string,
     *       clientCertificateAuthorities?: array,
     *       strictTransportSecurity?: array{
     *         enabled?: bool,
     *         includeSubdomains?: bool,
     *         preload?: bool,
     *       },
     *     },
     *     redirects?: array{
     *       expires?: string,
     *       paths: array,
     *     },
     *     cache?: array{
     *       enabled: bool,
     *       defaultTtl?: int,
     *       cookies?: array,
     *       headers?: array
     *     },
     *     ssi_enabled?: bool,
     * } $data
     */
    public function update(
        string $projectId,
        string $environmentId,
        string $routeId,
        array $data
    ): AcceptedResponse {
        $routePatch = new RoutePatch(
            type: $data['type'],
            to: $data['to'],
            upstream: $data['upstream'],
            primary: $data['primary'] ?? null,
            id: $data['id'] ?? null,
            productionUrl: $data['productionUrl'] ?? null,
            attributes: $data['attributes'] ?? null,
            tls: $data['tls'] ? new TLSSettingsForTheRoute1(
                minVersion: $data['tls']['minVersion'] ?? null,
                clientAuthentication: $data['tls']['clientAuthentication'] ?? null,
                strictTransportSecurity: $data['tls']['strictTransportSecurity'] ?
                    new StrictTransportSecurityOptions1(...$data['tls']['strictTransportSecurity'])
                    : null,
                clientCertificateAuthorities: $data['tls']['clientCertificateAuthorities'] ?? null,
            ) : null,
            redirects: $data['redirects'] ? new TheConfigurationOfTheRedirects1(...$data['redirects']) : null,
            cache: $data['cache'] ? new CacheConfiguration1(...$data['cache']) : null,
            ssi: $data['ssi_enabled'] ? new ServerSideIncludeConfiguration1(enabled: $data['ssi_enabled']) : null,
        );
        return $this->api->updateProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId, $routePatch);
    }
}
