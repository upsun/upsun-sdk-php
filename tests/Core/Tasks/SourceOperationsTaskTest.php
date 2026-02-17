<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\SourceOperationsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\UpsunClient;

class SourceOperationsTaskTest extends BaseTestCase
{
    private SourceOperationsTask $task;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
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
            new SourceOperationsApi(...$apiClassParams)
        ) extends SourceOperationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRun(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

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

        $result = $this->task->run(
            projectId: $projectId,
            environmentId: $environmentId,
            operation: 'sync',
            variables: []
        );

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testList(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $fakeEnvironmentOperations = [
            [
                'id' => 'op-12345',
                'app' => 'backend',
                'operation' => 'deploy',
                'command' => 'php artisan migrate --force',
            ],
            [
                'id' => 'op-67890',
                'app' => 'frontend',
                'operation' => 'build',
                'command' => 'npm run build',
            ],
            [
                'id' => 'op-54321',
                'app' => 'worker',
                'operation' => 'restart',
                'command' => 'supervisorctl restart all',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeEnvironmentOperations)
            ));

        $result = $this->task->list(projectId: $projectId, environmentId: $environmentId);

        $this->assertContainsOnlyInstancesOf(EnvironmentSourceOperation::class, $result);
        $this->assertObjectMatchesArray($result, $fakeEnvironmentOperations);
    }
}
