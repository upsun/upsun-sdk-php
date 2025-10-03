<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\Api\AutoscalingApi;
use Upsun\ApiException;
use Upsun\Model\Activity;
use Upsun\UpsunClient;

/**
 * ActivitiesTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class AutoscalingTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly AutoscalingApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Gets a project (or environment) activity log entry
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $activityId, ?string $environmentId = null): Activity
    {
        if (!$environmentId) {
            return $this->prjApi->getProjectsActivities($projectId, $activityId);
        } else {
            return $this->envApi->getProjectsEnvironmentsActivities($projectId, $environmentId, $activityId);
        }
    }

    /**
     * Gets project (or environment) activity log
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @return Activity[]
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        if (!$environmentId) {
            return $this->prjApi->listProjectsActivities($projectId);
        } else {
            return $this->envApi->listProjectsEnvironmentsActivities($projectId, $environmentId);
        }
    }
}
