<?php

namespace Tests\Unit\Core\Tasks;

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\OperationTask;
use Upsun\API\RuntimeOperationsApi;
use Upsun\ApiException;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentOperationInput;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class OperationTaskTest extends TestCase
{
    private RuntimeOperationsApi $operationApiMock;
    private OperationTask $operationTask;

    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->operationApiMock = $this->createMock(RuntimeOperationsApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->operationTask = new class(
            $this->clientMock,
            $this->operationApiMock
        ) extends OperationTask {
            public function refreshToken(): void {}
        };
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
            ->willThrowException($this->createMock(ApiException::class));

        $this->operationTask->run('project', 'env', 'deploy', ['operation' => 'invalid']);
    }
}
