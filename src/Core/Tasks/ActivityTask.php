<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentActivityApi;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use Upsun\UpsunClient;

class ActivityTask extends TaskBase
{
    public function __construct(
        public UpsunClient                      $client,
        private readonly ProjectActivityApi     $prjApi,
        private readonly EnvironmentActivityApi $envApi
    )
    {
        parent::__construct($this->client);
    }

    /**
     * Cancels a project (or environment) activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancel(string $projectId, string $activityId, ?string $environmentId = null): AcceptedResponse
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->prjApi->actionProjectsActivitiesCancel($projectId, $activityId);
        } else {
            return $this->envApi->actionProjectsEnvironmentsActivitiesCancel(
                $projectId,
                $environmentId,
                $activityId
            );
        }
    }

    /**
     * Gets a project (or environment) activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $activityId, ?string $environmentId = null): Activity
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->prjApi->getProjectsActivities($projectId, $activityId);
        } else {
            return $this->envApi->getProjectsEnvironmentsActivities($projectId, $environmentId, $activityId);
        }
    }

    /**
     * Gets project (or environment) activity log
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->prjApi->listProjectsActivities($projectId);
        } else {
            return $this->envApi->listProjectsEnvironmentsActivities($projectId, $environmentId);
        }
    }
}
