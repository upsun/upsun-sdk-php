<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\Api\RegionsApi;
use Upsun\Model\Error;
use Upsun\Model\ListRegions200Response;
use Upsun\Model\Region;
use Upsun\Model\StringFilter;
use Upsun\UpsunClient;

/**
 * RegionTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class RegionTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly RegionsApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Gets a region
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $regionId): Region|Error
    {
        return $this->api->getRegion($regionId);
    }

    /**
     * List regions
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        ?array $filter_available = null,
        ?array $filter_private = null,
        ?array $filter_zone = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListRegions200Response|Error {

        return $this->api->listRegions(
            $filter_available !== null ? new StringFilter($filter_available) : null,
            $filter_private !== null ? new StringFilter($filter_private) : null,
            $filter_zone !== null ? new StringFilter($filter_zone) : null,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
