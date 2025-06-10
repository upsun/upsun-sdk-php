<?php

namespace Tests\Upsun\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\TheEnvironmentDeploymentState;
use OpenAPI\Client\Model\WebApplicationsValue;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\ApplicationTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\UpsunClient;

class ApplicationTaskTest extends TestCase
{
    private UpsunClient $clientMock;
    private DeploymentApi $deploymentApiMock;
    private ApplicationTask $applicationTask;
    private EnvironmentTask $environmentTaskMock;
    protected function setUp(): void
    {
        $this->deploymentApiMock = $this->createMock(DeploymentApi::class); 

        $this->clientMock = new class() extends UpsunClient {
            public Client $apiClient;
            public Configuration $apiConfig;

            public function __construct() {}
        };

        $this->clientMock->apiClient = $this->createMock(Client::class);
        $this->clientMock->apiConfig = $this->createMock(Configuration::class);

        $this->environmentTaskMock = $this->createMock(EnvironmentTask::class);
        $this->clientMock->environment = $this->environmentTaskMock;
        
        $this->applicationTask = new class($this->clientMock) extends ApplicationTask {
            private ?DeploymentApi $mockApi = null;

            public function refreshToken(): void {}

            public function setMockApi(DeploymentApi $mock): void
            {
                $this->mockApi = $mock;
            }

            public function getApi(): DeploymentApi
            {
                return $this->mockApi ?? parent::getApi();
            }
        };
        $this->applicationTask->setMockApi($this->deploymentApiMock);
    }

    public function testListApplicationsSuccess()
    {
        // Prepare test data
        $projectId = 'test-project';
        $environmentId = 'test-env';

        $mockDeployment = new Deployment();
        $mockWebapps = [
            'app1' => new WebApplicationsValue(),
            'app2' => new WebApplicationsValue()
        ];
        $mockDeployment->setWebapps($mockWebapps);

        // Configure the mock
        $this->deploymentApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([$mockDeployment]);

        // Execute the method
        $result = $this->applicationTask->list($projectId, $environmentId);

        // Assert the result
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('app1', $result);
        $this->assertArrayHasKey('app2', $result);
    }

    public function testListApplicationsEmptyResult()
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';

        // Configure the mock to return empty array
        $this->deploymentApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([]);

        $result = $this->applicationTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testListApplicationsApiException()
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';

        $this->deploymentApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willThrowException(new ApiException("API Error", 500));

        $this->expectException(ApiException::class);
        $this->applicationTask->list($projectId, $environmentId);
    }

    public function testGetApplicationSuccess(): void
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';
        $appId = 'app1';

        // Simule un environnement avec un déploiement réussi
        $deploymentState = new TheEnvironmentDeploymentState();
        $deploymentState->setLastDeploymentSuccessful(true);

        $environment = new \OpenAPI\Client\Model\Environment();
        $environment->setDeploymentState($deploymentState);

        // Le mock d'EnvironmentTask doit retourner l'environnement simulé
        $this->environmentTaskMock
            ->expects($this->once())
            ->method('get')
            ->with($projectId, $environmentId)
            ->willReturn($environment);

        // Simule une réponse de déploiement avec deux applications
        $webapps = [
            'app1' => new WebApplicationsValue(),
            'app2' => new WebApplicationsValue(),
        ];
        $deployment = new Deployment();
        $deployment->setWebapps($webapps);

        $this->deploymentApiMock
            ->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([$deployment]);

        // Exécution
        $result = $this->applicationTask->get($projectId, $environmentId, $appId);

        // Vérification
        $this->assertInstanceOf(WebApplicationsValue::class, $result);
        $this->assertSame($webapps['app1'], $result);
    }


    public function testGetApplicationNotFound()
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';
        $appId = 'non-existent-app';

        // Mock environment with successful deployment state
        $environmentMock = new Environment();
        $deploymentStateMock = new TheEnvironmentDeploymentState();
        $deploymentStateMock->setLastDeploymentSuccessful(true);
        $environmentMock->setDeploymentState($deploymentStateMock);
        
        $this->environmentTaskMock->expects($this->once())
            ->method('get')
            ->with($projectId, $environmentId)
            ->willReturn($environmentMock);

        // Mock deployment with webapps
        $mockDeployment = new Deployment();
        $mockWebapps = [
            'app1' => new WebApplicationsValue()
        ];
        $mockDeployment->setWebapps($mockWebapps);

        $this->deploymentApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([$mockDeployment]);

        $result = $this->applicationTask->get($projectId, $environmentId, $appId);

        $this->assertNull($result);
    }

    public function testGetApplicationFailedDeployment()
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';
        $appId = 'app1';

        // Mock environment with failed deployment state
        $environmentMock = new Environment();
        $deploymentStateMock = new TheEnvironmentDeploymentState();
        $deploymentStateMock->setLastDeploymentSuccessful(false);
        $environmentMock->setDeploymentState($deploymentStateMock);

        $this->environmentTaskMock->expects($this->once())
            ->method('get')
            ->with($projectId, $environmentId)
            ->willReturn($environmentMock);

        // The API should not be called when deployment failed
        $this->deploymentApiMock->expects($this->never())
            ->method('listProjectsEnvironmentsDeployments');

        $result = $this->applicationTask->get($projectId, $environmentId, $appId);

        $this->assertNull($result);
    }

    public function testGetApplicationApiException()
    {
        $projectId = 'test-project';
        $environmentId = 'test-env';
        $appId = 'app1';

        // Mock environment with successful deployment state
        $environmentMock = new Environment();
        $deploymentStateMock = new TheEnvironmentDeploymentState();
        $deploymentStateMock->setLastDeploymentSuccessful(true);
        $environmentMock->setDeploymentState($deploymentStateMock);

        $this->environmentTaskMock->expects($this->once())
            ->method('get')
            ->with($projectId, $environmentId)
            ->willReturn($environmentMock);

        $this->deploymentApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willThrowException(new ApiException("API Error", 500));

        $this->expectException(ApiException::class);
        $this->applicationTask->get($projectId, $environmentId, $appId);
    }
}