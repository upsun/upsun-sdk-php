<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use Upsun\Core\TaskBase;
use Upsun\Exception\UpsunException;

class ProjectTask extends TaskBase
{

    public function clearBuildCache(string $projectId) {
        $api = new ProjectApi($this->client);
        return $api->actionProjectsClearBuildCache($projectId);
    }

    public function create(string $organizationId, string $title) {
        throw new UpsunException("Not implemented");
    }

    public function delete(string $projectId) {
        $api = new ProjectApi($this->client);
        return $api->deleteProjects($projectId);
    }

    public function get(string $projectId) {
        throw new UpsunException("Not implemented");
    }

    public function info(string $projectId) {
        $api = new ProjectApi($this->client);
        return $api->getProjects($projectId);
    }

    public function list(string $organizationId) {
        $api = new SubscriptionsApi($this->client);
        return $api->listOrgSubscriptions($organizationId);
    }
}