<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\CertManagementApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\CertificatesTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Certificate;
use Upsun\UpsunClient;

class CertificatesTaskTest extends BaseTestCase
{
    private CertificatesTask $task;

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

        $this->task = new class (
            $upsunClient,
            new CertManagementApi(...$apiClassParams),
        ) extends CertificatesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateCertificateSuccess()
    {
        $projectId = 'proj_123';
        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->task->create(
            projectId: $projectId,
            certificate: 'cert-data',
            key: 'key-data',
            chain: ['chain1', 'chain2'],
            isInvalid: false,
        );

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateCertificateError()
    {
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid certificate data'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->create(
            projectId: $projectId,
            certificate: 'cert-data',
            key: 'key-data'
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testDeleteCertificateSuccess()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_456';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->task->delete(projectId: $projectId, certificateId: $certificateId);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteCertificateError()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Certificate not found'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->delete(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetCertificateSuccess()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_456';

        $fakeCertificate = [
            'id' => 'ref1',
            'certificate' => '-----BEGIN CERTIFICATE----- ...',
            'chain' => ['chain1', 'chain2'],
            'isProvisioned' => true,
            'isInvalid' => false,
            'isRoot' => false,
            'domains' => ['example.com', 'www.example.com'],
            'authType' => ['http', 'dns'],
            'issuer' => [
                ['oid' => '1.2.3.4', 'value' => 'Issuer Name', 'alias' => 'CA']
            ],
            'expiresAt' => '2025-12-31T23:59:59+00:00',
            'createdAt' => '2025-01-01T10:00:00+00:00',
            'updatedAt' => '2025-09-26T12:00:00+00:00',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCertificate)
            ));

        $result = $this->task->get(projectId: $projectId, certificateId: $certificateId);

        $this->assertInstanceOf(Certificate::class, $result);
        $this->assertObjectProperties($result, $fakeCertificate);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCertificateError()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Certificate not found'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->get(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListCertificatesSuccess()
    {
        $projectId = 'proj_123';

        $fakeCertificates = [
            [
                'id' => 'ref1',
                'certificate' => '-----BEGIN CERTIFICATE----- ...',
                'chain' => ['chain1', 'chain2'],
                'isProvisioned' => true,
                'isInvalid' => false,
                'isRoot' => false,
                'domains' => ['example.com'],
                'authType' => ['http'],
                'issuer' => [
                    ['oid' => '1.2.3.4', 'value' => 'Issuer Name', 'alias' => 'CA']
                ],
                'expiresAt' => '2025-12-31T23:59:59+00:00',
                'createdAt' => '2025-01-01T10:00:00+00:00',
                'updatedAt' => '2025-09-26T12:00:00+00:00',
            ],
            [
                'id' => 'ref2',
                'certificate' => '-----BEGIN CERTIFICATE----- ...',
                'chain' => ['chainA', 'chainB'],
                'isProvisioned' => true,
                'isInvalid' => false,
                'isRoot' => true,
                'domains' => ['test.com'],
                'authType' => ['dns'],
                'issuer' => [
                    ['oid' => '2.3.4.5', 'value' => 'Another Issuer', 'alias' => 'CA2']
                ],
                'expiresAt' => '2026-01-31T23:59:59+00:00',
                'createdAt' => '2025-02-01T10:00:00+00:00',
                'updatedAt' => '2025-09-26T12:00:00+00:00',
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCertificates)
            ));

        $result = $this->task->list(projectId: $projectId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Certificate::class, $result);
        $this->assertObjectMatchesArray($result, $fakeCertificates);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListCertificatesError()
    {
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                500,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 500,
                    'message' => 'Internal server error'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->list(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateCertificateSuccess()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_123';
        $data = [
            'chain' => ['newChain1', 'newChain2'],
            'isInvalid' => false,
        ];

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->task->update(projectId: $projectId, certificateId: $certificateId, chain: $data);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateCertificateError()
    {
        $projectId = 'proj_123';
        $certificateId = 'cert_123';
        $data = [
            'chain' => ['newChain1'],
            'isInvalid' => true,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid certificate data'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->update(projectId: $projectId, certificateId: $certificateId, chain: $data);
    }
}
