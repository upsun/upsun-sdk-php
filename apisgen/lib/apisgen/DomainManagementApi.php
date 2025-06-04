<?php
/**
 * DomainManagementApi
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
 * Generator version: 7.13.0
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
 * DomainManagementApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DomainManagementApi
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
        'createProjectsDomains' => [
            'application/json',
        ],
        'createProjectsEnvironmentsDomains' => [
            'application/json',
        ],
        'deleteProjectsDomains' => [
            'application/json',
        ],
        'deleteProjectsEnvironmentsDomains' => [
            'application/json',
        ],
        'getProjectsDomains' => [
            'application/json',
        ],
        'getProjectsEnvironmentsDomains' => [
            'application/json',
        ],
        'listProjectsDomains' => [
            'application/json',
        ],
        'listProjectsEnvironmentsDomains' => [
            'application/json',
        ],
        'updateProjectsDomains' => [
            'application/json',
        ],
        'updateProjectsEnvironmentsDomains' => [
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
     * Operation createProjectsDomains
     *
     * Add a project domain
     *
     * @param  string $project_id project_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function createProjectsDomains($project_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsDomains'][0])
    {
        list($response) = $this->createProjectsDomainsWithHttpInfo($project_id, $domain_create_input, $contentType);
        return $response;
    }

    /**
     * Operation createProjectsDomainsWithHttpInfo
     *
     * Add a project domain
     *
     * @param  string $project_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProjectsDomainsWithHttpInfo($project_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsDomains'][0])
    {
        $request = $this->createProjectsDomainsRequest($project_id, $domain_create_input, $contentType);

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
     * Operation createProjectsDomainsAsync
     *
     * Add a project domain
     *
     * @param  string $project_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsDomainsAsync($project_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsDomains'][0])
    {
        return $this->createProjectsDomainsAsyncWithHttpInfo($project_id, $domain_create_input, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createProjectsDomainsAsyncWithHttpInfo
     *
     * Add a project domain
     *
     * @param  string $project_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsDomainsAsyncWithHttpInfo($project_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->createProjectsDomainsRequest($project_id, $domain_create_input, $contentType);

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
     * Create request for operation 'createProjectsDomains'
     *
     * @param  string $project_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createProjectsDomainsRequest($project_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling createProjectsDomains'
            );
        }

        // verify the required parameter 'domain_create_input' is set
        if ($domain_create_input === null || (is_array($domain_create_input) && count($domain_create_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_create_input when calling createProjectsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($domain_create_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($domain_create_input));
            } else {
                $httpBody = $domain_create_input;
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
     * Operation createProjectsEnvironmentsDomains
     *
     * Add an environment domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsDomains'][0])
    {
        list($response) = $this->createProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_create_input, $contentType);
        return $response;
    }

    /**
     * Operation createProjectsEnvironmentsDomainsWithHttpInfo
     *
     * Add an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsDomains'][0])
    {
        $request = $this->createProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_create_input, $contentType);

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
     * Operation createProjectsEnvironmentsDomainsAsync
     *
     * Add an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsEnvironmentsDomainsAsync($project_id, $environment_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsDomains'][0])
    {
        return $this->createProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_create_input, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createProjectsEnvironmentsDomainsAsyncWithHttpInfo
     *
     * Add an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->createProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_create_input, $contentType);

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
     * Create request for operation 'createProjectsEnvironmentsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\DomainCreateInput $domain_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling createProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling createProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'domain_create_input' is set
        if ($domain_create_input === null || (is_array($domain_create_input) && count($domain_create_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_create_input when calling createProjectsEnvironmentsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/environments/{environmentId}/domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($domain_create_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($domain_create_input));
            } else {
                $httpBody = $domain_create_input;
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
     * Operation deleteProjectsDomains
     *
     * Delete a project domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteProjectsDomains($project_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsDomains'][0])
    {
        list($response) = $this->deleteProjectsDomainsWithHttpInfo($project_id, $domain_id, $contentType);
        return $response;
    }

    /**
     * Operation deleteProjectsDomainsWithHttpInfo
     *
     * Delete a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectsDomainsWithHttpInfo($project_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsDomains'][0])
    {
        $request = $this->deleteProjectsDomainsRequest($project_id, $domain_id, $contentType);

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
     * Operation deleteProjectsDomainsAsync
     *
     * Delete a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsDomainsAsync($project_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsDomains'][0])
    {
        return $this->deleteProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteProjectsDomainsAsyncWithHttpInfo
     *
     * Delete a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteProjectsDomainsRequest($project_id, $domain_id, $contentType);

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
     * Create request for operation 'deleteProjectsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteProjectsDomainsRequest($project_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deleteProjectsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling deleteProjectsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
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
     * Operation deleteProjectsEnvironmentsDomains
     *
     * Delete an environment domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsDomains'][0])
    {
        list($response) = $this->deleteProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, $contentType);
        return $response;
    }

    /**
     * Operation deleteProjectsEnvironmentsDomainsWithHttpInfo
     *
     * Delete an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsDomains'][0])
    {
        $request = $this->deleteProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $contentType);

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
     * Operation deleteProjectsEnvironmentsDomainsAsync
     *
     * Delete an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsEnvironmentsDomainsAsync($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsDomains'][0])
    {
        return $this->deleteProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteProjectsEnvironmentsDomainsAsyncWithHttpInfo
     *
     * Delete an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $contentType);

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
     * Create request for operation 'deleteProjectsEnvironmentsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deleteProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling deleteProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling deleteProjectsEnvironmentsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/environments/{environmentId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
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
     * Operation getProjectsDomains
     *
     * Get a project domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Domain
     */
    public function getProjectsDomains($project_id, $domain_id, string $contentType = self::contentTypes['getProjectsDomains'][0])
    {
        list($response) = $this->getProjectsDomainsWithHttpInfo($project_id, $domain_id, $contentType);
        return $response;
    }

    /**
     * Operation getProjectsDomainsWithHttpInfo
     *
     * Get a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Domain, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectsDomainsWithHttpInfo($project_id, $domain_id, string $contentType = self::contentTypes['getProjectsDomains'][0])
    {
        $request = $this->getProjectsDomainsRequest($project_id, $domain_id, $contentType);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Domain',
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
                '\OpenAPI\Client\Model\Domain',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Domain',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getProjectsDomainsAsync
     *
     * Get a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsDomainsAsync($project_id, $domain_id, string $contentType = self::contentTypes['getProjectsDomains'][0])
    {
        return $this->getProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectsDomainsAsyncWithHttpInfo
     *
     * Get a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, string $contentType = self::contentTypes['getProjectsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Domain';
        $request = $this->getProjectsDomainsRequest($project_id, $domain_id, $contentType);

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
     * Create request for operation 'getProjectsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectsDomainsRequest($project_id, $domain_id, string $contentType = self::contentTypes['getProjectsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getProjectsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getProjectsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
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
     * Operation getProjectsEnvironmentsDomains
     *
     * Get an environment domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Domain
     */
    public function getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['getProjectsEnvironmentsDomains'][0])
    {
        list($response) = $this->getProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, $contentType);
        return $response;
    }

    /**
     * Operation getProjectsEnvironmentsDomainsWithHttpInfo
     *
     * Get an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Domain, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['getProjectsEnvironmentsDomains'][0])
    {
        $request = $this->getProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $contentType);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Domain',
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
                '\OpenAPI\Client\Model\Domain',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Domain',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getProjectsEnvironmentsDomainsAsync
     *
     * Get an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsEnvironmentsDomainsAsync($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['getProjectsEnvironmentsDomains'][0])
    {
        return $this->getProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectsEnvironmentsDomainsAsyncWithHttpInfo
     *
     * Get an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['getProjectsEnvironmentsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Domain';
        $request = $this->getProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $contentType);

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
     * Create request for operation 'getProjectsEnvironmentsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, string $contentType = self::contentTypes['getProjectsEnvironmentsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling getProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getProjectsEnvironmentsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/environments/{environmentId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
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
     * Operation listProjectsDomains
     *
     * Get list of project domains
     *
     * @param  string $project_id project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Domain[]
     */
    public function listProjectsDomains($project_id, string $contentType = self::contentTypes['listProjectsDomains'][0])
    {
        list($response) = $this->listProjectsDomainsWithHttpInfo($project_id, $contentType);
        return $response;
    }

    /**
     * Operation listProjectsDomainsWithHttpInfo
     *
     * Get list of project domains
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Domain[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsDomainsWithHttpInfo($project_id, string $contentType = self::contentTypes['listProjectsDomains'][0])
    {
        $request = $this->listProjectsDomainsRequest($project_id, $contentType);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Domain[]',
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
                '\OpenAPI\Client\Model\Domain[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Domain[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listProjectsDomainsAsync
     *
     * Get list of project domains
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsDomainsAsync($project_id, string $contentType = self::contentTypes['listProjectsDomains'][0])
    {
        return $this->listProjectsDomainsAsyncWithHttpInfo($project_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listProjectsDomainsAsyncWithHttpInfo
     *
     * Get list of project domains
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsDomainsAsyncWithHttpInfo($project_id, string $contentType = self::contentTypes['listProjectsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Domain[]';
        $request = $this->listProjectsDomainsRequest($project_id, $contentType);

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
     * Create request for operation 'listProjectsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listProjectsDomainsRequest($project_id, string $contentType = self::contentTypes['listProjectsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listProjectsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
            ['application/json', ],
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
     * Operation listProjectsEnvironmentsDomains
     *
     * Get a list of environment domains
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Domain[]
     */
    public function listProjectsEnvironmentsDomains($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsDomains'][0])
    {
        list($response) = $this->listProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation listProjectsEnvironmentsDomainsWithHttpInfo
     *
     * Get a list of environment domains
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Domain[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsDomains'][0])
    {
        $request = $this->listProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $contentType);

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
                default:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\Domain[]',
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
                '\OpenAPI\Client\Model\Domain[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\Domain[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listProjectsEnvironmentsDomainsAsync
     *
     * Get a list of environment domains
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsDomainsAsync($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsDomains'][0])
    {
        return $this->listProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listProjectsEnvironmentsDomainsAsyncWithHttpInfo
     *
     * Get a list of environment domains
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Domain[]';
        $request = $this->listProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'listProjectsEnvironmentsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listProjectsEnvironmentsDomainsRequest($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling listProjectsEnvironmentsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/environments/{environmentId}/domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
            ['application/json', ],
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
     * Operation updateProjectsDomains
     *
     * Update a project domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateProjectsDomains($project_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsDomains'][0])
    {
        list($response) = $this->updateProjectsDomainsWithHttpInfo($project_id, $domain_id, $domain_patch, $contentType);
        return $response;
    }

    /**
     * Operation updateProjectsDomainsWithHttpInfo
     *
     * Update a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProjectsDomainsWithHttpInfo($project_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsDomains'][0])
    {
        $request = $this->updateProjectsDomainsRequest($project_id, $domain_id, $domain_patch, $contentType);

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
     * Operation updateProjectsDomainsAsync
     *
     * Update a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsDomainsAsync($project_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsDomains'][0])
    {
        return $this->updateProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, $domain_patch, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateProjectsDomainsAsyncWithHttpInfo
     *
     * Update a project domain
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsDomainsAsyncWithHttpInfo($project_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateProjectsDomainsRequest($project_id, $domain_id, $domain_patch, $contentType);

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
     * Create request for operation 'updateProjectsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateProjectsDomainsRequest($project_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateProjectsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling updateProjectsDomains'
            );
        }

        // verify the required parameter 'domain_patch' is set
        if ($domain_patch === null || (is_array($domain_patch) && count($domain_patch) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_patch when calling updateProjectsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($domain_patch)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($domain_patch));
            } else {
                $httpBody = $domain_patch;
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
     * Operation updateProjectsEnvironmentsDomains
     *
     * Update an environment domain
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $domain_id domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsDomains'][0])
    {
        list($response) = $this->updateProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, $domain_patch, $contentType);
        return $response;
    }

    /**
     * Operation updateProjectsEnvironmentsDomainsWithHttpInfo
     *
     * Update an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProjectsEnvironmentsDomainsWithHttpInfo($project_id, $environment_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsDomains'][0])
    {
        $request = $this->updateProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $domain_patch, $contentType);

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
     * Operation updateProjectsEnvironmentsDomainsAsync
     *
     * Update an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsEnvironmentsDomainsAsync($project_id, $environment_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsDomains'][0])
    {
        return $this->updateProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, $domain_patch, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateProjectsEnvironmentsDomainsAsyncWithHttpInfo
     *
     * Update an environment domain
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsEnvironmentsDomainsAsyncWithHttpInfo($project_id, $environment_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsDomains'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $domain_patch, $contentType);

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
     * Create request for operation 'updateProjectsEnvironmentsDomains'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $domain_id (required)
     * @param  \OpenAPI\Client\Model\DomainPatch $domain_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsDomains'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateProjectsEnvironmentsDomainsRequest($project_id, $environment_id, $domain_id, $domain_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsDomains'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'environment_id' is set
        if ($environment_id === null || (is_array($environment_id) && count($environment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_id when calling updateProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling updateProjectsEnvironmentsDomains'
            );
        }

        // verify the required parameter 'domain_patch' is set
        if ($domain_patch === null || (is_array($domain_patch) && count($domain_patch) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_patch when calling updateProjectsEnvironmentsDomains'
            );
        }


        $resourcePath = '/projects/{projectId}/environments/{environmentId}/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($domain_patch)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($domain_patch));
            } else {
                $httpBody = $domain_patch;
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
