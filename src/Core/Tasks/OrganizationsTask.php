<?php

namespace Upsun\Core\Tasks;

use DateTime;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\ApiException;
use Upsun\Api\DefaultApi;
use Upsun\Api\DiscountsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MfaApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationManagementApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\ReferencesApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\VouchersApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Address;
use Upsun\Model\ApplyOrgVoucherRequest;
use Upsun\Model\ArrayFilter;
use Upsun\Model\CanAffordSubscriptionRequest;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\CanUpdateSubscription200Response;
use Upsun\Model\CreateAuthorizationCredentials200Response;
use Upsun\Model\CreateOrgMemberRequest;
use Upsun\Model\CreateOrgProjectRequest;
use Upsun\Model\CreateOrgRequest;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\Discount;
use Upsun\Model\EstimationObject;
use Upsun\Model\GetOrgPrepaymentInfo200Response;
use Upsun\Model\GetSubscriptionUsageAlerts200Response;
use Upsun\Model\GetTypeAllowance200Response;
use Upsun\Model\Invoice;
use Upsun\Model\ListOrgDiscounts200Response;
use Upsun\Model\ListOrgInvoices200Response;
use Upsun\Model\ListOrgMembers200Response;
use Upsun\Model\ListOrgOrders200Response;
use Upsun\Model\ListOrgPlanRecords200Response;
use Upsun\Model\ListOrgPrepaymentTransactions200Response;
use Upsun\Model\ListOrgProjects200Response;
use Upsun\Model\ListOrgs200Response;
use Upsun\Model\ListOrgSubscriptions200Response;
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\ListUserOrgs200Response;
use Upsun\Model\Order;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationAddonsObject;
use Upsun\Model\OrganizationAlertConfig;
use Upsun\Model\OrganizationCarbon;
use Upsun\Model\OrganizationEstimationObject;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationMFAEnforcement;
use Upsun\Model\OrganizationProject;
use Upsun\Model\Profile;
use Upsun\Model\Project;
use Upsun\Model\ProjectCarbon;
use Upsun\Model\SendOrgMfaReminders200ResponseValue;
// only mentionned in PHPDocs
use Upsun\Model\SendOrgMfaRemindersRequest;
use Upsun\Model\StringFilter;
use Upsun\Model\Subscription;
use Upsun\Model\SubscriptionAddonsObject;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\UpdateOrgAddonsRequest;
use Upsun\Model\UpdateOrgBillingAlertConfigRequest;
use Upsun\Model\UpdateOrgMemberRequest;
use Upsun\Model\UpdateOrgProfileRequest;
use Upsun\Model\UpdateOrgRequest;
use Upsun\Model\UpdateOrgSubscriptionRequest;
use Upsun\Model\UpdateSubscriptionUsageAlertsRequest;
use Upsun\Model\Vouchers;
use Upsun\UpsunClient;

/**
 * OrganizationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class OrganizationsTask extends TaskBase
{
    private const DEFAULT_UPSUN_PLAN = 'upsun/flexible';

    public function __construct(
        UpsunClient $client,
        private readonly OrganizationsApi $organizationsApi,
        private readonly OrganizationProjectsApi $projectsApi,
        private readonly OrganizationMembersApi $membersApi,
        private readonly SubscriptionsApi $subscriptionsApi,
        private readonly InvoicesApi $invoicesApi,
        private readonly MfaApi $mfaApi,
        private readonly OrdersApi $ordersApi,
        private readonly ProfilesApi $profilesApi,
        private readonly RecordsApi $recordsApi,
        private readonly VouchersApi $vouchersApi,
        private readonly AddOnsApi $addOnsApi,
        private readonly DiscountsApi $discountsApi,
        private readonly OrganizationManagementApi $organizationManagementApi,
        private readonly ReferencesApi $referencesApi,
        private readonly DefaultApi $defaultApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Create organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(
        string $label,
        ?string $type = null,
        ?string $ownerId = null,
        ?string $name = null,
        ?string $country = null,
    ): Organization {
        return $this->organizationsApi->createOrg(
            createOrgRequest: new CreateOrgRequest(
                label: $label,
                type: $type,
                ownerId: $ownerId,
                name: $name,
                country: $country
            )
        );
    }

    /**
     * Delete organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function delete(string $organizationId): void
    {
        $this->checkOrganizationId($organizationId);

        $this->organizationsApi->deleteOrg(organizationId: $organizationId);
    }

    /**
     * Get or update organization info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function info(
        string $organizationId,
        ?string $name = null,
        ?string $label = null,
        ?string $country = null,
        ?string $securityContact = null
    ): Organization {
        if (
            $country !== null
            || $label !== null
            || $name !== null
            || $securityContact !== null
        ) {
            return $this->update(
                $organizationId,
                $name,
                $label,
                $country,
                $securityContact
            );
        }

        return $this->get($organizationId);
    }

    /**
     * Get organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function get(string $organizationId): Organization
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationsApi->getOrg(organizationId: $organizationId);
    }

    /**
     * Update an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function update(
        string $organizationId,
        ?string $name = null,
        ?string $label = null,
        ?string $country = null,
        ?string $securityContact = null
    ): Organization {
        $this->checkOrganizationId($organizationId);

        return $this->organizationsApi->updateOrg(
            organizationId: $organizationId,
            updateOrgRequest: new UpdateOrgRequest(
                $name,
                $label,
                $country,
                $securityContact
            )
        );
    }

    /**
     * List organizations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function list(
        ?array $filterId = null,
        ?array $filterOwnerId = null,
        ?array $filterType = null,
        ?array $filterName = null,
        ?array $filterLabel = null,
        ?array $filterVendor = null,
        ?array $filterCapabilities = null,
        ?array $filterStatus = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = 100,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListOrgs200Response {
        return $this->organizationsApi->listOrgs(
            filterId: new StringFilter(...$this->normalizeFilter($filterId)),
            filterType: new StringFilter(...$this->normalizeFilter($filterType)),
            filterOwnerId: new StringFilter(...$this->normalizeFilter($filterOwnerId)),
            filterName: new StringFilter(...$this->normalizeFilter($filterName)),
            filterLabel: new StringFilter(...$this->normalizeFilter($filterLabel)),
            filterVendor: new StringFilter(...$this->normalizeFilter($filterVendor)),
            filterCapabilities: new ArrayFilter(...$this->normalizeFilter($filterCapabilities)),
            filterStatus: new StringFilter(...$this->normalizeFilter($filterStatus)),
            filterUpdatedAt: new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * List the subscriptions for an organization. This will return a list of all active and past subscriptions associated
     * with the organization, including details such as the subscription plan, status, and billing information.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     */
    public function listSubscriptions(string $organizationId): ListOrgSubscriptions200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->subscriptionsApi->listOrgSubscriptions($organizationId);
    }

    /**
     * Create an organization member
     *
     * @param ('read'|'write'|'admin')[]|null $permissions
     * @deprecated use addMembers() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createMember(
        string $organizationId,
        string $userId,
        ?array $permissions = []
    ): OrganizationMember {
        return $this->addMember($organizationId, $userId, $permissions);
    }

    /**
     * Add a member to an organization with the specified permissions. This will invite the user to join the
     * organization,and the user will need to accept the invitation before they become an active member of the
     * organization. The permissions parameter can be used to specify the level of access the member will have within
     * the organization.
     *
     * @param ('read'|'write'|'admin')[]|null $permissions
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function addMember(
        string $organizationId,
        string $userId,
        ?array $permissions = []
    ): OrganizationMember {
        $this->checkOrganizationId($organizationId);
        $this->checkUserId($userId);

        return $this->membersApi->createOrgMember(
            organizationId: $organizationId,
            createOrgMemberRequest: new CreateOrgMemberRequest(
                userId: $userId,
                permissions: $permissions ?? null
            )
        );
    }

    /**
     * Delete an organization member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function deleteMember(string $organizationId, string $userId): void
    {
        $this->checkOrganizationId($organizationId);
        $this->checkUserId($userId);

        $this->membersApi->deleteOrgMember(organizationId: $organizationId, userId: $userId);
    }

    /**
     * Get organization member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getMember(string $organizationId, string $userId): OrganizationMember
    {
        return $this->membersApi->getOrgMember(organizationId: $organizationId, userId: $userId);
    }

    /**
     * List members of an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listMembers(
        string $organizationId,
        ?array $filterPermissions = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListOrgMembers200Response {
        $this->checkOrganizationId($organizationId);

        return $this->membersApi->listOrgMembers(
            organizationId: $organizationId,
            filterPermissions: $filterPermissions ?
                new ArrayFilter(...$this->normalizeFilter($filterPermissions)) : null,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Update an organization member's permissions. This will modify the member's access level within the organization
     * based on the specified permissions.
     *
     * @param ('read'|'write'|'admin')[]|null $permissions
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateMember(
        string $organizationId,
        string $userId,
        ?array $permissions = []
    ): OrganizationMember {
        $this->checkOrganizationId($organizationId);
        $this->checkUserId($userId);

        return $this->membersApi->updateOrgMember(
            organizationId: $organizationId,
            userId: $userId,
            updateOrgMemberRequest: new UpdateOrgMemberRequest(
                permissions: $permissions
            )
        );
    }

    /**
     * List the organizations that a user belongs to, with optional filtering. This will return a list of organizations
     * that the specified user is a member of, and the filters can be used to narrow down the list based on specific
     * criteria.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listUserOrgs(
        string $userId,
        ?array $filterId = null,
        ?array $filterType = null,
        ?array $filterVendor = null,
        ?array $filterStatus = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListUserOrgs200Response {
        $this->checkUserId($userId);

        return $this->organizationsApi->listUserOrgs(
            userId: $userId,
            filterId: new StringFilter(...$this->normalizeFilter($filterId)),
            filterType: new StringFilter(...$this->normalizeFilter($filterType)),
            filterVendor: new StringFilter(...$this->normalizeFilter($filterVendor)),
            filterStatus: new StringFilter(...$this->normalizeFilter($filterStatus)),
            filterUpdatedAt: new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * List organization accessible to the current user, with optional filtering.
     * This will return a list of organizations that the current user has access to, and the filters can be used to
     * narrow down the list based on specific criteria.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listCurrentUserOrgs(
        ?array $filterId = null,
        ?array $filterVendor = null,
        ?array $filterStatus = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListUserOrgs200Response {
        return $this->listUserOrgs(
            userId: $this->client->users->me()->getId(),
            filterId: $filterId,
            filterVendor: $filterVendor,
            filterStatus: $filterStatus,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Get Teams of the current organization (for current user)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listTeams(
        ?string $filterOrganizationId = null,
        ?string $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->client->teams->list(
            filterOrganizationId: $filterOrganizationId ? ['eq' => $filterOrganizationId] : null,
            filterId: null,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Retrieve teams that the specified user is a member of.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listTeamsByMember(
        string $userId,
        ?array $filterOrganizationId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->client->teams->listByMember(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Get a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getProject(string $projectId): Project
    {
        return $this->client->projects->get(projectId: $projectId);
    }

    /**
     * List projects from an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listProjects(
        string $organizationId,
        ?array $filterId = null,
        ?array $filterTitle = null,
        ?array $filterStatus = null,
        ?array $filterUpdatedAt = null,
        ?array $filterCreatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListOrgProjects200Response {
        $this->checkOrganizationId($organizationId);

        return $this->projectsApi->listOrgProjects(
            $organizationId,
            filterId: $filterId ? new StringFilter(...$this->normalizeFilter($filterId)) : null,
            filterTitle: $filterTitle ? new StringFilter(...$this->normalizeFilter($filterTitle)) : null,
            filterStatus: $filterStatus ? new StringFilter(...$this->normalizeFilter($filterStatus)) : null,
            filterUpdatedAt: $filterUpdatedAt ? new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)) : null,
            filterCreatedAt: $filterCreatedAt ? new DateTimeFilter(...$this->normalizeFilter($filterCreatedAt)) : null,
            pageSize: $pageSize ?? null,
            pageBefore: $pageBefore ?? null,
            pageAfter: $pageAfter ?? null,
            sort: $sort ?? null
        );
    }

    /**
     * Check if a new project can be created within the specified organization. This will return information about whether
     * the organization is eligible to create a new project, based on factors such as the organization's current
     * subscription status, project limits, and any other relevant criteria defined by the API.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function canCreateProject(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->client->projects->canCreate(organizationId: $organizationId);
    }

    /**
     * Create a project
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createProject(
        string $organizationId,
        string $projectRegion,
        ?string $plan = null,
        ?string $title = null,
        ?string $optionsUrl = null,
        ?string $defaultBranch = null,
        ?int $environments = null,
        ?int $storage = null,
    ): Subscription {
        return $this->client->projects->create(
            organizationId: $organizationId,
            projectRegion: $projectRegion,
            title: $title,
            defaultBranch: $defaultBranch,
            plan: $plan,
            optionsUrl: $optionsUrl,
            environments: $environments,
            storage: $storage
        );
    }

    /**
     * Delete a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function deleteProject(string $projectId): void
    {
        $this->client->projects->delete($projectId);
    }

    /**
     * Estimate the cost of creating a new project within the specified organization, based on parameters such as the
     * number of environments, storage, and user licenses.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function estimateNewProject(
        string $organizationId,
        ?int $environments = 3,
        ?int $storage = 500,
        ?int $userLicenses = 1,
        ?string $format = null,
    ): EstimationObject {
        $this->checkOrganizationId($organizationId);

        return $this->subscriptionsApi->estimateNewOrgSubscription(
            organizationId: $organizationId,
            plan: self::DEFAULT_UPSUN_PLAN,
            environments: $environments,
            storage: $storage,
            userLicenses: $userLicenses,
            format: $format
        );
    }

    /**
     * Estimate the cost of a project within the specified organization, based on parameters such as the
     * number of environments, storage, and user licenses.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function estimateProject(
        string $organizationId,
        string $projectId,
        ?int $environments = 3,
        ?int $storage = 500,
        ?int $userLicenses = 1,
        ?string $format = null
    ): EstimationObject {
        $this->checkOrganizationId($organizationId);
        $this->checkProjectId($projectId);

        $project = $this->client->projects->get($projectId);
        $subscriptionId = $this->extractSubscriptionId($project->getSubscription()->getLicenseUri());

        return $this->subscriptionsApi->estimateOrgSubscription(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId,
            plan: self::DEFAULT_UPSUN_PLAN,
            environments: $environments,
            storage: $storage,
            userLicenses: $userLicenses,
            format: $format
        );
    }

    /**
     * Get current usage for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getProjectUsage(
        string $organizationId,
        string $projectId,
        ?string $usageGroups = null,
        ?bool $includeNotCharged = null
    ): SubscriptionCurrentUsageObject {
        $this->checkOrganizationId($organizationId);
        $this->checkProjectId($projectId);

        $project = $this->client->projects->get($projectId);
        $subscriptionId = $this->extractSubscriptionId($project->getSubscription()->getLicenseUri());

        return $this->subscriptionsApi->getOrgSubscriptionCurrentUsage(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId,
            usageGroups: $usageGroups,
            includeNotCharged: $includeNotCharged
        );
    }

    /**
     * Update a project
     *
     * @deprecated use $client->projects->update() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateProject(
        string $projectId,
        ?string $title = null,
        ?string $timezone = null,
    ): AcceptedResponse {
        return $this->client->projects->update(
            projectId: $projectId,
            title: $title,
            timezone: $timezone,
        );
    }

    /**
     * Disable organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function disableMfaEnforcement(string $organizationId): void
    {
        $this->checkOrganizationId($organizationId);

        $this->mfaApi->disableOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Enable organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function enableMfaEnforcement(string $organizationId): void
    {
        $this->checkOrganizationId($organizationId);

        $this->mfaApi->enableOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Get organization MFA settings
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getMfaEnforcement(string $organizationId): OrganizationMFAEnforcement
    {
        $this->checkOrganizationId($organizationId);

        return $this->mfaApi->getOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Send MFA reminders to organization members
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return SendOrgMfaReminders200ResponseValue[]
     */
    public function sendMfaReminders(string $organizationId, ?array $userIds = null): array
    {
        $this->checkOrganizationId($organizationId);

        return $this->mfaApi->sendOrgMfaReminders(
            organizationId: $organizationId,
            sendOrgMfaRemindersRequest: new SendOrgMfaRemindersRequest(userIds: $userIds)
        );
    }

    /**
     * Get invoice
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getInvoice(string $invoiceId, string $organizationId): Invoice
    {
        $this->checkInvoiceId($invoiceId);
        $this->checkOrganizationId($organizationId);

        return $this->invoicesApi->getOrgInvoice(invoiceId: $invoiceId, organizationId: $organizationId);
    }

    /**
     * List invoices
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listInvoices(
        string $organizationId,
        ?string $filterStatus = null,
        ?string $filterType = null,
        ?string $filterOrderId = null,
        ?int $page = null
    ): ListOrgInvoices200Response {
        $this->checkOrganizationId($organizationId);

        return $this->invoicesApi->listOrgInvoices(
            organizationId: $organizationId,
            filterStatus: $filterStatus,
            filterType: $filterType,
            filterOrderId: $filterOrderId,
            page: $page
        );
    }

    /**
     * Download an invoice.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function downloadInvoice(string $token): string
    {
        return $this->ordersApi->downloadInvoice(token: $token);
    }

    /**
     * Create confirmation credentials for 3D-Secure
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createAuthorizationCredentials(
        string $organizationId,
        string $orderId
    ): CreateAuthorizationCredentials200Response {
        $this->checkOrganizationId($organizationId);
        $this->checkOrderId($orderId);

        return $this->ordersApi->createAuthorizationCredentials(organizationId: $organizationId, orderId: $orderId);
    }

    /**
     * Get an order
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getOrder(string $organizationId, string $orderId, ?string $mode = null): Order
    {
        $this->checkOrganizationId($organizationId);
        $this->checkOrderId($orderId);

        return $this->ordersApi->getOrgOrder(organizationId: $organizationId, orderId: $orderId, mode: $mode);
    }

    /**
     * List orders
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listOrders(
        string $organizationId,
        ?string $filterStatus = null,
        ?int $filterTotal = null,
        ?int $page = null,
        ?string $mode = null
    ): ListOrgOrders200Response {
        return $this->ordersApi->listOrgOrders(
            organizationId: $organizationId,
            filterStatus: $filterStatus,
            filterTotal: $filterTotal,
            page: $page,
            mode: $mode
        );
    }

    /**
     * Get address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getAddress(string $organizationId): Address
    {
        $this->checkOrganizationId($organizationId);

        return $this->profilesApi->getOrgAddress(organizationId: $organizationId);
    }

    /**
     * Get profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getProfile(string $organizationId): Profile
    {
        $this->checkOrganizationId($organizationId);

        return $this->profilesApi->getOrgProfile(organizationId: $organizationId);
    }

    /**
     * Update address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateAddress(
        string $organizationId,
        ?string $country = null,
        ?string $nameLine = null,
        ?string $premise = null,
        ?string $subPremise = null,
        ?string $thoroughfare = null,
        ?string $administrativeArea = null,
        ?string $subAdministrativeArea = null,
        ?string $locality = null,
        ?string $dependentLocality = null,
        ?string $postalCode = null,
    ): Address {
        $this->checkOrganizationId($organizationId);

        return $this->profilesApi->updateOrgAddress(
            organizationId: $organizationId,
            address: new Address(
                country: $country,
                nameLine: $nameLine,
                premise: $premise,
                subPremise: $subPremise,
                thoroughfare: $thoroughfare,
                administrativeArea: $administrativeArea,
                subAdministrativeArea: $subAdministrativeArea,
                locality: $locality,
                dependentLocality: $dependentLocality,
                postalCode: $postalCode,
            )
        );
    }

    /**
     * Update profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateProfile(
        string $organizationId,
        ?string $defaultCatalog = null,
        ?string $projectOptionsUrl = null,
        ?string $companyName = null,
        ?string $vatNumber = null,
        ?string $billingContact = null,
    ): Profile {
        $this->checkOrganizationId($organizationId);

        return $this->profilesApi->updateOrgProfile(
            organizationId: $organizationId,
            updateOrgProfileRequest: new UpdateOrgProfileRequest(
                defaultCatalog: $defaultCatalog,
                projectOptionsUrl: $projectOptionsUrl,
                companyName: $companyName,
                vatNumber: $vatNumber,
                billingContact: $billingContact,
            )
        );
    }

    /**
     * List plan records
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listRecords(
        string $organizationId,
        ?string $filterProjectId = null,
        ?string $filterPlan = null,
        ?DateTime $filterStatus = null,
        ?DateTime $filterStart = null,
        ?DateTime $filterEnd = null,
        ?DateTime $filterStartedAt = null,
        ?DateTime $filterEndedAt = null,
        ?int $page = null
    ): ListOrgPlanRecords200Response {
        $this->checkOrganizationId($organizationId);

        $subscriptionId = null;
        if ($filterProjectId) {
            $this->checkProjectId($filterProjectId);

            $project = $this->client->projects->get($filterProjectId);
            $subscriptionId = $this->extractSubscriptionId($project->getSubscription()->getLicenseUri());
        }

        return $this->recordsApi->listOrgPlanRecords(
            organizationId: $organizationId,
            filterSubscriptionId: $subscriptionId,
            filterPlan: $filterPlan,
            filterStatus: $filterStatus,
            filterStart: $filterStart,
            filterEnd: $filterEnd,
            filterStartedAt: $filterStartedAt,
            filterEndedAt: $filterEndedAt,
            page: $page
        );
    }

    /**
     * List usage records
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listUsageRecords(
        string $organizationId,
        ?string $filterProjectId = null,
        ?string $filterUsageGroup = null,
        ?DateTime $filterStart = null,
        ?DateTime $filterStartedAt = null,
        ?int $page = null
    ): ListOrgUsageRecords200Response {
        $this->checkOrganizationId($organizationId);

        $subscriptionId = null;
        if ($filterProjectId) {
            $this->checkProjectId($filterProjectId);

            $project = $this->client->projects->get($filterProjectId);
            $subscriptionId = $this->extractSubscriptionId($project->getSubscription()->getLicenseUri());
        }

        return $this->recordsApi->listOrgUsageRecords(
            organizationId: $organizationId,
            filterSubscriptionId: $subscriptionId,
            filterUsageGroup: $filterUsageGroup,
            filterStart: $filterStart,
            filterStartedAt: $filterStartedAt,
            page: $page
        );
    }

    /**
     * Apply a voucher code to an organization. This will attempt to apply the specified voucher code to the
     * organization's account, which may result in discounts, credits, or other benefits being applied to the
     * organization's subscription.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function applyVoucher(string $organizationId, string $code): void
    {
        $this->checkOrganizationId($organizationId);
        $this->checkVoucherCode($code);

        $applyOrgVoucherRequest = new ApplyOrgVoucherRequest(
            code: $code
        );
        $this->vouchersApi->applyOrgVoucher(
            organizationId: $organizationId,
            applyOrgVoucherRequest: $applyOrgVoucherRequest
        );
    }

    /**
     * List vouchers
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function listVouchers(string $organizationId): Vouchers
    {
        $this->checkOrganizationId($organizationId);

        return $this->vouchersApi->listOrgVouchers(organizationId: $organizationId);
    }

    /**
     * Get Organization Addons
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getAddons(string $organizationId): OrganizationAddonsObject
    {
        $this->checkOrganizationId($organizationId);

        return $this->addOnsApi->getOrgAddons(organizationId: $organizationId);
    }

    /**
     * Updates Organization Addons
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateAddons(
        string $organizationId,
        ?string $userManagement = null,
        ?string $supportLevel = null,
    ): OrganizationAddonsObject {
        $this->checkOrganizationId($organizationId);

        return $this->addOnsApi->updateOrgAddons(
            organizationId: $organizationId,
            updateOrgAddonsRequest: new UpdateOrgAddonsRequest(
                userManagement: $userManagement,
                supportLevel: $supportLevel
            )
        );
    }

    // Organization Projects Methods

    /**
     * Creates a project in an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return OrganizationProject
     */
    public function createOrgProject(
        string $organizationId,
        CreateOrgProjectRequest $createOrgProjectRequest
    ): OrganizationProject {
        $this->checkOrganizationId($organizationId);

        return $this->projectsApi->createOrgProject(
            organizationId: $organizationId,
            createOrgProjectRequest: $createOrgProjectRequest
        );
    }

    /**
     * Deletes a project from an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function deleteOrgProject(string $organizationId, string $projectId): void
    {
        $this->checkOrganizationId($organizationId);
        $this->checkProjectId($projectId);

        $this->projectsApi->deleteOrgProject(
            organizationId: $organizationId,
            projectId: $projectId
        );
    }

    /**
     * Gets a project from an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return OrganizationProject
     */
    public function getOrgProject(string $organizationId, string $projectId): OrganizationProject
    {
        $this->checkOrganizationId($organizationId);
        $this->checkProjectId($projectId);

        return $this->projectsApi->getOrgProject(
            organizationId: $organizationId,
            projectId: $projectId
        );
    }

    /**
     * Queries project carbon emissions metrics.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return ProjectCarbon
     */
    public function queryProjectCarbon(
        string $organizationId,
        string $projectId,
        ?DateTimeFilter $from = null,
        ?DateTimeFilter $to = null,
        ?string $interval = null
    ): ProjectCarbon {
        $this->checkOrganizationId($organizationId);
        $this->checkProjectId($projectId);
        if ($interval !== null && trim($interval) === '') {
            throw new InvalidArgumentException('interval cannot be empty when provided.');
        }

        return $this->projectsApi->queryProjectCarbon(
            organizationId: $organizationId,
            projectId: $projectId,
            from: $from,
            to: $to,
            interval: $interval ?? null
        );
    }

    // Subscriptions Methods

    /**
     * Checks whether the subscription can afford requested resources.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the subscription ID is invalid
     */
    public function canAffordSubscription(
        string $subscriptionId,
        CanAffordSubscriptionRequest $canAffordSubscriptionRequest
    ): void {
        $this->checkSubscriptionId($subscriptionId);

        $this->subscriptionsApi->canAffordSubscription(
            subscriptionId: $subscriptionId,
            canAffordSubscriptionRequest: $canAffordSubscriptionRequest
        );
    }

    /**
     * Checks whether the subscription can be updated with the requested values.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the subscription ID is invalid
     * @return CanUpdateSubscription200Response
     */
    public function canUpdateSubscription(
        string $subscriptionId,
        ?string $plan = null,
        ?int $environments = null,
        ?int $storage = null,
        ?int $userLicenses = null
    ): CanUpdateSubscription200Response {
        $this->checkSubscriptionId($subscriptionId);

        return $this->subscriptionsApi->canUpdateSubscription(
            subscriptionId: $subscriptionId,
            plan: $plan,
            environments: $environments,
            storage: $storage,
            userLicenses: $userLicenses
        );
    }

    /**
     * Gets subscription usage alerts for an organization subscription.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return GetSubscriptionUsageAlerts200Response
     */
    public function getSubscriptionUsageAlerts(
        string $organizationId,
        string $subscriptionId
    ): GetSubscriptionUsageAlerts200Response {
        $this->checkOrganizationId($organizationId);
        $this->checkSubscriptionId($subscriptionId);

        return $this->subscriptionsApi->getSubscriptionUsageAlerts(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId
        );
    }

    /**
     * Lists addons for an organization subscription.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return SubscriptionAddonsObject
     */
    public function listSubscriptionAddons(
        string $organizationId,
        string $subscriptionId
    ): SubscriptionAddonsObject {
        $this->checkOrganizationId($organizationId);
        $this->checkSubscriptionId($subscriptionId);

        return $this->subscriptionsApi->listSubscriptionAddons(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId
        );
    }

    /**
     * Updates an organization subscription.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return Subscription
     */
    public function updateOrgSubscription(
        string $organizationId,
        string $subscriptionId,
        UpdateOrgSubscriptionRequest $updateOrgSubscriptionRequest
    ): Subscription {
        $this->checkOrganizationId($organizationId);
        $this->checkSubscriptionId($subscriptionId);

        return $this->subscriptionsApi->updateOrgSubscription(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId,
            updateOrgSubscriptionRequest: $updateOrgSubscriptionRequest
        );
    }

    /**
     * Updates usage alerts for an organization subscription.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return GetSubscriptionUsageAlerts200Response
     */
    public function updateSubscriptionUsageAlerts(
        string $organizationId,
        string $subscriptionId,
        UpdateSubscriptionUsageAlertsRequest $updateSubscriptionUsageAlertsRequest
    ): GetSubscriptionUsageAlerts200Response {
        $this->checkOrganizationId($organizationId);
        $this->checkSubscriptionId($subscriptionId);

        return $this->subscriptionsApi->updateSubscriptionUsageAlerts(
            organizationId: $organizationId,
            subscriptionId: $subscriptionId,
            updateSubscriptionUsageAlertsRequest: $updateSubscriptionUsageAlertsRequest
        );
    }

    // Discounts Methods

    /**
     * Gets a discount by ID.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the discount ID is empty
     * @return Discount
     */
    public function getDiscount(string $id): Discount
    {
        if (trim($id) === '') {
            throw new InvalidArgumentException('id cannot be empty.');
        }

        return $this->discountsApi->getDiscount(id: $id);
    }

    /**
     * Gets the First Project Incentive type allowance.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return GetTypeAllowance200Response
     */
    public function getTypeAllowance(): GetTypeAllowance200Response
    {
        return $this->discountsApi->getTypeAllowance();
    }

    /**
     * Lists discounts for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return ListOrgDiscounts200Response
     */
    public function listOrgDiscounts(string $organizationId): ListOrgDiscounts200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->discountsApi->listOrgDiscounts(organizationId: $organizationId);
    }

    // Organization Management Methods

    /**
     * Estimates total spend for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return OrganizationEstimationObject
     */
    public function estimateOrg(string $organizationId): OrganizationEstimationObject
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationManagementApi->estimateOrg(organizationId: $organizationId);
    }

    /**
     * Gets billing alert configuration for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return OrganizationAlertConfig
     */
    public function getOrgBillingAlertConfig(string $organizationId): OrganizationAlertConfig
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationManagementApi->getOrgBillingAlertConfig(organizationId: $organizationId);
    }

    /**
     * Gets prepayment information for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return GetOrgPrepaymentInfo200Response
     */
    public function getOrgPrepaymentInfo(string $organizationId): GetOrgPrepaymentInfo200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationManagementApi->getOrgPrepaymentInfo(organizationId: $organizationId);
    }

    /**
     * Lists prepayment transactions for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return ListOrgPrepaymentTransactions200Response
     */
    public function listOrgPrepaymentTransactions(string $organizationId): ListOrgPrepaymentTransactions200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationManagementApi->listOrgPrepaymentTransactions(organizationId: $organizationId);
    }

    /**
     * Updates billing alert configuration for an organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the organization ID is invalid
     * @return OrganizationAlertConfig
     */
    public function updateOrgBillingAlertConfig(
        string $organizationId,
        UpdateOrgBillingAlertConfigRequest $updateOrgBillingAlertConfigRequest
    ): OrganizationAlertConfig {
        $this->checkOrganizationId($organizationId);

        return $this->organizationManagementApi->updateOrgBillingAlertConfig(
            organizationId: $organizationId,
            updateOrgBillingAlertConfigRequest: $updateOrgBillingAlertConfigRequest
        );
    }

    // References Methods

    /**
     * Lists referenced organizations.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return array<string,\Upsun\Model\OrganizationReference>
     */
    public function listReferencedOrgs(string $in, string $sig): array
    {
        if (trim($in) === '') {
            throw new InvalidArgumentException('in cannot be empty.');
        }

        if (trim($sig) === '') {
            throw new InvalidArgumentException('sig cannot be empty.');
        }

        return $this->referencesApi->listReferencedOrgs(
            in: $in,
            sig: $sig
        );
    }

    /**
     * Lists referenced projects.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return array<string,\Upsun\Model\ProjectReference>
     */
    public function listReferencedProjects(string $in, string $sig): array
    {
        if (trim($in) === '') {
            throw new InvalidArgumentException('in cannot be empty.');
        }

        if (trim($sig) === '') {
            throw new InvalidArgumentException('sig cannot be empty.');
        }

        return $this->referencesApi->listReferencedProjects(
            in: $in,
            sig: $sig
        );
    }

    // Organization Carbon Methods

    /**
     * Queries organization carbon emissions metrics.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return OrganizationCarbon
     */
    public function queryOrganiationCarbon(
        string $organizationId,
        ?DateTimeFilter $from = null,
        ?DateTimeFilter $to = null,
        ?string $interval = null
    ): OrganizationCarbon {
        $this->checkOrganizationId($organizationId);
        if ($interval !== null && trim($interval) === '') {
            throw new InvalidArgumentException('interval cannot be empty when provided.');
        }

        return $this->defaultApi->queryOrganiationCarbon(
            organizationId: $organizationId,
            from: $from,
            to: $to,
            interval: $interval ?? null
        );
    }
}
