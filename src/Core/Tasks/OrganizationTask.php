<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\OrganizationsApi;
use Upsun\UpsunClient;

class OrganizationTask extends TaskBase
{
    public OrganizationsApi $api;
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
    }
    
    
    public function create(string $name) {
        $this->refreshToken();
        return $this->api->createOrg($name);
    }

    public function delete(string $organizationId) {
        $this->refreshToken();
        $this->api->deleteOrg($organizationId);
    }

    public function info(string $organizationId) {
        $this->refreshToken();
        return $this->api->getOrg($organizationId);
    }
    public function list($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '') {
        $this->refreshToken();
        return $this->api->listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
    }

    public function listOrgMembers($organization_id, $filter_permissions = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '') {
        $this->refreshToken();
        return $this->api->listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort, $contentType);
    }
    
    /**
     * Get Teams of the current organization (for current user)
     * @param $organization_id
     * @param $filter_id
     * @param $filter_updated_at
     * @param $page_size
     * @param $page_before
     * @param $page_after
     * @param $sort
     * @param string $contentType
     * @return mixed
     */
    public function getTeams($organization_id, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '') {
        $this->refreshToken();
        return $this->client->team->listUserTeams($this->client->getUserId(), ['eq' => $organization_id], $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
    }
}