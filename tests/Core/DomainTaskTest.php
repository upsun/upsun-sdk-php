<?php

namespace Tests\Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DomainManagementApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\DomainCreateInput;
use OpenAPI\Client\Model\DomainPatch;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\DomainTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class DomainTaskTest extends TestCase
{
    private DomainManagementApi $apiMock;
    private DomainTask $task;

    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->apiMock = $this->createMock(DomainManagementApi::class);
        
        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->task = new class($this->clientMock, $this->apiMock) extends DomainTask {
            public function refreshToken(): void {}
        };
    }

    public function testCreateWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $input = ['type' => 'custom', 'hostname' => 'test.example.com'];
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('createProjectsDomains')
            ->with($projectId, $this->isInstanceOf(DomainCreateInput::class))
            ->willReturn($expected);

        $result = $this->task->create($projectId, $input);
        $this->assertSame($expected, $result);
    }

    public function testCreateWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $input = ['type' => 'custom', 'hostname' => 'env.example.com'];
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('createProjectsEnvironmentsDomains')
            ->with($projectId, $envId, $this->isInstanceOf(DomainCreateInput::class))
            ->willReturn($expected);

        $result = $this->task->create($projectId, $input, $envId);
        $this->assertSame($expected, $result);
    }

    public function testDeleteWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-abc';
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('deleteProjectsDomains')
            ->with($projectId, $domainId)
            ->willReturn($expected);

        $result = $this->task->delete($projectId, $domainId);
        $this->assertSame($expected, $result);
    }

    public function testDeleteWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-xyz';
        $envId = 'env-1';
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('deleteProjectsEnvironmentsDomains')
            ->with($projectId, $envId, $domainId)
            ->willReturn($expected);

        $result = $this->task->delete($projectId, $domainId, $envId);
        $this->assertSame($expected, $result);
    }

    public function testGetWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-abc';
        $expected = $this->createMock(Domain::class);

        $this->apiMock->expects($this->once())
            ->method('getProjectsDomains')
            ->with($projectId, $domainId)
            ->willReturn($expected);

        $result = $this->task->get($projectId, $domainId);
        $this->assertSame($expected, $result);
    }

    public function testGetWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-xyz';
        $envId = 'env-2';
        $expected = $this->createMock(Domain::class);

        $this->apiMock->expects($this->once())
            ->method('getProjectsEnvironmentsDomains')
            ->with($projectId, $envId, $domainId)
            ->willReturn($expected);

        $result = $this->task->get($projectId, $domainId, $envId);
        $this->assertSame($expected, $result);
    }

    public function testListWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domain1 = $this->createMock(Domain::class);
        $domain2 = $this->createMock(Domain::class);

        $this->apiMock->expects($this->once())
            ->method('listProjectsDomains')
            ->with($projectId)
            ->willReturn([$domain1, $domain2]);

        $result = $this->task->list($projectId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Domain::class, $result);
    }

    public function testListWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $domain = $this->createMock(Domain::class);

        $this->apiMock->expects($this->once())
            ->method('listProjectsEnvironmentsDomains')
            ->with($projectId, $envId)
            ->willReturn([$domain]);

        $result = $this->task->list($projectId, $envId);

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertContainsOnlyInstancesOf(Domain::class, $result);
    }

    public function testUpdateWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-1';
        $patch = ['label' => 'new-label'];
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('updateProjectsDomains')
            ->with(
                $projectId,
                $domainId,
                $this->isInstanceOf(DomainPatch::class)
            )
            ->willReturn($expected);

        $result = $this->task->update($projectId, $domainId, $patch);
        $this->assertSame($expected, $result);
    }

    public function testUpdateWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-2';
        $envId = 'env-2';
        $patch = ['label' => 'custom-env-label'];
        $expected = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('updateProjectsEnvironmentsDomains')
            ->with(
                $projectId,
                $envId,
                $domainId,
                $this->isInstanceOf(DomainPatch::class)
            )
            ->willReturn($expected);

        $result = $this->task->update($projectId, $domainId, $patch, $envId);
        $this->assertSame($expected, $result);
    }

    public function testCreateThrowsApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->apiMock->method('createProjectsDomains')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->create('proj-x', ['type' => 'a', 'hostname' => 'b']);
    }
}
