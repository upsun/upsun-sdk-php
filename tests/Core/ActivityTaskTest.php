<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\Activity;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\UpsunClient;
use Nyholm\Psr7\Factory\Psr17Factory;

class ActivityTaskTest extends TestCase
{
    private ActivityTask $activityTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $projectActivityApi = new ProjectActivityApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $environmentActivityApi = new EnvironmentActivityApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->activityTask = new class (
            $upsunClient,
            $projectActivityApi,
            $environmentActivityApi
        ) extends ActivityTask {
        };
    }

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
                    "_embedded" => (object) ['activities' => []],
                ])
            ));

        /** @var Activity $activity */
        $response = $this->activityTask->cancel("proj-id", "act-213");

        $this->assertNotEmpty($response);
    }

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

        /** @var Activity $activity */
        $activity = $this->activityTask->get("proj-id", "act-213");

        $this->assertNotEmpty($activity);
        $this->assertEquals("proj-id", $activity->getProject());
    }

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
                    "_embedded" => (object) ['activities' => []],
                ])
            ));

        /** @var Activity $activity */
        $response = $this->activityTask->cancel("proj-id", "act-213", "env-123");

        $this->assertNotEmpty($response);
    }

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

        /** @var Activity $activity */
        $activity = $this->activityTask->get("proj-id", "act-213", "env-123");

        $this->assertNotEmpty($activity);
        $this->assertEquals("proj-id", $activity->getProject());
    }

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

        /** @var Activity $activity */
        $response = $this->activityTask->list("proj-id");

        $this->assertNotEmpty($response);
        $this->assertEquals("proj-id-1", $response[0]->getProject());
        $this->assertEquals("proj-id-2", $response[1]->getProject());
    }

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

        /** @var Activity $activity */
        $response = $this->activityTask->list("proj-id", "env-id");

        $this->assertNotEmpty($response);
        $this->assertEquals("proj-id-1", $response[0]->getProject());
        $this->assertEquals("proj-id-2", $response[1]->getProject());
    }
}
