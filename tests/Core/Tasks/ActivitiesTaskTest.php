<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\UpsunClient;

class ActivitiesTaskTest extends BaseTestCase
{
    private ActivitiesTask $activitiesTask;

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

    /**
     * @throws ClientExceptionInterface
     */
    public function testListActivitiesReturnsEmptyArray(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, []));

        $response = $this->activitiesTask->list(projectId: "proj-id");

        $this->assertIsArray($response);
        $this->assertCount(0, $response);
    }

    /**
     * @dataProvider activityTypesProvider
     * @throws ClientExceptionInterface
     */
    public function testGetActivityWithDifferentTypes(string $activityType): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, [
                'type' => $activityType,
                'parameters' => (object)[],
                'project' => 'proj-id',
                'state' => 'complete',
                'completionPercent' => 100,
                'timings' => [],
                'log' => 'log content',
                'payload' => (object)[],
                'id' => '123',
            ]));

        $activity = $this->activitiesTask->get(projectId: "proj-id", activityId: "act-213");

        $this->assertNotEmpty($activity);
        $this->assertEquals($activityType, $activity->getType());
    }

    /**
     * @dataProvider activityStatesProvider
     * @throws ClientExceptionInterface
     */
    public function testGetActivityWithDifferentStates(string $state, int $completionPercent): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, [
                'type' => 'build',
                'parameters' => (object)[],
                'project' => 'proj-id',
                'state' => $state,
                'completionPercent' => $completionPercent,
                'timings' => [],
                'log' => 'log content',
                'payload' => (object)[],
                'id' => '123',
            ]));

        $activity = $this->activitiesTask->get(projectId: "proj-id", activityId: "act-213");

        $this->assertNotEmpty($activity);
        $this->assertEquals($state, $activity->getState());
        $this->assertEquals($completionPercent, $activity->getCompletionPercent());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListActivitiesWithLimit(): void
    {
        $limit = 5;
        $activities = [];

        for ($i = 0; $i < $limit; $i++) {
            $activities[] = [
                'type' => 'build',
                'parameters' => (object)[],
                'project' => 'proj-id',
                'state' => 'complete',
                'completionPercent' => 100,
                'timings' => [],
                'log' => 'log content',
                'payload' => (object)[],
                'id' => (string)$i,
            ];
        }

        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, $activities));

        $response = $this->activitiesTask->list(projectId: "proj-id");

        $this->assertCount($limit, $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelActivityNotFound(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createErrorResponse(404, 'Activity not found'));

        $this->expectException(ApiException::class);

        $this->activitiesTask->cancel(projectId: "proj-id", activityId: "nonexistent");
    }

    public static function activityTypesProvider(): array
    {
        return [
            'build' => ['build'],
            'deploy' => ['deploy'],
            'merge' => ['merge'],
            'sync' => ['sync'],
            'backup' => ['backup'],
            'restore' => ['restore'],
            'push' => ['push'],
        ];
    }

    public static function activityStatesProvider(): array
    {
        return [
            'pending' => ['pending', 0],
            'in_progress' => ['in_progress', 50],
            'complete' => ['complete', 100],
            'cancelled' => ['cancelled', 0],
            'failed' => ['failed', 75],
        ];
    }
}
