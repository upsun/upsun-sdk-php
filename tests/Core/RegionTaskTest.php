<?php

use OpenAPI\Client\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\RegionTask;
use Upsun\UpsunClient;
use OpenAPI\Client\apisgen\RegionsApi;
use OpenAPI\Client\Model\Region;
use OpenAPI\Client\Model\ListRegions200Response;
use OpenAPI\Client\ApiException;
use Upsun\UpsunConfig;

class RegionTaskTest extends TestCase
{
    private RegionTask $regionTask;
    private RegionsApi $regionsApiMock;
    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->regionsApiMock = $this->createMock(RegionsApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };

        $this->regionTask = new class(
            $this->clientMock,
            $this->regionsApiMock
        ) extends RegionTask {
            public function refreshToken(): void
            {
            }
        };
    }

    public function testGetRegion(): void
    {
        $regionId = 'region-001';
        $expectedRegion = $this->createMock(Region::class);

        $this->regionsApiMock->expects($this->once())
            ->method('getRegion')
            ->with($regionId)
            ->willReturn($expectedRegion);

        $result = $this->regionTask->get($regionId);

        $this->assertSame($expectedRegion, $result);
    }

    public function testGetRegionThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->regionsApiMock->expects($this->once())
            ->method('getRegion')
            ->willThrowException($this->createMock(ApiException::class));

        $this->regionTask->get('invalid-region');
    }

    public function testListRegions(): void
    {
        $expectedList = $this->createMock(ListRegions200Response::class);

        $this->regionsApiMock->expects($this->once())
            ->method('listRegions')
            ->willReturn($expectedList);

        $result = $this->regionTask->list();

        $this->assertSame($expectedList, $result);
    }

    public function testListRegionsWithParams(): void
    {
        $expectedList = $this->createMock(ListRegions200Response::class);
        $filters = ['zone-eu'];
        $sort = 'name';

        $this->regionsApiMock->expects($this->once())
            ->method('listRegions')
            ->with(null, null, $filters, 10, 'prev', 'next', $sort)
            ->willReturn($expectedList);

        $result = $this->regionTask->list(
            filter_available: null,
            filter_private: null,
            filter_zone: $filters,
            pageSize: 10,
            pageBefore: 'prev',
            pageAfter: 'next',
            sort: $sort
        );

        $this->assertSame($expectedList, $result);
    }

    public function testListRegionsThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $this->regionsApiMock->expects($this->once())
            ->method('listRegions')
            ->willThrowException($this->createMock(ApiException::class));

        $this->regionTask->list();
    }
}
