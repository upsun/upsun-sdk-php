<?php

namespace Upsun\Tests\Core\Tasks;

use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\ServicesTask;
use Upsun\Core\TokenProvider;
use Upsun\Model\ServicesValue;
use Upsun\UpsunClient;

class ServicesTaskTest extends BaseTestCase
{
    private ServicesTask $servicesTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        // $this->upsunClient = $this->createMock(UpsunClient::class);

        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

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

        $environmentsTask = new class (
            $upsunClient,
            new EnvironmentApi(...$apiClassParams),
            new EnvironmentTypeApi(...$apiClassParams),
            new DeploymentApi(...$apiClassParams)
        ) extends EnvironmentsTask {
        };
        $upsunClient->environments = $environmentsTask;

        $this->servicesTask = new class (
            $upsunClient
        ) extends ServicesTask {
        };
    }

    public function testListServices(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $services = [
            'database' => $this->createServiceValue('mariadb', '11.4'),
            'cache' => $this->createServiceValue('redis', '7.2')
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(null, services: $services), JSON_THROW_ON_ERROR)
            ));

        $result = $this->servicesTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('database', $result);
        $this->assertArrayHasKey('cache', $result);
        $this->assertInstanceOf(ServicesValue::class, $result['database']);
        $this->assertInstanceOf(ServicesValue::class, $result['cache']);
    }

    public function testListServicesReturnsEmptyArray(): void
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

        $result = $this->servicesTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    /**
     * @dataProvider servicesTypesProvider
     */
    public function testListDifferentServiceTypes(array $services): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(null, $services), JSON_THROW_ON_ERROR)
            ));

        $result = $this->servicesTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertCount(count($services), $result);
    }

    public function testListServicesWithMultipleServices(): void
    {
        $projectId = 'test-project-id';
        $environmentId = 'production';

        $services = [
            'mariadb' => $this->createServiceValue('mariadb', '11.4'),
            'redis' => $this->createServiceValue('redis', '7.2'),
            'elasticsearch' => $this->createServiceValue('elasticsearch', '8.11'),
            'postgresql' => $this->createServiceValue('postgresql', '16')
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($this->getFakeDeployment(null, services: $services), JSON_THROW_ON_ERROR)
            ));

        $result = $this->servicesTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertCount(4, $result);
        $this->assertArrayHasKey('mariadb', $result);
        $this->assertArrayHasKey('redis', $result);
        $this->assertArrayHasKey('elasticsearch', $result);
        $this->assertArrayHasKey('postgresql', $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testListServicesWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->servicesTask->list($projectId, 'main');
    }

    /**
     * @dataProvider invalidEnvironmentIdProvider
     */
    public function testListServicesWithInvalidEnvironmentId(string $environmentId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->servicesTask->list('test-project-id', $environmentId);
    }

    public function testListServicesWithDifferentEnvironments(): void
    {
        $projectId = 'test-project-id';

        $environments = ['main', 'staging', 'production', 'develop'];

        foreach ($environments as $environmentId) {
            $services = [
                'database' => $this->createServiceValue('mariadb', '11.4')
            ];

            $this->httpClient
                ->expects($this->atLeast(1))
                ->method('sendRequest')
                ->willReturn(new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($this->getFakeDeployment(null, $services), JSON_THROW_ON_ERROR)
                ));

            $result = $this->servicesTask->list($projectId, $environmentId);

            $this->assertIsArray($result);
            $this->assertCount(1, $result);
        }
    }

    private function createServiceValue(string $type, string $version): ServicesValue
    {
        return new ServicesValue(
            type: $type . ':' . $version,
            size: 'AUTO',
            access: (object)[],
            configuration: (object)[],
            relationships: [],
            supportsHorizontalScaling: false,
            disk: null,
            firewall: null,
            resources: null,
            containerProfile: null,
            endpoints: null,
            instanceCount: null
        );
    }

    public static function invalidProjectIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidEnvironmentIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function servicesTypesProvider(): array
    {
        $createService = function (string $type, string $version): ServicesValue {
            return new ServicesValue(
                type: $type . ':' . $version,
                size: 'AUTO',
                access: (object)[],
                configuration: (object)[],
                relationships: [],
                supportsHorizontalScaling: false,
                disk: null,
                firewall: null,
                resources: null,
                containerProfile: null,
                endpoints: null,
                instanceCount: null
            );
        };

        return [
            'MySQL only' => [
                ['mysql' => $createService('mysql', '8.0')]
            ],
            'Redis and PostgreSQL' => [
                ['redis' => $createService('redis', '7.2'), 'postgresql' => $createService('postgresql', '16')]
            ],
            'Complete stack' => [
                ['mariadb' => $createService('mariadb', '11.4'), 'redis' => $createService('redis', '7.2'), 'elasticsearch' => $createService('elasticsearch', '8.11')]
            ],
        ];
    }
}
