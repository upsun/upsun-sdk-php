<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class ResourcesTaskTest extends BaseTestCase
{
    private ResourcesTask $resourcesTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $deploymentApi = new DeploymentApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->resourcesTask = new class (
            $upsunClient,
            $deploymentApi
        ) extends ResourcesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateSuccess(): void
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

        $response = $this->resourcesTask->update($projectId, $environmentId, $webapps, $services, $workers);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateWithDefaultParameters(): void
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

        $response = $this->resourcesTask->update($projectId, $environmentId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateWithOnlyWebapps(): void
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

        $response = $this->resourcesTask->update($projectId, $environmentId, $webapps);
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

        $response = $this->resourcesTask->update($projectId, $environmentId, $webapps, $services);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateError(): void
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
        $this->resourcesTask->update($projectId, $environmentId, $webapps);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateNotFound(): void
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
        $this->resourcesTask->update($projectId, $environmentId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateInvalidResources(): void
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
        $this->resourcesTask->update($projectId, $environmentId, $webapps);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateInsufficientResources(): void
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
        $this->resourcesTask->update($projectId, $environmentId, $webapps);
    }
}
