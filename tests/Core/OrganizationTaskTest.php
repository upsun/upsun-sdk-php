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
use PHPUnit\Framework\TestCase;
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
use Upsun\Core\Tasks\VariableTask;
use Upsun\UpsunClient;

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

    protected function setUp(): void
    {
        $this->mockEnvironmentApi = $this->createMock(EnvironmentApi::class);
        $this->mockEnvironmentTypeApi = $this->createMock(EnvironmentTypeApi::class);
        $this->mockDeploymentApi = $this->createMock(DeploymentApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public \Psr\Http\Client\ClientInterface $apiClient;
            public Configuration $apiConfig;

            public function __construct()
            {
            }
        };

        $this->environmentTask = new class(
            $this->clientMock,
            $this->mockEnvironmentApi,
            $this->mockEnvironmentTypeApi,
            $this->mockDeploymentApi
        ) extends EnvironmentTask {
            public function refreshToken(): void
            {
            }
        };

        // Mock des tâches
        $this->mockActivityTask = $this->createMock(ActivityTask::class);
        $this->mockBackupTask = $this->createMock(BackupTask::class);
        $this->mockVariableTask = $this->createMock(VariableTask::class);
        $this->mockRouteTask = $this->createMock(RouteTask::class);
        $this->mockDomainTask = $this->createMock(DomainTask::class);
        $this->mockSourceOperationTask = $this->createMock(SourceOperationTask::class);

        // Configuration des propriétés du client
        $this->clientMock->activity = $this->mockActivityTask;
        $this->clientMock->backup = $this->mockBackupTask;
        $this->clientMock->variables = $this->mockVariableTask;
        $this->clientMock->route = $this->mockRouteTask;
        $this->clientMock->domain = $this->mockDomainTask;
        $this->clientMock->sourceOperation = $this->mockSourceOperationTask;
    }

//    protected function setUp(): void
//    {
//        parent::setUp();
//        $this->organizationTask = App::make(OrganizationTask::class);
//    }

    public function testCreateOrganizationSuccess()
    {
        $response = $this->organizationTask->create(['name' => 'Test Org']);
        $this->assertInstanceOf(Organization::class, $response);
    }

    public function testDeleteOrganization()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->delete('org_123');
    }

    public function testGetOrganizationSuccess()
    {
        $response = $this->organizationTask->get('org_123');
        $this->assertInstanceOf(Organization::class, $response);
    }

    public function testListOrganizations()
    {
        $response = $this->organizationTask->list();
        $this->assertInstanceOf(ListOrgs200Response::class, $response);
    }

    public function testListUserOrganizations()
    {
        $response = $this->organizationTask->listUserOrgs('user_123');
        $this->assertInstanceOf(ListUserOrgs200Response::class, $response);
    }

    public function testListCurrentUserOrganizations()
    {
        $response = $this->organizationTask->listCurrentUserOrgs();
        $this->assertInstanceOf(ListUserOrgs200Response::class, $response);
    }

    public function testUpdateOrganization()
    {
        $response = $this->organizationTask->update('org_123', ['name' => 'Updated']);
        $this->assertInstanceOf(Organization::class, $response);
    }

    public function testCreateMember()
    {
        $request = new CreateOrgMemberRequest(['userId' => 'user_1']);
        $response = $this->organizationTask->createMember('org_123', $request);
        $this->assertInstanceOf(OrganizationMember::class, $response);
    }

    public function testUpdateMember()
    {
        $request = new UpdateOrgMemberRequest(['role' => 'admin']);
        $response = $this->organizationTask->updateMember('org_123', 'user_1', $request);
        $this->assertInstanceOf(OrganizationMember::class, $response);
    }

    public function testGetMember()
    {
        $response = $this->organizationTask->getMember('org_123', 'user_1');
        $this->assertInstanceOf(OrganizationMember::class, $response);
    }

    public function testListMembers()
    {
        $response = $this->organizationTask->listMembers('org_123');
        $this->assertInstanceOf(ListOrgMembers200Response::class, $response);
    }

    public function testDeleteMember()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->deleteMember('org_123', 'user_1');
    }

    public function testListTeams()
    {
        $response = $this->organizationTask->listTeams('org_123');
        $this->assertInstanceOf(ListTeams200Response::class, $response);
    }

    public function testGetProject()
    {
        $response = $this->organizationTask->getProject('org_123', 'proj_1');
        $this->assertInstanceOf(OrganizationProject::class, $response);
    }

    public function testListProjects()
    {
        $response = $this->organizationTask->listProjects('org_123');
        $this->assertInstanceOf(ListOrgProjects200Response::class, $response);
    }

    public function testCanCreateProject()
    {
        $response = $this->organizationTask->canCreateProject('org_123');
        $this->assertInstanceOf(CanCreateNewOrgSubscription200Response::class, $response);
    }

    public function testCreateProject()
    {
        $response = $this->organizationTask->createProject('org_123', ['name' => 'New Project']);
        $this->assertInstanceOf(Subscription::class, $response);
    }

    public function testDeleteProject()
    {
        $this->expectNotToPerformAssertions();
        $this->organizationTask->deleteProject('org_123', 'proj_1');
    }

    public function testUpdateProject()
    {
        $response = $this->organizationTask->updateProject('org_123', 'proj_1', ['name' => 'Updated Project']);
        $this->assertInstanceOf(Subscription::class, $response);
    }

    public function testEstimateNewProject()
    {
        $response = $this->organizationTask->estimateNewProject('org_123');
        $this->assertInstanceOf(EstimationObject::class, $response);
    }

    public function testEstimateProject()
    {
        $response = $this->organizationTask->estimateProject('org_123', 'proj_1');
        $this->assertInstanceOf(EstimationObject::class, $response);
    }

    public function testGetProjectUsage()
    {
        $response = $this->organizationTask->getProjectUsage('org_123', 'proj_1');
        $this->assertInstanceOf(SubscriptionCurrentUsageObject::class, $response);
    }
}
