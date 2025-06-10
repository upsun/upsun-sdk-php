<?php

namespace Tests\Upsun\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\CertManagementApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Certificate;
use OpenAPI\Client\Model\CertificateCreateInput;
use OpenAPI\Client\Model\CertificatePatch;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\CertificateTask;
use Upsun\UpsunClient;

class CertificateTaskTest extends TestCase
{
    private $clientMock;
    private $apiMock;
    private $task;

    protected function setUp(): void
    {
        $this->clientMock = new class() extends UpsunClient {
            public Client $apiClient;
            public Configuration $apiConfig;
            public function __construct() {}
        };

        $this->clientMock->apiClient = $this->createMock(Client::class);
        $this->clientMock->apiConfig = $this->createMock(Configuration::class);

        $this->apiMock = $this->createMock(CertManagementApi::class);

        $this->task = new class($this->clientMock) extends CertificateTask {
            private ?CertManagementApi $mockApi = null;

            public function refreshToken(): void {}
            public function setMockApi(CertManagementApi $mock): void
            {
                $this->mockApi = $mock;
            }
            public function getApi(): CertManagementApi
            {
                return $this->mockApi ?? parent::getApi();
            }
        };

        $this->task->setMockApi($this->apiMock);
    }

    public function testCreateCertificate(): void
    {
        $projectId = 'proj-123';
        $input = ['certificate' => 'data', 'key' => 'secret'];
        $expectedResponse = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('createProjectsCertificates')
            ->with($projectId, $this->isInstanceOf(CertificateCreateInput::class))
            ->willReturn($expectedResponse);

        $result = $this->task->create($projectId, $input);
        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteCertificate(): void
    {
        $projectId = 'proj-123';
        $certId = 'cert-abc';
        $expectedResponse = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('deleteProjectsCertificates')
            ->with($projectId, $certId)
            ->willReturn($expectedResponse);

        $result = $this->task->delete($projectId, $certId);
        $this->assertSame($expectedResponse, $result);
    }

    public function testGetCertificate(): void
    {
        $projectId = 'proj-123';
        $certId = 'cert-xyz';
        $expected = $this->createMock(Certificate::class);

        $this->apiMock->expects($this->once())
            ->method('getProjectsCertificates')
            ->with($projectId, $certId)
            ->willReturn($expected);

        $result = $this->task->get($projectId, $certId);
        $this->assertSame($expected, $result);
    }

    public function testListCertificates(): void
    {
        $projectId = 'proj-123';
        $cert1 = $this->createMock(Certificate::class);
        $cert2 = $this->createMock(Certificate::class);

        $this->apiMock->expects($this->once())
            ->method('listProjectsCertificates')
            ->with($projectId)
            ->willReturn([$cert1, $cert2]);

        $result = $this->task->list($projectId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Certificate::class, $result);
    }

    public function testUpdateCertificate(): void
    {
        $projectId = 'proj-123';
        $certId = 'cert-456';
        $patch = ['label' => 'updated-cert'];
        $expectedResponse = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('updateProjectsCertificates')
            ->with(
                $projectId,
                $certId,
                $this->isInstanceOf(CertificatePatch::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->task->update($projectId, $certId, $patch);
        $this->assertSame($expectedResponse, $result);
    }

    public function testApiExceptionOnCreate(): void
    {
        $this->expectException(ApiException::class);
        $this->apiMock->method('createProjectsCertificates')->willThrowException(new ApiException("Erreur"));
        $this->task->create('proj-id', ['certificate' => 'data', 'key' => 'key']);
    }
}
