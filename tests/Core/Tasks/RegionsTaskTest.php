<?php

namespace Upsun\Tests\Core\Tasks;

use Upsun\Core\TokenProvider;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\RegionsApi;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\Model\Region;
use Upsun\UpsunClient;

class RegionsTaskTest extends BaseTestCase
{
    protected RegionsTask $regionsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
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

        $this->regionsTask = new class (
            $upsunClient,
            new RegionsApi(...$apiClassParams)
        ) extends RegionsTask {
        };
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
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

        $result = $this->regionsTask->get(regionId: $regionId);
        $this->assertInstanceOf(Region::class, $result);
        $this->assertObjectProperties($result, $fakeRegion);
    }

    /**
     * @throws ClientExceptionInterface
     */
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
        $this->regionsTask->get(regionId: 'invalid-region');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
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

    /**
     * @throws ClientExceptionInterface
     */
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
