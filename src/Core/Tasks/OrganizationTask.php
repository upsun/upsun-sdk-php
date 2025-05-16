<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\OrganizationsApi;

class OrganizationTask extends TaskBase
{
    public function create(string $name) {
        return $this->api->createOrg($name);
    }

    public function delete(string $organizationId) {
        $this->api->deleteOrg($organizationId);
    }

    public function info(string $organizationId) {
        return $this->api->getOrg($organizationId);
    }

    public function list($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '') {
        var_dump($this->api->listOrgsRequest($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType));
        
        return $this->api->listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, 1000, $page_before, $page_after, $sort, $contentType);
    }
}