<?php

use OpenAPI\Client\apisgen\InvoicesApi;
use OpenAPI\Client\apisgen\MFAApi;
use OpenAPI\Client\apisgen\OrdersApi;
use OpenAPI\Client\apisgen\OrganizationMembersApi;
use OpenAPI\Client\apisgen\OrganizationProjectsApi;
use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\apisgen\ProfilesApi;
use OpenAPI\Client\apisgen\RecordsApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use OpenAPI\Client\apisgen\VouchersApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\Model\Address;
use OpenAPI\Client\Model\ApplyOrgVoucherRequest;
use OpenAPI\Client\Model\CreateAuthorizationCredentials200Response;
use OpenAPI\Client\Model\CreateOrgRequest;
use OpenAPI\Client\Model\CreateOrgSubscriptionRequest;
use OpenAPI\Client\Model\Invoice;
use OpenAPI\Client\Model\ListOrgInvoices200Response;
use OpenAPI\Client\Model\ListOrgOrders200Response;
use OpenAPI\Client\Model\ListOrgPlanRecords200Response;
use OpenAPI\Client\Model\Order;
use OpenAPI\Client\Model\OrganizationMFAEnforcement;
use OpenAPI\Client\Model\Profile;
use OpenAPI\Client\Model\SendOrgMfaReminders200ResponseValue;
use OpenAPI\Client\Model\UpdateOrgProfileRequest;
use OpenAPI\Client\Model\UpdateOrgRequest;
use OpenAPI\Client\Model\UpdateOrgSubscriptionRequest;
use OpenAPI\Client\Model\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\OrganizationTask;
use OpenAPI\Client\Model\Organization;
use OpenAPI\Client\Model\OrganizationMember;
use OpenAPI\Client\Model\OrganizationProject;
use OpenAPI\Client\Model\Subscription;
use OpenAPI\Client\Model\EstimationObject;
use OpenAPI\Client\Model\SubscriptionCurrentUsageObject;
use OpenAPI\Client\Model\ListOrgs200Response;
use OpenAPI\Client\Model\ListUserOrgs200Response;
use OpenAPI\Client\Model\ListOrgMembers200Response;
use OpenAPI\Client\Model\ListTeams200Response;
use OpenAPI\Client\Model\ListOrgProjects200Response;
use OpenAPI\Client\Model\CreateOrgMemberRequest;
use OpenAPI\Client\Model\UpdateOrgMemberRequest;
use OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Core\Tasks\ProjectTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class OrganizationTaskTest extends TestCase
{
    protected $organizationTask;
    private const DEFAULT_UPSUN_PLAN = 'upsun/flexible';

    private readonly UpsunClient $clientMock;
    private readonly HeaderSelector $headerSelectorMock;
    private readonly OrganizationsApi $apiMock;
    private readonly OrganizationProjectsApi $projectsApiMock;
    private readonly OrganizationMembersApi $membersApiMock;
    private readonly SubscriptionsApi $subscriptionsApiMock;
    private readonly InvoicesApi $invoicesApiMock;
    private readonly MFAApi $mfaApiMock;
    private readonly OrdersApi $ordersApiMock;
    private readonly ProfilesApi $profilesApiMock;
    private readonly RecordsApi $recordsApiMock;
    private readonly VouchersApi $vouchersApiMock;

    private readonly UserTask $mockUserTask;
    private readonly ProjectTask $mockProjectTask;
    private readonly TeamTask $mockTeamTask;

    protected function setUp(): void
    {
        $this->headerSelectorMock = $this->createMock(HeaderSelector::class);
        $this->apiMock = $this->createMock(OrganizationsApi::class);
        $this->projectsApiMock = $this->createMock(OrganizationProjectsApi::class);
        $this->membersApiMock = $this->createMock(OrganizationMembersApi::class);
        $this->subscriptionsApiMock = $this->createMock(SubscriptionsApi::class);
        $this->invoicesApiMock = $this->createMock(InvoicesApi::class);
        $this->mfaApiMock = $this->createMock(MFAApi::class);
        $this->ordersApiMock = $this->createMock(OrdersApi::class);
        $this->profilesApiMock = $this->createMock(ProfilesApi::class);
        $this->recordsApiMock = $this->createMock(RecordsApi::class);
        $this->vouchersApiMock = $this->createMock(VouchersApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };

        $this->organizationTask = new class(
            $this->clientMock,
            $this->headerSelectorMock,
            $this->apiMock,
            $this->projectsApiMock,
            $this->membersApiMock,
            $this->subscriptionsApiMock,
            $this->invoicesApiMock,
            $this->mfaApiMock,
            $this->ordersApiMock,
            $this->profilesApiMock,
            $this->recordsApiMock,
            $this->vouchersApiMock,

        ) extends OrganizationTask {
            public function refreshToken(): void
            {
            }

            protected function updateOrgAddonsWithHttpInfo(
                $organizationId,
                ?array $update_org_request = [],
                ?string $contentType = 'application/json'
            ): array
            {
                return ['data', 200, []];
            }
        };

        $this->mockUserTask = $this->createMock(UserTask::class);
        $this->mockProjectTask = $this->createMock(ProjectTask::class);
        $this->mockTeamTask = $this->createMock(TeamTask::class);
        $this->clientMock->user = $this->mockUserTask;
        $this->clientMock->project = $this->mockProjectTask;
        $this->clientMock->team = $this->mockTeamTask;
    }

    public function testCreateOrganizationSuccess()
    {
        $params = [
            'owner_id' => '12345',
            'label' => 'test Org',
            'name' => 'test-org',
        ];

        $expectedResponse = $this->createMock(Organization::class);

        $this->apiMock->expects($this->once())
            ->method('createOrg')
            ->with(
                $this->isInstanceOf(CreateOrgRequest::class)
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->create($params);

        $this->assertSame($expectedResponse, $response);
    }

    public function testDeleteOrganization()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->delete('org_123');
    }

    public function testGetOrganizationSuccess()
    {
        $orgId = 'org_123';
        $expectedResponse = $this->createMock(Organization::class);

        $this->apiMock
            ->expects($this->once())
            ->method('getOrg')
            ->with($orgId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->get($orgId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testListOrganizations()
    {
        $list = $this->createMock(ListOrgs200Response::class);

        $this->apiMock
            ->expects($this->once())
            ->method('listOrgs')
            ->willReturn($list);

        $response = $this->organizationTask->list();
        $this->assertSame($list, $response);
    }

    public function testListUserOrganizations()
    {
        $list = $this->createMock(ListUserOrgs200Response::class);

        $this->apiMock
            ->expects($this->once())
            ->method('listUserOrgs')
            ->willReturn($list);

        $response = $this->organizationTask->listUserOrgs('user_123');
        $this->assertSame($list, $response);
    }

    public function testListCurrentUserOrganizations()
    {
        $list = $this->createMock(ListUserOrgs200Response::class);
        $user = $this->createMock(User::class);


        $this->mockUserTask
            ->expects($this->once())
            ->method('me')
            ->willReturn($user);

        $user->method('getId')->willReturn('user_123');

        $this->apiMock
            ->expects($this->once())
            ->method('listUserOrgs')
            ->with($user->getId())
            ->willReturn($list);

        $response = $this->organizationTask->listCurrentUserOrgs();
        $this->assertSame($list, $response);
    }

    public function testUpdateOrganization()
    {

        $orgId = 'project-123';

        $expectedResponse = $this->createMock(Organization::class);

        $this->apiMock
            ->expects($this->once())
            ->method('updateOrg')
            ->with(
                $this->equalTo($orgId),
                $this->isInstanceOf(UpdateOrgRequest::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->organizationTask->update($orgId, ['label' => 'updated Org']);

        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateMember()
    {
        $params = ['userId' => 'user_1'];

        $expectedResponse = $this->createMock(OrganizationMember::class);

        $this->membersApiMock->expects($this->once())
            ->method('createOrgMember')
            ->with(
                'org_123',
                $this->isInstanceOf(CreateOrgMemberRequest::class)
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->createMember('org_123', $params);
        $this->assertInstanceOf(OrganizationMember::class, $response);
    }

    public function testUpdateMember()
    {
        $params = ['role' => 'admin'];
        $expectedResponse = $this->createMock(OrganizationMember::class);

        $this->membersApiMock->expects($this->once())
            ->method('updateOrgMember')
            ->with(
                'org_123',
                'user_1',
                $this->isInstanceOf(UpdateOrgMemberRequest::class)
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->updateMember('org_123', 'user_1', $params);
        $this->assertInstanceOf(OrganizationMember::class, $response);
    }

    public function testGetMember()
    {
        $orgId = 'org_123';
        $userId = 'user_1';
        $expectedResponse = $this->createMock(OrganizationMember::class);

        $this->membersApiMock
            ->expects($this->once())
            ->method('getOrgMember')
            ->with($orgId, $userId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->getMember($orgId, $userId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testListMembers()
    {
        $orgId = 'org_123';
        $expectedResponse = $this->createMock(ListOrgMembers200Response::class);

        $this->membersApiMock
            ->expects($this->once())
            ->method('listOrgMembers')
            ->with($orgId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->listMembers($orgId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testDeleteMember()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->deleteMember('org_123', 'user_1');
    }

    public function testListTeams()
    {
        $orgId = 'org_123';
        $list = $this->createMock(ListTeams200Response::class);
        
        $this->mockTeamTask
            ->expects($this->once())
            ->method('list')
            ->with(['eq' => $orgId])
            ->willReturn($list);

        $response = $this->organizationTask->listTeams($orgId);
        $this->assertSame($list, $response);
    }

    public function testGetProject()
    {
        $orgId = 'org_123';
        $prjId = 'prj_1';
        $expectedResponse = $this->createMock(OrganizationProject::class);

        $this->projectsApiMock
            ->expects($this->once())
            ->method('getOrgProject')
            ->with($orgId, $prjId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->getProject($orgId, $prjId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testListProjects()
    {
        $orgId = 'org_123';
        $expectedResponse = $this->createMock(ListOrgProjects200Response::class);

        $this->projectsApiMock
            ->expects($this->once())
            ->method('listOrgProjects')
            ->with($orgId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->listProjects($orgId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testCanCreateProject()
    {
        $orgId = 'org_123';
        $expectedResponse = $this->createMock(CanCreateNewOrgSubscription200Response::class);

        $this->mockProjectTask
            ->expects($this->once())
            ->method('canCreate')
            ->with($orgId)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->canCreateProject($orgId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testCreateProject()
    {
        $orgId = 'org_1';
        $params = ['name' => 'New Project'];

        $expectedResponse = $this->createMock(Subscription::class);
        
        $this->mockProjectTask
            ->expects($this->once())
            ->method('create')
            ->with($orgId, $params)
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->createProject($orgId, $params);

        $this->assertSame($expectedResponse, $response);
    }

    public function testDeleteProject()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->deleteProject('org_123', 'proj_1');
    }

    public function testUpdateProject()
    {
        $orgId = 'org_1';
        $prjId = 'proj_1';
        $params = ['name' => 'Updated Project'];

        $expectedResponse = $this->createMock(Subscription::class);

        $this->subscriptionsApiMock->expects($this->once())
            ->method('updateOrgSubscription')
            ->with(
                $orgId,
                $prjId,
                $this->isInstanceOf(UpdateOrgSubscriptionRequest::class)
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->updateProject($orgId, $prjId, $params);

        $this->assertSame($expectedResponse, $response);
    }

    public function testEstimateNewProject()
    {
        $orgId = 'org_1';

        $expectedResponse = $this->createMock(EstimationObject::class);

        $this->subscriptionsApiMock->expects($this->once())
            ->method('estimateNewOrgSubscription')
            ->with(
                $orgId
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->estimateNewProject($orgId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testEstimateProject()
    {
        $orgId = 'org_1';
        $prjId = 'prj_1';

        $expectedResponse = $this->createMock(EstimationObject::class);

        $this->subscriptionsApiMock->expects($this->once())
            ->method('estimateOrgSubscription')
            ->with(
                $orgId,
                $prjId
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->estimateProject($orgId, $prjId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testGetProjectUsage()
    {
        $orgId = 'org_1';
        $prjId = 'prj_1';

        $expectedResponse = $this->createMock(SubscriptionCurrentUsageObject::class);

        $this->subscriptionsApiMock->expects($this->once())
            ->method('getOrgSubscriptionCurrentUsage')
            ->with(
                $orgId,
                $prjId
            )
            ->willReturn($expectedResponse);

        $response = $this->organizationTask->getProjectUsage($orgId, $prjId);

        $this->assertSame($expectedResponse, $response);
    }

    public function testDisableMfaEnforcement(): void
    {
        $orgId = 'org_1';

        $this->mfaApiMock
            ->expects($this->once())
            ->method('disableOrgMfaEnforcement')
            ->with(
                $this->equalTo($orgId),
            );

        $this->organizationTask->disableMfaEnforcement($orgId);
    }

    public function testGetInvoice(): void
    {
        $invoice = $this->createMock(Invoice::class);

        $this->invoicesApiMock->expects($this->once())
            ->method('getOrgInvoice')
            ->with('inv-001', 'org-123')
            ->willReturn($invoice);

        $result = $this->organizationTask->getInvoice('inv-001', 'org-123');
        $this->assertSame($invoice, $result);
    }

    public function testGetAddress(): void
    {
        $address = $this->createMock(Address::class);

        $this->profilesApiMock->expects($this->once())
            ->method('getOrgAddress')
            ->with('org-123')
            ->willReturn($address);

        $result = $this->organizationTask->getAddress('org-123');
        $this->assertSame($address, $result);
    }

    public function testListUsageRecords(): void
    {
        $response = $this->createMock(\OpenAPI\Client\Model\ListOrgUsageRecords200Response::class);

        $this->recordsApiMock->expects($this->once())
            ->method('listOrgUsageRecords')
            ->with('org-123')
            ->willReturn($response);

        $result = $this->organizationTask->listUsageRecords('org-123');
        $this->assertSame($response, $result);
    }

    public function testListVouchers(): void
    {
        $vouchers = $this->createMock(\OpenAPI\Client\Model\Vouchers::class);

        $this->vouchersApiMock->expects($this->once())
            ->method('listOrgVouchers')
            ->with('org-123')
            ->willReturn($vouchers);

        $result = $this->organizationTask->listVouchers('org-123');
        $this->assertSame($vouchers, $result);
    }

    public function testEnableMfaEnforcement(): void
    {
        $this->mfaApiMock->expects($this->once())
            ->method('enableOrgMfaEnforcement')
            ->with('org-123');

        $this->organizationTask->enableMfaEnforcement('org-123');
    }

    public function testGetMfaEnforcement(): void
    {
        $list = $this->createMock(OrganizationMFAEnforcement::class);
        $this->mfaApiMock->expects($this->once())
            ->method('getOrgMfaEnforcement')
            ->with('org-123')
            ->willReturn($list);

        $this->assertSame($list, $this->organizationTask->getMfaEnforcement('org-123'));
    }

    public function testSendMfaReminders(): void
    {
        $result = [$this->createMock(SendOrgMfaReminders200ResponseValue::class)];

        $this->mfaApiMock->expects($this->once())
            ->method('sendOrgMfaReminders')
            ->with('org-123')
            ->willReturn($result);

        $this->assertSame($result, $this->organizationTask->sendMfaReminders('org-123'));
    }

    public function testListInvoices(): void
    {
        $list = $this->createMock(ListOrgInvoices200Response::class);

        $this->invoicesApiMock->expects($this->once())
            ->method('listOrgInvoices')
            ->with('org-123')
            ->willReturn($list);

        $result = $this->organizationTask->listInvoices('org-123');
        $this->assertSame($list, $result);
    }

    public function testCreateAuthorizationCredentials(): void
    {
        $result = $this->createMock(CreateAuthorizationCredentials200Response::class);
        $this->ordersApiMock->expects($this->once())
            ->method('createAuthorizationCredentials')
            ->with('org-123', 'ord_1')
            ->willReturn($result);

        $this->assertSame($result, $this->organizationTask->createAuthorizationCredentials('org-123', 'ord_1'));
    }

    public function testDownloadInvoice(): void
    {
        $this->ordersApiMock->expects($this->once())
            ->method('downloadInvoice')
            ->with('token_123');

        $this->organizationTask->downloadInvoice('token_123');
    }

    public function testGetOrder(): void
    {
        $order = $this->createMock(Order::class);

        $this->ordersApiMock->expects($this->once())
            ->method('getOrgOrder')
            ->with('order-001', 'org-123')
            ->willReturn($order);

        $this->assertSame($order, $this->organizationTask->getOrder('order-001', 'org-123'));
    }

    public function testListOrders(): void
    {
        $list = $this->createMock(ListOrgOrders200Response::class);

        $this->ordersApiMock->expects($this->once())
            ->method('listOrgOrders')
            ->with('org-123')
            ->willReturn($list);

        $this->assertSame($list, $this->organizationTask->listOrders('org-123'));
    }

    public function testGetProfile(): void
    {
        $profile = $this->createMock(Profile::class);

        $this->profilesApiMock->expects($this->once())
            ->method('getOrgProfile')
            ->with('org-123')
            ->willReturn($profile);

        $this->assertSame($profile, $this->organizationTask->getProfile('org-123'));
    }

    public function testUpdateAddress(): void
    {
        $address = $this->createMock(Address::class);

        $this->profilesApiMock->expects($this->once())
            ->method('updateOrgAddress')
            ->with('org-123', ['street' => '21 jump street'])
            ->willReturn($address);;

        $this->assertSame($address, $this->organizationTask->updateAddress('org-123', ['street' => '21 jump street']));
    }

    public function testUpdateProfile(): void
    {
        $profile = $this->createMock(Profile::class);

        $this->profilesApiMock->expects($this->once())
            ->method('updateOrgProfile')
            ->with('org-123', $this->isInstanceOf(UpdateOrgProfileRequest::class))
            ->willReturn($profile);

        $this->assertSame($profile, $this->organizationTask->updateProfile('org-123', ['name' => 'Mister Bean']));
    }

    public function testListRecords(): void
    {
        $records = $this->createMock(ListOrgPlanRecords200Response::class);

        $this->recordsApiMock->expects($this->once())
            ->method('listOrgPlanRecords')
            ->with('org-123')
            ->willReturn($records);

        $this->assertSame($records, $this->organizationTask->listRecords('org-123'));
    }

    public function testApplyVoucher(): void
    {
        $this->vouchersApiMock->expects($this->once())
            ->method('applyOrgVoucher')
            ->with('org-123', $this->isInstanceOf(ApplyOrgVoucherRequest::class));

        $this->organizationTask->applyVoucher('org-123', ['voucher' => 'VOUCHER123']);
    }

    public function testUpdateAddons(): void
    {
        $result = $this->organizationTask->updateAddons('org-123');
        $this->assertSame('data', $result);
    }

}
