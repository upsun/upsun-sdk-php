<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\UpsunClient;
use Upsun\Model\Deployment;
use Upsun\Model\WebApplicationsValue;
use Upsun\Model\Environment;
use Upsun\Model\TheEnvironmentDeploymentState as DeploymentState;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Nyholm\Psr7\Factory\Psr17Factory;

class ApplicationTaskTest extends TestCase
{
    private UpsunClient $clientMock;
    private EnvironmentTask $environmentTaskMock;
    protected function setUp(): void
    {
        $this->environmentTaskMock = $this->createMock(EnvironmentTask::class);

        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $deploymentApi = new DeploymentApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $environmentApi = new EnvironmentApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $environmentActivityApi = new EnvironmentActivityApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->environmentTaskMock = new class (
            $upsunClient,
            $environmentApi,
            $environmentActivityApi,
            $deploymentApi,
        ) extends EnvironmentTask {
        };
    }

    public function testListReturnsWebappsArray(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "status" => "OK",
                    "code" => 200,
                    "_embedded" => (object) ['activities' => []],
                ])
            ));
        
        
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
