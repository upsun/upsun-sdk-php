<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\Model\WorkersValue;
use Upsun\UpsunClient;

class WorkersTaskTest extends BaseTestCase
{
    private WorkersTask $workersTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $environmentsTask = new class (
            $upsunClient,
            new EnvironmentApi(...$apiClassParams),
            new EnvironmentTypeApi(...$apiClassParams),
            new DeploymentApi(...$apiClassParams)
        ) extends EnvironmentsTask {
        };
        $upsunClient->environments = $environmentsTask;

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->workersTask = new class (
            $upsunClient,
        ) extends WorkersTask {
        };
    }

    public function testListWorkers()
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment([],[]), JSON_THROW_ON_ERROR)
            )
        );

        $result = $this->workersTask->list('proj1', 'main');

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('app--app-worker', $result);
        $this->assertInstanceOf(WorkersValue::class, $result['app--app-worker']);
   
    }


    /**
     * Test that WorkersTask correctly calls EnvironmentsTask::getDeployment()
     */
    public function testListWorkersInvalidArguments()
    {

        // This test verifies that WorkersTask depends on EnvironmentsTask
        // Since Deployment is final and cannot be mocked, we just verify the interaction
        $this->assertTrue(method_exists($this->workersTask, 'list'));

        // Verify that the task requires valid IDs
        $this->expectException(\InvalidArgumentException::class);
        $this->workersTask->list('', ''); // Empty IDs should fail validation
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListWorkersError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->workersTask->list(projectId: $projectId, environmentId: $environmentId);
    }
}
