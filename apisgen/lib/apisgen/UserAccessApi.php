<?php
/**
 * UserAccessApi
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
 * UserAccessApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserAccessApi
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
     * Operation getProjectUserAccess
     *
     * Get user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\UserProjectAccess|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function getProjectUserAccess($project_id, $user_id)
    {
        list($response) = $this->getProjectUserAccessWithHttpInfo($project_id, $user_id);
        return $response;
    }

    /**
     * Operation getProjectUserAccessWithHttpInfo
     *
     * Get user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\UserProjectAccess|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectUserAccessWithHttpInfo($project_id, $user_id)
    {
        $request = $this->getProjectUserAccessRequest($project_id, $user_id);

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
                        '\OpenAPI\Client\Model\UserProjectAccess',
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
                '\OpenAPI\Client\Model\UserProjectAccess',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UserProjectAccess',
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
     * Operation getProjectUserAccessAsync
     *
     * Get user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getProjectUserAccessAsync($project_id, $user_id)
    {
        return $this->getProjectUserAccessAsyncWithHttpInfo($project_id, $user_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectUserAccessAsyncWithHttpInfo
     *
     * Get user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getProjectUserAccessAsyncWithHttpInfo($project_id, $user_id)
    {
        $returnType = '\OpenAPI\Client\Model\UserProjectAccess';
        $request = $this->getProjectUserAccessRequest($project_id, $user_id);

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
     * Create request for operation 'getProjectUserAccess'
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getProjectUserAccessRequest($project_id, $user_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getProjectUserAccess'
            );
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling getProjectUserAccess'
            );
        }

        $resourcePath = '/projects/{project_id}/user-access/{user_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
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
     * Operation getUserProjectAccess
     *
     * Get project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\UserProjectAccess|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function getUserProjectAccess($user_id, $project_id)
    {
        list($response) = $this->getUserProjectAccessWithHttpInfo($user_id, $project_id);
        return $response;
    }

    /**
     * Operation getUserProjectAccessWithHttpInfo
     *
     * Get project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\UserProjectAccess|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserProjectAccessWithHttpInfo($user_id, $project_id)
    {
        $request = $this->getUserProjectAccessRequest($user_id, $project_id);

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
                        '\OpenAPI\Client\Model\UserProjectAccess',
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
                '\OpenAPI\Client\Model\UserProjectAccess',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UserProjectAccess',
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
     * Operation getUserProjectAccessAsync
     *
     * Get project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getUserProjectAccessAsync($user_id, $project_id)
    {
        return $this->getUserProjectAccessAsyncWithHttpInfo($user_id, $project_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserProjectAccessAsyncWithHttpInfo
     *
     * Get project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getUserProjectAccessAsyncWithHttpInfo($user_id, $project_id)
    {
        $returnType = '\OpenAPI\Client\Model\UserProjectAccess';
        $request = $this->getUserProjectAccessRequest($user_id, $project_id);

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
     * Create request for operation 'getUserProjectAccess'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getUserProjectAccessRequest($user_id, $project_id)
    {
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling getUserProjectAccess'
            );
        }
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getUserProjectAccess'
            );
        }

        $resourcePath = '/users/{user_id}/project-access/{project_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
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
     * Operation grantProjectUserAccess
     *
     * Grant user access to a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner grant_project_user_access_request_inner (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function grantProjectUserAccess($project_id, $grant_project_user_access_request_inner)
    {
        $this->grantProjectUserAccessWithHttpInfo($project_id, $grant_project_user_access_request_inner);
    }

    /**
     * Operation grantProjectUserAccessWithHttpInfo
     *
     * Grant user access to a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function grantProjectUserAccessWithHttpInfo($project_id, $grant_project_user_access_request_inner)
    {
        $request = $this->grantProjectUserAccessRequest($project_id, $grant_project_user_access_request_inner);

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
     * Operation grantProjectUserAccessAsync
     *
     * Grant user access to a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function grantProjectUserAccessAsync($project_id, $grant_project_user_access_request_inner)
    {
        return $this->grantProjectUserAccessAsyncWithHttpInfo($project_id, $grant_project_user_access_request_inner)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation grantProjectUserAccessAsyncWithHttpInfo
     *
     * Grant user access to a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function grantProjectUserAccessAsyncWithHttpInfo($project_id, $grant_project_user_access_request_inner)
    {
        $returnType = '';
        $request = $this->grantProjectUserAccessRequest($project_id, $grant_project_user_access_request_inner);

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
     * Create request for operation 'grantProjectUserAccess'
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function grantProjectUserAccessRequest($project_id, $grant_project_user_access_request_inner)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling grantProjectUserAccess'
            );
        }
        // verify the required parameter 'grant_project_user_access_request_inner' is set
        if ($grant_project_user_access_request_inner === null || (is_array($grant_project_user_access_request_inner) && count($grant_project_user_access_request_inner) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $grant_project_user_access_request_inner when calling grantProjectUserAccess'
            );
        }

        $resourcePath = '/projects/{project_id}/user-access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($grant_project_user_access_request_inner)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($grant_project_user_access_request_inner));
            } else {
                $httpBody = $grant_project_user_access_request_inner;
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
     * Operation grantUserProjectAccess
     *
     * Grant project access to a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner grant_user_project_access_request_inner (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function grantUserProjectAccess($user_id, $grant_user_project_access_request_inner)
    {
        $this->grantUserProjectAccessWithHttpInfo($user_id, $grant_user_project_access_request_inner);
    }

    /**
     * Operation grantUserProjectAccessWithHttpInfo
     *
     * Grant project access to a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function grantUserProjectAccessWithHttpInfo($user_id, $grant_user_project_access_request_inner)
    {
        $request = $this->grantUserProjectAccessRequest($user_id, $grant_user_project_access_request_inner);

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
     * Operation grantUserProjectAccessAsync
     *
     * Grant project access to a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function grantUserProjectAccessAsync($user_id, $grant_user_project_access_request_inner)
    {
        return $this->grantUserProjectAccessAsyncWithHttpInfo($user_id, $grant_user_project_access_request_inner)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation grantUserProjectAccessAsyncWithHttpInfo
     *
     * Grant project access to a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function grantUserProjectAccessAsyncWithHttpInfo($user_id, $grant_user_project_access_request_inner)
    {
        $returnType = '';
        $request = $this->grantUserProjectAccessRequest($user_id, $grant_user_project_access_request_inner);

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
     * Create request for operation 'grantUserProjectAccess'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function grantUserProjectAccessRequest($user_id, $grant_user_project_access_request_inner)
    {
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling grantUserProjectAccess'
            );
        }
        // verify the required parameter 'grant_user_project_access_request_inner' is set
        if ($grant_user_project_access_request_inner === null || (is_array($grant_user_project_access_request_inner) && count($grant_user_project_access_request_inner) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $grant_user_project_access_request_inner when calling grantUserProjectAccess'
            );
        }

        $resourcePath = '/users/{user_id}/project-access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($grant_user_project_access_request_inner)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($grant_user_project_access_request_inner));
            } else {
                $httpBody = $grant_user_project_access_request_inner;
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
     * Operation listProjectUserAccess
     *
     * List user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListProjectUserAccess200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listProjectUserAccess($project_id, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        list($response) = $this->listProjectUserAccessWithHttpInfo($project_id, $page_size, $page_before, $page_after, $sort);
        return $response;
    }

    /**
     * Operation listProjectUserAccessWithHttpInfo
     *
     * List user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListProjectUserAccess200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectUserAccessWithHttpInfo($project_id, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $request = $this->listProjectUserAccessRequest($project_id, $page_size, $page_before, $page_after, $sort);

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
                        '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
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
                '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
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
     * Operation listProjectUserAccessAsync
     *
     * List user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectUserAccessAsync($project_id, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        return $this->listProjectUserAccessAsyncWithHttpInfo($project_id, $page_size, $page_before, $page_after, $sort)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listProjectUserAccessAsyncWithHttpInfo
     *
     * List user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listProjectUserAccessAsyncWithHttpInfo($project_id, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $returnType = '\OpenAPI\Client\Model\ListProjectUserAccess200Response';
        $request = $this->listProjectUserAccessRequest($project_id, $page_size, $page_before, $page_after, $sort);

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
     * Create request for operation 'listProjectUserAccess'
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listProjectUserAccessRequest($project_id, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listProjectUserAccess'
            );
        }
        if ($page_size !== null && $page_size > 200) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling UserAccessApi.listProjectUserAccess, must be smaller than or equal to 200.');
        }
        if ($page_size !== null && $page_size < 1) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling UserAccessApi.listProjectUserAccess, must be bigger than or equal to 1.');
        }


        $resourcePath = '/projects/{project_id}/user-access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

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
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
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
     * Operation listUserProjectAccess
     *
     * List project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListProjectUserAccess200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error
     */
    public function listUserProjectAccess($user_id, $filter_organization_id = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        list($response) = $this->listUserProjectAccessWithHttpInfo($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort);
        return $response;
    }

    /**
     * Operation listUserProjectAccessWithHttpInfo
     *
     * List project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListProjectUserAccess200Response|\OpenAPI\Client\Model\Error|\OpenAPI\Client\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function listUserProjectAccessWithHttpInfo($user_id, $filter_organization_id = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $request = $this->listUserProjectAccessRequest($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort);

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
                        '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
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
                '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListProjectUserAccess200Response',
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
     * Operation listUserProjectAccessAsync
     *
     * List project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listUserProjectAccessAsync($user_id, $filter_organization_id = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        return $this->listUserProjectAccessAsyncWithHttpInfo($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listUserProjectAccessAsyncWithHttpInfo
     *
     * List project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function listUserProjectAccessAsyncWithHttpInfo($user_id, $filter_organization_id = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $returnType = '\OpenAPI\Client\Model\ListProjectUserAccess200Response';
        $request = $this->listUserProjectAccessRequest($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort);

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
     * Create request for operation 'listUserProjectAccess'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
     * @param  int $page_size Determines the number of items to show. (optional)
     * @param  string $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param  string $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function listUserProjectAccessRequest($user_id, $filter_organization_id = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling listUserProjectAccess'
            );
        }
        if ($page_size !== null && $page_size > 200) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling UserAccessApi.listUserProjectAccess, must be smaller than or equal to 200.');
        }
        if ($page_size !== null && $page_size < 1) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling UserAccessApi.listUserProjectAccess, must be bigger than or equal to 1.');
        }


        $resourcePath = '/users/{user_id}/project-access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($filter_organization_id !== null) {
            if('form' === 'form' && is_array($filter_organization_id)) {
                foreach($filter_organization_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[organization_id]'] = $filter_organization_id;
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
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
     * Operation removeProjectUserAccess
     *
     * Remove user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function removeProjectUserAccess($project_id, $user_id)
    {
        $this->removeProjectUserAccessWithHttpInfo($project_id, $user_id);
    }

    /**
     * Operation removeProjectUserAccessWithHttpInfo
     *
     * Remove user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function removeProjectUserAccessWithHttpInfo($project_id, $user_id)
    {
        $request = $this->removeProjectUserAccessRequest($project_id, $user_id);

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
     * Operation removeProjectUserAccessAsync
     *
     * Remove user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function removeProjectUserAccessAsync($project_id, $user_id)
    {
        return $this->removeProjectUserAccessAsyncWithHttpInfo($project_id, $user_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation removeProjectUserAccessAsyncWithHttpInfo
     *
     * Remove user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function removeProjectUserAccessAsyncWithHttpInfo($project_id, $user_id)
    {
        $returnType = '';
        $request = $this->removeProjectUserAccessRequest($project_id, $user_id);

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
     * Create request for operation 'removeProjectUserAccess'
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function removeProjectUserAccessRequest($project_id, $user_id)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling removeProjectUserAccess'
            );
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling removeProjectUserAccess'
            );
        }

        $resourcePath = '/projects/{project_id}/user-access/{user_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
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
     * Operation removeUserProjectAccess
     *
     * Remove project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function removeUserProjectAccess($user_id, $project_id)
    {
        $this->removeUserProjectAccessWithHttpInfo($user_id, $project_id);
    }

    /**
     * Operation removeUserProjectAccessWithHttpInfo
     *
     * Remove project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function removeUserProjectAccessWithHttpInfo($user_id, $project_id)
    {
        $request = $this->removeUserProjectAccessRequest($user_id, $project_id);

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
     * Operation removeUserProjectAccessAsync
     *
     * Remove project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function removeUserProjectAccessAsync($user_id, $project_id)
    {
        return $this->removeUserProjectAccessAsyncWithHttpInfo($user_id, $project_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation removeUserProjectAccessAsyncWithHttpInfo
     *
     * Remove project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function removeUserProjectAccessAsyncWithHttpInfo($user_id, $project_id)
    {
        $returnType = '';
        $request = $this->removeUserProjectAccessRequest($user_id, $project_id);

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
     * Create request for operation 'removeUserProjectAccess'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function removeUserProjectAccessRequest($user_id, $project_id)
    {
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling removeUserProjectAccess'
            );
        }
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling removeUserProjectAccess'
            );
        }

        $resourcePath = '/users/{user_id}/project-access/{project_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
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
     * Operation updateProjectUserAccess
     *
     * Update user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request update_project_user_access_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request = null)
    {
        $this->updateProjectUserAccessWithHttpInfo($project_id, $user_id, $update_project_user_access_request);
    }

    /**
     * Operation updateProjectUserAccessWithHttpInfo
     *
     * Update user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProjectUserAccessWithHttpInfo($project_id, $user_id, $update_project_user_access_request = null)
    {
        $request = $this->updateProjectUserAccessRequest($project_id, $user_id, $update_project_user_access_request);

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
     * Operation updateProjectUserAccessAsync
     *
     * Update user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateProjectUserAccessAsync($project_id, $user_id, $update_project_user_access_request = null)
    {
        return $this->updateProjectUserAccessAsyncWithHttpInfo($project_id, $user_id, $update_project_user_access_request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateProjectUserAccessAsyncWithHttpInfo
     *
     * Update user access for a project
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateProjectUserAccessAsyncWithHttpInfo($project_id, $user_id, $update_project_user_access_request = null)
    {
        $returnType = '';
        $request = $this->updateProjectUserAccessRequest($project_id, $user_id, $update_project_user_access_request);

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
     * Create request for operation 'updateProjectUserAccess'
     *
     * @param  string $project_id The ID of the project. (required)
     * @param  string $user_id The ID of the user. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function updateProjectUserAccessRequest($project_id, $user_id, $update_project_user_access_request = null)
    {
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateProjectUserAccess'
            );
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling updateProjectUserAccess'
            );
        }

        $resourcePath = '/projects/{project_id}/user-access/{user_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }
        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($update_project_user_access_request)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($update_project_user_access_request));
            } else {
                $httpBody = $update_project_user_access_request;
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
     * Operation updateUserProjectAccess
     *
     * Update project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request update_project_user_access_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function updateUserProjectAccess($user_id, $project_id, $update_project_user_access_request = null)
    {
        $this->updateUserProjectAccessWithHttpInfo($user_id, $project_id, $update_project_user_access_request);
    }

    /**
     * Operation updateUserProjectAccessWithHttpInfo
     *
     * Update project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateUserProjectAccessWithHttpInfo($user_id, $project_id, $update_project_user_access_request = null)
    {
        $request = $this->updateUserProjectAccessRequest($user_id, $project_id, $update_project_user_access_request);

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
     * Operation updateUserProjectAccessAsync
     *
     * Update project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateUserProjectAccessAsync($user_id, $project_id, $update_project_user_access_request = null)
    {
        return $this->updateUserProjectAccessAsyncWithHttpInfo($user_id, $project_id, $update_project_user_access_request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateUserProjectAccessAsyncWithHttpInfo
     *
     * Update project access for a user
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function updateUserProjectAccessAsyncWithHttpInfo($user_id, $project_id, $update_project_user_access_request = null)
    {
        $returnType = '';
        $request = $this->updateUserProjectAccessRequest($user_id, $project_id, $update_project_user_access_request);

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
     * Create request for operation 'updateUserProjectAccess'
     *
     * @param  string $user_id The ID of the user. (required)
     * @param  string $project_id The ID of the project. (required)
     * @param  \OpenAPI\Client\Model\UpdateProjectUserAccessRequest $update_project_user_access_request (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function updateUserProjectAccessRequest($user_id, $project_id, $update_project_user_access_request = null)
    {
        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling updateUserProjectAccess'
            );
        }
        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateUserProjectAccess'
            );
        }

        $resourcePath = '/users/{user_id}/project-access/{project_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($project_id !== null) {
            $resourcePath = str_replace(
                '{' . 'project_id' . '}',
                ObjectSerializer::toPathValue($project_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            'application/json',
            $multipart
        );

        // for model (json/xml)
        if (isset($update_project_user_access_request)) {
            if ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($update_project_user_access_request));
            } else {
                $httpBody = $update_project_user_access_request;
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
