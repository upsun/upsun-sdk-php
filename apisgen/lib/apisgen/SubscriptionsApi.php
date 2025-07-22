<?php
/**
 * SubscriptionsApi
 * PHP version 7.2
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
 * Generator version: 7.13.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\apisgen;

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
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\DebugPlugin;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\FormDataProcessor;
use OpenAPI\Client\ObjectSerializer;
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
 * SubscriptionsApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SubscriptionsApi
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
     * Operation canCreateNewOrgSubscription
     *
     * Checks if the user is able to create a new project.
     *
     * @param  string $organization_id The ID of the organization. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function canCreateNewOrgSubscription($organization_id)
    {
        list($response) = $this->canCreateNewOrgSubscriptionWithHttpInfo($organization_id);
        return $response;
    }

    /**
     * Operation canCreateNewOrgSubscriptionWithHttpInfo
     *
     * Checks if the user is able to create a new project.
     *
     * @param  string $organization_id The ID of the organization. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function canCreateNewOrgSubscriptionWithHttpInfo($organization_id)
    {
        $request = $this->canCreateNewOrgSubscriptionRequest($organization_id);

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
                        '\OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response',
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
                '\OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response',
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
     * Operation canCreateNewOrgSubscriptionAsync
     *
     * Checks if the user is able to create a new project.
     *
     * @param  string $organization_id The ID of the organization. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function canCreateNewOrgSubscriptionAsync($organization_id)
    {
        return $this->canCreateNewOrgSubscriptionAsyncWithHttpInfo($organization_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation canCreateNewOrgSubscriptionAsyncWithHttpInfo
     *
     * Checks if the user is able to create a new project.
     *
     * @param  string $organization_id The ID of the organization. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function canCreateNewOrgSubscriptionAsyncWithHttpInfo($organization_id)
    {
        $returnType = '\OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response';
        $request = $this->canCreateNewOrgSubscriptionRequest($organization_id);

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
     * Create request for operation 'canCreateNewOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function canCreateNewOrgSubscriptionRequest($organization_id)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling canCreateNewOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/can-create';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
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
     * Operation createOrgSubscription
     *
     * Create subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\CreateOrgSubscriptionRequest $create_org_subscription_request create_org_subscription_request (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function createOrgSubscription($organization_id, $create_org_subscription_request)
    {
        list($response) = $this->createOrgSubscriptionWithHttpInfo($organization_id, $create_org_subscription_request);
        return $response;
    }

    /**
     * Operation createOrgSubscriptionWithHttpInfo
     *
     * Create subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\CreateOrgSubscriptionRequest $create_org_subscription_request (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function createOrgSubscriptionWithHttpInfo($organization_id, $create_org_subscription_request)
    {
        $request = $this->createOrgSubscriptionRequest($organization_id, $create_org_subscription_request);

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
                case 201:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Subscription',
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
                '\OpenAPI\Client\Model\Subscription',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Subscription',
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
     * Operation createOrgSubscriptionAsync
     *
     * Create subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\CreateOrgSubscriptionRequest $create_org_subscription_request (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function createOrgSubscriptionAsync($organization_id, $create_org_subscription_request)
    {
        return $this->createOrgSubscriptionAsyncWithHttpInfo($organization_id, $create_org_subscription_request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createOrgSubscriptionAsyncWithHttpInfo
     *
     * Create subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\CreateOrgSubscriptionRequest $create_org_subscription_request (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function createOrgSubscriptionAsyncWithHttpInfo($organization_id, $create_org_subscription_request)
    {
        $returnType = '\OpenAPI\Client\Model\Subscription';
        $request = $this->createOrgSubscriptionRequest($organization_id, $create_org_subscription_request);

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
     * Create request for operation 'createOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  \OpenAPI\Client\Model\CreateOrgSubscriptionRequest $create_org_subscription_request (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function createOrgSubscriptionRequest($organization_id, $create_org_subscription_request)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling createOrgSubscription'
            );
        }
        // verify the required parameter 'create_org_subscription_request' is set
        if ($create_org_subscription_request === null || (is_array($create_org_subscription_request) && count($create_org_subscription_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_org_subscription_request when calling createOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
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
            ['application/json', 'application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($create_org_subscription_request)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($create_org_subscription_request));
            } else {
                $httpBody = $create_org_subscription_request;
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

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }

    /**
     * Operation deleteOrgSubscription
     *
     * Delete subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteOrgSubscription($organization_id, $subscription_id)
    {
        $this->deleteOrgSubscriptionWithHttpInfo($organization_id, $subscription_id);
    }

    /**
     * Operation deleteOrgSubscriptionWithHttpInfo
     *
     * Delete subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteOrgSubscriptionWithHttpInfo($organization_id, $subscription_id)
    {
        $request = $this->deleteOrgSubscriptionRequest($organization_id, $subscription_id);

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


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
     * Operation deleteOrgSubscriptionAsync
     *
     * Delete subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteOrgSubscriptionAsync($organization_id, $subscription_id)
    {
        return $this->deleteOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteOrgSubscriptionAsyncWithHttpInfo
     *
     * Delete subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id)
    {
        $returnType = '';
        $request = $this->deleteOrgSubscriptionRequest($organization_id, $subscription_id);

        return $this->httpAsyncClient->sendAsyncRequest($request)
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'deleteOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function deleteOrgSubscriptionRequest($organization_id, $subscription_id)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling deleteOrgSubscription'
            );
        }
        // verify the required parameter 'subscription_id' is set
        if ($subscription_id === null || (is_array($subscription_id) && count($subscription_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subscription_id when calling deleteOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/{subscription_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }
        // path params
        if ($subscription_id !== null) {
            $resourcePath = str_replace(
                '{' . 'subscription_id' . '}',
                ObjectSerializer::toPathValue($subscription_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
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

        return $this->createRequest('DELETE', $uri, $headers, $httpBody);
    }

    /**
     * Operation estimateNewOrgSubscription
     *
     * Estimate the price of a new subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param  int $storage The total storage available to each environment, in MiB. (required)
     * @param  int $user_licenses The number of user licenses. (required)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\EstimationObject|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function estimateNewOrgSubscription($organization_id, $plan, $environments, $storage, $user_licenses, $format = null)
    {
        list($response) = $this->estimateNewOrgSubscriptionWithHttpInfo($organization_id, $plan, $environments, $storage, $user_licenses, $format);
        return $response;
    }

    /**
     * Operation estimateNewOrgSubscriptionWithHttpInfo
     *
     * Estimate the price of a new subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param  int $storage The total storage available to each environment, in MiB. (required)
     * @param  int $user_licenses The number of user licenses. (required)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\EstimationObject|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function estimateNewOrgSubscriptionWithHttpInfo($organization_id, $plan, $environments, $storage, $user_licenses, $format = null)
    {
        $request = $this->estimateNewOrgSubscriptionRequest($organization_id, $plan, $environments, $storage, $user_licenses, $format);

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
                        '\OpenAPI\Client\Model\EstimationObject',
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
                '\OpenAPI\Client\Model\EstimationObject',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\EstimationObject',
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
     * Operation estimateNewOrgSubscriptionAsync
     *
     * Estimate the price of a new subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param  int $storage The total storage available to each environment, in MiB. (required)
     * @param  int $user_licenses The number of user licenses. (required)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function estimateNewOrgSubscriptionAsync($organization_id, $plan, $environments, $storage, $user_licenses, $format = null)
    {
        return $this->estimateNewOrgSubscriptionAsyncWithHttpInfo($organization_id, $plan, $environments, $storage, $user_licenses, $format)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation estimateNewOrgSubscriptionAsyncWithHttpInfo
     *
     * Estimate the price of a new subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param  int $storage The total storage available to each environment, in MiB. (required)
     * @param  int $user_licenses The number of user licenses. (required)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function estimateNewOrgSubscriptionAsyncWithHttpInfo($organization_id, $plan, $environments, $storage, $user_licenses, $format = null)
    {
        $returnType = '\OpenAPI\Client\Model\EstimationObject';
        $request = $this->estimateNewOrgSubscriptionRequest($organization_id, $plan, $environments, $storage, $user_licenses, $format);

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
     * Create request for operation 'estimateNewOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (required)
     * @param  int $storage The total storage available to each environment, in MiB. (required)
     * @param  int $user_licenses The number of user licenses. (required)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function estimateNewOrgSubscriptionRequest($organization_id, $plan, $environments, $storage, $user_licenses, $format = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling estimateNewOrgSubscription'
            );
        }
        // verify the required parameter 'plan' is set
        if ($plan === null || (is_array($plan) && count($plan) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $plan when calling estimateNewOrgSubscription'
            );
        }
        // verify the required parameter 'environments' is set
        if ($environments === null || (is_array($environments) && count($environments) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environments when calling estimateNewOrgSubscription'
            );
        }
        // verify the required parameter 'storage' is set
        if ($storage === null || (is_array($storage) && count($storage) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $storage when calling estimateNewOrgSubscription'
            );
        }
        // verify the required parameter 'user_licenses' is set
        if ($user_licenses === null || (is_array($user_licenses) && count($user_licenses) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_licenses when calling estimateNewOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/estimate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($plan !== null) {
            if('form' === 'form' && is_array($plan)) {
                foreach($plan as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['plan'] = $plan;
            }
        }
        // query params
        if ($environments !== null) {
            if('form' === 'form' && is_array($environments)) {
                foreach($environments as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['environments'] = $environments;
            }
        }
        // query params
        if ($storage !== null) {
            if('form' === 'form' && is_array($storage)) {
                foreach($storage as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['storage'] = $storage;
            }
        }
        // query params
        if ($user_licenses !== null) {
            if('form' === 'form' && is_array($user_licenses)) {
                foreach($user_licenses as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['user_licenses'] = $user_licenses;
            }
        }
        // query params
        if ($format !== null) {
            if('form' === 'form' && is_array($format)) {
                foreach($format as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['format'] = $format;
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
     * Operation estimateOrgSubscription
     *
     * Estimate the price of a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param  int $storage The total storage available to each environment, in MiB. (optional)
     * @param  int $user_licenses The number of user licenses. (optional)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\EstimationObject|\OpenAPI\Client\Model\Error
     */
    public function estimateOrgSubscription($organization_id, $subscription_id, $plan, $environments = null, $storage = null, $user_licenses = null, $format = null)
    {
        list($response) = $this->estimateOrgSubscriptionWithHttpInfo($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format);
        return $response;
    }

    /**
     * Operation estimateOrgSubscriptionWithHttpInfo
     *
     * Estimate the price of a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param  int $storage The total storage available to each environment, in MiB. (optional)
     * @param  int $user_licenses The number of user licenses. (optional)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\EstimationObject|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function estimateOrgSubscriptionWithHttpInfo($organization_id, $subscription_id, $plan, $environments = null, $storage = null, $user_licenses = null, $format = null)
    {
        $request = $this->estimateOrgSubscriptionRequest($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format);

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
                        '\OpenAPI\Client\Model\EstimationObject',
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
                '\OpenAPI\Client\Model\EstimationObject',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\EstimationObject',
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
     * Operation estimateOrgSubscriptionAsync
     *
     * Estimate the price of a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param  int $storage The total storage available to each environment, in MiB. (optional)
     * @param  int $user_licenses The number of user licenses. (optional)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function estimateOrgSubscriptionAsync($organization_id, $subscription_id, $plan, $environments = null, $storage = null, $user_licenses = null, $format = null)
    {
        return $this->estimateOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation estimateOrgSubscriptionAsyncWithHttpInfo
     *
     * Estimate the price of a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param  int $storage The total storage available to each environment, in MiB. (optional)
     * @param  int $user_licenses The number of user licenses. (optional)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function estimateOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id, $plan, $environments = null, $storage = null, $user_licenses = null, $format = null)
    {
        $returnType = '\OpenAPI\Client\Model\EstimationObject';
        $request = $this->estimateOrgSubscriptionRequest($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format);

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
     * Create request for operation 'estimateOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $plan The plan type of the subscription. (required)
     * @param  int $environments The maximum number of environments which can be provisioned on the project. (optional)
     * @param  int $storage The total storage available to each environment, in MiB. (optional)
     * @param  int $user_licenses The number of user licenses. (optional)
     * @param  string $format The format of the estimation output. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function estimateOrgSubscriptionRequest($organization_id, $subscription_id, $plan, $environments = null, $storage = null, $user_licenses = null, $format = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling estimateOrgSubscription'
            );
        }
        // verify the required parameter 'subscription_id' is set
        if ($subscription_id === null || (is_array($subscription_id) && count($subscription_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subscription_id when calling estimateOrgSubscription'
            );
        }
        // verify the required parameter 'plan' is set
        if ($plan === null || (is_array($plan) && count($plan) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $plan when calling estimateOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/{subscription_id}/estimate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($plan !== null) {
            if('form' === 'form' && is_array($plan)) {
                foreach($plan as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['plan'] = $plan;
            }
        }
        // query params
        if ($environments !== null) {
            if('form' === 'form' && is_array($environments)) {
                foreach($environments as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['environments'] = $environments;
            }
        }
        // query params
        if ($storage !== null) {
            if('form' === 'form' && is_array($storage)) {
                foreach($storage as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['storage'] = $storage;
            }
        }
        // query params
        if ($user_licenses !== null) {
            if('form' === 'form' && is_array($user_licenses)) {
                foreach($user_licenses as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['user_licenses'] = $user_licenses;
            }
        }
        // query params
        if ($format !== null) {
            if('form' === 'form' && is_array($format)) {
                foreach($format as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['format'] = $format;
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
        // path params
        if ($subscription_id !== null) {
            $resourcePath = str_replace(
                '{' . 'subscription_id' . '}',
                ObjectSerializer::toPathValue($subscription_id),
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
     * Operation getOrgSubscription
     *
     * Get subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function getOrgSubscription($organization_id, $subscription_id)
    {
        list($response) = $this->getOrgSubscriptionWithHttpInfo($organization_id, $subscription_id);
        return $response;
    }

    /**
     * Operation getOrgSubscriptionWithHttpInfo
     *
     * Get subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrgSubscriptionWithHttpInfo($organization_id, $subscription_id)
    {
        $request = $this->getOrgSubscriptionRequest($organization_id, $subscription_id);

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
                        '\OpenAPI\Client\Model\Subscription',
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
                '\OpenAPI\Client\Model\Subscription',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Subscription',
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
     * Operation getOrgSubscriptionAsync
     *
     * Get subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getOrgSubscriptionAsync($organization_id, $subscription_id)
    {
        return $this->getOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrgSubscriptionAsyncWithHttpInfo
     *
     * Get subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id)
    {
        $returnType = '\OpenAPI\Client\Model\Subscription';
        $request = $this->getOrgSubscriptionRequest($organization_id, $subscription_id);

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
     * Create request for operation 'getOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getOrgSubscriptionRequest($organization_id, $subscription_id)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling getOrgSubscription'
            );
        }
        // verify the required parameter 'subscription_id' is set
        if ($subscription_id === null || (is_array($subscription_id) && count($subscription_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subscription_id when calling getOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/{subscription_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }
        // path params
        if ($subscription_id !== null) {
            $resourcePath = str_replace(
                '{' . 'subscription_id' . '}',
                ObjectSerializer::toPathValue($subscription_id),
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
     * Operation getOrgSubscriptionCurrentUsage
     *
     * Get current usage for a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param  bool $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\SubscriptionCurrentUsageObject|\OpenAPI\Client\Model\Error
     */
    public function getOrgSubscriptionCurrentUsage($organization_id, $subscription_id, $usage_groups = null, $include_not_charged = null)
    {
        list($response) = $this->getOrgSubscriptionCurrentUsageWithHttpInfo($organization_id, $subscription_id, $usage_groups, $include_not_charged);
        return $response;
    }

    /**
     * Operation getOrgSubscriptionCurrentUsageWithHttpInfo
     *
     * Get current usage for a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param  bool $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\SubscriptionCurrentUsageObject|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrgSubscriptionCurrentUsageWithHttpInfo($organization_id, $subscription_id, $usage_groups = null, $include_not_charged = null)
    {
        $request = $this->getOrgSubscriptionCurrentUsageRequest($organization_id, $subscription_id, $usage_groups, $include_not_charged);

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
                        '\OpenAPI\Client\Model\SubscriptionCurrentUsageObject',
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
                '\OpenAPI\Client\Model\SubscriptionCurrentUsageObject',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\SubscriptionCurrentUsageObject',
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
     * Operation getOrgSubscriptionCurrentUsageAsync
     *
     * Get current usage for a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param  bool $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getOrgSubscriptionCurrentUsageAsync($organization_id, $subscription_id, $usage_groups = null, $include_not_charged = null)
    {
        return $this->getOrgSubscriptionCurrentUsageAsyncWithHttpInfo($organization_id, $subscription_id, $usage_groups, $include_not_charged)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrgSubscriptionCurrentUsageAsyncWithHttpInfo
     *
     * Get current usage for a subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param  bool $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getOrgSubscriptionCurrentUsageAsyncWithHttpInfo($organization_id, $subscription_id, $usage_groups = null, $include_not_charged = null)
    {
        $returnType = '\OpenAPI\Client\Model\SubscriptionCurrentUsageObject';
        $request = $this->getOrgSubscriptionCurrentUsageRequest($organization_id, $subscription_id, $usage_groups, $include_not_charged);

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
     * Create request for operation 'getOrgSubscriptionCurrentUsage'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  string $usage_groups A list of usage groups to retrieve current usage for. (optional)
     * @param  bool $include_not_charged Whether to include not charged usage groups. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getOrgSubscriptionCurrentUsageRequest($organization_id, $subscription_id, $usage_groups = null, $include_not_charged = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling getOrgSubscriptionCurrentUsage'
            );
        }
        // verify the required parameter 'subscription_id' is set
        if ($subscription_id === null || (is_array($subscription_id) && count($subscription_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subscription_id when calling getOrgSubscriptionCurrentUsage'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/{subscription_id}/current_usage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($usage_groups !== null) {
            if('form' === 'form' && is_array($usage_groups)) {
                foreach($usage_groups as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['usage_groups'] = $usage_groups;
            }
        }
        // query params
        if ($include_not_charged !== null) {
            if('form' === 'form' && is_array($include_not_charged)) {
                foreach($include_not_charged as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['include_not_charged'] = $include_not_charged;
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
        // path params
        if ($subscription_id !== null) {
            $resourcePath = str_replace(
                '{' . 'subscription_id' . '}',
                ObjectSerializer::toPathValue($subscription_id),
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
     * Operation listOrgSubscriptions
     *
     * List subscriptions
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $filter_status The status of the subscription. (optional)
     * @param  string $filter_id Machine name of the region. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListOrgSubscriptions200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listOrgSubscriptions($organization_id, $filter_status = null, $filter_id = null, $filter_project_id = null, $filter_project_title = null, $filter_region = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        list($response) = $this->listOrgSubscriptionsWithHttpInfo($organization_id, $filter_status, $filter_id, $filter_project_id, $filter_project_title, $filter_region, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
        return $response;
    }

    /**
     * Operation listOrgSubscriptionsWithHttpInfo
     *
     * List subscriptions
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $filter_status The status of the subscription. (optional)
     * @param  string $filter_id Machine name of the region. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListOrgSubscriptions200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listOrgSubscriptionsWithHttpInfo($organization_id, $filter_status = null, $filter_id = null, $filter_project_id = null, $filter_project_title = null, $filter_region = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $request = $this->listOrgSubscriptionsRequest($organization_id, $filter_status, $filter_id, $filter_project_id, $filter_project_title, $filter_region, $filter_updated_at, $page_size, $page_before, $page_after, $sort);

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
                        '\OpenAPI\Client\Model\ListOrgSubscriptions200Response',
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
                '\OpenAPI\Client\Model\ListOrgSubscriptions200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListOrgSubscriptions200Response',
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
     * Operation listOrgSubscriptionsAsync
     *
     * List subscriptions
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $filter_status The status of the subscription. (optional)
     * @param  string $filter_id Machine name of the region. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgSubscriptionsAsync($organization_id, $filter_status = null, $filter_id = null, $filter_project_id = null, $filter_project_title = null, $filter_region = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        return $this->listOrgSubscriptionsAsyncWithHttpInfo($organization_id, $filter_status, $filter_id, $filter_project_id, $filter_project_title, $filter_region, $filter_updated_at, $page_size, $page_before, $page_after, $sort)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listOrgSubscriptionsAsyncWithHttpInfo
     *
     * List subscriptions
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $filter_status The status of the subscription. (optional)
     * @param  string $filter_id Machine name of the region. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listOrgSubscriptionsAsyncWithHttpInfo($organization_id, $filter_status = null, $filter_id = null, $filter_project_id = null, $filter_project_title = null, $filter_region = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $returnType = '\OpenAPI\Client\Model\ListOrgSubscriptions200Response';
        $request = $this->listOrgSubscriptionsRequest($organization_id, $filter_status, $filter_id, $filter_project_id, $filter_project_title, $filter_region, $filter_updated_at, $page_size, $page_before, $page_after, $sort);

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
     * Create request for operation 'listOrgSubscriptions'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $filter_status The status of the subscription. (optional)
     * @param  string $filter_id Machine name of the region. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_id Allows filtering by &#x60;project_id&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_project_title Allows filtering by &#x60;project_title&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\StringFilter $filter_region Allows filtering by &#x60;region&#x60; using one or more operators. (optional)
     * @param  \OpenAPI\Client\Model\DateTimeFilter $filter_updated_at Allows filtering by &#x60;updated_at&#x60; using one or more operators. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listOrgSubscriptionsRequest($organization_id, $filter_status = null, $filter_id = null, $filter_project_id = null, $filter_project_title = null, $filter_region = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling listOrgSubscriptions'
            );
        }
        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling SubscriptionsApi.listOrgSubscriptions, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 1) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling SubscriptionsApi.listOrgSubscriptions, must be bigger than or equal to 1.');
        }


        $resourcePath = '/organizations/{organization_id}/subscriptions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

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
        if ($filter_id !== null) {
            if('form' === 'form' && is_array($filter_id)) {
                foreach($filter_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[id]'] = $filter_id;
            }
        }
        // query params
        if ($filter_project_id !== null) {
            if('form' === 'deepObject' && is_array($filter_project_id)) {
                foreach($filter_project_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[project_id]'] = $filter_project_id;
            }
        }
        // query params
        if ($filter_project_title !== null) {
            if('form' === 'deepObject' && is_array($filter_project_title)) {
                foreach($filter_project_title as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[project_title]'] = $filter_project_title;
            }
        }
        // query params
        if ($filter_region !== null) {
            if('form' === 'deepObject' && is_array($filter_region)) {
                foreach($filter_region as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[region]'] = $filter_region;
            }
        }
        // query params
        if ($filter_updated_at !== null) {
            if('form' === 'deepObject' && is_array($filter_updated_at)) {
                foreach($filter_updated_at as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[updated_at]'] = $filter_updated_at;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page[size]'] = $page_size;
            }
        }
        // query params
        if ($page_before !== null) {
            if('form' === 'form' && is_array($page_before)) {
                foreach($page_before as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page[before]'] = $page_before;
            }
        }
        // query params
        if ($page_after !== null) {
            if('form' === 'form' && is_array($page_after)) {
                foreach($page_after as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page[after]'] = $page_after;
            }
        }
        // query params
        if ($sort !== null) {
            if('form' === 'form' && is_array($sort)) {
                foreach($sort as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['sort'] = $sort;
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
     * Operation updateOrgSubscription
     *
     * Update subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest $update_org_subscription_request update_org_subscription_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function updateOrgSubscription($organization_id, $subscription_id, $update_org_subscription_request = null)
    {
        list($response) = $this->updateOrgSubscriptionWithHttpInfo($organization_id, $subscription_id, $update_org_subscription_request);
        return $response;
    }

    /**
     * Operation updateOrgSubscriptionWithHttpInfo
     *
     * Update subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest $update_org_subscription_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Subscription|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateOrgSubscriptionWithHttpInfo($organization_id, $subscription_id, $update_org_subscription_request = null)
    {
        $request = $this->updateOrgSubscriptionRequest($organization_id, $subscription_id, $update_org_subscription_request);

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
                        '\OpenAPI\Client\Model\Subscription',
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
                '\OpenAPI\Client\Model\Subscription',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Subscription',
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
     * Operation updateOrgSubscriptionAsync
     *
     * Update subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest $update_org_subscription_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateOrgSubscriptionAsync($organization_id, $subscription_id, $update_org_subscription_request = null)
    {
        return $this->updateOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id, $update_org_subscription_request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateOrgSubscriptionAsyncWithHttpInfo
     *
     * Update subscription
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest $update_org_subscription_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateOrgSubscriptionAsyncWithHttpInfo($organization_id, $subscription_id, $update_org_subscription_request = null)
    {
        $returnType = '\OpenAPI\Client\Model\Subscription';
        $request = $this->updateOrgSubscriptionRequest($organization_id, $subscription_id, $update_org_subscription_request);

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
     * Create request for operation 'updateOrgSubscription'
     *
     * @param  string $organization_id The ID of the organization. (required)
     * @param  string $subscription_id The ID of the subscription. (required)
     * @param  \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest $update_org_subscription_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function updateOrgSubscriptionRequest($organization_id, $subscription_id, $update_org_subscription_request = null)
    {
        // verify the required parameter 'organization_id' is set
        if ($organization_id === null || (is_array($organization_id) && count($organization_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_id when calling updateOrgSubscription'
            );
        }
        // verify the required parameter 'subscription_id' is set
        if ($subscription_id === null || (is_array($subscription_id) && count($subscription_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subscription_id when calling updateOrgSubscription'
            );
        }

        $resourcePath = '/organizations/{organization_id}/subscriptions/{subscription_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($organization_id !== null) {
            $resourcePath = str_replace(
                '{' . 'organization_id' . '}',
                ObjectSerializer::toPathValue($organization_id),
                $resourcePath
            );
        }
        // path params
        if ($subscription_id !== null) {
            $resourcePath = str_replace(
                '{' . 'subscription_id' . '}',
                ObjectSerializer::toPathValue($subscription_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($update_org_subscription_request)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($update_org_subscription_request));
            } else {
                $httpBody = $update_org_subscription_request;
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

        return $this->createRequest('PATCH', $uri, $headers, $httpBody);
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
