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
    public RegionsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new RegionsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * Operation getRegion
     *
     * Get region
     *
     * @param string $region_id The ID of the region. (required)
     *
     * @return Region|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getRegion(string $region_id): Region|Error
    {
        $this->refreshToken();
        return $this->api->getRegion($region_id);
    }

    /**
     * Operation listRegions
     *
     * List regions
     *
     * @param array|null $filter_available Allows filtering by &#x60;available&#x60; using one or more operators. (optional)
     * @param array|null $filter_private Allows filtering by &#x60;private&#x60; using one or more operators. (optional)
     * @param array|null $filter_zone Allows filtering by &#x60;zone&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;id&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListRegions200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listRegions(array $filter_available = null, array $filter_private = null, array $filter_zone = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListRegions200Response|Error
    {
        $this->refreshToken();
        return $this->api->listRegions($filter_available, $filter_private, $filter_zone, $page_size, $page_before, $page_after, $sort);
    }


}