<?php

namespace Tests;

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\WorkerTask;
use Upsun\Api\DeploymentApi;
use Upsun\Model\Deployment;
use Upsun\UpsunClient;
use Upsun\ApiException;
use Upsun\UpsunConfig;

class WorkerTaskTest extends TestCase
{
    private DeploymentApi $deploymentApi;
    private UpsunClient $upsunClient;
    private WorkerTask $workerTask;

    protected function setUp(): void
    {
        $this->deploymentApi = $this->createMock(DeploymentApi::class);

        $this->upsunClient = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->workerTask = new class(
            $this->upsunClient,
            $this->deploymentApi
        ) extends WorkerTask {
            public function refreshToken(): void
            {
            }
        };
    }

    public function testListSuccess(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $deployment = $this->createMock(Deployment::class);
        $deployment->expects($this->once())
            ->method('getWorkers')
            ->willReturn([['name' => 'worker-1'], ['name' => 'worker-2']]);

        $this->deploymentApi->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([$deployment]);

        $workers = $this->workerTask->list($projectId, $environmentId);

        $this->assertIsArray($workers);
        $this->assertCount(2, $workers);
        $this->assertEquals('worker-1', $workers[0]['name']);
    }

    public function testListReturnsEmptyArrayWhenNoDeployment(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->deploymentApi->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willReturn([]); // Simulate empty deployments

        $workers = $this->workerTask->list($projectId, $environmentId);

        $this->assertIsArray($workers);
        $this->assertEmpty($workers);
    }

    public function testListThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->deploymentApi->expects($this->once())
            ->method('listProjectsEnvironmentsDeployments')
            ->with($projectId, $environmentId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->workerTask->list($projectId, $environmentId);
    }
}
