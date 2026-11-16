<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\EntrypointApi;
use Upsun\Api\LogsApi;
use Upsun\Model\LogsOverview200Response;
use Upsun\Model\LogsQuery200Response;
use Upsun\Model\ObservabilityEntrypoint200Response;
use Upsun\UpsunClient;

/**
 * ObservabilityTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ObservabilityTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly EntrypointApi $entrypointApi,
        private readonly LogsApi $logsApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Get the links to the observability resources of an environment.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if an ID is empty
     */
    public function entrypoint(string $projectId, string $environmentId): ObservabilityEntrypoint200Response
    {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->entrypointApi->observabilityEntrypoint(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Get an overview of the logs of an environment between two Unix timestamps.
     *
     * @param array<string, mixed> $filters Named parameters of LogsApi::logsOverview, for example
     *                                      ['severities' => ['error'], 'hostsMode' => 'exclude']
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if an ID is empty
     */
    public function logsOverview(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        array $filters = []
    ): LogsOverview200Response {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->logsApi->logsOverview(
            $projectId,
            $environmentId,
            $from,
            $to,
            ...$filters
        );
    }

    /**
     * Get one page of the log entries of an environment between two Unix timestamps.
     *
     * @param array<string, mixed> $filters Named parameters of LogsApi::logsQuery, for example
     *                                      ['order' => 'asc', 'cursor' => $next, 'services' => ['app']]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if an ID is empty
     */
    public function logsQuery(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        array $filters = []
    ): LogsQuery200Response {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->logsApi->logsQuery(
            $projectId,
            $environmentId,
            $from,
            $to,
            ...$filters
        );
    }
}
