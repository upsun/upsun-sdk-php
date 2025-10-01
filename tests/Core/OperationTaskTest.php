<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\OperationTask;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\ApiException;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class OperationTaskTest extends BaseTestCase
{
    private OperationTask $operationTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $runtimeOperationApi = new RuntimeOperationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->operationTask = new class (
            $upsunClient,
            $runtimeOperationApi
        ) extends OperationTask {
        };
    }

    public function testRun(): void
    {
        $projectId = 'project-1';
        $environmentId = 'env-1';
        $deploymentId = 'deploy-1';
        $inputArray = [
            'operation' => 'clear-cache',
            'service' => 'cache-service',
            'parameters' => []
        ];
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->operationTask->run($projectId, $environmentId, $deploymentId, $inputArray);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    public function testRunThrowsApiException(): void
    {
        $projectId = 'project-1';
        $environmentId = 'env-1';
        $deploymentId = 'deploy-1';
        $inputArray = [
            'operation' => 'unknown-operation',
            'service' => 'cache-service',
            'parameters' => []
        ];

        $this->expectException(ApiException::class);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'Forbidden',
                    'code' => 403
                ])
            ));

        $this->operationTask->run($projectId, $environmentId, $deploymentId, $inputArray);
    }
}
