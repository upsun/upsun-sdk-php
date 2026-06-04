<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
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
}
