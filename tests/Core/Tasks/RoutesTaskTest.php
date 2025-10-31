<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\RoutingApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Model\Route;
use Upsun\UpsunClient;

class RoutesTaskTest extends BaseTestCase
{
    private RoutesTask $routesTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->routesTask = new class (
            $upsunClient,
            new RoutingApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends RoutesTask {
        };
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

        $result = $this->routesTask->get('proj1', 'env1', 'route1');
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

        $result = $this->routesTask->list('proj1', 'env1');
        $this->assertContainsOnlyInstancesOf(Route::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }
}
