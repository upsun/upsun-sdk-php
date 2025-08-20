<?php
/**
 * RecordsApi
 * PHP version 7.2
 *
 * @category Class
 * @package  Upsun
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

namespace Upsun\Api;

use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\PluginClientFactory;
use Http\Client\Exception\HttpException;
use Http\Client\HttpAsyncClient;
use Http\Discovery\HttpAsyncClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\RequestFactory;
use Http\Promise\Promise;
use Upsun\ApiException;
use Upsun\Configuration;
use Upsun\DebugPlugin;
use Upsun\HeaderSelector;
use Upsun\FormDataProcessor;
use Upsun\ObjectSerializer;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use function sprintf;

/**
 * RecordsApi Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class RecordsApi
{
    /**
     * @var PluginClient
     */
    protected $httpClient;

    /**
     * @var PluginClient
     */
    protected $httpAsyncClient;

    /**
     * @var UriFactoryInterface
     */
    protected $uriFactory;

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

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    public function __construct(
        ?ClientInterface $httpClient = null,
        ?Configuration $config = null,
        ?HttpAsyncClient $httpAsyncClient = null,
        ?UriFactoryInterface $uriFactory = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?HeaderSelector $selector = null,
        ?array $plugins = null,
        $hostIndex = 0
    ) {
        $this->config = $config ?? (new Configuration())->setHost('https://api.platform.sh');
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $plugins = $plugins ?? [
            new RedirectPlugin(['strict' => true]),
            new ErrorPlugin(),
        ];

        if ($this->config->getDebug()) {
            $plugins[] = new DebugPlugin(fopen($this->config->getDebugFile(), 'ab'));
        }

        $this->httpClient = (new PluginClientFactory())->createClient(
            $httpClient ?? Psr18ClientDiscovery::find(),
            $plugins
        );

        $this->httpAsyncClient = (new PluginClientFactory())->createClient(
            $httpAsyncClient ?? HttpAsyncClientDiscovery::find(),
            $plugins
        );

        $this->uriFactory = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();

        $this->headerSelector = $selector ?? new HeaderSelector();

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
     * Operation listOrgPlanRecords
     *
     * List plan records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_plan The plan type of the subscription. (optional)
     * @param  string $filter_status The status of the plan record. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_end The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  \DateTime $filter_ended_at The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \Upsun\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Upsun\Model\ListOrgPlanRecords200Response|\Upsun\Model\Error|\Upsun\Model\Error
     */
    public function listOrgPlanRecords($organization_id, $filter_subscription_id = null, $filter_plan = null, $filter_status = null, $filter_start = null, $filter_end = null, $filter_started_at = null, $filter_ended_at = null, $page = null)
    {
        list($response) = $this->listOrgPlanRecordsWithHttpInfo($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page);
        return $response;
    }

    /**
     * Operation listOrgPlanRecordsWithHttpInfo
     *
     * List plan records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_plan The plan type of the subscription. (optional)
     * @param  string $filter_status The status of the plan record. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_end The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  \DateTime $filter_ended_at The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \Upsun\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Upsun\Model\ListOrgPlanRecords200Response|\Upsun\Model\Error|\Upsun\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listOrgPlanRecordsWithHttpInfo($organization_id, $filter_subscription_id = null, $filter_plan = null, $filter_status = null, $filter_start = null, $filter_end = null, $filter_started_at = null, $filter_ended_at = null, $page = null)
    {
        $request = $this->listOrgPlanRecordsRequest($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\ListOrgPlanRecords200Response',
                        $request,
                        $response,
                    );
                case 403:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\Error',
                        $request,
                        $response,
                    );
                case 404:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\Error',
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
                '\Upsun\Model\ListOrgPlanRecords200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\ListOrgPlanRecords200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listOrgPlanRecordsAsync
     *
     * List plan records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_plan The plan type of the subscription. (optional)
     * @param  string $filter_status The status of the plan record. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_end The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  \DateTime $filter_ended_at The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgPlanRecordsAsync($organization_id, $filter_subscription_id = null, $filter_plan = null, $filter_status = null, $filter_start = null, $filter_end = null, $filter_started_at = null, $filter_ended_at = null, $page = null)
    {
        return $this->listOrgPlanRecordsAsyncWithHttpInfo($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listOrgPlanRecordsAsyncWithHttpInfo
     *
     * List plan records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_plan The plan type of the subscription. (optional)
     * @param  string $filter_status The status of the plan record. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_end The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  \DateTime $filter_ended_at The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgPlanRecordsAsyncWithHttpInfo($organization_id, $filter_subscription_id = null, $filter_plan = null, $filter_status = null, $filter_start = null, $filter_end = null, $filter_started_at = null, $filter_ended_at = null, $page = null)
    {
        $returnType = '\Upsun\Model\ListOrgPlanRecords200Response';
        $request = $this->listOrgPlanRecordsRequest($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page);

        return $this->httpAsyncClient->sendAsyncRequest($request)
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function (HttpException $exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $exception->getRequest(),
                        $exception->getResponse(),
                        $exception
                    );
                }
            );
    }

    /**
     * Create request for operation 'listOrgPlanRecords'
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_plan The plan type of the subscription. (optional)
     * @param  string $filter_status The status of the plan record. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_end The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  \DateTime $filter_ended_at The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listOrgPlanRecordsRequest($organization_id, $filter_subscription_id = null, $filter_plan = null, $filter_status = null, $filter_start = null, $filter_end = null, $filter_started_at = null, $filter_ended_at = null, $page = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling listOrgPlanRecords'
            );
        }

        $resourcePath = '/organizations/{organization_id}/records/plan';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($filter_subscription_id !== null) {
            if('form' === 'form' && is_array($filter_subscription_id)) {
                foreach($filter_subscription_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[subscription_id]'] = $filter_subscription_id;
            }
        }
        // query params
        if ($filter_plan !== null) {
            if('form' === 'form' && is_array($filter_plan)) {
                foreach($filter_plan as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[plan]'] = $filter_plan;
            }
        }
        // query params
        if ($filter_status !== null) {
            if('form' === 'form' && is_array($filter_status)) {
                foreach($filter_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[status]'] = $filter_status;
            }
        }
        // query params
        if ($filter_start !== null) {
            if('form' === 'form' && is_array($filter_start)) {
                foreach($filter_start as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[start]'] = $filter_start;
            }
        }
        // query params
        if ($filter_end !== null) {
            if('form' === 'form' && is_array($filter_end)) {
                foreach($filter_end as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[end]'] = $filter_end;
            }
        }
        // query params
        if ($filter_started_at !== null) {
            if('form' === 'form' && is_array($filter_started_at)) {
                foreach($filter_started_at as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[started_at]'] = $filter_started_at;
            }
        }
        // query params
        if ($filter_ended_at !== null) {
            if('form' === 'form' && is_array($filter_ended_at)) {
                foreach($filter_ended_at as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[ended_at]'] = $filter_ended_at;
            }
        }
        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }


        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json'],
            '',
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

            } elseif ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
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

        $uri = $this->createUri($operationHost, $resourcePath, $queryParams);

        return $this->createRequest('GET', $uri, $headers, $httpBody);
    }

    /**
     * Operation listOrgUsageRecords
     *
     * List usage records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_usage_group Filter records by the type of usage. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \Upsun\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Upsun\Model\ListOrgUsageRecords200Response|\Upsun\Model\Error|\Upsun\Model\Error
     */
    public function listOrgUsageRecords($organization_id, $filter_subscription_id = null, $filter_usage_group = null, $filter_start = null, $filter_started_at = null, $page = null)
    {
        list($response) = $this->listOrgUsageRecordsWithHttpInfo($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page);
        return $response;
    }

    /**
     * Operation listOrgUsageRecordsWithHttpInfo
     *
     * List usage records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_usage_group Filter records by the type of usage. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \Upsun\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Upsun\Model\ListOrgUsageRecords200Response|\Upsun\Model\Error|\Upsun\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listOrgUsageRecordsWithHttpInfo($organization_id, $filter_subscription_id = null, $filter_usage_group = null, $filter_start = null, $filter_started_at = null, $page = null)
    {
        $request = $this->listOrgUsageRecordsRequest($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\ListOrgUsageRecords200Response',
                        $request,
                        $response,
                    );
                case 403:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\Error',
                        $request,
                        $response,
                    );
                case 404:
                    return $this->handleResponseWithDataType(
                        '\Upsun\Model\Error',
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
                '\Upsun\Model\ListOrgUsageRecords200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\ListOrgUsageRecords200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Upsun\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listOrgUsageRecordsAsync
     *
     * List usage records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_usage_group Filter records by the type of usage. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgUsageRecordsAsync($organization_id, $filter_subscription_id = null, $filter_usage_group = null, $filter_start = null, $filter_started_at = null, $page = null)
    {
        return $this->listOrgUsageRecordsAsyncWithHttpInfo($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listOrgUsageRecordsAsyncWithHttpInfo
     *
     * List usage records
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_usage_group Filter records by the type of usage. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgUsageRecordsAsyncWithHttpInfo($organization_id, $filter_subscription_id = null, $filter_usage_group = null, $filter_start = null, $filter_started_at = null, $page = null)
    {
        $returnType = '\Upsun\Model\ListOrgUsageRecords200Response';
        $request = $this->listOrgUsageRecordsRequest($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page);

        return $this->httpAsyncClient->sendAsyncRequest($request)
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function (HttpException $exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $exception->getRequest(),
                        $exception->getResponse(),
                        $exception
                    );
                }
            );
    }

    /**
     * Create request for operation 'listOrgUsageRecords'
     *
     * @param  string $organization_id The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. (required)
     * @param  string $filter_subscription_id The ID of the subscription (optional)
     * @param  string $filter_usage_group Filter records by the type of usage. (optional)
     * @param  \DateTime $filter_start The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 (optional)
     * @param  \DateTime $filter_started_at The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; (optional)
     * @param  int $page Page to be displayed. Defaults to 1. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listOrgUsageRecordsRequest($organization_id, $filter_subscription_id = null, $filter_usage_group = null, $filter_start = null, $filter_started_at = null, $page = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling listOrgUsageRecords'
            );
        }

        $resourcePath = '/organizations/{organization_id}/records/usage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($filter_subscription_id !== null) {
            if('form' === 'form' && is_array($filter_subscription_id)) {
                foreach($filter_subscription_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[subscription_id]'] = $filter_subscription_id;
            }
        }
        // query params
        if ($filter_usage_group !== null) {
            if('form' === 'form' && is_array($filter_usage_group)) {
                foreach($filter_usage_group as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[usage_group]'] = $filter_usage_group;
            }
        }
        // query params
        if ($filter_start !== null) {
            if('form' === 'form' && is_array($filter_start)) {
                foreach($filter_start as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[start]'] = $filter_start;
            }
        }
        // query params
        if ($filter_started_at !== null) {
            if('form' === 'form' && is_array($filter_started_at)) {
                foreach($filter_started_at as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[started_at]'] = $filter_started_at;
            }
        }
        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }


        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json'],
            '',
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

            } elseif ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
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

        $uri = $this->createUri($operationHost, $resourcePath, $queryParams);

        return $this->createRequest('GET', $uri, $headers, $httpBody);
    }


    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array $headers
     * @param string|StreamInterface|null $body
     *
     * @return RequestInterface
     */
    protected function createRequest(string $method, $uri, array $headers = [], $body = null): RequestInterface
    {
        if ($this->requestFactory instanceof RequestFactory) {
            return $this->requestFactory->createRequest(
                $method,
                $uri,
                $headers,
                $body
            );
        }

        if (is_string($body) && '' !== $body && null === $this->streamFactory) {
            throw new \RuntimeException('Cannot create request: A stream factory is required to create a request with a non-empty string body.');
        }

        $request = $this->requestFactory->createRequest($method, $uri);

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        if (null !== $body && '' !== $body) {
            $request = $request->withBody(
                is_string($body) ? $this->streamFactory->createStream($body) : $body
            );
        }

        return $request;
    }

    private function createUri(
        string $operationHost,
        string $resourcePath,
        array $queryParams
    ): UriInterface {
        $parsedUrl = parse_url($operationHost);

        $host = $parsedUrl['host'] ?? null;
        $scheme = $parsedUrl['scheme'] ?? null;
        $basePath = $parsedUrl['path'] ?? null;
        $port = $parsedUrl['port'] ?? null;
        $user = $parsedUrl['user'] ?? null;
        $password = $parsedUrl['pass'] ?? null;

        $uri = $this->uriFactory->createUri($basePath . $resourcePath)
            ->withHost($host)
            ->withScheme($scheme)
            ->withPort($port)
            ->withQuery(ObjectSerializer::buildQuery($queryParams));

        if ($user) {
            $uri = $uri->withUserInfo($user, $password);
        }

        return $uri;
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
