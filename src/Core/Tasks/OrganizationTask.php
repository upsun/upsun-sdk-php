<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\OrganizationsApi;

class OrganizationTask extends TaskBase
{
    public function create(string $name) {
        $api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
        return $api->createOrg($name);
    }

    public function delete(string $organizationId) {
        $api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
        return $api->deleteOrg($organizationId);
    }

    public function info(string $organizationId) {
        $api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
        return $api->getOrg($organizationId);
    }

    public function list() {
        $api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
        return $api->listUserOrgs("1");
    }
}