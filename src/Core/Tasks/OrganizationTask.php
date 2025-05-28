<?php

namespace Upsun\Core\Tasks;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\InvoicesApi;
use OpenAPI\Client\apisgen\OrganizationMembersApi;
use OpenAPI\Client\apisgen\OrganizationProjectsApi;
use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response;
use OpenAPI\Client\Model\CreateOrgMemberRequest;
use OpenAPI\Client\Model\CreateOrgRequest;
use OpenAPI\Client\Model\CreateOrgSubscriptionRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\EstimationObject;
use OpenAPI\Client\Model\Invoice;
use OpenAPI\Client\Model\ListOrgInvoices200Response;
use OpenAPI\Client\Model\ListOrgMembers200Response;
use OpenAPI\Client\Model\ListOrgProjects200Response;
use OpenAPI\Client\Model\ListOrgs200Response;
use OpenAPI\Client\Model\ListOrgSubscriptions200Response;
use OpenAPI\Client\Model\ListUserOrgs200Response;
use OpenAPI\Client\Model\Organization;
use OpenAPI\Client\Model\OrganizationMember;
use OpenAPI\Client\Model\OrganizationProject;
use OpenAPI\Client\Model\Subscription;
use OpenAPI\Client\Model\SubscriptionCurrentUsageObject;
use OpenAPI\Client\Model\UpdateOrgMemberRequest;
use OpenAPI\Client\Model\UpdateOrgRequest;
use OpenAPI\Client\Model\UpdateOrgSubscriptionRequest;
use OpenAPI\Client\ObjectSerializer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Upsun\UpsunClient;

class OrganizationTask extends TaskBase
{
    const DEFAULT_UPSUN_PLAN = 'upsun/flexible';

    public OrganizationsApi $api;
    public OrganizationProjectsApi $projectsApi;

    public OrganizationMembersApi $membersApi;

    public SubscriptionsApi $subscriptionsApi;
    protected HeaderSelector $headerSelector;

    public readonly InvoicesApi $invoicesApi;
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->headerSelector = new HeaderSelector();
        $this->api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
        $this->projectsApi = new OrganizationProjectsApi($this->client->apiClient, $this->client->apiConfig);
        $this->membersApi = new OrganizationMembersApi($this->client->apiClient, $this->client->apiConfig);
        $this->subscriptionsApi = new SubscriptionsApi($this->client->apiClient, $this->client->apiConfig);
        $this->invoicesApi = new InvoicesApi($this->client->apiClient, $this->client->apiConfig);
    }


    /************** ***********************************/
    /********* OrganizationApi ************************/
    /************** ***********************************/

    /**
     * Operation createOrg
     *
     * Create organization
     *
     * @param array $create_org_data create_org_request (required)
     *
     * @return Organization|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrg(array $create_org_data): Organization|Error
    {
        $this->refreshToken();
        $create_org_request = new CreateOrgRequest($create_org_data);
        return $this->api->createOrg($create_org_request);
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
     * Operation getOrg
     *
     * Get organization
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return Organization|Error
     */
    public function getOrg(string $organization_id): Organization|Error
    {
        $this->refreshToken();
        return $this->api->getOrg($organization_id);
    }

    /**
     * Operation listOrgs
     *
     * List organizations
     *
     * @param array|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param array|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param array|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param array|null $filter_label
     * @param array|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param array|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param array|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param array|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListOrgs200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgs(array $filter_id = null, array $filter_owner_id = null, array $filter_name = null, array $filter_label = null, array $filter_vendor = null, array $filter_capabilities = null, array $filter_status = null, array $filter_updated_at = null, int $page_size = 100, string $page_before = null, string $page_after = null, string $sort = null): Error|ListOrgs200Response
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
     * @param array|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param array|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param array|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param array|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListUserOrgs200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listUserOrgs(string $user_id, array $filter_id = null, array $filter_vendor = null, array $filter_status = null, array $filter_updated_at = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): Error|ListUserOrgs200Response
    {
        $this->refreshToken();
        return $this->api->listUserOrgs($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listCurrentUserOrgs
     *
     * User organizations
     *
     * @param array|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param array|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param array|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param array|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListUserOrgs200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listCurrentUserOrgs(array $filter_id = null, array $filter_vendor = null, array $filter_status = null, array $filter_updated_at = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): Error|ListUserOrgs200Response
    {
//        dd($this->client->user->me()->getId());
        return $this->listUserOrgs($this->client->user->me()->getId(), $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
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
    public function updateOrg(string $organization_id, array $update_org_data = null): Organization|Error
    {
        $this->refreshToken();
        $update_org_request = new UpdateOrgRequest($update_org_data);
        return $this->api->updateOrg($organization_id, $update_org_request);
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
    public function listOrgTeams($organization_id, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = ''): mixed
    {
        $this->refreshToken();
        return $this->client->team->listUserTeams($this->client->getUserId(), ['eq' => $organization_id], $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
    }

    /************** ***********************************/
    /********* OrganizationProjectsApi ****************/
    /************** ***********************************/

    /**
     * Operation getOrgProject
     *
     * Get project of a specific organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $project_id The ID of the project. (required)
     *
     * @return OrganizationProject|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getOrgProject(string $organization_id, string $project_id): OrganizationProject|Error
    {
        $this->refreshToken();
        return $this->projectsApi->getOrgProject($organization_id, $project_id);
    }


    /**
     * Operation listOrgProjects
     *
     * List projects from an organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param array|null $filter_title Allows filtering by &#x60;title&#x60; using one or more operators. (optional)
     * @param array|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators. (optional)
     * @param array|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param array|null $filter_created_at Allows filtering by &#x60;created_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;id&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListOrgProjects200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgProjects(string $organization_id, array $filter_id = null, array $filter_title = null, array $filter_status = null, array $filter_updated_at = null, array $filter_created_at = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListOrgProjects200Response|Error
    {
        $this->refreshToken();
        return $this->projectsApi->listOrgProjects($organization_id, $filter_id, $filter_title, $filter_status, $filter_updated_at, $filter_created_at, $page_size, $page_before, $page_after, $sort);
    }

    /************** **********************************/
    /********* OrganizationMembersApi ****************/
    /************** **********************************/

    /**
     * Operation createOrgMember
     *
     * Create organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param CreateOrgMemberRequest $create_org_member_request create_org_member_request (required)
     *
     * @return OrganizationMember|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrgMember(string $organization_id, CreateOrgMemberRequest $create_org_member_request): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->membersApi->createOrgMember($organization_id, $create_org_member_request);
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
     * @return OrganizationMember|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrgMember(string $organization_id, string $user_id, UpdateOrgMemberRequest $update_org_member_request = null): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->membersApi->updateOrgMember($organization_id, $user_id, $update_org_member_request);
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
        return $this->membersApi->getOrgMember($organization_id, $user_id);
    }

    /**
     * Operation listOrgMembers
     *
     * List organization members
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param array|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListOrgMembers200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgMembers(string $organization_id, array $filter_permissions = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListOrgMembers200Response|Error
    {
        $this->refreshToken();
        return $this->membersApi->listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort);
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
        $this->membersApi->deleteOrgMember($organization_id, $user_id);
    }


    /************** ************************************/
    /********* SubscriptionsApi ************************/
    /************** ************************************/

    /**
     * Operation canCreateNewOrgSubscription
     *
     * Checks if the user is able to create a new project in the organization.
     *
     * @param string $organization_id The ID of the organization. (required)
     *
     * @return CanCreateNewOrgSubscription200Response|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function canCreateNewOrgSubscription(string $organization_id): CanCreateNewOrgSubscription200Response|Error
    {
        $this->refreshToken();
        return $this->subscriptionsApi->canCreateNewOrgSubscription($organization_id);
    }

    /**
     * Operation canCreateNewOrgProject
     *
     * Checks if the user is able to create a new project in the organization.
     *
     * @param string $organization_id The ID of the organization. (required)
     *
     * @return CanCreateNewOrgSubscription200Response|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function canCreateNewOrgProject(string $organization_id): CanCreateNewOrgSubscription200Response|Error
    {
        return $this->canCreateNewOrgSubscription($organization_id);
    }

    /**
     * Operation createOrgSubscription
     *
     * Create subscription/project
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $create_org_subscription_data create_org_subscription_request (required)
     * @return Subscription|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrgSubscription(string $organization_id, array $create_org_subscription_data): Error|Subscription
    {
        $this->refreshToken();
        $create_org_subscription_request = new CreateOrgSubscriptionRequest($create_org_subscription_data);
        return $this->subscriptionsApi->createOrgSubscription($organization_id, $create_org_subscription_request);
    }

    /**
     * Operation createOrgProject
     *
     * Create project
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $create_org_subscription_data create_org_subscription_request (required)
     * @return Subscription|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrgProject(string $organization_id, array $create_org_subscription_data): Error|Subscription
    {
        return $this->createOrgSubscription($organization_id, $create_org_subscription_data);
    }

    /**
     * Operation deleteOrgSubscription
     *
     * Delete subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $subscription_id The ID of the subscription. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrgSubscription(string $organization_id, string $subscription_id): void
    {
        $this->refreshToken();
        $this->subscriptionsApi->deleteOrgSubscription($organization_id, $subscription_id);
    }


    /**
     * Operation deleteOrgProject
     *
     * Delete project
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $project_id
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrgProject(string $organization_id, string $project_id): void
    {
        $this->deleteOrgSubscription($organization_id, $project_id);
    }

    /**
     * Operation estimateNewOrgSubscription
     *
     * Estimate the price of a new subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param int $storage The total storage available to each environment, in MiB. (required)
     * @param int $user_licenses The number of user licenses. (required)
     * @param string|null $format The format of the estimation output. (optional)
     *
     * @return EstimationObject|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function estimateNewOrgSubscription(string $organization_id, int $environments = 3, int $storage = 500, int $user_licenses = 1, string $format = null): EstimationObject|Error
    {
        $this->refreshToken();
        return $this->subscriptionsApi->estimateNewOrgSubscription($organization_id, self::DEFAULT_UPSUN_PLAN, $environments, $storage, $user_licenses, $format);
    }

    /**
     * Operation estimateOrgSubscription
     *
     * Estimate the price of a subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $subscription_id The ID of the subscription. (required)
     * @param int|null $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param int|null $storage The total storage available to each environment, in MiB. (optional)
     * @param int|null $user_licenses The number of user licenses. (optional)
     * @param string|null $format The format of the estimation output. (optional)
     *
     * @return EstimationObject|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function estimateOrgSubscription(string $organization_id, string $subscription_id, int $environments = null, int $storage = null, int $user_licenses = null, string $format = null): EstimationObject|Error
    {
        $this->refreshToken();

        return $this->subscriptionsApi->estimateOrgSubscription($organization_id, $subscription_id, self::DEFAULT_UPSUN_PLAN, $environments, $storage, $user_licenses, $format);
    }

    /**
     * Operation getOrgSubscription
     *
     * Get subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $subscription_id The ID of the subscription. (required)
     *
     * @return Subscription|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getOrgSubscription(string $organization_id, string $subscription_id): Error|Subscription
    {
        $this->refreshToken();
        return $this->subscriptionsApi->getOrgSubscription($organization_id, $subscription_id);
    }

    /**
     * Operation getOrgSubscriptionCurrentUsage
     *
     * Get current usage for a subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $subscription_id The ID of the subscription. (required)
     * @param string|null $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param bool|null $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @return SubscriptionCurrentUsageObject|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getOrgSubscriptionCurrentUsage(string $organization_id, string $subscription_id, string $usage_groups = null, bool $include_not_charged = null): Error|SubscriptionCurrentUsageObject
    {
        $this->refreshToken();
        return $this->subscriptionsApi->getOrgSubscriptionCurrentUsage($organization_id, $subscription_id, $usage_groups, $include_not_charged);
    }

    /**
     * Operation listOrgSubscriptions
     *
     * List subscriptions
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string|null $filter_status The status of the subscription. (optional)
     * @param string|null $filter_id Machine name of the region. (optional)
     * @param array|null $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param array|null $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param array|null $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param array|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListOrgSubscriptions200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgSubscriptions(string $organization_id, string $filter_status = null, string $filter_id = null, array $filter_project_id = null, array $filter_project_title = null, array $filter_region = null, array $filter_updated_at = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListOrgSubscriptions200Response|Error
    {
        $this->refreshToken();
        return $this->subscriptionsApi->listOrgSubscriptions($organization_id, $filter_status, $filter_id, $filter_project_id, $filter_project_title, $filter_region, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation updateOrgSubscription
     *
     * Update subscription
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $subscription_id The ID of the subscription. (required)
     * @param array|null $update_org_subscription_data
     * @return Subscription|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrgSubscription(string $organization_id, string $subscription_id, array $update_org_subscription_data = null): Error|Subscription
    {
        $this->refreshToken();
        $update_org_subscription_request = new UpdateOrgSubscriptionRequest($update_org_subscription_data);
        return $this->subscriptionsApi->updateOrgSubscription($organization_id, $subscription_id, $update_org_subscription_request);
    }

    /************** ***********************************/
    /********* InvoicesApi ************************/
    /************** ***********************************/

    /**
     * Operation getOrgInvoice
     *
     * Get invoice
     *
     * @param string $invoice_id The ID of the invoice. (required)
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @return Invoice|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getOrgInvoice(string $invoice_id, string $organization_id): Error|Invoice
    {
        $this->refreshToken();
        return $this->invoicesApi->getOrgInvoice($invoice_id, $organization_id);
    }

    /**
     * Operation listOrgInvoices
     *
     * List invoices
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param string|null $filter_status The status of the invoice. (optional)
     * @param string|null $filter_type The invoice type. Use invoice for standard invoices, credit_memo for refund/credit invoices. (optional)
     * @param string|null $filter_order_id The order id of Invoice. (optional)
     * @param int|null $page Page to be displayed. Defaults to 1. (optional)
     * @return ListOrgInvoices200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgInvoices($organization_id, string $filter_status = null, string $filter_type = null, string $filter_order_id = null, int $page = null): ListOrgInvoices200Response|Error
    {
        $this->refreshToken();
        return $this->invoicesApi->listOrgInvoices($organization_id, $filter_status, $filter_type, $filter_order_id, $page);
    }
    
    /************** *********************/
    /********* Override ****************/
    /************** *********************/


    /**
     * Activate addons userManagement on organization $organizationId
     *
     * Equivalent to upsun api:curl -X PATCH --json '{"user_management":"standard"}' 'api/organizations/ORGANIZATION_ID/addons' | jq
     * @param $organization_id
     * @return mixed
     * @throws ApiException|GuzzleException
     */
    public function updateOrgAddons($organization_id): mixed
    {
        $this->refreshToken();
        $user_management_addons = ['user_management' => "standard"];
        list($response) = $this->updateOrgAddonsWithHttpInfo($organization_id, $user_management_addons);
        return $response;
    }


    /**
     * Create http client option
     * TODO Duplicate from OrganizationApi.php
     *
     * @return array of http client options
     * @throws \RuntimeException on file opening failure
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->client->apiConfig->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->client->apiConfig->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->client->apiConfig->getDebugFile());
            }
        }

        return $options;
    }

    /**
     *
     * TODO Duplicate from Organizationpi
     * @param string $dataType
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array
     * @throws ApiException
     */
    private function handleResponseWithDataType(
        string            $dataType,
        RequestInterface  $request,
        ResponseInterface $response
    ): array
    {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string)$response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Operation updateOrgAddonsWithHttpInfo
     *
     * Update organization addons
     *
     * @TODO duplicate from OrganizationAPI
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_request (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @return array of \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     * @throws InvalidArgumentException
     * @throws ApiException|GuzzleException on non-2xx response or if the response body is not in the expected format
     */
    private function updateOrgAddonsWithHttpInfo($organization_id, $update_org_request = [], string $contentType = OrganizationsApi::contentTypes['updateOrg'][0]): array
    {
        $request = $this->updateOrgAddonsRequest($organization_id, $update_org_request, $contentType);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->apiClient->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string)$e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch ($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Organization',
                        $request,
                        $response,
                    );
                case 400:
                case 403:
                case 404:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string)$request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string)$response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\Organization',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Organization',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }

            throw $e;
        }
    }

    /**
     * Create request for operation 'updateOrg'
     * @TODO duplicate from OrganizationAPI
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_request (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @return Request
     * @throws InvalidArgumentException
     */
    public function updateOrgAddonsRequest($organization_id, array $update_org_request = [], string $contentType = OrganizationsApi::contentTypes['updateOrg'][0]): Request
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $organization_id when calling updateOrgAddons'
            );
        }

        $resourcePath = '/organizations/{organization_id}/addons';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json',],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_org_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_org_request));
            } else {
                $httpBody = $update_org_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if (!empty($this->api->getConfig()->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->api->getConfig()->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->api->getConfig()->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->api->getConfig()->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->api->getConfig()->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }
}