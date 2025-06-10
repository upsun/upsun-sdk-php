<?php

namespace Tests\Unit\Core\Tasks;

use PHPUnit\Framework\TestCase;
use OpenAPI\Client\apisgen\DeploymentApi;
use Upsun\Core\Tasks\ApplicationTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\UpsunClient;
use OpenAPI\Client\Model\Deployment;
use OpenAPI\Client\Model\WebApplicationsValue;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\TheEnvironmentDeploymentState as DeploymentState;

class ApplicationTaskTest extends TestCase
{
    private DeploymentApi $deploymentApiMock;
    private UpsunClient $clientMock;
    private EnvironmentTask $environmentTaskMock;
    private ApplicationTask $applicationTask;

    protected function setUp(): void
    {
        $this->deploymentApiMock = $this->createMock(DeploymentApi::class);
        $this->environmentTaskMock = $this->createMock(EnvironmentTask::class); 

        $this->clientMock = new class($this->environmentTaskMock) extends UpsunClient {
            public EnvironmentTask $environment;
            public function __construct($env) {
                $this->environment = $env;
            }
        };

        $this->applicationTask = new class($this->clientMock, $this->deploymentApiMock) extends ApplicationTask {
            public function refreshToken(): void {}
        };
    }

    public function testListReturnsWebappsArray(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';

        $webapps = ['app1' => $this->createMock(WebApplicationsValue::class)];

        $deployment = $this->createMock(Deployment::class);
        $deployment->method('getWebapps')->willReturn($webapps);

        $this->deploymentApiMock->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $envId)
            ->willReturn([$deployment]);

        $result = $this->applicationTask->list($projectId, $envId);
        $this->assertSame($webapps, $result);
    }

    public function testListReturnsEmptyArrayIfNoDeployment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';

        $this->deploymentApiMock->method('listProjectsEnvironmentsDeployments')
            ->willReturn([]);

        $result = $this->applicationTask->list($projectId, $envId);
        $this->assertSame([], $result);
    }

    public function testGetReturnsWebApplicationWhenAvailable(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $appId = 'app1';

        $webapp = $this->createMock(WebApplicationsValue::class);
        $webapps = [$appId => $webapp];

        $deployment = $this->createMock(Deployment::class);
        $deployment->method('getWebapps')->willReturn($webapps);

        $deploymentState = $this->createMock(DeploymentState::class);
        $deploymentState->method('getLastDeploymentSuccessful')->willReturn(true);

        $environment = $this->createMock(Environment::class);
        $environment->method('getDeploymentState')->willReturn($deploymentState);

        $this->environmentTaskMock->method('get')->with($projectId, $envId)->willReturn($environment);

        $this->deploymentApiMock->method('listProjectsEnvironmentsDeployments')
            ->willReturn([$deployment]);

        $result = $this->applicationTask->get($projectId, $envId, $appId);
        $this->assertSame($webapp, $result);
    }

    public function testGetReturnsNullWhenLastDeploymentUnsuccessful(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $appId = 'app1';

        $deploymentState = $this->createMock(DeploymentState::class);
        $deploymentState->method('getLastDeploymentSuccessful')->willReturn(false);

        $environment = $this->createMock(Environment::class);
        $environment->method('getDeploymentState')->willReturn($deploymentState);

        $this->environmentTaskMock->method('get')->willReturn($environment);

        $result = $this->applicationTask->get($projectId, $envId, $appId);
        $this->assertNull($result);
    }

    public function testGetReturnsNullWhenAppNotFound(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $appId = 'nonexistent';

        $deployment = $this->createMock(Deployment::class);
        $deployment->method('getWebapps')->willReturn([]);

        $deploymentState = $this->createMock(DeploymentState::class);
        $deploymentState->method('getLastDeploymentSuccessful')->willReturn(true);

        $environment = $this->createMock(Environment::class);
        $environment->method('getDeploymentState')->willReturn($deploymentState);

        $this->environmentTaskMock->method('get')->willReturn($environment);
        $this->deploymentApiMock->method('listProjectsEnvironmentsDeployments')->willReturn([$deployment]);

        $result = $this->applicationTask->get($projectId, $envId, $appId);
        $this->assertNull($result);
    }
}
