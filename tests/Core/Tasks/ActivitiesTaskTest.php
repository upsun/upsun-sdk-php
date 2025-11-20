<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\UpsunClient;

class ActivitiesTaskTest extends BaseTestCase
{
    private ActivitiesTask $activitiesTask;

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

        $this->activitiesTask = new class (
            $upsunClient,
            new ProjectActivityApi(...$apiClassParams),
            new EnvironmentActivityApi(...$apiClassParams)
        ) extends ActivitiesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelProjectActivity()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "status" => "OK",
                    "code" => 200,
                    "_embedded" => (object)['activities' => []],
                ])
            ));

        $response = $this->activitiesTask->cancel(
            projectId: "proj-id",
            activityId:  "act-213"
        );

        $this->assertNotEmpty($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetProjectActivity()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                )
            ));

        $activity = $this->activitiesTask->get(projectId: "proj-id", activityId: "act-213");

        $this->assertNotEmpty($activity);
        $this->assertEquals("proj-id", $activity->getProject());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelEnvironmentActivity()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "status" => "OK",
                    "code" => 200,
                    "_embedded" => (object)['activities' => []],
                ])
            ));

        $response = $this->activitiesTask->cancel(
            projectId: "proj-id",
            activityId: "act-213",
            environmentId: "env-123"
        );

        $this->assertNotEmpty($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetEnvironmentActivity()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                )
            ));

        $activity = $this->activitiesTask->get(
            projectId: "proj-id",
            activityId: "act-213",
            environmentId: "env-123"
        );

        $this->assertNotEmpty($activity);
        $this->assertEquals("proj-id", $activity->getProject());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectActivities()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-1',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ],
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-2',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                ])
            ));

        $response = $this->activitiesTask->list(projectId: "proj-id");

        $this->assertNotEmpty($response);
        $this->assertEquals("proj-id-1", $response[0]->getProject());
        $this->assertEquals("proj-id-2", $response[1]->getProject());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListEnvironmentActivities()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-1',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ],
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-2',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                ])
            ));

        $response = $this->activitiesTask->list(projectId: "proj-id", environmentId: "env-id");

        $this->assertNotEmpty($response);
        $this->assertEquals("proj-id-1", $response[0]->getProject());
        $this->assertEquals("proj-id-2", $response[1]->getProject());
    }
}
