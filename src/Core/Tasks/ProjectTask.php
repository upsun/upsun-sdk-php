<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use Upsun\Exception\UpsunException;

class ProjectTask extends TaskBase
{
    public function clearBuildCache(string $projectId)
    {
        $api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        return $api->actionProjectsClearBuildCache($projectId);
    }

    public function create(string $organizationId, string $title)
    {
        throw new UpsunException("Not implemented");
    }

    public function delete(string $projectId)
    {
        $api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        return $api->deleteProjects($projectId);
    }

    public function get(string $projectId)
    {
        throw new UpsunException("Not implemented");
    }

    public function info(string $projectId)
    {
        $api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        return $api->getProjects($projectId);
    }

    public function list(string $organizationId)
    {
        $api = new SubscriptionsApi($this->client->apiClient, $this->client->apiConfig);
        return $api->listOrgSubscriptions($organizationId);
    }
}
