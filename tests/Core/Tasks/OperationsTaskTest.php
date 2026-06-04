<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Core\Tasks\OperationsTask;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class OperationsTaskTest extends BaseTestCase
{
    private OperationsTask $operationsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            new class implements \Upsun\Core\TokenProvider
            {
                public function __invoke(bool $force = false): string
                {
                    return 'Bearer test-token';
                }
            },
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->operationsTask = new class (
            $upsunClient,
            new RuntimeOperationsApi(...$apiClassParams),
        ) extends OperationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRun(): void
    {
        $projectId = 'project-1';
        $environmentId = 'env-1';
        $deploymentId = 'deploy-1';

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

        $result = $this->operationsTask->run(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: $deploymentId,
            service: 'clear-cache',
            operation: 'cache-service',
            parameters: []
        );

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRunThrowsApiException(): void
    {
        $projectId = 'project-1';
        $environmentId = 'env-1';
        $deploymentId = 'deploy-1';

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

        $result = $this->operationsTask->run(
            projectId: $projectId,
            environmentId: $environmentId,
            deploymentId: $deploymentId,
            service: 'clear-cache',
            operation: 'cache-service',
            parameters: []
        );

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }
}
