<?php
/**
 * OrganizationsApi
 * PHP version 8.1
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Platform.sh Rest API
 *
 * # Introduction  Platform.sh is a container-based Platform-as-a-Service. Our main API is simply Git. With a single `git push` and a couple of YAML files in your repository you can deploy an arbitrarily complex cluster. Every [**Project**](#tag/Project) can have multiple applications (PHP, Node.js, Python, Ruby, Go, etc.) and managed, automatically provisioned services (databases, message queues, etc.).  Each project also comes with multiple concurrent live staging/development [**Environments**](#tag/Environment). These ephemeral development environments are automatically created every time you push a new branch or create a pull request, and each has a full copy of the data of its parent branch, which is created on-the-fly in seconds.  Our Git implementation supports integrations with third party Git providers such as GitHub, Bitbucket, or GitLab, allowing you to simply integrate Platform.sh into your existing workflow.  ## Using the REST API  In addition to the Git API, we also offer a REST API that allows you to manage every aspect of the platform, from managing projects and environments, to accessing accounts and subscriptions, to creating robust workflows and integrations with your CI systems and internal services.  These API docs are generated from a standard **OpenAPI (Swagger)** Specification document which you can find here in [YAML](openapispec-platformsh.yaml) and in [JSON](openapispec-platformsh.json) formats.  This RESTful API consumes and produces HAL-style JSON over HTTPS, and any REST library can be used to access it. On GitHub, we also host a few API libraries that you can use to make API access easier, such as our [PHP API client](https://github.com/platformsh/platformsh-client-php) and our [JavaScript API client](https://github.com/platformsh/platformsh-client-js).  In order to use the API you will first need to have a Platform.sh account (we have a [free trial](https://accounts.platform.sh/platform/trial/general/setup) available) and create an API Token.  # Authentication  ## OAuth2  API authentication is done with OAuth2 access tokens.  ### API tokens  You can use an API token as one way to get an OAuth2 access token. This is particularly useful in scripts, e.g. for CI pipelines.  To create an API token, go to the \"API Tokens\" section of the \"Account Settings\" tab on the [Console](https://console.platform.sh).  To exchange this API token for an access token, a `POST` request must be made to `https://auth.api.platform.sh/oauth2/token`.  The request will look like this in cURL:  <pre> curl -u platform-api-user: \\     -d 'grant_type=api_token&amp;api_token=<em><b>API_TOKEN</b></em>' \\     https://auth.api.platform.sh/oauth2/token </pre>  This will return a \"Bearer\" access token that can be used to authenticate further API requests, for example:  <pre> {     \"access_token\": \"<em><b>abcdefghij1234567890</b></em>\",     \"expires_in\": 900,     \"token_type\": \"bearer\" } </pre>  ### Using the Access Token  To authenticate further API requests, include this returned bearer token in the `Authorization` header. For example, to retrieve a list of [Projects](#tag/Project) accessible by the current user, you can make the following request (substituting the dummy token for your own):  <pre> curl -H \"Authorization: Bearer <em><b>abcdefghij1234567890</b></em>\" \\     https://api.platform.sh/projects </pre>  # HAL Links  Most endpoints in the API return fields which defines a HAL (Hypertext Application Language) schema for the requested endpoint. The particular objects returns and their contents can vary by endpoint. The payload examples we give here for the requests do not show these elements. These links can allow you to create a fully dynamic API client that does not need to hardcode any method or schema.  Unless they are used for pagination we do not show the HAL links in the payload examples in this documentation for brevity and as their content is contextual (based on the permissions of the user).  ## _links Objects  Most endpoints that respond to `GET` requests will include a `_links` object in their response. The `_links` object contains a key-object pair labelled `self`, which defines two further key-value pairs:  * `href` - A URL string referring to the fully qualified name of the returned object. For many endpoints, this will be the direct link to the API endpoint on the region gateway, rather than on the general API gateway. This means it may reference a host of, for example, `eu-2.platform.sh` rather than `api.platform.sh`. * `meta` - An object defining the OpenAPI Specification (OAS) [schema object](https://swagger.io/specification/#schemaObject) of the component returned by the endpoint.  There may be zero or more other fields in the `_links` object resembling fragment identifiers beginning with a hash mark, e.g. `#edit` or `#delete`. Each of these keys refers to a JSON object containing two key-value pairs:  * `href` - A URL string referring to the path name of endpoint which can perform the action named in the key. * `meta` - An object defining the OAS schema of the endpoint. This consists of a key-value pair, with the key defining an HTTP method and the value defining the [operation object](https://swagger.io/specification/#operationObject) of the endpoint.  To use one of these HAL links, you must send a new request to the URL defined in the `href` field which contains a body defined the schema object in the `meta` field.  For example, if you make a request such as `GET /projects/abcdefghij1234567890`, the `_links` object in the returned response will include the key `#delete`. That object will look something like this fragment:  ``` \"#delete\": {     \"href\": \"/api/projects/abcdefghij1234567890\",     \"meta\": {         \"delete\": {             \"responses\": {                 . . . // Response definition omitted for space             },             \"parameters\": []         }     } } ```  To use this information to delete a project, you would then send a `DELETE` request to the endpoint `https://api.platform.sh/api/projects/abcdefghij1234567890` with no body or parameters to delete the project that was originally requested.  ## _embedded Objects  Requests to endpoints which create or modify objects, such as `POST`, `PATCH`, or `DELETE` requests, will include an `_embedded` key in their response. The object represented by this key will contain the created or modified object. This object is identical to what would be returned by a subsequent `GET` request for the object referred to by the endpoint.
 *
 * The version of the OpenAPI document: 1.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.14.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\apisgen;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\FormDataProcessor;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * OrganizationsApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class OrganizationsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'createOrg' => [
            'application/json',
        ],
        'deleteOrg' => [
            'application/json',
        ],
        'getOrg' => [
            'application/json',
        ],
        'listOrgs' => [
            'application/json',
        ],
        'listUserOrgs' => [
            'application/json',
        ],
        'updateOrg' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation createOrg
     *
     * Create organization
     *
     * @param  \OpenAPI\Client\Model\CreateOrgRequest $create_org_request create_org_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function createOrg($create_org_request, string $contentType = self::contentTypes['createOrg'][0])
    {
        list($response) = $this->createOrgWithHttpInfo($create_org_request, $contentType);
        return $response;
    }

    /**
     * Operation createOrgWithHttpInfo
     *
     * Create organization
     *
     * @param  \OpenAPI\Client\Model\CreateOrgRequest $create_org_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function createOrgWithHttpInfo($create_org_request, string $contentType = self::contentTypes['createOrg'][0])
    {
        $request = $this->createOrgRequest($create_org_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 201:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Organization',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
                case 403:
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
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\Organization',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
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
            }
        

            throw $e;
        }
    }

    /**
     * Operation createOrgAsync
     *
     * Create organization
     *
     * @param  \OpenAPI\Client\Model\CreateOrgRequest $create_org_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createOrgAsync($create_org_request, string $contentType = self::contentTypes['createOrg'][0])
    {
        return $this->createOrgAsyncWithHttpInfo($create_org_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createOrgAsyncWithHttpInfo
     *
     * Create organization
     *
     * @param  \OpenAPI\Client\Model\CreateOrgRequest $create_org_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createOrgAsyncWithHttpInfo($create_org_request, string $contentType = self::contentTypes['createOrg'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Organization';
        $request = $this->createOrgRequest($create_org_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createOrg'
     *
     * @param  \OpenAPI\Client\Model\CreateOrgRequest $create_org_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createOrgRequest($create_org_request, string $contentType = self::contentTypes['createOrg'][0])
    {

        // verify the required parameter 'create_org_request' is set
        if ($create_org_request === null || (is_array($create_org_request) && count($create_org_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_org_request when calling createOrg'
            );
        }


        $resourcePath = '/organizations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_org_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_org_request));
            } else {
                $httpBody = $create_org_request;
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteOrg
     *
     * Delete organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteOrg($organization_id, string $contentType = self::contentTypes['deleteOrg'][0])
    {
        $this->deleteOrgWithHttpInfo($organization_id, $contentType);
    }

    /**
     * Operation deleteOrgWithHttpInfo
     *
     * Delete organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteOrgWithHttpInfo($organization_id, string $contentType = self::contentTypes['deleteOrg'][0])
    {
        $request = $this->deleteOrgRequest($organization_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
     * Operation deleteOrgAsync
     *
     * Delete organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteOrgAsync($organization_id, string $contentType = self::contentTypes['deleteOrg'][0])
    {
        return $this->deleteOrgAsyncWithHttpInfo($organization_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteOrgAsyncWithHttpInfo
     *
     * Delete organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteOrgAsyncWithHttpInfo($organization_id, string $contentType = self::contentTypes['deleteOrg'][0])
    {
        $returnType = '';
        $request = $this->deleteOrgRequest($organization_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteOrg'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteOrgRequest($organization_id, string $contentType = self::contentTypes['deleteOrg'][0])
    {

        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling deleteOrg'
            );
        }


        $resourcePath = '/organizations/{organization_id}';
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
            ['application/problem+json', ],
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrg
     *
     * Get organization
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function getOrg($organization_id, string $contentType = self::contentTypes['getOrg'][0])
    {
        list($response) = $this->getOrgWithHttpInfo($organization_id, $contentType);
        return $response;
    }

    /**
     * Operation getOrgWithHttpInfo
     *
     * Get organization
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrgWithHttpInfo($organization_id, string $contentType = self::contentTypes['getOrg'][0])
    {
        $request = $this->getOrgRequest($organization_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Organization',
                        $request,
                        $response,
                    );
                case 403:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
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
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
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
     * Operation getOrgAsync
     *
     * Get organization
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrgAsync($organization_id, string $contentType = self::contentTypes['getOrg'][0])
    {
        return $this->getOrgAsyncWithHttpInfo($organization_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrgAsyncWithHttpInfo
     *
     * Get organization
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrgAsyncWithHttpInfo($organization_id, string $contentType = self::contentTypes['getOrg'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Organization';
        $request = $this->getOrgRequest($organization_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrg'
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getOrgRequest($organization_id, string $contentType = self::contentTypes['getOrg'][0])
    {

        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling getOrg'
            );
        }


        $resourcePath = '/organizations/{organization_id}';
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
            ['application/json', 'application/problem+json', ],
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listOrgs
     *
     * List organizations
     *
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgs'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListOrgs200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listOrgs($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listOrgs'][0])
    {
        list($response) = $this->listOrgsWithHttpInfo($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
        return $response;
    }

    /**
     * Operation listOrgsWithHttpInfo
     *
     * List organizations
     *
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgs'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListOrgs200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listOrgsWithHttpInfo($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listOrgs'][0])
    {
        $request = $this->listOrgsRequest($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\ListOrgs200Response',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
                case 403:
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
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\ListOrgs200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListOrgs200Response',
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
            }
        

            throw $e;
        }
    }

    /**
     * Operation listOrgsAsync
     *
     * List organizations
     *
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listOrgsAsync($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listOrgs'][0])
    {
        return $this->listOrgsAsyncWithHttpInfo($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listOrgsAsyncWithHttpInfo
     *
     * List organizations
     *
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listOrgsAsyncWithHttpInfo($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listOrgs'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ListOrgs200Response';
        $request = $this->listOrgsRequest($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listOrgs'
     *
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_owner_id Allows filtering by &#x60;owner_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_name Allows filtering by &#x60;name&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_label Allows filtering by &#x60;label&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\ArrayFilter|null $filter_capabilities Allows filtering by &#x60;capabilites&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listOrgsRequest($filter_id = null, $filter_owner_id = null, $filter_name = null, $filter_label = null, $filter_vendor = null, $filter_capabilities = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listOrgs'][0])
    {









        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listOrgs, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 1) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listOrgs, must be bigger than or equal to 1.');
        }
        




        $resourcePath = '/organizations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_id,
            'filter[id]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_owner_id,
            'filter[owner_id]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_name,
            'filter[name]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_label,
            'filter[label]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_vendor,
            'filter[vendor]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_capabilities,
            'filter[capabilities]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_status,
            'filter[status]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_updated_at,
            'filter[updated_at]', // param base name
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




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json', ],
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listUserOrgs
     *
     * User organizations
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listUserOrgs'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListUserOrgs200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listUserOrgs($user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listUserOrgs'][0])
    {
        list($response) = $this->listUserOrgsWithHttpInfo($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);
        return $response;
    }

    /**
     * Operation listUserOrgsWithHttpInfo
     *
     * User organizations
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listUserOrgs'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListUserOrgs200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listUserOrgsWithHttpInfo($user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listUserOrgs'][0])
    {
        $request = $this->listUserOrgsRequest($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\ListUserOrgs200Response',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
                case 403:
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
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\ListUserOrgs200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListUserOrgs200Response',
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
            }
        

            throw $e;
        }
    }

    /**
     * Operation listUserOrgsAsync
     *
     * User organizations
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listUserOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listUserOrgsAsync($user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listUserOrgs'][0])
    {
        return $this->listUserOrgsAsyncWithHttpInfo($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listUserOrgsAsyncWithHttpInfo
     *
     * User organizations
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listUserOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listUserOrgsAsyncWithHttpInfo($user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listUserOrgs'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ListUserOrgs200Response';
        $request = $this->listUserOrgsRequest($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listUserOrgs'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_id Allows filtering by &#x60;id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_vendor Allows filtering by &#x60;vendor&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter|null $filter_status Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter|null $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int|null $page_size Determines the number of items to show. (optional)
     * @param  string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listUserOrgs'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listUserOrgsRequest($user_id, $filter_id = null, $filter_vendor = null, $filter_status = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = self::contentTypes['listUserOrgs'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling listUserOrgs'
            );
        }





        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listUserOrgs, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 1) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling OrganizationsApi.listUserOrgs, must be bigger than or equal to 1.');
        }
        




        $resourcePath = '/users/{user_id}/organizations';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_id,
            'filter[id]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_vendor,
            'filter[vendor]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_status,
            'filter[status]', // param base name
            'object', // openApiType
            'deepObject', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_updated_at,
            'filter[updated_at]', // param base name
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json', ],
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateOrg
     *
     * Update organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgRequest|null $update_org_request update_org_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function updateOrg($organization_id, $update_org_request = null, string $contentType = self::contentTypes['updateOrg'][0])
    {
        list($response) = $this->updateOrgWithHttpInfo($organization_id, $update_org_request, $contentType);
        return $response;
    }

    /**
     * Operation updateOrgWithHttpInfo
     *
     * Update organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgRequest|null $update_org_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Organization|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateOrgWithHttpInfo($organization_id, $update_org_request = null, string $contentType = self::contentTypes['updateOrg'][0])
    {
        $request = $this->updateOrgRequest($organization_id, $update_org_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Organization',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
                case 403:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Error',
                        $request,
                        $response,
                    );
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
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
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
     * Operation updateOrgAsync
     *
     * Update organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgRequest|null $update_org_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateOrgAsync($organization_id, $update_org_request = null, string $contentType = self::contentTypes['updateOrg'][0])
    {
        return $this->updateOrgAsyncWithHttpInfo($organization_id, $update_org_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateOrgAsyncWithHttpInfo
     *
     * Update organization
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgRequest|null $update_org_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateOrgAsyncWithHttpInfo($organization_id, $update_org_request = null, string $contentType = self::contentTypes['updateOrg'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Organization';
        $request = $this->updateOrgRequest($organization_id, $update_org_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateOrg'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgRequest|null $update_org_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateOrg'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateOrgRequest($organization_id, $update_org_request = null, string $contentType = self::contentTypes['updateOrg'][0])
    {

        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling updateOrg'
            );
        }



        $resourcePath = '/organizations/{organization_id}';
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
            ['application/json', 'application/problem+json', ],
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
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    private function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response
    ): array {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
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

    private function responseWithinRangeCode(
        string $rangeCode,
        int $statusCode
    ): bool {
        $left = (int) ($rangeCode[0].'00');
        $right = (int) ($rangeCode[0].'99');

        return $statusCode >= $left && $statusCode <= $right;
    }
}
