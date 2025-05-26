<?php

namespace Upsun\Core\Tasks;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\Model\ArrayFilter;
use OpenAPI\Client\Model\CreateOrgMemberRequest;
use OpenAPI\Client\Model\CreateOrgRequest;
use OpenAPI\Client\Model\DateTimeFilter;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\ListOrgMembers200Response;
use OpenAPI\Client\Model\ListOrgs200Response;
use OpenAPI\Client\Model\ListUserOrgs200Response;
use OpenAPI\Client\Model\Organization;
use OpenAPI\Client\Model\OrganizationMember;
use OpenAPI\Client\Model\StringFilter;
use OpenAPI\Client\Model\UpdateOrgMemberRequest;
use OpenAPI\Client\Model\UpdateOrgRequest;
use OpenAPI\Client\ObjectSerializer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Upsun\UpsunClient;

class OrganizationTask extends TaskBase
{
    public OrganizationsApi $api;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->headerSelector = new HeaderSelector();
        $this->api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->refreshToken();
        $this->api->setHostIndex($hostIndex);
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        $this->refreshToken();
        return $this->api->getHostIndex();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        $this->refreshToken();
        return $this->api->getConfig();
    }

    /**
     * Operation createOrg
     *
     * Create organization
     *
     * @param array $create_org_request create_org_request (required)
     *
     * @return Organization|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrg(array $create_org_data)
    {
        $this->refreshToken();
        $create_org_request = new CreateOrgRequest($create_org_data);
        return $this->api->createOrg($create_org_request);
    }

    /**
     * Operation createOrgMember
     *
     * Create organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param CreateOrgMemberRequest $create_org_member_request create_org_member_request (required)
     *
     * @return OrganizationMember|Error|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createOrgMember(string $organization_id, CreateOrgMemberRequest $create_org_member_request): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->createOrgMember($organization_id, $create_org_member_request);
    }

    /**
     * Operation deleteOrg
     *
     * Delete organization
     *
     * @param string $organization_id The ID of the organization. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrg(string $organization_id): void
    {
        $this->refreshToken();
        $this->api->deleteOrg($organization_id);
    }

    /**
     * Operation deleteOrgMember
     *
     * Delete organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $user_id The ID of the user. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteOrgMember(string $organization_id, string $user_id): void
    {
        $this->refreshToken();
        $this->api->deleteOrgMember($organization_id, $user_id);
    }

    /**
     * Operation getOrg
     *
     * Get organization
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return Organization|Error|Error
     */
    public function getOrg(string $organization_id): Organization|Error
    {
        $this->refreshToken();
        return $this->api->getOrg($organization_id);
    }

    /**
     * Operation getOrgMember
     *
     * Get organization member
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param string $user_id The ID of the user. (required)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return OrganizationMember|Error
     */
    public function getOrgMember(string $organization_id, string $user_id): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->getOrgMember($organization_id, $user_id);
    }

    /**
     * Operation listOrgMembers
     *
     * List organization members
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param ArrayFilter|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return ListOrgMembers200Response|Error
     */
    public function listOrgMembers(string $organization_id, ArrayFilter $filter_permissions = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListOrgMembers200Response|Error
    {
        $this->refreshToken();
        return $this->api->listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listOrgs
     *
     * List organizations
     *
     * @param StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return ListOrgs200Response|Error
     */
    public function listOrgs($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $this->refreshToken();
        return $this->api->listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listUserOrgs
     *
     * User organizations
     *
     * @param string $user_id The ID of the user. (required)
     * @param StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @return ListUserOrgs200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function listUserOrgs(string $user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $this->refreshToken();
        return $this->api->listUserOrgs($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation updateOrg
     *
     * Update organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_data update_org_request (optional)
     *
     * @return Organization|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrg(string $organization_id, array $update_org_data = []): Organization|Error
    {
        $this->refreshToken();
        $update_org_request = new UpdateOrgRequest($update_org_data);
        return $this->api->updateOrg($organization_id, $update_org_request);
    }

    /**
     * Operation updateOrgMember
     *
     * Update organization member
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $user_id The ID of the user. (required)
     * @param UpdateOrgMemberRequest|null $update_org_member_request update_org_member_request (optional)
     *
     * @return OrganizationMember|Error|Error|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateOrgMember(string $organization_id, string $user_id, UpdateOrgMemberRequest $update_org_member_request = null): OrganizationMember|Error
    {
        $this->refreshToken();
        return $this->api->updateOrg($organization_id, $user_id, $update_org_member_request);
    }

    /**
     * Get Teams of the current organization (for current user)
     *
     * @param $organization_id
     * @param null $filter_updated_at
     * @param null $page_size
     * @param null $page_before
     * @param null $page_after
     * @param null $sort
     * @param string $contentType
     * @return mixed
     */
    public function listOrgTeams($organization_id, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '')
    {
        $this->refreshToken();
        return $this->client->team->listUserTeams($this->client->getUserId(), ['eq' => $organization_id], $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
    }

    /**
     * Activate addons userManagement on organization $organizationId
     *
     * Equivalent to upsun api:curl -X PATCH --json '{"user_management":"standard"}' 'api/organizations/ORGANIZATION_ID/addons' | jq
     * @param $organization_id
     * @return mixed
     * @throws ApiException
     */
    public function updateOrgAddons($organization_id)
    {
        $this->refreshToken();
        $user_management_addons = ['user_management' => "standard"];

        list($response) = $this->updateOrgAddonsWithHttpInfo($organization_id, $user_management_addons);
        return $response;
    }


    /**
     * Create http client option
     * TODO Duplicate from OrganizationApi.php
     *
     * @return array of http client options
     * @throws \RuntimeException on file opening failure
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->client->apiConfig->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->client->apiConfig->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->client->apiConfig->getDebugFile());
            }
        }

        return $options;
    }

    /**
     *
     * TODO Duplicate from Organizationpi
     * @param string $dataType
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array
     * @throws ApiException
     */
    private function handleResponseWithDataType(
        string            $dataType,
        RequestInterface  $request,
        ResponseInterface $response
    ): array
    {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string)$response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    /**
     * Operation updateOrgAddonsWithHttpInfo
     *
     * Update organization addons
     *
     * @TODO duplicate from OrganizationAPI
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_request (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @return array of \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     */
    private function updateOrgAddonsWithHttpInfo($organization_id, $update_org_request = [], string $contentType = OrganizationsApi::contentTypes['updateOrg'][0])
    {
        $request = $this->updateOrgAddonsRequest($organization_id, $update_org_request, $contentType);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->apiClient->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string)$e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch ($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Organization',
                        $request,
                        $response,
                    );
                case 400:
                case 403:
                case 404:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string)$request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string)$response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\Organization',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Organization',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }

            throw $e;
        }
    }

    /**
     * Create request for operation 'updateOrg'
     * @TODO duplicate from OrganizationAPI
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array $update_org_request (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @return \GuzzleHttp\Psr7\Request
     * @throws \InvalidArgumentException
     */
    public function updateOrgAddonsRequest($organization_id, array $update_org_request = [], string $contentType = OrganizationsApi::contentTypes['updateOrg'][0])
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling updateOrgAddons'
            );
        }

        $resourcePath = '/organizations/{organization_id}/addons';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json',],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_org_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_org_request));
            } else {
                $httpBody = $update_org_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if (!empty($this->api->getConfig()->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->api->getConfig()->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->api->getConfig()->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->api->getConfig()->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->api->getConfig()->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listOrgProjects
     *
     * List organization projects
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param \OpenAPI\Client\Model\ArrayFilter|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgMembers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListOrgMembers200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listOrgProjects($organization_id, $filter_permissions = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = OrganizationsApi::contentTypes['listOrgMembers'][0])
    {
        list($response) = $this->listOrgProjectsWithHttpInfo($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort, $contentType);
        return $response;
    }

    /**
     * Operation listOrgMembersWithHttpInfo
     *
     * List organization members
     *
     * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param \OpenAPI\Client\Model\ArrayFilter|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgMembers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListOrgMembers200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listOrgProjectsWithHttpInfo(string $organization_id, $filter_permissions = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = OrganizationsApi::contentTypes['listOrg'][0])
    {
        $request = $this->listOrgProjectsRequest($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->apiClient->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string)$e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int)$e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch ($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\ListOrgMembers200Response',
                        $request,
                        $response,
                    );
                case 400:
                case 403:
                case 404:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
            }


            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string)$request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string)$response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\ListOrgMembers200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListOrgMembers200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }


            throw $e;
        }

        /**
         * Create request for operation 'listOrgProjects'
         *
         * @param string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
         * @param \OpenAPI\Client\Model\ArrayFilter|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
         * @param int|null $page_size Determines the number of items to show. (optional)
         * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
         * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
         * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
         * @param string $contentType The value for the Content-Type header. Check self::contentTypes['listOrg'] to see the possible values for this operation
         *
         * @throws \InvalidArgumentException
         * @return \GuzzleHttp\Psr7\Request
         */
        private function listOrgProjectsRequest(string $organization_id, $filter_permissions = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = OrganizationsApi::contentTypes['listOrgs'][0])
        {

            // verify the required parameter 'organization_id' is set
            if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
                throw new \InvalidArgumentException(
                    'Missing the required parameter $organization_id when calling listOrgProjects'
                );
            }


            if ($page_size !== null && $page_size > 100) {
                throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listOrgProjects, must be smaller than or equal to 100.');
            }
            if ($page_size !== null && $page_size < 1) {
                throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listOrgProjects, must be bigger than or equal to 1.');
            }


            $resourcePath = '/organizations/{organization_id}/projects';
            $formParams = [];
            $queryParams = [];
            $headerParams = [];
            $httpBody = '';
            $multipart = false;

            // query params
            $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
                $filter_permissions,
                'filter[permissions]', // param base name
                'object', // openApiType
                'deepObject', // style
                true, // explode
                false // required
            ) ?? []);
            // query params
            $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
                $page_size,
                'page[size]', // param base name
                'integer', // openApiType
                'form', // style
                true, // explode
                false // required
            ) ?? []);
            // query params
            $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
                $page_before,
                'page[before]', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                false // required
            ) ?? []);
            // query params
            $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
                $page_after,
                'page[after]', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                false // required
            ) ?? []);
            // query params
            $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
                $sort,
                'sort', // param base name
                'string', // openApiType
                'form', // style
                true, // explode
                false // required
            ) ?? []);


            // path params
            if ($organization_id !== null) {
                $resourcePath = str_replace(
                    '{' . 'organization_id' . '}',
                    ObjectSerializer::toPathValue($organization_id),
                    $resourcePath
                );
            }


            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json',],
                $contentType,
                $multipart
            );

            // for model (json/xml)
            if (count($formParams) > 0) {
                if ($multipart) {
                    $multipartContents = [];
                    foreach ($formParams as $formParamName => $formParamValue) {
                        $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                        foreach ($formParamValueItems as $formParamValueItem) {
                            $multipartContents[] = [
                                'name' => $formParamName,
                                'contents' => $formParamValueItem
                            ];
                        }
                    }
                    // for HTTP post (form)
                    $httpBody = new MultipartStream($multipartContents);

                } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                    # if Content-Type contains "application/json", json_encode the form parameters
                    $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
                } else {
                    // for HTTP post (form)
                    $httpBody = ObjectSerializer::buildQuery($formParams);
                }
            }

            // this endpoint requires OAuth (access token)
            if (!empty($this->api->getConfig()->getAccessToken())) {
                $headers['Authorization'] = 'Bearer ' . $this->api->getConfig()->getAccessToken();
            }

            $defaultHeaders = [];
            if ($this->api->getConfig()->getUserAgent()) {
                $defaultHeaders['User-Agent'] = $this->api->getConfig()->getUserAgent();
            }

            $headers = array_merge(
                $defaultHeaders,
                $headerParams,
                $headers
            );

            $operationHost = $this->api->getConfig()->getHost();
            $query = ObjectSerializer::buildQuery($queryParams);
            return new Request(
                'GET',
                $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
                $headers,
                $httpBody
            );
        }
    }
}