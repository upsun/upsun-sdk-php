<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\BlackfireMonitoringApi;
use Upsun\Api\BlackfireProfilingApi;
use Upsun\Api\ContinuousProfilingApi;
use Upsun\Api\EntrypointApi;
use Upsun\Api\HttpTrafficApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\TaskBase;
use Upsun\Model\BlackfireProfileGraph200Response;
use Upsun\Model\BlackfireProfileProfile200Response;
use Upsun\Model\BlackfireProfilesList200Response;
use Upsun\Model\BlackfireProfilesRecommendations200Response;
use Upsun\Model\BlackfireProfileSubprofiles200Response;
use Upsun\Model\BlackfireProfileTimeline200Response;
use Upsun\Model\ObservabilityEntrypoint200Response;
use Upsun\UpsunClient;

class MetricsTaskTest extends BaseTestCase
{
    private MetricsTask $metricsTask;

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

        $this->metricsTask = new class (
            $upsunClient,
            new HttpTrafficApi(...$apiClassParams),
            new BlackfireMonitoringApi(...$apiClassParams),
            new ContinuousProfilingApi(...$apiClassParams),
            new BlackfireProfilingApi(...$apiClassParams),
            new EntrypointApi(...$apiClassParams),
        ) extends MetricsTask {
        };
    }

    public function testMetricsTaskCanBeInstantiated(): void
    {
        $this->assertInstanceOf(MetricsTask::class, $this->metricsTask);
    }

    public function testMetricsTaskExtendsTaskBase(): void
    {
        $this->assertInstanceOf(TaskBase::class, $this->metricsTask);
    }

    public function testMetricsTaskStructure(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $constructor = $reflection->getConstructor();

        $this->assertNotNull($constructor);
        $this->assertCount(6, $constructor->getParameters());
        $this->assertEquals('client', $constructor->getParameters()[0]->getName());
    }

    public function testHttpMetricsTimelineIpsMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('httpMetricsTimelineIps'));
        $this->assertTrue($reflection->getMethod('httpMetricsTimelineIps')->isPublic());
    }

    public function testHttpMetricsTimelineUrlsMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('httpMetricsTimelineUrls'));
        $this->assertTrue($reflection->getMethod('httpMetricsTimelineUrls')->isPublic());
    }

    public function testHttpMetricsTimelineUserAgentsMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('httpMetricsTimelineUserAgents'));
        $this->assertTrue($reflection->getMethod('httpMetricsTimelineUserAgents')->isPublic());
    }

    public function testBlackfirePhpServerCachesMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('blackfirePhpServerCaches'));
        $this->assertTrue($reflection->getMethod('blackfirePhpServerCaches')->isPublic());
    }

    public function testBlackfireServerGlobalMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('blackfireServerGlobal'));
        $this->assertTrue($reflection->getMethod('blackfireServerGlobal')->isPublic());
    }

    public function testBlackfireServerTopSpansMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('blackfireServerTopSpans'));
        $this->assertTrue($reflection->getMethod('blackfireServerTopSpans')->isPublic());
    }

    public function testBlackfireServerTransactionsBreakdownMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('blackfireServerTransactionsBreakdown'));
        $this->assertTrue($reflection->getMethod('blackfireServerTransactionsBreakdown')->isPublic());
    }

    public function testListContinuousProfilingApplicationsMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('listContinuousProfilingApplications'));
        $this->assertTrue($reflection->getMethod('listContinuousProfilingApplications')->isPublic());
    }

    public function testGetContinuousProfilingApplicationFilterMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('getContinuousProfilingApplicationFilter'));
        $this->assertTrue($reflection->getMethod('getContinuousProfilingApplicationFilter')->isPublic());
    }

    public function testGetContinuousProfilingApplicationMergeMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('getContinuousProfilingApplicationMerge'));
        $this->assertTrue($reflection->getMethod('getContinuousProfilingApplicationMerge')->isPublic());
    }

    public function testGetContinuousProfilingApplicationTimelineMethod(): void
    {
        $reflection = new \ReflectionClass($this->metricsTask);
        $this->assertTrue($reflection->hasMethod('getContinuousProfilingApplicationTimeline'));
        $this->assertTrue($reflection->getMethod('getContinuousProfilingApplicationTimeline')->isPublic());
    }

    public function testHttpMetricsTimelineIpsWithInvalidProjectId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->metricsTask->httpMetricsTimelineIps('', 'env456', 1, 2);
    }

    public function testBlackfireServerGlobalWithEmptyKeys(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->metricsTask->blackfireServerGlobal('project123', 'env456', 1, 2, []);
    }

    public function testGetContinuousProfilingApplicationFilterWithEmptyApplicationName(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->metricsTask->getContinuousProfilingApplicationFilter('project123', 'env456', '');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfileGraphSuccess(): void
    {
        $payload = $this->createBlackfireGraphPayload();

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfileGraph(
            'project123',
            'env456',
            '123e4567-e89b-12d3-a456-426614174000'
        );

        $this->assertInstanceOf(BlackfireProfileGraph200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfileProfileSuccess(): void
    {
        $payload = [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'profile' => (object) ['wt' => 12.3]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfileProfile(
            'project123',
            'env456',
            '123e4567-e89b-12d3-a456-426614174000'
        );

        $this->assertInstanceOf(BlackfireProfileProfile200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfileSubprofilesSuccess(): void
    {
        $payload = [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'subprofiles' => (object) ['child' => (object) ['uuid' => 'uuid-child']]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfileSubprofiles(
            'project123',
            'env456',
            '123e4567-e89b-12d3-a456-426614174000'
        );

        $this->assertInstanceOf(BlackfireProfileSubprofiles200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfileTimelineSuccess(): void
    {
        $payload = [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'timeline' => (object) ['samples' => []],
            'dimension' => 'wt',
            'time' => 123,
            'language' => 'php'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfileTimeline(
            'project123',
            'env456',
            '123e4567-e89b-12d3-a456-426614174000'
        );

        $this->assertInstanceOf(BlackfireProfileTimeline200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfilesListSuccess(): void
    {
        $payload = [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'profiles' => [],
            'page' => 1,
            'pages' => 1,
            'total' => 0
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfilesList('project123', 'env456');

        $this->assertInstanceOf(BlackfireProfilesList200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBlackfireProfilesRecommendationsSuccess(): void
    {
        $payload = [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'from' => 100,
            'to' => 200,
            'recommendations' => [],
            'total' => 0,
            'transaction' => 'GET /',
            'testedTransactions' => [],
            'untestedTopTransactions' => []
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->blackfireProfilesRecommendations('project123', 'env456', 100, 200);

        $this->assertInstanceOf(BlackfireProfilesRecommendations200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testObservabilityEntrypointSuccess(): void
    {
        $payload = [
            'message' => 'Observability entrypoint',
            'projectId' => 'project123',
            'branchMachineName' => 'main-abc123',
            'environmentId' => 'env456',
            'environmentType' => 'production',
            'vendor' => 'upsun',
            'pshUserIdentifier' => 'user-123',
            'links' => [
                'self' => ['href' => 'https://api.example.test/observability'],
                'resourcesByService' => [
                    ['name' => 'app', 'href' => 'https://api.example.test/observability/resources/app']
                ],
                'resourcesOverview' => ['href' => 'https://api.example.test/resources-overview'],
                'resourcesSummary' => ['href' => 'https://api.example.test/resources-summary'],
                'blackfirePhpServerCaches' => ['href' => 'https://api.example.test/php-caches'],
                'blackfireServerGlobal' => ['href' => 'https://api.example.test/server-global'],
                'blackfireServerTransactionsBreakdown' => ['href' => 'https://api.example.test/server-breakdown'],
                'logsQuery' => ['href' => 'https://api.example.test/logs-query'],
                'logsOverview' => ['href' => 'https://api.example.test/logs-overview'],
                'httpMetricsTimelineUrls' => ['href' => 'https://api.example.test/http-urls'],
                'httpMetricsTimelineIps' => ['href' => 'https://api.example.test/http-ips'],
                'httpMetricsTimelineUserAgents' => ['href' => 'https://api.example.test/http-uas'],
                'consoleSandboxAccess' => ['href' => 'https://api.example.test/console'],
                'conprofApplications' => ['href' => 'https://api.example.test/conprof-apps'],
                'conprofApplicationFilters' => ['href' => 'https://api.example.test/conprof-filters'],
                'conprofTimeline' => ['href' => 'https://api.example.test/conprof-timeline'],
                'conprofFlamegraph' => ['href' => 'https://api.example.test/conprof-flamegraph']
            ],
            'retention' => [
                'resources' => 60,
                'logs' => 60,
                'httpTraffic' => 60,
                'continuousProfiling' => 60
            ],
            'dataRetention' => [
                'unit' => 'minute',
                'unitInSeconds' => 60,
                'resources' => ['retentionPeriod' => 60, 'maxRange' => 60, 'recommendedDefaultRange' => 15],
                'serverMonitoring' => ['retentionPeriod' => 60, 'maxRange' => 60, 'recommendedDefaultRange' => 15],
                'logs' => ['retentionPeriod' => 60, 'maxRange' => 60, 'recommendedDefaultRange' => 15],
                'httpTraffic' => ['retentionPeriod' => 60, 'maxRange' => 60, 'recommendedDefaultRange' => 15],
                'continuousProfiling' => ['retentionPeriod' => 60, 'maxRange' => 60, 'recommendedDefaultRange' => 15]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode($payload)));

        $result = $this->metricsTask->observabilityEntrypoint('project123', 'env456');

        $this->assertInstanceOf(ObservabilityEntrypoint200Response::class, $result);
        $this->assertObjectProperties($result, $payload);
    }

    private function createBlackfireGraphPayload(): array
    {
        return [
            'projectId' => 'project123',
            'environmentId' => 'env456',
            'branchMachineName' => 'main-abc123',
            'agent' => 'blackfire',
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'dimensions' => (object) ['wt' => 'Wall Time'],
            'root' => 'n1',
            'nodes' => (object) ['n1' => (object) ['label' => 'main']],
            'edges' => (object) [],
            'comparison' => false,
            'language' => 'php'
        ];
    }
}
