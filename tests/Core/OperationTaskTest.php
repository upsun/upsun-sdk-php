<?php

namespace Tests\Unit\Core\Tasks;

use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\OperationTask;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\EnvironmentOperationInput;

class OperationTaskTest extends TestCase
{
    private RuntimeOperationsApi $operationApiMock;
    private OperationTask $operationTask;

    protected function setUp(): void
    {
        $this->operationApiMock = $this->createMock(RuntimeOperationsApi::class);

        $this->operationTask = new class(
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
            ->willThrowException(new ApiException('API error'));

        $this->operationTask->run('project', 'env', 'deploy', ['operation' => 'invalid']);
    }
}
