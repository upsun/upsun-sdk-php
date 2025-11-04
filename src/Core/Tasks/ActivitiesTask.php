<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\UpsunClient;

/**
 * ActivitiesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ActivitiesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly ProjectActivityApi $prjApi,
        private readonly EnvironmentActivityApi $envApi
    ) {
        parent::__construct($client);
    }

    /**
     * Cancels a project (or environment) activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancel(string $projectId, string $activityId, ?string $environmentId = null): AcceptedResponse
    {
        if (!$environmentId) {
            return $this->prjApi->actionProjectsActivitiesCancel($projectId, $activityId);
        } else {
            return $this->envApi->actionProjectsEnvironmentsActivitiesCancel(
                projectId: $projectId,
                environmentId: $environmentId,
                activityId: $activityId
            );
        }
    }

    /**
     * Gets a project (or environment) activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $activityId, ?string $environmentId = null): Activity
    {
        if (!$environmentId) {
            return $this->prjApi->getProjectsActivities(
                projectId: $projectId,
                activityId: $activityId
            );
        } else {
            return $this->envApi->getProjectsEnvironmentsActivities(
                projectId: $projectId,
                environmentId: $environmentId,
                activityId: $activityId
            );
        }
    }

    /**
     * Gets project (or environment) activity log
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Activity[]
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        if (!$environmentId) {
            return $this->prjApi->listProjectsActivities(projectId: $projectId);
        } else {
            return $this->envApi->listProjectsEnvironmentsActivities(
                projectId: $projectId,
                environmentId: $environmentId
            );
        }
    }
}
