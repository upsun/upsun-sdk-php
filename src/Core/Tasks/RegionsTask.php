<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\RegionsApi;
use Upsun\Model\ListRegions200Response;
use Upsun\Model\Region;
use Upsun\Model\StringFilter;
use Upsun\UpsunClient;

/**
 * RegionTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class RegionsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly RegionsApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Gets a region
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $regionId): Region
    {
        return $this->api->getRegion($regionId);
    }

    /**
     * List regions
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function list(
        ?array $filterAvailable = null,
        ?array $filterPrivate = null,
        ?array $filterZone = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListRegions200Response {

        return $this->api->listRegions(
            $filterAvailable !== null ? new StringFilter(...$this->normalizeFilter($filterAvailable)) : null,
            $filterPrivate !== null ? new StringFilter(...$this->normalizeFilter($filterPrivate)) : null,
            $filterZone !== null ? new StringFilter(...$this->normalizeFilter($filterZone)) : null,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
