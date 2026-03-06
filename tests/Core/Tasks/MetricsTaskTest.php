<?php

namespace Upsun\Tests\Core\Tasks;

use Upsun\Core\Tasks\TaskBase;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\UpsunClient;

class MetricsTaskTest extends BaseTestCase
{
    private MetricsTask $metricsTask;
    private UpsunClient $upsunClient;

    protected function setUp(): void
    {
        $this->upsunClient = $this->createMock(UpsunClient::class);

        $this->metricsTask = new class (
            $this->upsunClient
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

    /**
     * This test is a placeholder for future metrics functionality.
     * Once metrics methods are implemented, additional tests should be added.
     */
    public function testMetricsTaskStructure(): void
    {
        // Verify the task is properly constructed with UpsunClient
        $reflection = new \ReflectionClass($this->metricsTask);
        $constructor = $reflection->getConstructor();

        $this->assertNotNull($constructor);
        $this->assertCount(1, $constructor->getParameters());
        $this->assertEquals('client', $constructor->getParameters()[0]->getName());
    }
}
