<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\SourceOperationsApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\UpsunClient;
use Upsun\Model\AcceptedResponse;

class SourceOperationsTaskTest extends BaseTestCase
{
    private SourceOperationsTask $task;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->task = new class (
            $upsunClient,
            new SourceOperationsApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration())
        ) extends SourceOperationsTask {
        };
    }

    public function testRun(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = [
            'operation' => 'sync',
            'variables' => []
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

        $result = $this->task->run($projectId, $environmentId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

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

        $result = $this->task->list($projectId, $environmentId);

        $this->assertContainsOnlyInstancesOf(EnvironmentSourceOperation::class, $result);
        $this->assertObjectMatchesArray($result, $fakeEnvironmentOperations);
    }
}
