<?php

namespace Tests\Unit\Upsun\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\apisgen\EnvironmentTypeApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\Backup;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\EnvironmentActivateInput;
use OpenAPI\Client\Model\EnvironmentBranchInput;
use OpenAPI\Client\Model\EnvironmentMergeInput;
use OpenAPI\Client\Model\EnvironmentPatch;
use OpenAPI\Client\Model\EnvironmentType;
use OpenAPI\Client\Model\EnvironmentVariable;
use OpenAPI\Client\Model\Version;
use OpenAPI\Client\Model\VersionCreateInput;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Core\Tasks\DomainTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\Core\Tasks\RouteTask;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\Core\Tasks\VariableTask;
use Upsun\UpsunClient;

class EnvironmentTaskTest extends TestCase
{
    private UpsunClient $clientMock;
    private EnvironmentTask $environmentTask;
    private MockObject|UpsunClient $mockClient;
    private MockObject|EnvironmentApi $mockEnvironmentApi;
    private MockObject|EnvironmentTypeApi $mockEnvironmentTypeApi;
    private MockObject|DeploymentApi $mockDeploymentApi;
    private MockObject|ActivityTask $mockActivityTask;
    private MockObject|BackupTask $mockBackupTask;
    private MockObject|VariableTask $mockVariableTask;
    private MockObject|RouteTask $mockRouteTask;
    private MockObject|DomainTask $mockDomainTask;
    private MockObject|SourceOperationTask $mockSourceOperationTask;


    protected function setUp(): void
    {
        $this->mockEnvironmentApi = $this->createMock(EnvironmentApi::class);
        $this->mockEnvironmentTypeApi = $this->createMock(EnvironmentTypeApi::class);
        $this->mockDeploymentApi = $this->createMock(DeploymentApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public function __construct() {}
        };

        $this->environmentTask = new class(
            $this->clientMock, 
            $this->mockEnvironmentApi, 
            $this->mockEnvironmentTypeApi, 
            $this->mockDeploymentApi
        ) extends EnvironmentTask {
            public function refreshToken(): void {}
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
    
    public function testActivate(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['parent' => 'main'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('activateEnvironment')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($environmentId),
                $this->isInstanceOf(EnvironmentActivateInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->activate($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }
    
    public function testBranch(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['name' => 'feature-branch'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('branchEnvironment')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($environmentId),
                $this->isInstanceOf(EnvironmentBranchInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->branch($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }
    
    public function testGet(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedEnvironment = new Environment(['id' => $environmentId, 'name' => 'test-env']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('getEnvironment')
            ->with($projectId, $environmentId)
            ->willReturn($expectedEnvironment);

        $result = $this->environmentTask->get($projectId, $environmentId);

        $this->assertSame($expectedEnvironment, $result);
    }
    
    public function testList(): void
    {
        $projectId = 'project-123';
        $expectedEnvironments = [
            new Environment(['id' => 'env-1', 'name' => 'main']),
            new Environment(['id' => 'env-2', 'name' => 'staging'])
        ];

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('listProjectsEnvironments')
            ->with($projectId)
            ->willReturn($expectedEnvironments);

        $result = $this->environmentTask->list($projectId);

        $this->assertSame($expectedEnvironments, $result);
    }
    
    public function testDelete(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('deleteEnvironment')
            ->with($projectId, $environmentId)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->delete($projectId, $environmentId);

        $this->assertSame($expectedResponse, $result);
    }
    
    public function testUpdate(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $patch = ['title' => 'Updated Environment'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('updateEnvironment')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($environmentId),
                $this->isInstanceOf(EnvironmentPatch::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->update($projectId, $environmentId, $patch);

        $this->assertSame($expectedResponse, $result);
    }

    public function testMerge(): void
    {
        $projectId = 'project-123';
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

    public function testPause(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('pauseEnvironment')
            ->with($projectId, $environmentId)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->pause($projectId, $environmentId);

        $this->assertSame($expectedResponse, $result);
    }

    public function testResume(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('resumeEnvironment')
            ->with($projectId, $environmentId)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->resume($projectId, $environmentId);

        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateVersions(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['version' => '1.0.0'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('createProjectsEnvironmentsVersions')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($environmentId),
                $this->isInstanceOf(VersionCreateInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->createVersions($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testGetVersions(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $versionId = 'version-789';
        $expectedVersion = new Version(['id' => $versionId, 'name' => '1.0.0']);

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('getProjectsEnvironmentsVersions')
            ->with($projectId, $environmentId, $versionId)
            ->willReturn($expectedVersion);

        $result = $this->environmentTask->getVersions($projectId, $environmentId, $versionId);

        $this->assertSame($expectedVersion, $result);
    }

    public function testListActivities(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedActivities = [
            new Activity(['id' => 'act-1', 'type' => 'deploy']),
            new Activity(['id' => 'act-2', 'type' => 'backup'])
        ];

        $this->mockActivityTask
            ->expects($this->once())
            ->method('list')
            ->with($projectId, $environmentId)
            ->willReturn($expectedActivities);

        $result = $this->environmentTask->listActivities($projectId, $environmentId);

        $this->assertSame($expectedActivities, $result);
    }

    public function testGetActivities(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $activityId = 'act-789';
        $expectedActivity = new Activity(['id' => $activityId, 'type' => 'deploy']);

        $this->mockActivityTask
            ->expects($this->once())
            ->method('get')
            ->with($projectId, $activityId, $environmentId)
            ->willReturn($expectedActivity);

        $result = $this->environmentTask->getActivities($projectId, $environmentId, $activityId);

        $this->assertSame($expectedActivity, $result);
    }

    public function testBackup(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['type' => 'snapshot'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockBackupTask
            ->expects($this->once())
            ->method('backup')
            ->with($projectId, $environmentId, $input)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->backup($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testListBackups(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedBackups = [
            new Backup(['id' => 'backup-1', 'created_at' => '2023-01-01']),
            new Backup(['id' => 'backup-2', 'created_at' => '2023-01-02'])
        ];

        $this->mockBackupTask
            ->expects($this->once())
            ->method('list')
            ->with($projectId, $environmentId)
            ->willReturn($expectedBackups);

        $result = $this->environmentTask->listBackups($projectId, $environmentId);

        $this->assertSame($expectedBackups, $result);
    }

    public function testCreateVariable(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['name' => 'API_KEY', 'value' => 'secret'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockVariableTask
            ->expects($this->once())
            ->method('createEnvironmentVariable')
            ->with($projectId, $environmentId, $input)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->createVariable($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testListVariables(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedVariables = [
            new EnvironmentVariable(['name' => 'API_KEY', 'value' => 'secret1']),
            new EnvironmentVariable(['name' => 'DB_HOST', 'value' => 'localhost'])
        ];

        $this->mockVariableTask
            ->expects($this->once())
            ->method('listEnvironmentVariables')
            ->with($projectId, $environmentId)
            ->willReturn($expectedVariables);

        $result = $this->environmentTask->listVariables($projectId, $environmentId);

        $this->assertSame($expectedVariables, $result);
    }

    public function testCreateRoute(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['pattern' => '/api/*', 'target' => 'backend'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockRouteTask
            ->expects($this->once())
            ->method('create')
            ->with($projectId, $environmentId, $input)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->createRoute($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateDomain(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['name' => 'example.com'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockDomainTask
            ->expects($this->once())
            ->method('create')
            ->with($projectId, $input, $environmentId)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->createDomain($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testGetType(): void
    {
        $projectId = 'project-123';
        $environmentTypeId = 'type-456';
        $expectedType = new EnvironmentType(['id' => $environmentTypeId, 'name' => 'production']);

        $this->mockEnvironmentTypeApi
            ->expects($this->once())
            ->method('getEnvironmentType')
            ->with($projectId, $environmentTypeId)
            ->willReturn($expectedType);

        $result = $this->environmentTask->getType($projectId, $environmentTypeId);

        $this->assertSame($expectedType, $result);
    }

    public function testListTypes(): void
    {
        $projectId = 'project-123';
        $expectedTypes = [
            new EnvironmentType(['id' => 'type-1', 'name' => 'production']),
            new EnvironmentType(['id' => 'type-2', 'name' => 'staging'])
        ];

        $this->mockEnvironmentTypeApi
            ->expects($this->once())
            ->method('listProjectsEnvironmentTypes')
            ->with($projectId)
            ->willReturn($expectedTypes);

        $result = $this->environmentTask->listTypes($projectId);

        $this->assertSame($expectedTypes, $result);
    }

    public function testGetDeployment(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $deploymentId = 'deploy-789';
        $expectedDeployment = new Deployment(['id' => $deploymentId, 'status' => 'success']);

        $this->mockDeploymentApi
            ->expects($this->once())
            ->method('getProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId, $deploymentId)
            ->willReturn($expectedDeployment);

        $result = $this->environmentTask->getDeployment($projectId, $environmentId, $deploymentId);

        $this->assertSame($expectedDeployment, $result);
    }
    
    public function testListDeployments(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $expectedDeployments = [
            new Deployment(['id' => 'deploy-1', 'status' => 'success']),
            new Deployment(['id' => 'deploy-2', 'status' => 'running'])
        ];

        $this->mockDeploymentApi
            ->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn($expectedDeployments);

        $result = $this->environmentTask->listDeployments($projectId, $environmentId);

        $this->assertSame($expectedDeployments, $result);
    }
    
    public function testRunSourceOperation(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['operation' => 'sync'];
        $expectedResponse = new AcceptedResponse(['status' => 'accepted']);

        $this->mockSourceOperationTask
            ->expects($this->once())
            ->method('run')
            ->with($projectId, $environmentId, $input)
            ->willReturn($expectedResponse);

        $result = $this->environmentTask->runSourceOperation($projectId, $environmentId, $input);

        $this->assertSame($expectedResponse, $result);
    }

    public function testActivateThrowsApiException(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = ['parent' => 'main'];

        $this->mockEnvironmentApi
            ->expects($this->once())
            ->method('activateEnvironment')
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);

        $this->environmentTask->activate($projectId, $environmentId, $input);
    }
}