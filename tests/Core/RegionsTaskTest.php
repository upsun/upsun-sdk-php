<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\UpsunClient;
use Upsun\Api\RegionsApi;
use Upsun\Model\Region;
use Upsun\ApiException;

class RegionsTaskTest extends BaseTestCase
{
    protected RegionsTask $regionsTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->regionsTask = new class (
            $upsunClient,
            new RegionsApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration())
        ) extends RegionsTask {
        };
    }

    /**
     * @throws \Exception
     */
    public function testGetRegion(): void
    {
        $regionId = 'region-001';

        $fakeRegion = [
            'id' => 'us-east-1',
            'label' => 'US East (Virginia)',
            'zone' => 'us-east',
            'selectionLabel' => 'United States East',
            'projectLabel' => 'US East 1',
            'timezone' => 'America/New_York',
            'available' => true,
            'private' => false,
            'endpoint' => 'https://us.upsun.com',
            'provider' => [
                'name' => 'AWS',
                'logo' => 'https://example.com/aws-logo.png',
            ],
            'datacenter' => [
                'name' => 'us-east-dc-1',
                'label' => 'Virginia Datacenter',
                'location' => 'Ashburn, Virginia, USA',
            ],
            'environmentalImpact' => [
                'zone' => 'us-east',
                'carbonIntensity' => 'low',
                'green' => true,
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeRegion)
            ));

        $result = $this->regionsTask->get($regionId);
        $this->assertInstanceOf(Region::class, $result);
        $this->assertObjectProperties($result, $fakeRegion);
    }

    public function testGetRegionThrowsApiException(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->regionsTask->get('invalid-region');
    }

    /**
     * @throws \Exception
     */
    public function testListRegions(): void
    {
        $filters = ['us-east'];
        $sort = 'name';
        $list = [
            'regions' => [[
                'id' => 'us-east-1',
                'label' => 'US East (Virginia)',
                'zone' => 'us-east',
                'selectionLabel' => 'United States East',
                'projectLabel' => 'US East 1',
                'timezone' => 'America/New_York',
                'available' => true,
                'private' => false,
                'endpoint' => 'https://us.upsun.com',
                'provider' => [
                    'name' => 'AWS',
                    'logo' => 'https://example.com/aws-logo.png',
                ],
                'datacenter' => [
                    'name' => 'us-east-dc-1',
                    'label' => 'Virginia Datacenter',
                    'location' => 'Ashburn, Virginia, USA',
                ],
                'environmentalImpact' => [
                    'zone' => 'us-east',
                    'carbonIntensity' => 'low',
                    'green' => true,
                ],
            ],
                [
                    'id' => 'us-east-2',
                    'label' => 'US East (Virginia 2)',
                    'zone' => 'us-east-2',
                    'selectionLabel' => 'United States East',
                    'projectLabel' => 'US East 2',
                    'timezone' => 'America/New_York',
                    'available' => true,
                    'private' => false,
                    'endpoint' => 'https://us-2.upsun.com',
                    'provider' => [
                        'name' => 'AWS',
                        'logo' => 'https://example.com/aws-logo.png',
                    ],
                    'datacenter' => [
                        'name' => 'us-east-dc-2',
                        'label' => 'Virginia Datacenter',
                        'location' => 'Ashburn, Virginia, USA',
                    ],
                    'environmentalImpact' => [
                        'zone' => 'us-east-2',
                        'carbonIntensity' => 'low',
                        'green' => true,
                    ],
                ]
            ],
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/regions',
                ],
                'update' => [
                    'href' => 'https://api.example.com/regions',
                ],
                'delete' => [
                    'href' => 'https://api.example.com//regions',
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

        $result = $this->regionsTask->list(
            filterZone: $filters,
            pageSize: 2,
            pageBefore: 'prev',
            pageAfter: 'next',
            sort: $sort
        );

        $this->assertContainsOnlyInstancesOf(Region::class, $result->getRegions());
        $this->assertObjectMatchesArray($result->getRegions(), $list['regions']);
    }

    public function testListRegionsThrowsApiException(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->regionsTask->list();
    }
}
