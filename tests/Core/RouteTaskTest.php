<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\RouteTask;
use Upsun\UpsunClient;
use Upsun\Api\RoutingApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Route;

class RouteTaskTest extends BaseTestCase
{
    private RouteTask $routeTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->routeTask = new class (
            $upsunClient,
            new RoutingApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration())
        ) extends RouteTask {
        };
    }

    public function testCreate(): void
    {
        $fakeRouteCreateInput = [
            'type' => 'upstream',
            'to' => 'app:http',
            'upstream' => 'my-app',
            'primary' => true,
            'id' => 'route-123',
            'productionUrl' => 'https://www.example.com',
            'attributes' => [
                'https_only' => true,
                'waf_enabled' => false,
            ],
            'tls' => [
                'minVersion' => 'TLSv1.2',
                'clientAuthentication' => 'optional',
                'strictTransportSecurity' => [
                    'enabled' => true,
                    'includeSubdomains' => true,
                    'preload' => false,
                ],
                'clientCertificateAuthorities' => [
                    '-----BEGIN CERTIFICATE-----
FAKE-CA-CERT
-----END CERTIFICATE-----',
                ],
            ],
            'redirects' => [
                'paths' => [
                    [
                        'to' => 'https://example.com',
                        'prefix' => true,
                        'appendSuffix' => false,
                        'expires' => '1h',
                        'regexp' => false,
                        'code' => 301,
                    ],
                    [
                        'to' => 'https://blog.example.com',
                        'prefix' => false,
                        'appendSuffix' => true,
                        'expires' => '2h',
                        'regexp' => true,
                        'code' => 302,
                    ],
                ],
                'expires' => '24h',
            ],
            'cache' => [
                'enabled' => true,
                'defaultTtl' => 3600,
                'cookies' => ['sessionid', 'csrftoken'],
                'headers' => ['Authorization', 'Accept-Language'],
            ],
            'ssi_enabled' => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->routeTask->create(
            'proj1',
            'env1',
            $fakeRouteCreateInput
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testDelete(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(
                new Response(
                    204,
                    ['Content-Type' => 'application/json'],
                    json_encode([
                        'status' => 'No Content',
                        'code' => 204
                    ])
                )
            );

        $this->routeTask->delete('proj1', 'env1', 'route1');
    }

    public function testGet(): void
    {
        $fakeRoute = [
            'id' => 'route1',
            'primary' => true,
            'productionUrl' => 'https://www.myapp.com',
            'attributes' => [
                'env' => 'production',
                'feature' => 'blue-green-deploy',
            ],
            'type' => 'proxy',
            'tls' => [
                'strictTransportSecurity' => [
                    'enabled' => true,
                    'includeSubdomains' => true,
                    'preload' => false,
                ],
                'minVersion' => 'TLSv1.2',
                'clientAuthentication' => 'require',
                'clientCertificateAuthorities' => [
                    '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-----END CERTIFICATE-----',
                    '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-2-----END CERTIFICATE-----',
                ],
            ],
            'to' => 'app:php',
            'upstream' => 'php:9000',
            'cache' => [
                'enabled' => true,
                'defaultTtl' => 3600,
                'cookies' => ['sessionid', 'csrftoken'],
                'headers' => ['Authorization', 'Accept-Language'],
            ],
            'redirects' => [
                'paths' => [
                    [
                        'to' => '/new-path',
                        'prefix' => true,
                        'appendSuffix' => false,
                        'expires' => '2026-01-01T00:00:00Z',
                        'regexp' => false,
                        'code' => 301,
                    ],
                ],
                'expires' => '2026-01-01T00:00:00Z',
            ],
            'ssi' => [
                'enabled' => false,
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeRoute)
            ));

        $result = $this->routeTask->get('proj1', 'env1', 'route1');
        $this->assertInstanceOf(Route::class, $result);
        $this->assertObjectProperties($result, $fakeRoute);
    }

    public function testList(): void
    {
        $list = [
            [
                'id' => 'route1',
                'primary' => true,
                'productionUrl' => 'https://www.myapp.com',
                'attributes' => [
                    'env' => 'production',
                    'feature' => 'blue-green-deploy',
                ],
                'type' => 'proxy',
                'tls' => [
                    'strictTransportSecurity' => [
                        'enabled' => true,
                        'includeSubdomains' => true,
                        'preload' => false,
                    ],
                    'minVersion' => 'TLSv1.2',
                    'clientAuthentication' => 'require',
                    'clientCertificateAuthorities' => [
                        '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-----END CERTIFICATE-----',
                        '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-2-----END CERTIFICATE-----',
                    ],
                ],
                'to' => 'app:php',
                'upstream' => 'php:8888',
                'cache' => [
                    'enabled' => true,
                    'defaultTtl' => 3600,
                    'cookies' => ['sessionid', 'csrftoken'],
                    'headers' => ['Authorization', 'Accept-Language'],
                ],
                'redirects' => [
                    'paths' => [
                        [
                            'to' => '/new-path',
                            'prefix' => true,
                            'appendSuffix' => false,
                            'expires' => '2026-01-01T00:00:00Z',
                            'regexp' => false,
                            'code' => 301,
                        ],
                    ],
                    'expires' => '2026-01-01T00:00:00Z',
                ],
                'ssi' => [
                    'enabled' => false,
                ],
            ],
            [
                'id' => 'route2',
                'primary' => false,
                'productionUrl' => 'https://route2.myapp.com',
                'attributes' => [
                    'env' => 'production',
                    'feature' => 'blue-green-deploy',
                ],
                'type' => 'proxy',
                'tls' => [
                    'strictTransportSecurity' => [
                        'enabled' => true,
                        'includeSubdomains' => true,
                        'preload' => false,
                    ],
                    'minVersion' => 'TLSv1.2',
                    'clientAuthentication' => 'require',
                    'clientCertificateAuthorities' => [
                        '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-----END CERTIFICATE-----',
                        '-----BEGIN CERTIFICATE-----FAKE-CA-DATA-2-----END CERTIFICATE-----',
                    ],
                ],
                'to' => 'app2:php',
                'upstream' => 'php:8888',
                'cache' => [
                    'enabled' => true,
                    'defaultTtl' => 3600,
                    'cookies' => ['sessionid', 'csrftoken'],
                    'headers' => ['Authorization', 'Accept-Language'],
                ],
                'redirects' => [
                    'paths' => [
                        [
                            'to' => '/new-path-2',
                            'prefix' => true,
                            'appendSuffix' => false,
                            'expires' => '2026-01-01T00:00:00Z',
                            'regexp' => false,
                            'code' => 301,
                        ],
                    ],
                    'expires' => '2026-01-01T00:00:00Z',
                ],
                'ssi' => [
                    'enabled' => false,
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->routeTask->list('proj1', 'env1');
        $this->assertContainsOnlyInstancesOf(Route::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testUpdate(): void
    {
        $fakeRoutePatch = [
            'id' => 'route-7890',
            'primary' => false,
            'productionUrl' => 'https://staging.myapp.com',
            'attributes' => [
                'env' => 'staging',
                'rollback' => 'enabled',
            ],
            'type' => 'upstream',
            'to' => 'app:node',
            'upstream' => 'node:3000',
            'tls' => [
                'strictTransportSecurity' => [
                    'enabled' => true,
                    'includeSubdomains' => false,
                    'preload' => true,
                ],
                'minVersion' => 'TLSv1.3',
                'clientAuthentication' => 'optional',
                'clientCertificateAuthorities' => [
                    '-----BEGIN CERTIFICATE-----FAKE-CA-STAGING-----END CERTIFICATE-----',
                ],
            ],
            'cache' => [
                'enabled' => true,
                'defaultTtl' => 120,
                'cookies' => ['sessionid'],
                'headers' => ['Authorization'],
            ],
            'redirects' => [
                'paths' => [
                    [
                        'to' => '/maintenance',
                        'prefix' => false,
                        'appendSuffix' => false,
                        'expires' => '2026-06-30T00:00:00Z',
                        'regexp' => true,
                        'code' => 302,
                    ],
                ],
                'expires' => '2026-06-30T00:00:00Z',
            ],
            'ssi_enabled' => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->routeTask->update(
            'proj1',
            'env1',
            'route1',
            $fakeRoutePatch
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }
}
