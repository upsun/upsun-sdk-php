<?php

namespace Upsun\Tests\Core\Tasks;

use DateTime;
use Error;
use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\EntrypointApi;
use Upsun\Api\LogsApi;
use Upsun\Core\Tasks\ObservabilityTask;
use Upsun\Core\TokenProvider;
use Upsun\Model\LogsQuery200Response;
use Upsun\UpsunClient;

class ObservabilityTaskTest extends BaseTestCase
{
    private ObservabilityTask $task;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    private ?RequestInterface $sentRequest = null;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $apiClassParams = [
            new class implements TokenProvider
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

        $this->task = new class (
            $this->createMock(UpsunClient::class),
            new EntrypointApi(...$apiClassParams),
            new LogsApi(...$apiClassParams)
        ) extends ObservabilityTask {
        };
    }

    /**
     * The request tests answer with a server error: the generated API builds the request for real,
     * and the test reads it without a full response fixture.
     */
    private function captureRequest(callable $call): RequestInterface
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request): Response {
                $this->sentRequest = $request;

                return new Response(500, ['Content-Type' => 'application/json'], '{"message":"error"}');
            });

        try {
            $call();
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException) {
        }

        return $this->sentRequest;
    }

    /**
     * @return array<string, string|string[]>
     */
    private function queryOf(RequestInterface $request): array
    {
        $query = [];
        foreach (explode('&', $request->getUri()->getQuery()) as $pair) {
            [$key, $value] = array_map('urldecode', explode('=', $pair, 2));
            if (str_ends_with($key, '[]')) {
                $query[$key][] = $value;
            } else {
                $query[$key] = $value;
            }
        }

        return $query;
    }

    public function testEntrypointGetsTheObservabilityRootOfTheEnvironment(): void
    {
        $request = $this->captureRequest(fn () => $this->task->entrypoint('proj-1', 'main'));

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/projects/proj-1/environments/main/observability', $request->getUri()->getPath());
    }

    public function testLogsOverviewSendsTheTimeRangeAndTheFilters(): void
    {
        $request = $this->captureRequest(fn () => $this->task->logsOverview(
            'proj-1',
            'main',
            1700000000,
            1700003600,
            ['severities' => ['ERROR', 'CRITICAL'], 'severitiesMode' => '1', 'services' => ['app']]
        ));

        $this->assertSame(
            '/projects/proj-1/environments/main/observability/logs/overview',
            $request->getUri()->getPath()
        );
        $query = $this->queryOf($request);
        $this->assertSame('1700000000', $query['from']);
        $this->assertSame('1700003600', $query['to']);
        $this->assertSame(['ERROR', 'CRITICAL'], $query['severities[]']);
        $this->assertSame('1', $query['severities_mode']);
        $this->assertSame(['app'], $query['services[]']);
    }

    public function testLogsQuerySendsTheOrderTheCursorAndTheFilters(): void
    {
        $request = $this->captureRequest(fn () => $this->task->logsQuery(
            'proj-1',
            'main',
            1700000000,
            1700003600,
            ['order' => 'ASC', 'cursor' => 'next-page', 'hosts' => ['web-1', 'web-2'], 'hostsMode' => '-1']
        ));

        $this->assertSame(
            '/projects/proj-1/environments/main/observability/logs/query',
            $request->getUri()->getPath()
        );
        $query = $this->queryOf($request);
        $this->assertSame('ASC', $query['order']);
        $this->assertSame('next-page', $query['cursor']);
        $this->assertSame(['web-1', 'web-2'], $query['hosts[]']);
        $this->assertSame('-1', $query['hosts_mode']);
    }

    public function testLogsQueryReturnsTheLogEntriesAsModels(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode([
                '_from' => 1,
                '_to' => 2,
                '_order' => 'DESC',
                '_project_id' => 'proj-1',
                '_environment_id' => 'main',
                '_branch_machine_name' => 'main-abc',
                '_has_more_results' => false,
                '_links' => ['self' => ['href' => '/self'], 'overview' => ['href' => '/overview']],
                'data' => [[
                    'cursor' => 'c1',
                    'datetime' => '2026-11-16T10:00:00Z',
                    'severity' => 'ERROR',
                    'container_id' => 'abc',
                    'content' => 'boom',
                ]],
            ])));

        $result = $this->task->logsQuery('proj-1', 'main', 1, 2);

        $this->assertInstanceOf(LogsQuery200Response::class, $result);
        $this->assertCount(1, $result->getData());
        $entry = $result->getData()[0];
        $this->assertEquals(new DateTime('2026-11-16T10:00:00Z'), $entry->getDatetime());
        $this->assertSame('abc', $entry->getContainerId());
        $this->assertSame('boom', $entry->getContent());
    }

    public function testFiltersCannotReplaceTheIdsOfTheArguments(): void
    {
        $this->httpClient->expects($this->never())->method('sendRequest');
        $this->expectException(Error::class);

        $this->task->logsOverview('proj-1', 'main', 1, 2, ['projectId' => 'other']);
    }

    public function testAnUnknownFilterIsRejected(): void
    {
        $this->httpClient->expects($this->never())->method('sendRequest');
        $this->expectException(Error::class);

        $this->task->logsQuery('proj-1', 'main', 1, 2, ['severity' => ['ERROR']]);
    }

    /**
     * @dataProvider invalidIdsProvider
     */
    public function testEveryMethodChecksTheIds(string $method, string $projectId, string $environmentId): void
    {
        $this->httpClient->expects($this->never())->method('sendRequest');
        $this->expectException(InvalidArgumentException::class);

        $method === 'entrypoint'
            ? $this->task->entrypoint($projectId, $environmentId)
            : $this->task->$method($projectId, $environmentId, 1, 2);
    }

    public static function invalidIdsProvider(): array
    {
        $cases = [];
        foreach (['entrypoint', 'logsOverview', 'logsQuery'] as $method) {
            $cases["$method without project ID"] = [$method, '', 'main'];
            $cases["$method without environment ID"] = [$method, 'proj-1', ' '];
        }

        return $cases;
    }
}
