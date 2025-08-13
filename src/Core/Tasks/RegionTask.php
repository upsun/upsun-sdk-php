<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\RegionsApi;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\ListRegions200Response;
use OpenAPI\Client\Model\Region;
use Upsun\UpsunClient;

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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $regionId): Region|Error
    {
        $this->refreshToken();
        return $this->api->getRegion($regionId);
    }

    /**
     * List regions
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
        $this->refreshToken();
        return $this->api->listRegions(
            $filter_available,
            $filter_private,
            $filter_zone,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
