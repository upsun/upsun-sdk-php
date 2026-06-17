<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\ReferencesApi;
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
 * @see       https://developer.upsun.com
 */
class RegionsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly RegionsApi $api,
        private readonly ReferencesApi $referencesApi,
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
        return $this->api->getRegion(regionId: $regionId);
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
            filterAvailable: $filterAvailable !== null ?
                new StringFilter(...$this->normalizeFilter($filterAvailable)) : null,
            filterPrivate: $filterPrivate !== null ? new StringFilter(...$this->normalizeFilter($filterPrivate)) : null,
            filterZone: $filterZone !== null ? new StringFilter(...$this->normalizeFilter($filterZone)) : null,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * List referenced regions
     * This method retrieves a list of regions that are referenced by a specific signature.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the in or sig parameter is invalid or empty
     * @return array
     */
    public function listReferencedRegions(string $in, string $sig): array
    {
        if (empty($in)) {
            throw new InvalidArgumentException('In parameter cannot be empty');
        }
        if (empty($sig)) {
            throw new InvalidArgumentException('Sig parameter cannot be empty');
        }

        return $this->referencesApi->listReferencedRegions(in: $in, sig: $sig);
    }
}
