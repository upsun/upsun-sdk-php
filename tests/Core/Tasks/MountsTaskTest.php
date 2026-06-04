<?php

namespace Upsun\Tests\Core\Tasks;

use GuzzleHttp\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use RuntimeException;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\MountsTask;
use Upsun\UpsunClient;

class MountsTaskTest extends BaseTestCase
{
    private MountsTask $mountsTask;
    private EnvironmentsTask $environmentsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            static fn (bool $force = false): string => 'Bearer test-token',
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->environmentsTask = new class (
            $upsunClient,
            new EnvironmentApi(...$apiClassParams),
            new EnvironmentTypeApi(...$apiClassParams),
            new DeploymentApi(...$apiClassParams)
        ) extends EnvironmentsTask {
        };
        $upsunClient->environments = $this->environmentsTask;

        $this->mountsTask = new class (
            $upsunClient
        ) extends MountsTask {
        };
    }

    public function testListMounts(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        // Create deployment with mounts
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('app', $result);
        $this->assertCount(3, $result['app']);
        $this->assertArrayHasKey('/var/cache', $result['app']);
        $this->assertArrayHasKey('/var/share', $result['app']);
        $this->assertArrayHasKey('/data', $result['app']);
    }

    public function testListMountsWithMultipleApplications(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId, 'webapps');

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('app', $result);
        $this->assertArrayHasKey('backend', $result);
    }

    public function testListMountsWithWorkerFilterType(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';
        $filterType = 'workers';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId, $filterType);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('app--app-worker', $result);
    }

    public function testListMountsReturnsEmptyArray(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment([], [], []), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertArrayNotHasKey('app', $result);
        $this->assertCount(0, $result);
    }

    public function testListMountsWithNoApplications(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment([]), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId, 'webapps');

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    public function testListMountsWithServices(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('mysql', $result);
    }

    public function testDownloadThrowsRuntimeException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot be implemented');

        $this->mountsTask->download('test-project-id', 'mount-id');
    }

    public function testUploadThrowsRuntimeException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot be implemented');

        $this->mountsTask->upload('test-project-id', 'mount-id', []);
    }

    /**
     * @dataProvider filterTypesProvider
     */
    public function testListMountsWithDifferentFilterTypes(string $filterType): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(), JSON_THROW_ON_ERROR)
            ));

        $result = $this->mountsTask->list($projectId, $environmentId, $filterType);

        $this->assertIsArray($result);
    }

    public static function filterTypesProvider(): array
    {
        return [
            'webapps' => ['webapps'],
            'services' => ['services'],
            'workers' => ['workers'],
        ];
    }
}
