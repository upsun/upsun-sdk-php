<?php

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\RouteTask;
use Upsun\UpsunClient;
use Upsun\API\RoutingApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Route;
use Upsun\ApiException;
use Upsun\UpsunConfig;

class RouteTaskTest extends TestCase
{
    private RouteTask $task;
    private RoutingApi $apiMock;
    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->apiMock = $this->createMock(RoutingApi::class);
        
        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };

        $this->task = new class(
            $this->clientMock,
            $this->apiMock
        ) extends RouteTask {
            public function refreshToken(): void
            {
            }
        };
        
//        $this->task = new RouteTask($this->clientMock, $this->apiMock);
    }

    public function testCreateSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('createProjectsEnvironmentsRoutes')
            ->willReturn($response);

        $result = $this->task->create('proj1', 'env1', ['id' => 'r1']);
        $this->assertSame($response, $result);
    }

    public function testCreateThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('createProjectsEnvironmentsRoutes')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->create('proj1', 'env1', []);
    }

    public function testDeleteSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('deleteProjectsEnvironmentsRoutes')
            ->willReturn($response);

        $result = $this->task->delete('proj1', 'env1', 'route1');
        $this->assertSame($response, $result);
    }

    public function testDeleteThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('deleteProjectsEnvironmentsRoutes')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->delete('proj1', 'env1', 'route1');
    }

    public function testGetSuccess(): void
    {
        $route = $this->createMock(Route::class);

        $this->apiMock->expects($this->once())
            ->method('getProjectsEnvironmentsRoutes')
            ->willReturn($route);

        $result = $this->task->get('proj1', 'env1', 'route1');
        $this->assertSame($route, $result);
    }

    public function testGetThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('getProjectsEnvironmentsRoutes')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->get('proj1', 'env1', 'route1');
    }

    public function testListSuccess(): void
    {
        $routes = [
            $this->createMock(Route::class),
            $this->createMock(Route::class),
        ];

        $this->apiMock->expects($this->once())
            ->method('listProjectsEnvironmentsRoutes')
            ->willReturn($routes);

        $result = $this->task->list('proj1', 'env1');
        $this->assertSame($routes, $result);
    }

    public function testListThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('listProjectsEnvironmentsRoutes')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->list('proj1', 'env1');
    }

    public function testUpdateSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('updateProjectsEnvironmentsRoutes')
            ->willReturn($response);

        $result = $this->task->update('proj1', 'env1', 'route1', ['label' => 'test']);
        $this->assertSame($response, $result);
    }

    public function testUpdateThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('updateProjectsEnvironmentsRoutes')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->update('proj1', 'env1', 'route1', ['label' => 'fail']);
    }
}
