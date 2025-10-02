<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\ApiException;
use Upsun\Api\CertManagementApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Certificate;
use Upsun\Core\Tasks\CertificateTask;
use Upsun\UpsunClient;

class CertificateTaskTest extends BaseTestCase
{
    private CertificateTask $task;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->task = new class (
            $upsunClient,
            new CertManagementApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
        ) extends CertificateTask {
        };
    }

    public function testCreateCertificateSuccess()
    {
        $projectId = 'proj_123';
        $options = [
            'certificate' => 'cert-data',
            'key' => 'key-data',
            'chain' => ['chain1', 'chain2'],
            'isInvalid' => false,
        ];

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

        $result = $this->task->create($projectId, $options);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    public function testCreateCertificateError()
    {
        $projectId = 'proj_123';
        $options = [
            'certificate' => 'cert-data',
            'key' => 'key-data',
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

        $this->task->create($projectId, $options);
    }

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

        $result = $this->task->delete($projectId, $certificateId);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

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

        $this->task->delete($projectId, $certificateId);
    }

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

        $result = $this->task->get($projectId, $certificateId);

        $this->assertInstanceOf(Certificate::class, $result);
        $this->assertObjectProperties($result, $fakeCertificate);
    }

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

        $this->task->get($projectId, $certificateId);
    }

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

        $result = $this->task->list($projectId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Certificate::class, $result);
        $this->assertObjectMatchesArray($result, $fakeCertificates);
    }

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

        $this->task->list($projectId);
    }

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

        $result = $this->task->update($projectId, $certificateId, $data);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

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

        $this->task->update($projectId, $certificateId, $data);
    }
}
