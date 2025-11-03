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
     * @param array{
     *     label: string,
     *     type?: string,
     *     ownerId?: string,
     *     name?: string,
     *     country?: string,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(array $data): Organization
    {
        $createOrgRequest = new CreateOrgRequest(...$data);
        return $this->api->createOrg($createOrgRequest);
    }

    /**
     * Deletes organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $organizationId): void
    {
        $this->api->deleteOrg($organizationId);
    }

    /**
     * Gets organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $organizationId): Organization
    {
        return $this->api->getOrg($organizationId);
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
            new StringFilter(...$this->normalizeFilter($filterId)),
            new StringFilter(...$this->normalizeFilter($filterType)),
            new StringFilter(...$this->normalizeFilter($filterOwnerId)),
            new StringFilter(...$this->normalizeFilter($filterName)),
            new StringFilter(...$this->normalizeFilter($filterLabel)),
            new StringFilter(...$this->normalizeFilter($filterVendor)),
            new ArrayFilter(...$this->normalizeFilter($filterCapabilities)),
            new StringFilter(...$this->normalizeFilter($filterStatus)),
            new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
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
            $userId,
            new StringFilter(...$this->normalizeFilter($filterId)),
            new StringFilter(...$this->normalizeFilter($filterType)),
            new StringFilter(...$this->normalizeFilter($filterVendor)),
            new StringFilter(...$this->normalizeFilter($filterStatus)),
            new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
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
            $this->client->users->me()->getId(),
            $filterId,
            $filterVendor,
            $filterStatus,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Updates an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(string $organizationId, ?array $updateOrgData = null): Organization
    {
        $updateOrgRequest = new UpdateOrgRequest(...$updateOrgData);
        return $this->api->updateOrg($organizationId, $updateOrgRequest);
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
            $organizationId ? ['eq' => $organizationId] : null,
            null,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
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
        return $this->projectsApi->getOrgProject($organizationId, $projectId);
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
            $filterId ? new StringFilter(...$this->normalizeFilter($filterId)) : null,
            $filterTitle ? new StringFilter(...$this->normalizeFilter($filterTitle)) : null,
            $filterStatus ? new StringFilter(...$this->normalizeFilter($filterStatus)) : null,
            $filterUpdatedAt ? new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)) : null,
            $filterCreatedAt ? new DateTimeFilter(...$this->normalizeFilter($filterCreatedAt)) : null,
            $pageSize ?? null,
            $pageBefore ?? null,
            $pageAfter ?? null,
            $sort ?? null
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
        return $this->membersApi->createOrgMember($organizationId, $createOrgMemberRequest);
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
        return $this->membersApi->updateOrgMember($organizationId, $userId, $updateOrgMemberRequest);
    }

    /**
     * Gets organization member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getMember(string $organizationId, string $userId): OrganizationMember
    {
        return $this->membersApi->getOrgMember($organizationId, $userId);
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
            $organizationId,
            $filterPermissions ? new ArrayFilter(...$this->normalizeFilter($filterPermissions)) : null,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
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
        $this->membersApi->deleteOrgMember($organizationId, $userId);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function canCreateProject(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->client->projects->canCreate($organizationId);
    }

    /**
     * Creates a project
     *
     * @param array{
     *     projectRegion: string,
     *     plan?: string,
     *     projectTitle?: string,
     *     optionsUrl?: string,
     *     defaultBranch?: string,
     *     environments?: int,
     *     storage?: int
     * } $createProjectData
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProject(string $organizationId, array $createProjectData): Subscription
    {
        return $this->client->projects->create($organizationId, $createProjectData);
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
            $organizationId,
            self::DEFAULT_UPSUN_PLAN,
            $environments,
            $storage,
            $userLicenses,
            $format
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
        return $this->subscriptionsApi->estimateOrgSubscription(
            $organizationId,
            $projectId,
            self::DEFAULT_UPSUN_PLAN,
            $environments,
            $storage,
            $userLicenses,
            $format
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
        return $this->subscriptionsApi->getOrgSubscriptionCurrentUsage(
            $organizationId,
            $projectId,
            $usageGroups,
            $includeNotCharged
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
        ?array $updateProjectData = null
    ): AcceptedResponse {
        return $this->client->projects->update($projectId, $updateProjectData);
    }

    /**
     * Disables organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function disableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->disableOrgMfaEnforcement($organizationId);
    }

    /**
     * Enables organization MFA enforcement
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function enableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->enableOrgMfaEnforcement($organizationId);
    }

    /**
     * Gets organization MFA settings
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getMfaEnforcement(string $organizationId): OrganizationMFAEnforcement
    {
        return $this->mfaApi->getOrgMfaEnforcement($organizationId);
    }

    /**
     * Sends MFA reminders to organization members
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return SendOrgMfaReminders200ResponseValue[]
     */
    public function sendMfaReminders(string $organizationId, ?array $userIds = null): array
    {
        $sendOrgMfaRemindersRequest = new SendOrgMfaRemindersRequest(userIds: $userIds);
        return $this->mfaApi->sendOrgMfaReminders($organizationId, $sendOrgMfaRemindersRequest);
    }

    /**
     * Gets invoice
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getInvoice(string $invoiceId, string $organizationId): Invoice
    {
        return $this->invoicesApi->getOrgInvoice($invoiceId, $organizationId);
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
            $organizationId,
            $filterStatus,
            $filterType,
            $filterOrderId,
            $page
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
        return $this->ordersApi->createAuthorizationCredentials($organizationId, $orderId);
    }

    /**
     * Downloads an invoice.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function downloadInvoice(string $token): string
    {
        return $this->ordersApi->downloadInvoice($token);
    }

    /**
     * Gets order
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getOrder(string $organizationId, string $orderId, ?string $mode = null): Order
    {
        return $this->ordersApi->getOrgOrder($organizationId, $orderId, $mode);
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
        return $this->ordersApi->listOrgOrders($organizationId, $filterStatus, $filterTotal, $page, $mode);
    }

    /**
     * Gets address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getAddress(string $organizationId): Address
    {
        return $this->profilesApi->getOrgAddress($organizationId);
    }

    /**
     * Gets profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProfile(string $organizationId): Profile
    {
        return $this->profilesApi->getOrgProfile($organizationId);
    }

    /**
     * Updates address
     *
     * @param array|null{
     *     country?: string,
     *     nameLine?: string,
     *     premise?: string,
     *     subPremise?: string,
     *     thoroughfare?: string,
     *     administrativeArea?: string,
     *     subAdministrativeArea?: string,
     *     locality?: string,
     *     dependentLocality?: string,
     *     postalCode?: string,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateAddress(string $organizationId, ?array $data = null): Address
    {
        $address = $data ? new Address(
            country: $data['country'],
            nameLine: $data['nameLine'],
            premise: $data['premise'],
            subPremise: $data['subPremise'],
            thoroughfare: $data['thoroughfare'],
            administrativeArea: $data['administrativeArea'],
            subAdministrativeArea: $data['subAdministrativeArea'],
            locality: $data['locality'],
            dependentLocality: $data['dependentLocality'],
            postalCode: $data['postalCode'],
        ) : null;
        return $this->profilesApi->updateOrgAddress($organizationId, $address);
    }

    /**
     * Updates profile
     *
     * @param array|null{
     *     defaultCatalog?: string,
     *     projectOptionsUrl?: string,
     *     securityContact?: string,
     *     companyName?: string,
     *     vatNumber?: string,
     *     billingContact?: string,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProfile(string $organizationId, ?array $data = null): Profile
    {
        $updateOrgProfileRequest = $data ? new UpdateOrgProfileRequest(
            defaultCatalog: $data['defaultCatalog'],
            projectOptionsUrl: $data['projectOptionsUrl'],
            securityContact: $data['securityContact'],
            companyName: $data['companyName'],
            vatNumber: $data['vatNumber'],
            billingContact: $data['billingContact'],
        ) : null;
        return $this->profilesApi->updateOrgProfile($organizationId, $updateOrgProfileRequest);
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
        return $this->recordsApi->listOrgPlanRecords(
            $organizationId,
            $filterProjectId,
            $filterPlan,
            $filterStatus,
            $filterStart,
            $filterEnd,
            $filterStartedAt,
            $filterEndedAt,
            $page
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
        return $this->recordsApi->listOrgUsageRecords(
            $organizationId,
            $filterProjectId,
            $filterUsageGroup,
            $filterStart,
            $filterStartedAt,
            $page
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
        $this->vouchersApi->applyOrgVoucher($organizationId, $applyOrgVoucherRequest);
    }

    /**
     * Lists vouchers
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listVouchers(string $organizationId): Vouchers
    {
        return $this->vouchersApi->listOrgVouchers($organizationId);
    }


    /**
     * Get Organization Addons
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getAddons(string $organizationId): OrganizationAddonsObject
    {
        return $this->addOnsApi->getOrgAddons($organizationId);
    }

    /**
     * Updates Organization Addons
     *
     * @param array{
     *     userManagement?: string,
     *     supportLevel?: string,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateAddons(string $organizationId, array $data): OrganizationAddonsObject
    {
        $updateOrgAddonsData = new UpdateOrgAddonsRequest(...$data);
        return $this->addOnsApi->updateOrgAddons($organizationId, $updateOrgAddonsData);
    }
}
