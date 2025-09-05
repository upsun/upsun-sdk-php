<?php

namespace Upsun\Core\Tasks;

use DateTime;
use Exception;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\ApiException;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MFAApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\VouchersApi;
use Upsun\HeaderSelector;
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
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\ListUserOrgs200Response;
use Upsun\Model\Order;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationMFAEnforcement;
use Upsun\Model\OrganizationProject;
use Upsun\Model\PlanRecords;
use Upsun\Model\Profile;
use Upsun\Model\SendOrgMfaRemindersRequest;
use Upsun\Model\StringFilter;
use Upsun\Model\Subscription;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\Team;
use Upsun\Model\UpdateOrgMemberRequest;
use Upsun\Model\UpdateOrgProfileRequest;
use Upsun\Model\UpdateOrgRequest;
use Upsun\Model\Usage;
use Upsun\Model\Vouchers;
use Upsun\ObjectSerializer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Upsun\UpsunClient;

class OrganizationTask extends TaskBase
{
    private const DEFAULT_UPSUN_PLAN = 'upsun/flexible';

    public function __construct(
        public UpsunClient $client,
        private readonly HeaderSelector $headerSelector,
        private readonly OrganizationsApi $api,
        private readonly OrganizationProjectsApi $projectsApi,
        private readonly OrganizationMembersApi $membersApi,
        private readonly SubscriptionsApi $subscriptionsApi,
        private readonly InvoicesApi $invoicesApi,
        private readonly MFAApi $mfaApi,
        private readonly OrdersApi $ordersApi,
        private readonly ProfilesApi $profilesApi,
        private readonly RecordsApi $recordsApi,
        private readonly VouchersApi $vouchersApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Creates organization
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     label: string,
     *     type?: string,
     *     ownerId?: string,
     *     name?: string,
     *     country?: string,
     * } $data
     */
    public function create(array $data): Organization
    {
        $create_org_request = new CreateOrgRequest(...$data);
        return $this->api->createOrg($create_org_request);
    }

    /**
     * Deletes organization
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $organizationId): void
    {
        $this->api->deleteOrg($organizationId);
    }

    /**
     * Gets organization
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $organizationId): Organization
    {
        return $this->api->getOrg($organizationId);
    }

    /**
     * Lists organizations
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        ?array $filterId = null,
        ?array $filterOwnerId = null,
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
    ): \Upsun\Model\ListOrgs200Response {
        return $this->api->listOrgs(
            new StringFilter($filterId),
            new StringFilter($filterOwnerId),
            new StringFilter($filterName),
            new StringFilter($filterLabel),
            new StringFilter($filterVendor),
            new ArrayFilter($filterCapabilities),
            new StringFilter($filterStatus),
            new DateTimeFilter($filterUpdatedAt),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Lists user organizations
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listUserOrgs(
        string $userId,
        ?array $filterId = null,
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
            new StringFilter($filterId),
            new StringFilter($filterVendor),
            new StringFilter($filterStatus),
            new DateTimeFilter($filterUpdatedAt),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Lists current user organizations
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
            $this->client->user->me()->getId(),
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $organizationId, ?array $updateOrgData = null): Organization
    {
        $update_org_request = new UpdateOrgRequest($updateOrgData);
        return $this->api->updateOrg($organizationId, $update_org_request);
    }

    /**
     * Gets Teams of the current organization (for current user)
     *
     * @throws Exception
     * @throws ApiException
     */
    public function listTeams(
        string $organizationId,
        ?string $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->client->team->list(
            ['eq' => $organizationId],
            [],
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
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProject(string $organizationId, string $projectId): OrganizationProject
    {
        return $this->projectsApi->getOrgProject($organizationId, $projectId);
    }


    /**
     * Lists projects from an organization
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
            new StringFilter($filterId),
            new StringFilter($filterTitle),
            new StringFilter($filterStatus),
            new DateTimeFilter($filterUpdatedAt),
            new DateTimeFilter($filterCreatedAt),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Creates organization member
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createMember(
        string $organizationId,
        string $userId,
        ?array $permissions = []
    ): OrganizationMember {
        $createOrgMemberRequest = new CreateOrgMemberRequest(
            userId: $userId,
            permissions: $permissions
        );
        return $this->membersApi->createOrgMember($organizationId, $createOrgMemberRequest);
    }

    /**
     * Updates organization member
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getMember(string $organizationId, string $userId): OrganizationMember
    {
        return $this->membersApi->getOrgMember($organizationId, $userId);
    }

    /**
     * Lists members of an organization
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
            new ArrayFilter($filterPermissions),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Delete an organization member
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteMember(string $organizationId, string $userId): void
    {
        $this->membersApi->deleteOrgMember($organizationId, $userId);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function canCreateProject(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->client->project->canCreate($organizationId);
    }

    /**
     * Creates a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createProject(string $organizationId, array $createProjectData): Subscription
    {
        return $this->client->project->create($organizationId, $createProjectData);
    }

    /**
     * Deletes a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProject(string $organizationId, string $projectId): void
    {
        $this->client->project->delete($organizationId, $projectId);
    }

    /**
     * Estimates the price of a new project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function estimateProject(
        string $organizationId,
        string $projectId,
        ?int $environments = null,
        ?int $storage = null,
        ?int $userLicenses = null,
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateProject(
        string $projectId,
        ?array $updateProjectData = null
    ): AcceptedResponse {
        return $this->client->project->update($projectId, $updateProjectData);
    }

    /**
     * Disables organization MFA enforcement
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function disableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->disableOrgMfaEnforcement($organizationId);
    }

    /**
     * Enables organization MFA enforcement
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function enableMfaEnforcement(string $organizationId): void
    {
        $this->mfaApi->enableOrgMfaEnforcement($organizationId);
    }

    /**
     * Gets organization MFA settings
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getMfaEnforcement(string $organizationId): OrganizationMFAEnforcement
    {
        return $this->mfaApi->getOrgMfaEnforcement($organizationId);
    }

    /**
     * Sends MFA reminders to organization members
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function sendMfaReminders(string $organizationId, ?array $userIds = null): array
    {
        $sendOrgMfaRemindersRequest = new SendOrgMfaRemindersRequest(userIds: $userIds);
        return $this->mfaApi->sendOrgMfaReminders($organizationId, $sendOrgMfaRemindersRequest);
    }

    /**
     * Gets invoice
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getInvoice(string $invoice_id, string $organizationId): Invoice
    {
        return $this->invoicesApi->getOrgInvoice($invoice_id, $organizationId);
    }

    /**
     * Lists invoices
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listInvoices(
        string $organizationId,
        ?string $filterStatus = null,
        ?string $filter_type = null,
        ?string $filter_order_id = null,
        ?int $page = null
    ): ListOrgInvoices200Response {
        return $this->invoicesApi->listOrgInvoices(
            $organizationId,
            $filterStatus,
            $filter_type,
            $filter_order_id,
            $page
        );
    }

    /**
     * Creates confirmation credentials for 3D-Secure
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function downloadInvoice(string $token): void
    {
        $this->ordersApi->downloadInvoice($token);
    }

    /**
     * Gets order
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getOrder(string $organizationId, string $orderId, ?string $mode = null): Order
    {
        return $this->ordersApi->getOrgOrder($organizationId, $orderId, $mode);
    }

    /**
     * Lists orders
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getAddress(string $organizationId): Address
    {
        return $this->profilesApi->getOrgAddress($organizationId);
    }

    /**
     * Gets profile
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProfile(string $organizationId): Profile
    {
        return $this->profilesApi->getOrgProfile($organizationId);
    }

    /**
     * Updates address
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array|null{
     *     defaultCatalog?: string,
     *     projectOptionsUrl?: string,
     *     securityContact?: string,
     *     companyName?: string,
     *     vatNumber?: string,
     *     billingContact?: string,
     * } $data
     */
    public function updateProfile(string $organizationId, ?array $data = null,): Profile
    {
        $update_org_profile_request = $data ? new UpdateOrgProfileRequest(
            defaultCatalog: $data['defaultCatalog'],
            projectOptionsUrl: $data['projectOptionsUrl'],
            securityContact: $data['securityContact'],
            companyName: $data['companyName'],
            vatNumber: $data['vatNumber'],
            billingContact: $data['billingContact'],
        ) : null;
        return $this->profilesApi->updateOrgProfile($organizationId, $update_org_profile_request);
    }

    /**
     * Lists plan records
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listVouchers(string $organizationId): Vouchers
    {
        return $this->vouchersApi->listOrgVouchers($organizationId);
    }

    /**
     * Activate addons userManagement on organization $organizationId
     *
     * Equivalent to
     * `upsun api:curl -X PATCH --json '{"user_management":"standard"}' 'api/organizations/ORGANIZATION_ID/addons' | jq`
     * Missing from the openapi config
     *
     * @throws ApiException|Exception
     * @throws RuntimeException
     * @throws ClientExceptionInterface
     */
    public function updateAddons(string $organizationId): mixed
    {
        $user_management_addons = ['user_management' => "standard"];
        list($response) = $this->updateOrgAddonsWithHttpInfo($organizationId, $user_management_addons);
        return $response;
    }

    /**
     * @template T
     * @param class-string<T>|string $dataType Fully-qualified class name, or scalar type like "string", "array"
     * @return T
     *
     * @throws ApiException
     */
    protected function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $request,
                        $response
                    );
                }
            }
        }

        return ObjectSerializer::deserialize($content, $dataType, []);
    }

    /**
     * Updates organization addons
     *
     * note: missing from OrganizationAPI
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception|ClientExceptionInterface on non-2xx response or if the
     *  response body is not in the expected format
     */
    protected function updateOrgAddonsWithHttpInfo(
        $organizationId,
        ?array $update_org_request = [],
        ?string $contentType = 'application/json'
    ): array {
        $request = $this->updateOrgAddonsRequest($organizationId, $update_org_request, $contentType);
        try {
            $response = $this->client->apiClient->sendRequest($request);

            return $this->handleResponseWithDataType(
                '\Upsun\Model\Organization',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            throw $e;
        }
    }

    /**
     * Create request for operation 'updateOrg'
     * note: missing from OrganizationAPI
     *
     * @throws InvalidArgumentException
     */
    public function updateOrgAddonsRequest(
        $organizationId,
        ?array $update_org_request = [],
        ?string $contentType = 'application/json'
    ): Request {
        // verify the required parameter 'organization_id' is set
        if ($organizationId === null || (is_array($organizationId) && count($organizationId) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $organizationId when calling updateOrgAddons'
            );
        }

        $resourcePath = '/organizations/{organization_id}/addons';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($organizationId !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organizationId),
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
                try {
                    $httpBody = json_encode(
                        ObjectSerializer::sanitizeForSerialization($update_org_request),
                        JSON_THROW_ON_ERROR
                    );
                } catch (JsonException $e) {
                    throw new \RuntimeException(
                        'Failed to encode request body to JSON: ' . $e->getMessage(),
                        0,
                        $e
                    );
                }
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
                try {
                    $httpBody = json_encode($formParams, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    throw new \RuntimeException(
                        'Failed to encode form parameters to JSON: ' . $e->getMessage(),
                        0,
                        $e
                    );
                }
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
