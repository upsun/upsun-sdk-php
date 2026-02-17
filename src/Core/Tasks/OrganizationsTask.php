<?php

namespace Upsun\Core\Tasks;

use DateTime;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\ApiException;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MfaApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\VouchersApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Address;
use Upsun\Model\ApplyOrgVoucherRequest;
use Upsun\Model\ArrayFilter;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\CreateAuthorizationCredentials200Response;
use Upsun\Model\CreateOrgMemberRequest;
use Upsun\Model\CreateOrgRequest;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\EstimationObject;
use Upsun\Model\Invoice;
use Upsun\Model\ListOrgInvoices200Response;
use Upsun\Model\ListOrgMembers200Response;
use Upsun\Model\ListOrgOrders200Response;
use Upsun\Model\ListOrgPlanRecords200Response;
use Upsun\Model\ListOrgProjects200Response;
use Upsun\Model\ListOrgs200Response;
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\ListUserOrgs200Response;
use Upsun\Model\Order;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationAddonsObject;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationMFAEnforcement;
use Upsun\Model\OrganizationProject;
use Upsun\Model\Profile;
use Upsun\Model\SendOrgMfaReminders200ResponseValue;
use Upsun\Model\SendOrgMfaRemindersRequest;
use Upsun\Model\StringFilter;
use Upsun\Model\Subscription;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\UpdateOrgAddonsRequest;
use Upsun\Model\UpdateOrgMemberRequest;
use Upsun\Model\UpdateOrgProfileRequest;
use Upsun\Model\UpdateOrgRequest;
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
        private readonly OrganizationsApi $api,
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
    ) {
        parent::__construct($client);
    }

    /**
     * Creates organization
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
        $createOrgRequest = new CreateOrgRequest(
            label: $label,
            type: $type,
            ownerId: $ownerId,
            name: $name,
            country: $country
        );
        return $this->api->createOrg(createOrgRequest: $createOrgRequest);
    }

    /**
     * Deletes organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $organizationId): void
    {
        $this->api->deleteOrg(organizationId: $organizationId);
    }

    /**
     * Gets organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $organizationId): Organization
    {
        return $this->api->getOrg(organizationId: $organizationId);
    }

    /**
     * Lists organizations
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
        return $this->api->listOrgs(
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
     * Lists user organizations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
        return $this->api->listUserOrgs(
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
     * Lists current user organizations
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
     * Updates an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $organizationId,
        ?string $name = null,
        ?string $label = null,
        ?string $country = null,
        ?string $securityContact = null
    ): Organization {
        return $this->api->updateOrg(
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
     * Gets Teams of the current organization (for current user)
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     */
    public function listTeams(
        ?string $organizationId,
        ?string $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->client->teams->list(
            filterOrganizationId: $organizationId ? ['eq' => $organizationId] : null,
            filterId: null,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Gets a project of a specific organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProject(string $organizationId, string $projectId): OrganizationProject
    {
        return $this->projectsApi->getOrgProject(organizationId: $organizationId, projectId: $projectId);
    }

    /**
     * Lists projects from an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
     * Creates organization member
     *
     * @param ('read'|'write'|'admin')[]|null $permissions
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createMember(
        string $organizationId,
        string $userId,
        ?array $permissions = []
    ): OrganizationMember {
        $createOrgMemberRequest = new CreateOrgMemberRequest(
            userId: $userId,
            permissions: $permissions ?? null
        );
        return $this->membersApi->createOrgMember(
            organizationId: $organizationId,
            createOrgMemberRequest: $createOrgMemberRequest
        );
    }

    /**
     * Updates organization member
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
        $updateOrgMemberRequest = $permissions ? new UpdateOrgMemberRequest(
            permissions: $permissions
        ) : null;
        return $this->membersApi->updateOrgMember(
            organizationId: $organizationId,
            userId: $userId,
            updateOrgMemberRequest: $updateOrgMemberRequest
        );
    }

    /**
     * Gets organization member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getMember(string $organizationId, string $userId): OrganizationMember
    {
        return $this->membersApi->getOrgMember(organizationId: $organizationId, userId: $userId);
    }

    /**
     * Lists members of an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listMembers(
        string $organizationId,
        ?array $filterPermissions = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListOrgMembers200Response {
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
     * Delete an organization member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteMember(string $organizationId, string $userId): void
    {
        $this->membersApi->deleteOrgMember(organizationId: $organizationId, userId: $userId);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function canCreateProject(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->client->projects->canCreate(organizationId: $organizationId);
    }

    /**
     * Creates a project
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * Deletes a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteProject(string $projectId): void
    {
        $this->client->projects->delete($projectId);
    }

    /**
     * Estimates the price of a new project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function estimateNewProject(
        string $organizationId,
        ?int $environments = 3,
        ?int $storage = 500,
        ?int $userLicenses = 1,
        ?string $format = null
    ): EstimationObject {
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
     * Estimates the price of a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function estimateProject(
        string $organizationId,
        string $projectId,
        ?int $environments = 3,
        ?int $storage = 500,
        ?int $userLicenses = 1,
        ?string $format = null
    ): EstimationObject {
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
     * Gets current usage for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectUsage(
        string $organizationId,
        string $projectId,
        ?string $usageGroups = null,
        ?bool $includeNotCharged = null
    ): SubscriptionCurrentUsageObject {
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
     * Updates a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProject(
        string $projectId,
        ?string $title = null,
        ?string $defaultBranch = null,
        ?string $description = null,
        ?string $defaultDomain = null,
        ?array $attributes = [],
        ?string $timezone = null,
        ?string $region = null,
    ): AcceptedResponse {
        return $this->client->projects->update(
            projectId: $projectId,
            title: $title,
            defaultBranch: $defaultBranch,
            description: $description,
            defaultDomain: $defaultDomain,
            attributes: $attributes,
            timezone: $timezone,
            region: $region,
        );
    }

    /**
     * Disables organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function disableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->disableOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Enables organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function enableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->enableOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Gets organization MFA settings
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getMfaEnforcement(string $organizationId): OrganizationMFAEnforcement
    {
        return $this->mfaApi->getOrgMfaEnforcement(organizationId: $organizationId);
    }

    /**
     * Sends MFA reminders to organization members
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return SendOrgMfaReminders200ResponseValue[]
     */
    public function sendMfaReminders(string $organizationId, ?array $userIds = null): array
    {
        $sendOrgMfaRemindersRequest = new SendOrgMfaRemindersRequest(userIds: $userIds);
        return $this->mfaApi->sendOrgMfaReminders(
            organizationId: $organizationId,
            sendOrgMfaRemindersRequest: $sendOrgMfaRemindersRequest
        );
    }

    /**
     * Gets invoice
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getInvoice(string $invoiceId, string $organizationId): Invoice
    {
        return $this->invoicesApi->getOrgInvoice(invoiceId: $invoiceId, organizationId: $organizationId);
    }

    /**
     * Lists invoices
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listInvoices(
        string $organizationId,
        ?string $filterStatus = null,
        ?string $filterType = null,
        ?string $filterOrderId = null,
        ?int $page = null
    ): ListOrgInvoices200Response {
        return $this->invoicesApi->listOrgInvoices(
            organizationId: $organizationId,
            filterStatus: $filterStatus,
            filterType: $filterType,
            filterOrderId: $filterOrderId,
            page: $page
        );
    }

    /**
     * Creates confirmation credentials for 3D-Secure
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createAuthorizationCredentials(
        string $organizationId,
        string $orderId
    ): CreateAuthorizationCredentials200Response {
        return $this->ordersApi->createAuthorizationCredentials(organizationId: $organizationId, orderId: $orderId);
    }

    /**
     * Downloads an invoice.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function downloadInvoice(string $token): string
    {
        return $this->ordersApi->downloadInvoice(token: $token);
    }

    /**
     * Gets order
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getOrder(string $organizationId, string $orderId, ?string $mode = null): Order
    {
        return $this->ordersApi->getOrgOrder(organizationId: $organizationId, orderId: $orderId, mode: $mode);
    }

    /**
     * Lists orders
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
     * Gets address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getAddress(string $organizationId): Address
    {
        return $this->profilesApi->getOrgAddress(organizationId: $organizationId);
    }

    /**
     * Gets profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProfile(string $organizationId): Profile
    {
        return $this->profilesApi->getOrgProfile(organizationId: $organizationId);
    }

    /**
     * Updates address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
        $address = new Address(
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
        );
        return $this->profilesApi->updateOrgAddress(organizationId: $organizationId, address: $address);
    }

    /**
     * Updates profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProfile(
        string $organizationId,
        ?string $defaultCatalog = null,
        ?string $projectOptionsUrl = null,
        ?string $companyName = null,
        ?string $vatNumber = null,
        ?string $billingContact = null,
    ): Profile {
        $updateOrgProfileRequest = new UpdateOrgProfileRequest(
            defaultCatalog: $defaultCatalog,
            projectOptionsUrl: $projectOptionsUrl,
            companyName: $companyName,
            vatNumber: $vatNumber,
            billingContact: $billingContact,
        );
        return $this->profilesApi->updateOrgProfile(
            organizationId: $organizationId,
            updateOrgProfileRequest: $updateOrgProfileRequest
        );
    }

    /**
     * Lists plan records
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
        $subscriptionId = null;
        if ($filterProjectId) {
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
     * Lists usage records
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listUsageRecords(
        string $organizationId,
        ?string $filterProjectId = null,
        ?string $filterUsageGroup = null,
        ?DateTime $filterStart = null,
        ?DateTime $filterStartedAt = null,
        ?int $page = null
    ): ListOrgUsageRecords200Response {
        $subscriptionId = null;
        if ($filterProjectId) {
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
     * Applies voucher
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function applyVoucher(string $organizationId, string $code): void
    {
        $applyOrgVoucherRequest = new ApplyOrgVoucherRequest(
            code: $code
        );
        $this->vouchersApi->applyOrgVoucher(
            organizationId: $organizationId,
            applyOrgVoucherRequest: $applyOrgVoucherRequest
        );
    }

    /**
     * Lists vouchers
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listVouchers(string $organizationId): Vouchers
    {
        return $this->vouchersApi->listOrgVouchers(organizationId: $organizationId);
    }

    /**
     * Get Organization Addons
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getAddons(string $organizationId): OrganizationAddonsObject
    {
        return $this->addOnsApi->getOrgAddons(organizationId: $organizationId);
    }

    /**
     * Updates Organization Addons
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateAddons(
        string $organizationId,
        ?string $userManagement = null,
        ?string $supportLevel = null,
    ): OrganizationAddonsObject {
        $updateOrgAddonsData = new UpdateOrgAddonsRequest(
            userManagement: $userManagement,
            supportLevel: $supportLevel
        );
        return $this->addOnsApi->updateOrgAddons(
            organizationId: $organizationId,
            updateOrgAddonsRequest: $updateOrgAddonsData
        );
    }
}
