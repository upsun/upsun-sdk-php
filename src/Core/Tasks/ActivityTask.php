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
    public readonly ProjectActivityApi $api;
    public readonly EnvironmentActivityApi $envApi;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new ProjectActivityApi($this->client->apiClient, $this->client->apiConfig);
        $this->envApi = new EnvironmentActivityApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ***************************************************************/
    /********* ProjectActivityApi + EnvironmentActivityApi ************************/
    /************** ***************************************************************/

    /**
     * Operation actionProjectsActivitiesCancel
     *
     * Cancel a project (or environment) activity
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @param string|null $environment_id
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancel(string $project_id, string $activity_id, string $environment_id = null): AcceptedResponse
    {
        $this->refreshToken();
        if(!$environment_id) {
            return $this->api->actionProjectsActivitiesCancel($project_id, $activity_id);
        } else {
            return $this->envApi->actionProjectsEnvironmentsActivitiesCancel($project_id, $environment_id, $environment_id);
        }
    }

    /**
     * Operation getProjectsActivities
     *
     * Get a project (or environment) activity log entry
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @param string|null $environment_id
     * @return Activity
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $activity_id, string $environment_id = null): Activity
    {
        $this->refreshToken();
        if(!$environment_id) {
            return $this->api->getProjectsActivities($project_id, $activity_id);
        } else {
            return $this->envApi->getProjectsEnvironmentsActivities($project_id, $environment_id, $environment_id);
        }
    }

    /**
     * Operation listProjectsActivities
     *
     * Get project (or environment) activity log
     *
     * @param string $project_id project_id (required)
     * @return Activity[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id, string $environment_id = null): array
    {
        $this->refreshToken();
        if(!$environment_id) {
            return $this->api->listProjectsActivities($project_id);
        } else {
            return $this->envApi->listProjectsEnvironmentsActivities($project_id, $environment_id);
        }
    }
}
