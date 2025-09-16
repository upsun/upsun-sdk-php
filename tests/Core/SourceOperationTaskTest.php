<?php

namespace Upsun\Test\Core;

use Upsun\Api\SourceOperationsApi;
use Upsun\Configuration;
use Upsun\Model\EnvironmentSourceOperationInput;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\UpsunClient;
use Upsun\Model\AcceptedResponse;
use Upsun\ApiException;
use Upsun\UpsunConfig;

class SourceOperationTaskTest extends TestCase
{
    private SourceOperationTask $task;
    private SourceOperationsApi $apiMock;
    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->apiMock = $this->createMock(SourceOperationsApi::class);
        
        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->task = new class(
            $this->clientMock,
            $this->apiMock
        ) extends SourceOperationTask {
            public function refreshToken(): void
            {
            }
        };
    }

    public function testRunSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('runSourceOperation')
            ->with('project1', 'env1', $this->isInstanceOf(EnvironmentSourceOperationInput::class))
            ->willReturn($response);

        $result = $this->task->run('project1', 'env1', ['operation' => 'op1']);
        $this->assertSame($response, $result);
    }

    public function testEnableThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('runSourceOperation')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->run('project1', 'env1', ['operation' => 'op1']);
    }

    public function testListSuccess(): void
    {
        $response = [];

        $this->apiMock->expects($this->once())
            ->method('listProjectsEnvironmentsSourceOperations')
            ->with('project1', 'env1')
            ->willReturn($response);

        $result = $this->task->list('project1', 'env1');
        $this->assertSame($response, $result);
    }

    public function testDisableThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('listProjectsEnvironmentsSourceOperations')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->list('project1', 'env1');
    }
}
