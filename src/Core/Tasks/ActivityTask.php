<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use Upsun\UpsunClient;

class ActivityTask extends TaskBase
{
    public readonly ProjectActivityApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new ProjectActivityApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************************/
    /********* ProjectActivityApi ************************/
    /************** **************************************/

    /**
     * Operation actionProjectsActivitiesCancel
     *
     * Cancel a project activity
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function actionProjectsActivitiesCancel(string $project_id, string $activity_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->actionProjectsActivitiesCancel($project_id, $activity_id);
    }

    /**
     * Operation getProjectsActivities
     *
     * Get a project activity log entry
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return Activity
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsActivities(string $project_id, string $activity_id): Activity
    {
        $this->refreshToken();
        return $this->api->getProjectsActivities($project_id, $activity_id);
    }

    /**
     * Operation listProjectsActivities
     *
     * Get project activity log
     *
     * @param string $project_id project_id (required)
     * @return Activity[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsActivities(string $project_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsActivities($project_id);
    }
}