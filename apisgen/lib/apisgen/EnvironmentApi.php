<?php
/**
 * EnvironmentApi
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
 * EnvironmentApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EnvironmentApi
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
     * Operation activateEnvironment
     *
     * Activate an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function activateEnvironment($project_id, $environment_id, $environment_activate_input)
    {
        list($response) = $this->activateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_activate_input);
        return $response;
    }

    /**
     * Operation activateEnvironmentWithHttpInfo
     *
     * Activate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function activateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_activate_input)
    {
        $request = $this->activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation activateEnvironmentAsync
     *
     * Activate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function activateEnvironmentAsync($project_id, $environment_id, $environment_activate_input)
    {
        return $this->activateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_activate_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation activateEnvironmentAsyncWithHttpInfo
     *
     * Activate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function activateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_activate_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input);

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
     * Create request for operation 'activateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling activateEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling activateEnvironment'
            );
        }
        // verify the required parameter 'environment_activate_input' is set
        if ($environment_activate_input === null || (is_array($environment_activate_input) && count($environment_activate_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_activate_input when calling activateEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/activate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_activate_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_activate_input));
            } else {
                $httpBody = $environment_activate_input;
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
     * Operation branchEnvironment
     *
     * Branch an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function branchEnvironment($project_id, $environment_id, $environment_branch_input)
    {
        list($response) = $this->branchEnvironmentWithHttpInfo($project_id, $environment_id, $environment_branch_input);
        return $response;
    }

    /**
     * Operation branchEnvironmentWithHttpInfo
     *
     * Branch an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function branchEnvironmentWithHttpInfo($project_id, $environment_id, $environment_branch_input)
    {
        $request = $this->branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation branchEnvironmentAsync
     *
     * Branch an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function branchEnvironmentAsync($project_id, $environment_id, $environment_branch_input)
    {
        return $this->branchEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_branch_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation branchEnvironmentAsyncWithHttpInfo
     *
     * Branch an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function branchEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_branch_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input);

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
     * Create request for operation 'branchEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling branchEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling branchEnvironment'
            );
        }
        // verify the required parameter 'environment_branch_input' is set
        if ($environment_branch_input === null || (is_array($environment_branch_input) && count($environment_branch_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_branch_input when calling branchEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/branch';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_branch_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_branch_input));
            } else {
                $httpBody = $environment_branch_input;
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
     * Operation createProjectsEnvironmentsVersions
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function createProjectsEnvironmentsVersions($project_id, $environment_id, $version_create_input)
    {
        list($response) = $this->createProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_create_input);
        return $response;
    }

    /**
     * Operation createProjectsEnvironmentsVersionsWithHttpInfo
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_create_input)
    {
        $request = $this->createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation createProjectsEnvironmentsVersionsAsync
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function createProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_create_input)
    {
        return $this->createProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_create_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createProjectsEnvironmentsVersionsAsyncWithHttpInfo
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function createProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_create_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input);

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
     * Create request for operation 'createProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling createProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling createProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'version_create_input' is set
        if ($version_create_input === null || (is_array($version_create_input) && count($version_create_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $version_create_input when calling createProjectsEnvironmentsVersions'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/versions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($version_create_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($version_create_input));
            } else {
                $httpBody = $version_create_input;
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
     * Operation deactivateEnvironment
     *
     * Deactivate an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deactivateEnvironment($project_id, $environment_id)
    {
        list($response) = $this->deactivateEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation deactivateEnvironmentWithHttpInfo
     *
     * Deactivate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deactivateEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->deactivateEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation deactivateEnvironmentAsync
     *
     * Deactivate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deactivateEnvironmentAsync($project_id, $environment_id)
    {
        return $this->deactivateEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deactivateEnvironmentAsyncWithHttpInfo
     *
     * Deactivate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deactivateEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deactivateEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'deactivateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function deactivateEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deactivateEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling deactivateEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/deactivate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }

    /**
     * Operation deleteEnvironment
     *
     * Delete an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteEnvironment($project_id, $environment_id)
    {
        list($response) = $this->deleteEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation deleteEnvironmentWithHttpInfo
     *
     * Delete an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->deleteEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation deleteEnvironmentAsync
     *
     * Delete an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteEnvironmentAsync($project_id, $environment_id)
    {
        return $this->deleteEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteEnvironmentAsyncWithHttpInfo
     *
     * Delete an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'deleteEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function deleteEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deleteEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling deleteEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation deleteProjectsEnvironmentsVersions
     *
     * Delete the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteProjectsEnvironmentsVersions($project_id, $environment_id, $version_id)
    {
        list($response) = $this->deleteProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id);
        return $response;
    }

    /**
     * Operation deleteProjectsEnvironmentsVersionsWithHttpInfo
     *
     * Delete the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id)
    {
        $request = $this->deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation deleteProjectsEnvironmentsVersionsAsync
     *
     * Delete the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id)
    {
        return $this->deleteProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteProjectsEnvironmentsVersionsAsyncWithHttpInfo
     *
     * Delete the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function deleteProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id);

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
     * Create request for operation 'deleteProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deleteProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling deleteProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'version_id' is set
        if ($version_id === null || (is_array($version_id) && count($version_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $version_id when calling deleteProjectsEnvironmentsVersions'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/versions/{versionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }
        // path params
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation getEnvironment
     *
     * Get an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Environment
     */
    public function getEnvironment($project_id, $environment_id)
    {
        list($response) = $this->getEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation getEnvironmentWithHttpInfo
     *
     * Get an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Environment, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->getEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Environment',
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
                '\OpenAPI\Client\Model\Environment',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Environment',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getEnvironmentAsync
     *
     * Get an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getEnvironmentAsync($project_id, $environment_id)
    {
        return $this->getEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getEnvironmentAsyncWithHttpInfo
     *
     * Get an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\Environment';
        $request = $this->getEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'getEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling getEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation getProjectsEnvironmentsVersions
     *
     * List the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Version
     */
    public function getProjectsEnvironmentsVersions($project_id, $environment_id, $version_id)
    {
        list($response) = $this->getProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id);
        return $response;
    }

    /**
     * Operation getProjectsEnvironmentsVersionsWithHttpInfo
     *
     * List the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Version, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id)
    {
        $request = $this->getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Version',
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
                '\OpenAPI\Client\Model\Version',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Version',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getProjectsEnvironmentsVersionsAsync
     *
     * List the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id)
    {
        return $this->getProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectsEnvironmentsVersionsAsyncWithHttpInfo
     *
     * List the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id)
    {
        $returnType = '\OpenAPI\Client\Model\Version';
        $request = $this->getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id);

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
     * Create request for operation 'getProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling getProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'version_id' is set
        if ($version_id === null || (is_array($version_id) && count($version_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $version_id when calling getProjectsEnvironmentsVersions'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/versions/{versionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }
        // path params
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation initializeEnvironment
     *
     * Initialize a new environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function initializeEnvironment($project_id, $environment_id, $environment_initialize_input)
    {
        list($response) = $this->initializeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_initialize_input);
        return $response;
    }

    /**
     * Operation initializeEnvironmentWithHttpInfo
     *
     * Initialize a new environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function initializeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_initialize_input)
    {
        $request = $this->initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation initializeEnvironmentAsync
     *
     * Initialize a new environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function initializeEnvironmentAsync($project_id, $environment_id, $environment_initialize_input)
    {
        return $this->initializeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_initialize_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation initializeEnvironmentAsyncWithHttpInfo
     *
     * Initialize a new environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function initializeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_initialize_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input);

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
     * Create request for operation 'initializeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling initializeEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling initializeEnvironment'
            );
        }
        // verify the required parameter 'environment_initialize_input' is set
        if ($environment_initialize_input === null || (is_array($environment_initialize_input) && count($environment_initialize_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_initialize_input when calling initializeEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/initialize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_initialize_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_initialize_input));
            } else {
                $httpBody = $environment_initialize_input;
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
     * Operation listProjectsEnvironments
     *
     * Get list of project environments
     *
     * @param  string $project_id project_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Environment[]
     */
    public function listProjectsEnvironments($project_id)
    {
        list($response) = $this->listProjectsEnvironmentsWithHttpInfo($project_id);
        return $response;
    }

    /**
     * Operation listProjectsEnvironmentsWithHttpInfo
     *
     * Get list of project environments
     *
     * @param  string $project_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Environment[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsEnvironmentsWithHttpInfo($project_id)
    {
        $request = $this->listProjectsEnvironmentsRequest($project_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Environment[]',
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
                '\OpenAPI\Client\Model\Environment[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Environment[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listProjectsEnvironmentsAsync
     *
     * Get list of project environments
     *
     * @param  string $project_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectsEnvironmentsAsync($project_id)
    {
        return $this->listProjectsEnvironmentsAsyncWithHttpInfo($project_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listProjectsEnvironmentsAsyncWithHttpInfo
     *
     * Get list of project environments
     *
     * @param  string $project_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectsEnvironmentsAsyncWithHttpInfo($project_id)
    {
        $returnType = '\OpenAPI\Client\Model\Environment[]';
        $request = $this->listProjectsEnvironmentsRequest($project_id);

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
     * Create request for operation 'listProjectsEnvironments'
     *
     * @param  string $project_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listProjectsEnvironmentsRequest($project_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listProjectsEnvironments'
            );
        }

        $resourcePath = '/projects/{projectId}/environments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation listProjectsEnvironmentsVersions
     *
     * List versions associated with the environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Version[]
     */
    public function listProjectsEnvironmentsVersions($project_id, $environment_id)
    {
        list($response) = $this->listProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation listProjectsEnvironmentsVersionsWithHttpInfo
     *
     * List versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Version[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->listProjectsEnvironmentsVersionsRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Version[]',
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
                '\OpenAPI\Client\Model\Version[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Version[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listProjectsEnvironmentsVersionsAsync
     *
     * List versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectsEnvironmentsVersionsAsync($project_id, $environment_id)
    {
        return $this->listProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listProjectsEnvironmentsVersionsAsyncWithHttpInfo
     *
     * List versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\Version[]';
        $request = $this->listProjectsEnvironmentsVersionsRequest($project_id, $environment_id);

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
     * Create request for operation 'listProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listProjectsEnvironmentsVersionsRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling listProjectsEnvironmentsVersions'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/versions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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
     * Operation mergeEnvironment
     *
     * Merge an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function mergeEnvironment($project_id, $environment_id, $environment_merge_input)
    {
        list($response) = $this->mergeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_merge_input);
        return $response;
    }

    /**
     * Operation mergeEnvironmentWithHttpInfo
     *
     * Merge an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function mergeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_merge_input)
    {
        $request = $this->mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation mergeEnvironmentAsync
     *
     * Merge an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function mergeEnvironmentAsync($project_id, $environment_id, $environment_merge_input)
    {
        return $this->mergeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_merge_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation mergeEnvironmentAsyncWithHttpInfo
     *
     * Merge an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function mergeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_merge_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input);

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
     * Create request for operation 'mergeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling mergeEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling mergeEnvironment'
            );
        }
        // verify the required parameter 'environment_merge_input' is set
        if ($environment_merge_input === null || (is_array($environment_merge_input) && count($environment_merge_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_merge_input when calling mergeEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/merge';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_merge_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_merge_input));
            } else {
                $httpBody = $environment_merge_input;
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
     * Operation pauseEnvironment
     *
     * Pause an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function pauseEnvironment($project_id, $environment_id)
    {
        list($response) = $this->pauseEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation pauseEnvironmentWithHttpInfo
     *
     * Pause an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function pauseEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->pauseEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation pauseEnvironmentAsync
     *
     * Pause an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function pauseEnvironmentAsync($project_id, $environment_id)
    {
        return $this->pauseEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation pauseEnvironmentAsyncWithHttpInfo
     *
     * Pause an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function pauseEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->pauseEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'pauseEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function pauseEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling pauseEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling pauseEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/pause';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }

    /**
     * Operation redeployEnvironment
     *
     * Redeploy an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function redeployEnvironment($project_id, $environment_id)
    {
        list($response) = $this->redeployEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation redeployEnvironmentWithHttpInfo
     *
     * Redeploy an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function redeployEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->redeployEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation redeployEnvironmentAsync
     *
     * Redeploy an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function redeployEnvironmentAsync($project_id, $environment_id)
    {
        return $this->redeployEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation redeployEnvironmentAsyncWithHttpInfo
     *
     * Redeploy an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function redeployEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->redeployEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'redeployEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function redeployEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling redeployEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling redeployEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/redeploy';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }

    /**
     * Operation resumeEnvironment
     *
     * Resume a paused environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function resumeEnvironment($project_id, $environment_id)
    {
        list($response) = $this->resumeEnvironmentWithHttpInfo($project_id, $environment_id);
        return $response;
    }

    /**
     * Operation resumeEnvironmentWithHttpInfo
     *
     * Resume a paused environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function resumeEnvironmentWithHttpInfo($project_id, $environment_id)
    {
        $request = $this->resumeEnvironmentRequest($project_id, $environment_id);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation resumeEnvironmentAsync
     *
     * Resume a paused environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function resumeEnvironmentAsync($project_id, $environment_id)
    {
        return $this->resumeEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resumeEnvironmentAsyncWithHttpInfo
     *
     * Resume a paused environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function resumeEnvironmentAsyncWithHttpInfo($project_id, $environment_id)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->resumeEnvironmentRequest($project_id, $environment_id);

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
     * Create request for operation 'resumeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function resumeEnvironmentRequest($project_id, $environment_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling resumeEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling resumeEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/resume';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
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

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }

    /**
     * Operation synchronizeEnvironment
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function synchronizeEnvironment($project_id, $environment_id, $environment_synchronize_input)
    {
        list($response) = $this->synchronizeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_synchronize_input);
        return $response;
    }

    /**
     * Operation synchronizeEnvironmentWithHttpInfo
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function synchronizeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_synchronize_input)
    {
        $request = $this->synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation synchronizeEnvironmentAsync
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function synchronizeEnvironmentAsync($project_id, $environment_id, $environment_synchronize_input)
    {
        return $this->synchronizeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_synchronize_input)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation synchronizeEnvironmentAsyncWithHttpInfo
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function synchronizeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_synchronize_input)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input);

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
     * Create request for operation 'synchronizeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling synchronizeEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling synchronizeEnvironment'
            );
        }
        // verify the required parameter 'environment_synchronize_input' is set
        if ($environment_synchronize_input === null || (is_array($environment_synchronize_input) && count($environment_synchronize_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_synchronize_input when calling synchronizeEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/synchronize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_synchronize_input)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_synchronize_input));
            } else {
                $httpBody = $environment_synchronize_input;
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
     * Operation updateEnvironment
     *
     * Update an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateEnvironment($project_id, $environment_id, $environment_patch)
    {
        list($response) = $this->updateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_patch);
        return $response;
    }

    /**
     * Operation updateEnvironmentWithHttpInfo
     *
     * Update an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_patch)
    {
        $request = $this->updateEnvironmentRequest($project_id, $environment_id, $environment_patch);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation updateEnvironmentAsync
     *
     * Update an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateEnvironmentAsync($project_id, $environment_id, $environment_patch)
    {
        return $this->updateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_patch)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateEnvironmentAsyncWithHttpInfo
     *
     * Update an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_patch)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateEnvironmentRequest($project_id, $environment_id, $environment_patch);

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
     * Create request for operation 'updateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function updateEnvironmentRequest($project_id, $environment_id, $environment_patch)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateEnvironment'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling updateEnvironment'
            );
        }
        // verify the required parameter 'environment_patch' is set
        if ($environment_patch === null || (is_array($environment_patch) && count($environment_patch) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_patch when calling updateEnvironment'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_patch)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($environment_patch));
            } else {
                $httpBody = $environment_patch;
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
     * Operation updateProjectsEnvironmentsVersions
     *
     * Update the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateProjectsEnvironmentsVersions($project_id, $environment_id, $version_id, $version_patch)
    {
        list($response) = $this->updateProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $version_patch);
        return $response;
    }

    /**
     * Operation updateProjectsEnvironmentsVersionsWithHttpInfo
     *
     * Update the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $version_patch)
    {
        $request = $this->updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\AcceptedResponse',
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
                '\OpenAPI\Client\Model\AcceptedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\AcceptedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation updateProjectsEnvironmentsVersionsAsync
     *
     * Update the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id, $version_patch)
    {
        return $this->updateProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $version_patch)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateProjectsEnvironmentsVersionsAsyncWithHttpInfo
     *
     * Update the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $version_patch)
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch);

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
     * Create request for operation 'updateProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling updateProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'version_id' is set
        if ($version_id === null || (is_array($version_id) && count($version_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $version_id when calling updateProjectsEnvironmentsVersions'
            );
        }
        // verify the required parameter 'version_patch' is set
        if ($version_patch === null || (is_array($version_patch) && count($version_patch) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $version_patch when calling updateProjectsEnvironmentsVersions'
            );
        }

        $resourcePath = '/projects/{projectId}/environments/{environmentId}/versions/{versionId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'projectId' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentId' . '}',
                ObjectSerializer::toPathValue($environment_id),
                $resourcePath
            );
        }
        // path params
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($version_patch)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($version_patch));
            } else {
                $httpBody = $version_patch;
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
