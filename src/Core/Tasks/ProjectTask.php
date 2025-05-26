<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Project;
use OpenAPI\Client\Model\ProjectCapabilities;
use OpenAPI\Client\Model\ProjectPatch;
use Upsun\Exception\UpsunException;
use Upsun\UpsunClient;

class ProjectTask extends TaskBase
{
    public ProjectApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        $this->refreshToken();
        return $this->api->getHostIndex();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        $this->refreshToken();
        return $this->api->getConfig();
    }

    /**
     * Operation deleteProjects
     *
     * Delete a project
     *
     * @param  string $project_id project_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteProjects(string $project_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjects($project_id);
    }

    /**
     * Operation getProjects
     *
     * Get a project
     *
     * @param  string $project_id project_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Project
     */
    public function getProjects(string $project_id): Project
    {
        $this->refreshToken();
        return $this->api->getProjects($project_id);
    }

    /**
     * Operation getProjectsCapabilities
     *
     * Get a project&#39;s capabilities
     *
     * @param  string $project_id project_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ProjectCapabilities
     */
    public function getProjectsCapabilities(string $project_id): ProjectCapabilities
    {
        $this->refreshToken();
        return $this->api->getProjectsCapabilities($project_id);
    }

    /**
     * Operation updateProjects
     *
     * Update a project
     *
     * @param  string $project_id project_id (required)
     * @param  array $project_patch  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateProjects(string $project_id, array $project_data): AcceptedResponse
    {
        $this->refreshToken();
        $project_patch = new ProjectPatch($project_data);
        return $this->api->updateProjects($project_id, $project_patch);
    }
}