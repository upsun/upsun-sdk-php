<?php

namespace Tests\Upsun\Core\Tasks;

use Nyholm\Psr7\Request;
use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentTargetApi;
use OpenAPI\Client\apisgen\OrganizationProjectsApi;
use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\ProjectSettingsApi;
use OpenAPI\Client\apisgen\RepositoryApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use OpenAPI\Client\apisgen\SystemInformationApi;
use OpenAPI\Client\apisgen\ThirdPartyIntegrationsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\Blob;
use OpenAPI\Client\Model\Certificate;
use OpenAPI\Client\Model\Commit;
use OpenAPI\Client\Model\CreateOrgSubscriptionRequest;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\DeploymentTarget;
use OpenAPI\Client\Model\DeploymentTargetCreateInput;
use OpenAPI\Client\Model\DeploymentTargetPatch;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\Integration;
use OpenAPI\Client\Model\IntegrationCreateInput;
use OpenAPI\Client\Model\IntegrationPatch;
use OpenAPI\Client\Model\ListProjectUserAccess200Response;
use OpenAPI\Client\Model\ListTeamProjectAccess200Response;
use OpenAPI\Client\Model\OrganizationProject;
use OpenAPI\Client\Model\Project;
use OpenAPI\Client\Model\ProjectCapabilities;
use OpenAPI\Client\Model\ProjectInvitation;
use OpenAPI\Client\Model\ProjectPatch;
use OpenAPI\Client\Model\ProjectSettings;
use OpenAPI\Client\Model\ProjectSettingsPatch;
use OpenAPI\Client\Model\Ref;
use OpenAPI\Client\Model\Subscription;
use OpenAPI\Client\Model\SystemInformation;
use OpenAPI\Client\Model\TeamProjectAccess;
use OpenAPI\Client\Model\Tree;
use OpenAPI\Client\Model\UserProjectAccess;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\Core\Tasks\ApplicationTask;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Core\Tasks\CertificateTask;
use Upsun\Core\Tasks\DomainTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\Core\Tasks\InvitationTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountTask;
use Upsun\Core\Tasks\OperationTask;
use Upsun\Core\Tasks\OrganizationTask;
use Upsun\Core\Tasks\ProjectTask;
use Upsun\Core\Tasks\RegionTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RouteTask;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\Core\Tasks\SupportTicketTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\Core\Tasks\VariableTask;
use Upsun\Core\Tasks\WorkerTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class ProjectTaskTest extends TestCase
{
    private $client;
    private readonly ProjectApi $projectApi;
    private readonly ProjectSettingsApi $settingsApi;
    private readonly DeploymentTargetApi $deploymentTargetApi;
    
    public readonly OrganizationProjectsApi $organizationProjectsApi;
    private readonly RepositoryApi $repositoryApi;
    private readonly SystemInformationApi $systemInfoApi;
    private readonly ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi;
    protected $projectTask;
    
    private readonly InvitationTask $invitationTask;
    
    private readonly VariableTask $variableTask;

    public readonly ActivityTask $activityTask;
    public readonly ApplicationTask $applicationTask;
    public readonly BackupTask $backupTask;
    public readonly CertificateTask $certificateTask;
    public readonly DomainTask $domainTask;
    public readonly EnvironmentTask $environmentTask;
    public readonly MetricsTask $metricsTask;
    public readonly MountTask $mountTask;
    public readonly OperationTask $operationTask;
    public readonly OrganizationTask $organizationTask;
    public readonly RegionTask $regionTask;
    public readonly ResourcesTask $resourceTask;
    public readonly RouteTask $routeTask;
    public readonly SourceOperationTask $sourceOperationTask;
    public readonly TeamTask $teamTask;
    public readonly SupportTicketTask $supportTicketTask;
    public readonly SubscriptionsApi $subscriptionsApi;
    public readonly UserTask $userTask;
    public readonly WorkerTask $workerTask;
    
    protected function setUp(): void
    {
        $this->projectApi = $this->createMock(ProjectApi::class);
        $this->settingsApi = $this->createMock(ProjectSettingsApi::class);
        $this->deploymentTargetApi = $this->createMock(DeploymentTargetApi::class);
        $this->repositoryApi = $this->createMock(RepositoryApi::class);
        $this->systemInfoApi = $this->createMock(SystemInformationApi::class);
        $this->thirdPartyIntegrationsApi = $this->createMock(ThirdPartyIntegrationsApi::class);
        $this->subscriptionsApi = $this->createMock(SubscriptionsApi::class);
        $this->organizationProjectsApi = $this->createMock(OrganizationProjectsApi::class);

        $this->client = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->projectTask = new class(
            $this->client,
            $this->projectApi,
            $this->settingsApi,
            $this->deploymentTargetApi,
            $this->repositoryApi,
            $this->systemInfoApi,
            $this->thirdPartyIntegrationsApi,
            $this->subscriptionsApi,
            $this->organizationProjectsApi
        ) extends ProjectTask {
            public function refreshToken(): void
            {
            }
        };

        $this->invitationTask = $this->createMock(InvitationTask::class);
        $this->variableTask = $this->createMock(VariableTask::class);
        $this->activityTask = $this->createMock(ActivityTask::class);
        $this->applicationTask = $this->createMock(ApplicationTask::class);
        $this->backupTask = $this->createMock(BackupTask::class);
        $this->certificateTask = $this->createMock(CertificateTask::class);
        $this->domainTask = $this->createMock(DomainTask::class);
        $this->environmentTask = $this->createMock(EnvironmentTask::class);
        $this->metricsTask = $this->createMock(MetricsTask::class);
        $this->mountTask = $this->createMock(MountTask::class);
        $this->operationTask = $this->createMock(OperationTask::class);
        $this->organizationTask = $this->createMock(OrganizationTask::class);
        $this->regionTask = $this->createMock(RegionTask::class);
        $this->resourceTask = $this->createMock(ResourcesTask::class);
        $this->routeTask = $this->createMock(RouteTask::class);
        $this->sourceOperationTask = $this->createMock(SourceOperationTask::class);
        $this->teamTask = $this->createMock(TeamTask::class);
        $this->supportTicketTask = $this->createMock(SupportTicketTask::class);
        $this->userTask = $this->createMock(UserTask::class);
        $this->workerTask = $this->createMock(WorkerTask::class);
        
        $this->client->invitations = $this->invitationTask;
        $this->client->variables = $this->variableTask;
        $this->client->activity = $this->activityTask;
        $this->client->application = $this->applicationTask;
        $this->client->backup = $this->backupTask;
        $this->client->certificate = $this->certificateTask;
        $this->client->domain = $this->domainTask;
        $this->client->environment = $this->environmentTask;
        $this->client->metrics = $this->metricsTask;
        $this->client->mount = $this->mountTask;
        $this->client->operation = $this->operationTask;
        $this->client->organization = $this->organizationTask;
        $this->client->region = $this->regionTask;
        $this->client->resource = $this->resourceTask;
        $this->client->route = $this->routeTask;
        $this->client->sourceOperation = $this->sourceOperationTask;
        $this->client->team = $this->teamTask;
        $this->client->supportTicket = $this->supportTicketTask;
        $this->client->user = $this->userTask;
        $this->client->worker = $this->workerTask;
    }

    public function testDelete()
    {
        $projectId = 'test-project';
        $expectedResponse = new AcceptedResponse();

        $this->projectApi->expects($this->once())
            ->method('deleteProjects')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->delete($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGet()
    {
        $orgId = 'test-org';
        $prjId = 'test-project';
        $expectedProject = $this->createMock(Project::class);
        $expectedProject->method('getOrganization')->willReturn($orgId);
        $expectedOrgProject = new OrganizationProject();

        $this->projectApi->expects($this->once())
            ->method('getProjects')
            ->with($prjId)
            ->willReturn($expectedProject);
        
        $this->organizationProjectsApi->expects($this->once())
            ->method('getOrgProject')
            ->with($orgId, $prjId)
            ->willReturn($expectedOrgProject);

        $result = $this->projectTask->get($prjId);
        $this->assertSame($expectedOrgProject, $result);
    }

    public function testGetCapabilities()
    {
        $projectId = 'test-project';
        $expectedResponse = new ProjectCapabilities();

        $this->projectApi->expects($this->once())
            ->method('getProjectsCapabilities')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getCapabilities($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdate()
    {
        $projectId = 'test-project';
        $projectData = ['title' => 'Updated Project'];
        $expectedResponse = new AcceptedResponse();

        $this->projectApi->expects($this->once())
            ->method('updateProjects')
            ->with($projectId, $this->isInstanceOf(ProjectPatch::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->update($projectId, $projectData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCancelInvite()
    {
        $projectId = 'test-project';
        $invitationId = 'invite-123';

        $this->invitationTask->expects($this->once())
            ->method('cancelProjectInvite')
            ->with($projectId, $invitationId);

        $this->projectTask->cancelInvite($projectId, $invitationId);
    }

    public function testCreateInvite()
    {
        $projectId = 'test-project';
        $expectedResponse = $this->createMock(ProjectInvitation::class);

        $this->invitationTask
            ->method('createProjectInvite')
            ->with(
                $projectId,
                ['email' => 'test@example.com']
            )
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createInvite($projectId, ['email' => 'test@example.com']);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListInvites()
    {
        $projectId = 'test-project';
        $filterState = ['active'];
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';
        $expectedResponse = [$this->createMock(ProjectInvitation::class)];

        $this->invitationTask->expects($this->once())
            ->method('listProjectInvites')
            ->with($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listInvites($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetSettings()
    {
        $projectId = 'test-project';
        $expectedResponse = new ProjectSettings();

        $this->settingsApi->expects($this->once())
            ->method('getProjectsSettings')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getSettings($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateSettings()
    {
        $projectId = 'test-project';
        $settingsData = ['timezone' => 'UTC'];
        $expectedResponse = new AcceptedResponse();

        $this->settingsApi->expects($this->once())
            ->method('updateProjectsSettings')
            ->with($projectId, $this->isInstanceOf(ProjectSettingsPatch::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateSettings($projectId, $settingsData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateVariable()
    {
        $projectId = 'test-project';
        $variableData = ['name' => 'VAR', 'value' => 'value'];
        $expectedResponse = new AcceptedResponse();

        $this->variableTask->expects($this->once())
            ->method('createProjectVariable')
            ->with($projectId, $variableData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createVariable($projectId, $variableData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';
        $expectedResponse = new AcceptedResponse();

        $this->variableTask->expects($this->once())
            ->method('deleteProjectVariable')
            ->with($projectId, $variableId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->deleteVariable($projectId, $variableId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListVariables()
    {
        $projectId = 'test-project';
        $expectedResponse = [['name' => 'VAR1', 'value' => 'value1']];

        $this->variableTask->expects($this->once())
            ->method('listProjectVariables')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listVariables($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';
        $variableData = ['value' => 'new-value'];
        $expectedResponse = new AcceptedResponse();

        $this->variableTask->expects($this->once())
            ->method('updateProjectVariable')
            ->with($projectId, $variableId, $variableData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateVariable($projectId, $variableId, $variableData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCancelActivity()
    {
        $projectId = 'test-project';
        $activityId = 'activity-123';
        $expectedResponse = new AcceptedResponse();

        $this->activityTask->expects($this->once())
            ->method('cancel')
            ->with($projectId, $activityId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->cancelActivity($projectId, $activityId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetActivity()
    {
        $projectId = 'test-project';
        $activityId = 'activity-123';
        $expectedResponse = new Activity();

        $this->activityTask->expects($this->once())
            ->method('get')
            ->with($projectId, $activityId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getActivity($projectId, $activityId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListActivities()
    {
        $projectId = 'test-project';
        $expectedResponse = [new Activity(), new Activity()];

        $this->activityTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listActivities($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateDeployment()
    {
        $projectId = 'test-project';
        $deploymentData = ['name' => 'production'];
        $expectedResponse = new AcceptedResponse();

        $this->deploymentTargetApi->expects($this->once())
            ->method('createProjectsDeployments')
            ->with($projectId, $this->isInstanceOf(DeploymentTargetCreateInput::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createDeployment($projectId, $deploymentData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $expectedResponse = new AcceptedResponse();

        $this->deploymentTargetApi->expects($this->once())
            ->method('deleteProjectsDeployments')
            ->with($projectId, $deploymentId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->deleteDeployment($projectId, $deploymentId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $expectedResponse = new DeploymentTarget();

        $this->deploymentTargetApi->expects($this->once())
            ->method('getProjectsDeployments')
            ->with($projectId, $deploymentId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getDeployment($projectId, $deploymentId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListDeployments()
    {
        $projectId = 'test-project';
        $expectedResponse = [new DeploymentTarget(), new DeploymentTarget()];

        $this->deploymentTargetApi->expects($this->once())
            ->method('listProjectsDeployments')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listDeployments($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $deploymentData = ['name' => 'staging'];
        $expectedResponse = new AcceptedResponse();

        $this->deploymentTargetApi->expects($this->once())
            ->method('updateProjectsDeployments')
            ->with($projectId, $deploymentId, $this->isInstanceOf(DeploymentTargetPatch::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateDeployment($projectId, $deploymentId, $deploymentData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetGitBlob()
    {
        $projectId = 'test-project';
        $blobId = 'blob-123';
        $expectedResponse = new Blob();

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitBlobs')
            ->with($projectId, $blobId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getGitBlob($projectId, $blobId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetGitCommit()
    {
        $projectId = 'test-project';
        $commitId = 'commit-123';
        $expectedResponse = new Commit();

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitCommits')
            ->with($projectId, $commitId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getGitCommit($projectId, $commitId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetGitRef()
    {
        $projectId = 'test-project';
        $refId = 'ref-123';
        $expectedResponse = new Ref();

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitRefs')
            ->with($projectId, $refId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getGitRef($projectId, $refId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetGitTree()
    {
        $projectId = 'test-project';
        $treeId = 'tree-123';
        $expectedResponse = new Tree();

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitTrees')
            ->with($projectId, $treeId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getGitTree($projectId, $treeId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListGitRefs()
    {
        $projectId = 'test-project';
        $expectedResponse = [new Ref(), new Ref()];

        $this->repositoryApi->expects($this->once())
            ->method('listProjectsGitRefs')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listGitRefs($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testRestartGitServer()
    {
        $projectId = 'test-project';
        $expectedResponse = new AcceptedResponse();

        $this->systemInfoApi->expects($this->once())
            ->method('actionProjectsSystemRestart')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->restartGitServer($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetGitInfo()
    {
        $projectId = 'test-project';
        $expectedResponse = new SystemInformation();

        $this->systemInfoApi->expects($this->once())
            ->method('getProjectsSystem')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getGitInfo($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateIntegration()
    {
        $projectId = 'test-project';
        $integrationData = ['type' => 'github'];
        $expectedResponse = new AcceptedResponse();

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('createProjectsIntegrations')
            ->with($projectId, $this->isInstanceOf(IntegrationCreateInput::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createIntegration($projectId, $integrationData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $expectedResponse = new AcceptedResponse();

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('deleteProjectsIntegrations')
            ->with($projectId, $integrationId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->deleteIntegration($projectId, $integrationId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $expectedResponse = new Integration();

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('getProjectsIntegrations')
            ->with($projectId, $integrationId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getIntegration($projectId, $integrationId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListIntegrations()
    {
        $projectId = 'test-project';
        $expectedResponse = [new Integration(), new Integration()];

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('listProjectsIntegrations')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listIntegrations($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $integrationData = ['config' => ['key' => 'value']];
        $expectedResponse = new AcceptedResponse();

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('updateProjectsIntegrations')
            ->with($projectId, $integrationId, $this->isInstanceOf(IntegrationPatch::class))
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateIntegration($projectId, $integrationId, $integrationData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateDomain()
    {
        $projectId = 'test-project';
        $domainData = ['name' => 'example.com'];
        $expectedResponse = new AcceptedResponse();

        $this->domainTask->expects($this->once())
            ->method('create')
            ->with($projectId, $domainData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createDomain($projectId, $domainData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $expectedResponse = new AcceptedResponse();

        $this->domainTask->expects($this->once())
            ->method('delete')
            ->with($projectId, $domainId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->deleteDomain($projectId, $domainId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $expectedResponse = new Domain();

        $this->domainTask->expects($this->once())
            ->method('get')
            ->with($projectId, $domainId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getDomain($projectId, $domainId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListDomains()
    {
        $projectId = 'test-project';
        $expectedResponse = [new Domain(), new Domain()];

        $this->domainTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listDomains($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domainData = ['ssl' => ['enabled' => true]];
        $expectedResponse = new AcceptedResponse();

        $this->domainTask->expects($this->once())
            ->method('update')
            ->with($projectId, $domainId, $domainData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateDomain($projectId, $domainId, $domainData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateCertificate()
    {
        $projectId = 'test-project';
        $certData = ['certificate' => 'cert-data', 'key' => 'key-data'];
        $expectedResponse = new AcceptedResponse();

        $this->certificateTask->expects($this->once())
            ->method('create')
            ->with($projectId, $certData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->createCertificate($projectId, $certData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $expectedResponse = new AcceptedResponse();

        $this->certificateTask->expects($this->once())
            ->method('delete')
            ->with($projectId, $certId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->deleteCertificate($projectId, $certId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $expectedResponse = new Certificate();

        $this->certificateTask->expects($this->once())
            ->method('get')
            ->with($projectId, $certId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getCertificate($projectId, $certId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListCertificates()
    {
        $projectId = 'test-project';
        $expectedResponse = [new Certificate(), new Certificate()];

        $this->certificateTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listCertificates($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testUpdateCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $certData = ['certificate' => 'new-cert-data'];
        $expectedResponse = new AcceptedResponse();

        $this->certificateTask->expects($this->once())
            ->method('update')
            ->with($projectId, $certId, $certData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->updateCertificate($projectId, $certId, $certData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testRunOperation()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $deploymentId = 'deploy-123';
        $operationData = ['type' => 'restart'];
        $expectedResponse = new AcceptedResponse();

        $this->operationTask->expects($this->once())
            ->method('run')
            ->with($projectId, $environmentId, $deploymentId, $operationData)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->runOperation($projectId, $environmentId, $deploymentId, $operationData);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetProjectTeamAccess()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';
        $expectedResponse = new TeamProjectAccess();

        $this->teamTask->expects($this->once())
            ->method('getProjectTeamAccess')
            ->with($projectId, $teamId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getProjectTeamAccess($projectId, $teamId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetTeamProjectAccess()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';
        $expectedResponse = new TeamProjectAccess();

        $this->teamTask->expects($this->once())
            ->method('getTeamProjectAccess')
            ->with($teamId, $projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getTeamProjectAccess($teamId, $projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGrantProjectTeamAccess()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->teamTask->expects($this->once())
            ->method('grantProjectTeamAccess')
            ->with($projectId, $request);

        $this->projectTask->grantProjectTeamAccess($projectId, $request);
    }

    public function testGrantTeamProjectAccess()
    {
        $teamId = 'team-123';
        $request = [['role' => 'admin']];

        $this->teamTask->expects($this->once())
            ->method('grantTeamProjectAccess')
            ->with($teamId, $request);

        $this->projectTask->grantTeamProjectAccess($teamId, $request);
    }

    public function testListProjectTeamAccess()
    {
        $projectId = 'test-project';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';
        $expectedResponse = new ListTeamProjectAccess200Response();

        $this->teamTask->expects($this->once())
            ->method('listProjectTeamAccess')
            ->with($projectId, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertSame($expectedResponse, $result);
    }

    public function testListTeamProjectAccess()
    {
        $teamId = 'team-123';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';
        $expectedResponse = new ListTeamProjectAccess200Response();

        $this->teamTask->expects($this->once())
            ->method('listTeamProjectAccess')
            ->with($teamId, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertSame($expectedResponse, $result);
    }

    public function testRemoveProjectTeamAccess()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';

        $this->teamTask->expects($this->once())
            ->method('removeProjectTeamAccess')
            ->with($projectId, $teamId);

        $this->projectTask->removeProjectTeamAccess($projectId, $teamId);
    }

    public function testRemoveTeamProjectAccess()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';

        $this->teamTask
            ->method('removeProjectTeamAccess')
            ->with($teamId, $projectId);

        $this->expectNotToPerformAssertions();
        $this->projectTask->removeTeamProjectAccess($teamId, $projectId);
    }

    public function testGetProjectUserAccess()
    {
        $projectId = 'test-project';
        $userId = 'user-123';
        $expectedResponse = new UserProjectAccess();

        $this->userTask->expects($this->once())
            ->method('getProjectUserAccess')
            ->with($projectId, $userId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->getProjectUserAccess($projectId, $userId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGrantProjectUserAccess()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->userTask->expects($this->once())
            ->method('grantProjectUserAccess')
            ->with($projectId, $request);

        $this->projectTask->grantProjectUserAccess($projectId, $request);
    }

    public function testRemoveProjectUserAccess()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

        $this->userTask->expects($this->once())
            ->method('removeProjectUserAccess')
            ->with($projectId, $userId);

        $this->projectTask->removeProjectUserAccess($projectId, $userId);
    }

    public function testUpdateProjectUserAccess()
    {
        $projectId = 'test-project';
        $userId = 'user-123';
        $request = ['role' => 'admin'];

        $this->userTask->expects($this->once())
            ->method('updateProjectUserAccess')
            ->with($projectId, $userId, $request);

        $this->projectTask->updateProjectUserAccess($projectId, $userId, $request);
    }

    public function testListProjectUserAccess()
    {
        $projectId = 'test-project';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';
        $expectedResponse = new ListProjectUserAccess200Response();

        $this->userTask->expects($this->once())
            ->method('listProjectUserAccess')
            ->with($projectId, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreate()
    {
        $orgId = 'org-123';
        $prjId = 'prj-123';
        $projectData = ['title' => 'New Project'];
        $expectedSubscription = $this->createMock(Subscription::class);
        $expectedSubscription->method('getProjectId')->willReturn($prjId);

        $expectedProject = $this->createMock(Project::class);
        $expectedProject->method('getOrganization')->willReturn($orgId);
        
        $expectedOrgProject = $this->createMock(OrganizationProject::class);

        $this->subscriptionsApi->expects($this->once())
            ->method('createOrgSubscription')
            ->with($orgId, $this->isInstanceOf(CreateOrgSubscriptionRequest::class))
            ->willReturn($expectedSubscription);

        $this->projectApi->expects($this->once())
            ->method('getProjects')
            ->with($prjId)
            ->willReturn($expectedProject);
        
        $this->organizationProjectsApi->expects($this->once())
            ->method('getOrgProject')
            ->with($orgId, $prjId)
            ->willReturn($expectedOrgProject);
        
        $result = $this->projectTask->create($orgId, $projectData);
        $this->assertSame($expectedOrgProject, $result);
    }

    public function testListEnvironments()
    {
        $projectId = 'test-project';
        $expectedResponse = [['id' => 'env1'], ['id' => 'env2']];

        $this->environmentTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willReturn($expectedResponse);

        $result = $this->projectTask->listEnvironments($projectId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteWithError()
    {
        $projectId = 'test-project';

        $this->projectApi->expects($this->once())
            ->method('deleteProjects')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->delete($projectId);
    }

    public function testGetWithError()
    {
        $projectId = 'test-project';

        $this->projectApi->expects($this->once())
            ->method('getProjects')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->get($projectId);
    }

    public function testGetCapabilitiesWithError()
    {
        $projectId = 'test-project';

        $this->projectApi->expects($this->once())
            ->method('getProjectsCapabilities')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getCapabilities($projectId);
    }

    public function testUpdateWithError()
    {
        $projectId = 'test-project';
        $projectData = ['title' => 'Updated Project'];

        $this->projectApi->expects($this->once())
            ->method('updateProjects')
            ->with($projectId, $this->isInstanceOf(ProjectPatch::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->update($projectId, $projectData);
    }

    public function testCancelInviteWithError()
    {
        $projectId = '-1';
        $invitationId = 'invite-123';

        $this->invitationTask->expects($this->once())
            ->method('cancelProjectInvite')
            ->with($projectId, $invitationId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->cancelInvite($projectId, $invitationId);
    }

    public function testCreateInviteWithError()
    {
        $projectId = 'test-project';
        $request = ['email' => 'test'];

        $this->invitationTask->expects($this->once())
            ->method('createProjectInvite')
            ->with($projectId, $request)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->createInvite($projectId, $request);
    }
    
    public function testGetSettingsWithError()
    {
        $projectId = 'test-project';

        $this->settingsApi->expects($this->once())
            ->method('getProjectsSettings')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getSettings($projectId);
    }

    public function testUpdateSettingsWithError()
    {
        $projectId = 'test-project';
        $settingsData = ['timezone' => 'UTC'];

        $this->settingsApi->expects($this->once())
            ->method('updateProjectsSettings')
            ->with($projectId, $this->isInstanceOf(ProjectSettingsPatch::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateSettings($projectId, $settingsData);
    }

    public function testCreateDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentData = ['name' => 'production'];

        $this->deploymentTargetApi->expects($this->once())
            ->method('createProjectsDeployments')
            ->with($projectId, $this->isInstanceOf(DeploymentTargetCreateInput::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->createDeployment($projectId, $deploymentData);
    }

    public function testDeleteDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

        $this->deploymentTargetApi->expects($this->once())
            ->method('deleteProjectsDeployments')
            ->with($projectId, $deploymentId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->deleteDeployment($projectId, $deploymentId);
    }

    public function testGetDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

        $this->deploymentTargetApi->expects($this->once())
            ->method('getProjectsDeployments')
            ->with($projectId, $deploymentId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getDeployment($projectId, $deploymentId);
    }

    public function testListDeploymentsWithError()
    {
        $projectId = 'test-project';

        $this->deploymentTargetApi->expects($this->once())
            ->method('listProjectsDeployments')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listDeployments($projectId);
    }

    public function testUpdateDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $deploymentData = ['name' => 'staging'];

        $this->deploymentTargetApi->expects($this->once())
            ->method('updateProjectsDeployments')
            ->with($projectId, $deploymentId, $this->isInstanceOf(DeploymentTargetPatch::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateDeployment($projectId, $deploymentId, $deploymentData);
    }

    public function testGetGitBlobWithError()
    {
        $projectId = 'test-project';
        $blobId = 'blob-123';

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitBlobs')
            ->with($projectId, $blobId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getGitBlob($projectId, $blobId);
    }

    public function testGetGitCommitWithError()
    {
        $projectId = 'test-project';
        $commitId = 'commit-123';

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitCommits')
            ->with($projectId, $commitId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getGitCommit($projectId, $commitId);
    }

    public function testGetGitRefWithError()
    {
        $projectId = 'test-project';
        $refId = 'ref-123';

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitRefs')
            ->with($projectId, $refId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getGitRef($projectId, $refId);
    }

    public function testGetGitTreeWithError()
    {
        $projectId = 'test-project';
        $treeId = 'tree-123';

        $this->repositoryApi->expects($this->once())
            ->method('getProjectsGitTrees')
            ->with($projectId, $treeId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getGitTree($projectId, $treeId);
    }

    public function testListGitRefsWithError()
    {
        $projectId = 'test-project';

        $this->repositoryApi->expects($this->once())
            ->method('listProjectsGitRefs')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listGitRefs($projectId);
    }

    public function testRestartGitServerWithError()
    {
        $projectId = 'test-project';

        $this->systemInfoApi->expects($this->once())
            ->method('actionProjectsSystemRestart')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->restartGitServer($projectId);
    }

    public function testGetGitInfoWithError()
    {
        $projectId = 'test-project';

        $this->systemInfoApi->expects($this->once())
            ->method('getProjectsSystem')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getGitInfo($projectId);
    }

    public function testCreateIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationData = ['type' => 'github'];

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('createProjectsIntegrations')
            ->with($projectId, $this->isInstanceOf(IntegrationCreateInput::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->createIntegration($projectId, $integrationData);
    }

    public function testDeleteIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('deleteProjectsIntegrations')
            ->with($projectId, $integrationId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->deleteIntegration($projectId, $integrationId);
    }

    public function testGetIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('getProjectsIntegrations')
            ->with($projectId, $integrationId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getIntegration($projectId, $integrationId);
    }

    public function testListIntegrationsWithError()
    {
        $projectId = 'test-project';

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('listProjectsIntegrations')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listIntegrations($projectId);
    }

    public function testUpdateIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $integrationData = ['config' => ['key' => 'value']];

        $this->thirdPartyIntegrationsApi->expects($this->once())
            ->method('updateProjectsIntegrations')
            ->with($projectId, $integrationId, $this->isInstanceOf(IntegrationPatch::class))
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateIntegration($projectId, $integrationId, $integrationData);
    }

    public function testCreateDomainWithError()
    {
        $projectId = '-1';
        $domainData = ['name' => 'example.com'];

        $this->domainTask->expects($this->once())
            ->method('create')
            ->with($projectId, $domainData)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->createDomain($projectId, $domainData);
    }

    public function testDeleteDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';

        $this->domainTask->expects($this->once())
            ->method('delete')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->deleteDomain($projectId, $domainId);
    }

    public function testGetDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';

        $this->domainTask->expects($this->once())
            ->method('get')
            ->with($projectId, $domainId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getDomain($projectId, $domainId);
    }

    public function testListDomainsWithError()
    {
        $projectId = 'test-project';

        $this->domainTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listDomains($projectId);
    }

    public function testUpdateDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domainData = ['ssl' => ['enabled' => true]];

        $this->domainTask->expects($this->once())
            ->method('update')
            ->with($projectId, $domainId, $domainData)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateDomain($projectId, $domainId, $domainData);
    }

    public function testCreateCertificateWithError()
    {
        $projectId = 'test-project';
        $certData = ['certificate' => 'cert-data', 'key' => 'key-data'];

        $this->certificateTask->expects($this->once())
            ->method('create')
            ->with($projectId, $certData)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->createCertificate($projectId, $certData);
    }

    public function testDeleteCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';

        $this->certificateTask->expects($this->once())
            ->method('delete')
            ->with($projectId, $certId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->deleteCertificate($projectId, $certId);
    }

    public function testGetCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';

        $this->certificateTask->expects($this->once())
            ->method('get')
            ->with($projectId, $certId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getCertificate($projectId, $certId);
    }

    public function testListCertificatesWithError()
    {
        $projectId = 'test-project';

        $this->certificateTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listCertificates($projectId);
    }

    public function testUpdateCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $certData = ['certificate' => 'new-cert-data'];

        $this->certificateTask->expects($this->once())
            ->method('update')
            ->with($projectId, $certId, $certData)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateCertificate($projectId, $certId, $certData);
    }

    public function testRunOperationWithError()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $deploymentId = 'deploy-123';
        $operationData = ['type' => 'restart'];

        $this->operationTask->expects($this->once())
            ->method('run')
            ->with($projectId, $environmentId, $deploymentId, $operationData)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->runOperation($projectId, $environmentId, $deploymentId, $operationData);
    }

    public function testGetProjectTeamAccessWithError()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';

        $this->teamTask->expects($this->once())
            ->method('getProjectTeamAccess')
            ->with($projectId, $teamId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getProjectTeamAccess($projectId, $teamId);
    }

    public function testGetTeamProjectAccessWithError()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';

        $this->teamTask->expects($this->once())
            ->method('getTeamProjectAccess')
            ->with($teamId, $projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getTeamProjectAccess($teamId, $projectId);
    }

    public function testGrantProjectTeamAccessWithError()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->teamTask->expects($this->once())
            ->method('grantProjectTeamAccess')
            ->with($projectId, $request)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->grantProjectTeamAccess($projectId, $request);
    }

    public function testGrantTeamProjectAccessWithError()
    {
        $teamId = 'team-123';
        $request = [['role' => 'admin']];

        $this->teamTask->expects($this->once())
            ->method('grantTeamProjectAccess')
            ->with($teamId, $request)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->grantTeamProjectAccess($teamId, $request);
    }

    public function testListProjectTeamAccessWithError()
    {
        $projectId = 'test-project';

        $this->teamTask->expects($this->once())
            ->method('listProjectTeamAccess')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listProjectTeamAccess($projectId);
    }

    public function testListTeamProjectAccessWithError()
    {
        $teamId = 'team-123';

        $this->teamTask->expects($this->once())
            ->method('listTeamProjectAccess')
            ->with($teamId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listTeamProjectAccess($teamId);
    }

    public function testRemoveProjectTeamAccessWithError()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';
        $error = new ApiException('Not Found', $this->createMock(Request::class));

        $this->teamTask->expects($this->once())
            ->method('removeProjectTeamAccess')
            ->with($projectId, $teamId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->removeProjectTeamAccess($projectId, $teamId);
    }

    public function testRemoveTeamProjectAccessWithError()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';
        $error = new ApiException('Forbidden', $this->createMock(Request::class));

        $this->teamTask->expects($this->once())
            ->method('removeTeamProjectAccess')
            ->with($teamId, $projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->removeTeamProjectAccess($teamId, $projectId);
    }

    public function testGetProjectUserAccessWithError()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

        $this->userTask->expects($this->once())
            ->method('getProjectUserAccess')
            ->with($projectId, $userId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->getProjectUserAccess($projectId, $userId);
    }

    public function testGrantProjectUserAccessWithError()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->userTask->expects($this->once())
            ->method('grantProjectUserAccess')
            ->with($projectId, $request)
            ->willThrowException($this->createMock(ApiException::class));
        
        $this->expectException(ApiException::class);
        $this->projectTask->grantProjectUserAccess($projectId, $request);
    }

    public function testRemoveProjectUserAccessWithError()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

        $this->userTask->expects($this->once())
            ->method('removeProjectUserAccess')
            ->with($projectId, $userId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->removeProjectUserAccess($projectId, $userId);
    }

    public function testUpdateProjectUserAccessWithError()
    {
        $projectId = 'test-project';
        $userId = 'user-123';
        $request = ['role' => 'admin'];

        $this->userTask->expects($this->once())
            ->method('updateProjectUserAccess')
            ->with($projectId, $userId, $request)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->updateProjectUserAccess($projectId, $userId, $request);
    }

    public function testListProjectUserAccessWithError()
    {
        $projectId = 'test-project';

        $this->userTask->expects($this->once())
            ->method('listProjectUserAccess')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listProjectUserAccess($projectId);
    }

    public function testCreateWithError()
    {
        $orgId = 'org-123';
        $projectData = ['title' => 'New Project'];

        $this->subscriptionsApi->expects($this->once())
            ->method('createOrgSubscription')
            ->with($orgId, $this->isInstanceOf(CreateOrgSubscriptionRequest::class))
            ->willThrowException($this->createMock(ApiException::class));
        
        $this->expectException(ApiException::class);
        $this->projectTask->create($orgId, $projectData);
    }

    public function testListEnvironmentsWithError()
    {
        $projectId = 'test-project';

        $this->environmentTask->expects($this->once())
            ->method('list')
            ->with($projectId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->projectTask->listEnvironments($projectId);
    }
}