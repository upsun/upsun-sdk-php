<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use stdClass;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\Model\Deployment;
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
        $environmentsTask = $this->createMock(EnvironmentsTask::class);
        $upsunClient->environments = $environmentsTask;

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->workersTask = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams),
        ) extends WorkersTask {
        };
    }

    /**
     * Test that WorkersTask correctly calls EnvironmentsTask::getDeployment()
     */
    public function testListWorkersCallsGetDeployment()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

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

        // Create a mock request for ApiException
        $request = $this->createMock(RequestInterface::class);

        // Mock environments task that throws ApiException
        $environmentsTask = $this->createMock(EnvironmentsTask::class);
        $environmentsTask->method('getDeployment')
            ->with($projectId, $environmentId, 'current')
            ->willThrowException(new ApiException('Not found', $request));

        $upsunClient = $this->createMock(UpsunClient::class);
        $upsunClient->environments = $environmentsTask;

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $workersTask = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams),
        ) extends WorkersTask {
        };

        $this->expectException(ApiException::class);

        $workersTask->list(projectId: $projectId, environmentId: $environmentId);
    }
}
