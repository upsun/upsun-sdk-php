<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\ArrayFilter;
use OpenAPI\Client\Model\CreateOrgMemberRequest;
use OpenAPI\Client\Model\CreateOrgRequest;
use OpenAPI\Client\Model\DateTimeFilter;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\ListOrgMembers200Response;
use OpenAPI\Client\Model\ListOrgs200Response;
use OpenAPI\Client\Model\ListUserOrgs200Response;
use OpenAPI\Client\Model\Organization;
use OpenAPI\Client\Model\OrganizationMember;
use OpenAPI\Client\Model\StringFilter;
use OpenAPI\Client\Model\UpdateOrgMemberRequest;
use OpenAPI\Client\Model\UpdateOrgRequest;
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

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->refreshToken();
        $this->api->setHostIndex($hostIndex);
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
     * Operation createOrg
     *
     * Create organization
     *
     * @param array $create_org_request create_org_request (required)
     *
     * @return Organization|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrg(array $create_org_data)
    {
        $this->refreshToken();
        $create_org_request = new CreateOrgRequest($create_org_data);
        return $this->api->createOrg($create_org_request);
    }

    /**
     * Operation createOrgMember
     *
     * Create organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param CreateOrgMemberRequest $create_org_member_request create_org_member_request (required)
     *
     * @return OrganizationMember|Error|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrgMember(string $organization_id, CreateOrgMemberRequest $create_org_member_request): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->createOrgMember($organization_id, $create_org_member_request);
    }

    /**
     * Operation deleteOrg
     *
     * Delete organization
     *
     * @param string $organization_id The ID of the organization. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrg(string $organization_id): void
    {
        $this->refreshToken();
        $this->api->deleteOrg($organization_id);
    }

    /**
     * Operation deleteOrgMember
     *
     * Delete organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $user_id The ID of the user. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrgMember(string $organization_id, string $user_id): void
    {
        $this->refreshToken();
        $this->api->deleteOrgMember($organization_id, $user_id);
    }

    /**
     * Operation getOrg
     *
     * Get organization
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return Organization|Error|Error
     */
    public function getOrg(string $organization_id): Organization|Error
    {
        $this->refreshToken();
        return $this->api->getOrg($organization_id);
    }

    /**
     * Operation getOrgMember
     *
     * Get organization member
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param string $user_id The ID of the user. (required)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return OrganizationMember|Error
     */
    public function getOrgMember(string $organization_id, string $user_id): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->getOrgMember($organization_id, $user_id);
    }

    /**
     * Operation listOrgMembers
     *
     * List organization members
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param ArrayFilter|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return ListOrgMembers200Response|Error
     */
    public function listOrgMembers(string $organization_id, ArrayFilter $filter_permissions = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListOrgMembers200Response|Error
    {
        $this->refreshToken();
        return $this->api->listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listOrgs
     *
     * List organizations
     *
     * @param StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return ListOrgs200Response|Error
     */
    public function listOrgs($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $this->refreshToken();
        return $this->api->listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listUserOrgs
     *
     * User organizations
     *
     * @param string $user_id The ID of the user. (required)
     * @param StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListUserOrgs200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function listUserOrgs(string $user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $this->refreshToken();
        return $this->api->listUserOrgs($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation updateOrg
     *
     * Update organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_data update_org_request (optional)
     *
     * @return Organization|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrg(string $organization_id, array $update_org_data = []): Organization|Error
    {
        $this->refreshToken();
        $update_org_request = new UpdateOrgRequest($update_org_data);
        return $this->api->updateOrg($organization_id, $update_org_request);
    }

    /**
     * Operation updateOrgMember
     *
     * Update organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $user_id The ID of the user. (required)
     * @param UpdateOrgMemberRequest|null $update_org_member_request update_org_member_request (optional)
     *
     * @return OrganizationMember|Error|Error|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrgMember(string $organization_id, string $user_id, UpdateOrgMemberRequest $update_org_member_request = null): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->updateOrg($organization_id, $user_id, $update_org_member_request);
    }

    /**
     * Get Teams of the current organization (for current user)
     *
     * @param $organization_id
     * @param null $filter_updated_at
     * @param null $page_size
     * @param null $page_before
     * @param null $page_after
     * @param null $sort
     * @param string $contentType
     * @return mixed
     */
    public function listOrgTeams($organization_id, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '')
    {
        $this->refreshToken();
        return $this->client->team->listUserTeams($this->client->getUserId(), ['eq' => $organization_id], $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
    }
}