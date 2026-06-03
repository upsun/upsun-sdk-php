<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\SystemInformationApi;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

/**
 * SystemOperationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class SystemOperationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly SystemInformationApi $systemInformationApi
    ) {
        parent::__construct($client);
    }

    /**
     * Restart the Git server for a project
     * This method forces the Git server to restart. This can be useful when dealing with server issues or to reset
     * server state for a project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function restartGitServer(string $projectId): AcceptedResponse
    {
        $this->checkProjectId($projectId);

        return $this->systemInformationApi->actionProjectsSystemRestart(
            projectId: $projectId
        );
    }
}
