<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\AutoscalingApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\ResourcesApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class ResourcesTaskTest extends BaseTestCase
{
    private ResourcesTask $resourcesTask;

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

        $this->resourcesTask = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams),
            new AutoscalingApi(...$apiClassParams),
            new ResourcesApi(...$apiClassParams),
        ) extends ResourcesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetSuccess(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'resources' => [
                    'profile_size' => 'large'
                ],
                'disk' => 2048,
                'instance_count' => 2
            ]
        ];
        $services = [
            'mysql' => [
                'resources' => [
                    'profile_size' => 'medium'
                ],
                'disk' => 1024,
                'instance_count' => 1
            ]
        ];
        $workers = [
            'worker1' => [
                'resources' => [
                    'profile_size' => 'small'
                ],
                'disk' => 512,
                'instance_count' => 4
            ]
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

        $response = $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps,
            services: $services,
            workers: $workers
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetWithDefaultParameters(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';

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

        $response = $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetWithOnlyWebapps(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'resources' => [
                    'profile_size' => 'xlarge'
                ],
                'disk' => 4096,
                'instance_count' => 4
            ]
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

        $response = $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateWithPartialResources(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'disk' => 2048
            ]
        ];
        $services = [
            'redis' => [
                'instance_count' => 2
            ]
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

        $response = $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps,
            services: $services
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetError(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'resources' => [
                    'profile_size' => 'large'
                ]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403,
                    'message' => 'Access denied'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->resourcesTask->set(projectId: $projectId, environmentId: $environmentId, webapps: $webapps);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetNotFound(): void
    {
        $projectId = 'invalidProject';
        $environmentId = 'env456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404,
                    'message' => 'Project or environment not found'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->resourcesTask->set(projectId: $projectId, environmentId: $environmentId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetInvalidResources(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'resources' => [
                    'profile_size' => 'invalid_size'
                ]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'bad_request',
                    'code' => 400,
                    'message' => 'Invalid profile size'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSetInsufficientResources(): void
    {
        $projectId = 'project123';
        $environmentId = 'env456';
        $webapps = [
            'app1' => [
                'resources' => [
                    'profile_size' => 'xlarge'
                ],
                'instance_count' => 100
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                402,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'payment_required',
                    'code' => 402,
                    'message' => 'Insufficient resources or quota exceeded'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->resourcesTask->set(
            projectId: $projectId,
            environmentId: $environmentId,
            webapps: $webapps
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testPatchAutoscalerSettingsSuccess(): void
    {
        $expectedData = [
            'services' => [
                'db' => [
                    'mysql' => [
                        'instances' => ['min' => 1, 'max' => 3]
                    ]
                ]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->resourcesTask->patchAutoscalerSettings(
            projectId: 'project123',
            environmentId: 'env456'
        );

        $this->assertObjectProperties($result, $expectedData);
    }
}
