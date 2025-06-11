<?php

use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\apisgen\EnvironmentTypeApi;
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
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\CreateOrgRequest;
use OpenAPI\Client\Model\CreateOrgSubscriptionRequest;
use OpenAPI\Client\Model\EnvironmentOperationInput;
use OpenAPI\Client\Model\UpdateOrgRequest;
use OpenAPI\Client\Model\UpdateOrgSubscriptionRequest;
use OpenAPI\Client\Model\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Core\Tasks\DomainTask;
use Upsun\Core\Tasks\EnvironmentTask;
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
use Upsun\Core\Tasks\RouteTask;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\Core\Tasks\VariableTask;
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
        };

        $this->mockUserTask = $this->createMock(UserTask::class);
        $this->mockTeamTask = $this->createMock(TeamTask::class);
        $this->clientMock->user = $this->mockUserTask;
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
        $userId = 'user_1';
        $list = $this->createMock(ListTeams200Response::class);
        $user = $this->createMock(User::class);

        $user->expects($this->once())
            ->method('getId')
            ->willReturn('user_1');

        $this->mockUserTask
            ->expects($this->once())
            ->method('me')
            ->willReturn($user);

        $this->mockTeamTask
            ->expects($this->once())
            ->method('listUserTeams')
            ->with($userId)
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

        $this->subscriptionsApiMock
            ->expects($this->once())
            ->method('canCreateNewOrgSubscription')
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

        $this->subscriptionsApiMock->expects($this->once())
            ->method('createOrgSubscription')
            ->with(
                $orgId,
                $this->isInstanceOf(CreateOrgSubscriptionRequest::class)
            )
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

        $environmentId = 'env-456';
        $input = ['parent' => 'main'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('mergeEnvironment')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($environmentId),
                $this->isInstanceOf(EnvironmentMergeInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->merge($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }
}
