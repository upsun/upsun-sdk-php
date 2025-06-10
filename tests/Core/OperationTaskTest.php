<?php

namespace Tests\Unit\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\OperationTask;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;

class OperationTaskTest extends TestCase
{
    private UpsunClient $clientMock;
    private RuntimeOperationsApi $operationApiMock;
    private OperationTask $operationTask;

    protected function setUp(): void
    {
        // Client mock avec propriétés publiques comme dans BackupTaskTest
        $this->clientMock = new class() extends UpsunClient {
            public Client $apiClient;
            public Configuration $apiConfig;
            public function __construct() {}
        };

        $this->clientMock->apiClient = $this->createMock(Client::class);
        $this->clientMock->apiConfig = $this->createMock(Configuration::class);

        // API mock
        $this->operationApiMock = $this->createMock(RuntimeOperationsApi::class);

        // OperationTask avec injection contrôlée du mock
        $this->operationTask = new class($this->clientMock) extends OperationTask {
            private ?RuntimeOperationsApi $mockApi = null;

            public function refreshToken(): void {} // no-op

            public function setMockApi(RuntimeOperationsApi $mock): void
            {
                $this->mockApi = $mock;
            }

            public function getApi(): RuntimeOperationsApi
            {
                return $this->mockApi ?? parent::getApi();
            }
        };

        $this->operationTask->setMockApi($this->operationApiMock);
    }

    public function testRunReturnsAcceptedResponse(): void
    {
        $projectId = 'project-1';
        $environmentId = 'env-1';
        $deploymentId = 'deploy-1';
        $inputArray = ['operation' => 'clear-cache'];

        $expectedResponse = $this->createMock(AcceptedResponse::class);

        $this->operationApiMock->expects($this->once())
            ->method('runOperation')
            ->with(
                $projectId,
                $environmentId,
                $deploymentId,
                $this->isInstanceOf(EnvironmentOperationInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->operationTask->run($projectId, $environmentId, $deploymentId, $inputArray);

        $this->assertSame($expectedResponse, $result);
    }

    public function testRunThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->operationApiMock->method('runOperation')
            ->willThrowException(new ApiException('API error'));

        $this->operationTask->run('project', 'env', 'deploy', ['operation' => 'invalid']);
    }
}
