<?php
/**
 * EnvironmentApi
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
        'activateEnvironment' => [
            'application/json',
        ],
        'branchEnvironment' => [
            'application/json',
        ],
        'createProjectsEnvironmentsVersions' => [
            'application/json',
        ],
        'deactivateEnvironment' => [
            'application/json',
        ],
        'deleteEnvironment' => [
            'application/json',
        ],
        'deleteProjectsEnvironmentsVersions' => [
            'application/json',
        ],
        'getEnvironment' => [
            'application/json',
        ],
        'getProjectsEnvironmentsVersions' => [
            'application/json',
        ],
        'initializeEnvironment' => [
            'application/json',
        ],
        'listProjectsEnvironments' => [
            'application/json',
        ],
        'listProjectsEnvironmentsVersions' => [
            'application/json',
        ],
        'mergeEnvironment' => [
            'application/json',
        ],
        'pauseEnvironment' => [
            'application/json',
        ],
        'redeployEnvironment' => [
            'application/json',
        ],
        'resumeEnvironment' => [
            'application/json',
        ],
        'synchronizeEnvironment' => [
            'application/json',
        ],
        'updateEnvironment' => [
            'application/json',
        ],
        'updateProjectsEnvironmentsVersions' => [
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
     * Operation activateEnvironment
     *
     * Activate an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function activateEnvironment($project_id, $environment_id, $environment_activate_input, string $contentType = self::contentTypes['activateEnvironment'][0])
    {
        list($response) = $this->activateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_activate_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function activateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_activate_input, string $contentType = self::contentTypes['activateEnvironment'][0])
    {
        $request = $this->activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input, $contentType);

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
     * Operation activateEnvironmentAsync
     *
     * Activate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function activateEnvironmentAsync($project_id, $environment_id, $environment_activate_input, string $contentType = self::contentTypes['activateEnvironment'][0])
    {
        return $this->activateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_activate_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function activateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_activate_input, string $contentType = self::contentTypes['activateEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input, $contentType);

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
     * Create request for operation 'activateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentActivateInput $environment_activate_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function activateEnvironmentRequest($project_id, $environment_id, $environment_activate_input, string $contentType = self::contentTypes['activateEnvironment'][0])
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
        if (isset($environment_activate_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_activate_input));
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
     * Operation branchEnvironment
     *
     * Branch an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['branchEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function branchEnvironment($project_id, $environment_id, $environment_branch_input, string $contentType = self::contentTypes['branchEnvironment'][0])
    {
        list($response) = $this->branchEnvironmentWithHttpInfo($project_id, $environment_id, $environment_branch_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['branchEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function branchEnvironmentWithHttpInfo($project_id, $environment_id, $environment_branch_input, string $contentType = self::contentTypes['branchEnvironment'][0])
    {
        $request = $this->branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input, $contentType);

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
     * Operation branchEnvironmentAsync
     *
     * Branch an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['branchEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function branchEnvironmentAsync($project_id, $environment_id, $environment_branch_input, string $contentType = self::contentTypes['branchEnvironment'][0])
    {
        return $this->branchEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_branch_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['branchEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function branchEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_branch_input, string $contentType = self::contentTypes['branchEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input, $contentType);

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
     * Create request for operation 'branchEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentBranchInput $environment_branch_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['branchEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function branchEnvironmentRequest($project_id, $environment_id, $environment_branch_input, string $contentType = self::contentTypes['branchEnvironment'][0])
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
        if (isset($environment_branch_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_branch_input));
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
     * Operation createProjectsEnvironmentsVersions
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function createProjectsEnvironmentsVersions($project_id, $environment_id, $version_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsVersions'][0])
    {
        list($response) = $this->createProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_create_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsVersions'][0])
    {
        $request = $this->createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input, $contentType);

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
     * Operation createProjectsEnvironmentsVersionsAsync
     *
     * Create versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsVersions'][0])
    {
        return $this->createProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_create_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsVersions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input, $contentType);

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
     * Create request for operation 'createProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\VersionCreateInput $version_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_create_input, string $contentType = self::contentTypes['createProjectsEnvironmentsVersions'][0])
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
        if (isset($version_create_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($version_create_input));
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
     * Operation deactivateEnvironment
     *
     * Deactivate an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deactivateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deactivateEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['deactivateEnvironment'][0])
    {
        list($response) = $this->deactivateEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation deactivateEnvironmentWithHttpInfo
     *
     * Deactivate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deactivateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deactivateEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['deactivateEnvironment'][0])
    {
        $request = $this->deactivateEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Operation deactivateEnvironmentAsync
     *
     * Deactivate an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deactivateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deactivateEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['deactivateEnvironment'][0])
    {
        return $this->deactivateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deactivateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deactivateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['deactivateEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deactivateEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'deactivateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deactivateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deactivateEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['deactivateEnvironment'][0])
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteEnvironment
     *
     * Delete an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['deleteEnvironment'][0])
    {
        list($response) = $this->deleteEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation deleteEnvironmentWithHttpInfo
     *
     * Delete an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['deleteEnvironment'][0])
    {
        $request = $this->deleteEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Operation deleteEnvironmentAsync
     *
     * Delete an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['deleteEnvironment'][0])
    {
        return $this->deleteEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['deleteEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'deleteEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['deleteEnvironment'][0])
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
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteProjectsEnvironmentsVersions
     *
     * Delete the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function deleteProjectsEnvironmentsVersions($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsVersions'][0])
    {
        list($response) = $this->deleteProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsVersions'][0])
    {
        $request = $this->deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $contentType);

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
     * Operation deleteProjectsEnvironmentsVersionsAsync
     *
     * Delete the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsVersions'][0])
    {
        return $this->deleteProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsVersions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $contentType);

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
     * Create request for operation 'deleteProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['deleteProjectsEnvironmentsVersions'][0])
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
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
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
     * Operation getEnvironment
     *
     * Get an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Environment
     */
    public function getEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['getEnvironment'][0])
    {
        list($response) = $this->getEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation getEnvironmentWithHttpInfo
     *
     * Get an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Environment, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['getEnvironment'][0])
    {
        $request = $this->getEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['getEnvironment'][0])
    {
        return $this->getEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['getEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Environment';
        $request = $this->getEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'getEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['getEnvironment'][0])
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
     * Operation getProjectsEnvironmentsVersions
     *
     * List the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Version
     */
    public function getProjectsEnvironmentsVersions($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['getProjectsEnvironmentsVersions'][0])
    {
        list($response) = $this->getProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Version, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['getProjectsEnvironmentsVersions'][0])
    {
        $request = $this->getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $contentType);

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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['getProjectsEnvironmentsVersions'][0])
    {
        return $this->getProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['getProjectsEnvironmentsVersions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Version';
        $request = $this->getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $contentType);

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
     * Create request for operation 'getProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, string $contentType = self::contentTypes['getProjectsEnvironmentsVersions'][0])
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
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
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
     * Operation initializeEnvironment
     *
     * Initialize a new environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['initializeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function initializeEnvironment($project_id, $environment_id, $environment_initialize_input, string $contentType = self::contentTypes['initializeEnvironment'][0])
    {
        list($response) = $this->initializeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_initialize_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['initializeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function initializeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_initialize_input, string $contentType = self::contentTypes['initializeEnvironment'][0])
    {
        $request = $this->initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input, $contentType);

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
     * Operation initializeEnvironmentAsync
     *
     * Initialize a new environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['initializeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function initializeEnvironmentAsync($project_id, $environment_id, $environment_initialize_input, string $contentType = self::contentTypes['initializeEnvironment'][0])
    {
        return $this->initializeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_initialize_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['initializeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function initializeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_initialize_input, string $contentType = self::contentTypes['initializeEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input, $contentType);

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
     * Create request for operation 'initializeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentInitializeInput $environment_initialize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['initializeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function initializeEnvironmentRequest($project_id, $environment_id, $environment_initialize_input, string $contentType = self::contentTypes['initializeEnvironment'][0])
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
        if (isset($environment_initialize_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_initialize_input));
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
     * Operation listProjectsEnvironments
     *
     * Get list of project environments
     *
     * @param  string $project_id project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironments'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Environment[]
     */
    public function listProjectsEnvironments($project_id, string $contentType = self::contentTypes['listProjectsEnvironments'][0])
    {
        list($response) = $this->listProjectsEnvironmentsWithHttpInfo($project_id, $contentType);
        return $response;
    }

    /**
     * Operation listProjectsEnvironmentsWithHttpInfo
     *
     * Get list of project environments
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironments'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Environment[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsEnvironmentsWithHttpInfo($project_id, string $contentType = self::contentTypes['listProjectsEnvironments'][0])
    {
        $request = $this->listProjectsEnvironmentsRequest($project_id, $contentType);

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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironments'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsAsync($project_id, string $contentType = self::contentTypes['listProjectsEnvironments'][0])
    {
        return $this->listProjectsEnvironmentsAsyncWithHttpInfo($project_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironments'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsAsyncWithHttpInfo($project_id, string $contentType = self::contentTypes['listProjectsEnvironments'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Environment[]';
        $request = $this->listProjectsEnvironmentsRequest($project_id, $contentType);

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
     * Create request for operation 'listProjectsEnvironments'
     *
     * @param  string $project_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironments'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listProjectsEnvironmentsRequest($project_id, string $contentType = self::contentTypes['listProjectsEnvironments'][0])
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
     * Operation listProjectsEnvironmentsVersions
     *
     * List versions associated with the environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\Version[]
     */
    public function listProjectsEnvironmentsVersions($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsVersions'][0])
    {
        list($response) = $this->listProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation listProjectsEnvironmentsVersionsWithHttpInfo
     *
     * List versions associated with the environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\Version[], HTTP status code, HTTP response headers (array of strings)
     */
    public function listProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsVersions'][0])
    {
        $request = $this->listProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $contentType);

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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsVersionsAsync($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsVersions'][0])
    {
        return $this->listProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsVersions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\Version[]';
        $request = $this->listProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'listProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listProjectsEnvironmentsVersionsRequest($project_id, $environment_id, string $contentType = self::contentTypes['listProjectsEnvironmentsVersions'][0])
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
     * Operation mergeEnvironment
     *
     * Merge an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['mergeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function mergeEnvironment($project_id, $environment_id, $environment_merge_input, string $contentType = self::contentTypes['mergeEnvironment'][0])
    {
        list($response) = $this->mergeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_merge_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['mergeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function mergeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_merge_input, string $contentType = self::contentTypes['mergeEnvironment'][0])
    {
        $request = $this->mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input, $contentType);

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
     * Operation mergeEnvironmentAsync
     *
     * Merge an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['mergeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function mergeEnvironmentAsync($project_id, $environment_id, $environment_merge_input, string $contentType = self::contentTypes['mergeEnvironment'][0])
    {
        return $this->mergeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_merge_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['mergeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function mergeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_merge_input, string $contentType = self::contentTypes['mergeEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input, $contentType);

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
     * Create request for operation 'mergeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentMergeInput $environment_merge_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['mergeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function mergeEnvironmentRequest($project_id, $environment_id, $environment_merge_input, string $contentType = self::contentTypes['mergeEnvironment'][0])
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
        if (isset($environment_merge_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_merge_input));
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
     * Operation pauseEnvironment
     *
     * Pause an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['pauseEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function pauseEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['pauseEnvironment'][0])
    {
        list($response) = $this->pauseEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation pauseEnvironmentWithHttpInfo
     *
     * Pause an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['pauseEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function pauseEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['pauseEnvironment'][0])
    {
        $request = $this->pauseEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Operation pauseEnvironmentAsync
     *
     * Pause an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['pauseEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function pauseEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['pauseEnvironment'][0])
    {
        return $this->pauseEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['pauseEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function pauseEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['pauseEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->pauseEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'pauseEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['pauseEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function pauseEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['pauseEnvironment'][0])
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation redeployEnvironment
     *
     * Redeploy an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['redeployEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function redeployEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['redeployEnvironment'][0])
    {
        list($response) = $this->redeployEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation redeployEnvironmentWithHttpInfo
     *
     * Redeploy an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['redeployEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function redeployEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['redeployEnvironment'][0])
    {
        $request = $this->redeployEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Operation redeployEnvironmentAsync
     *
     * Redeploy an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['redeployEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function redeployEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['redeployEnvironment'][0])
    {
        return $this->redeployEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['redeployEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function redeployEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['redeployEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->redeployEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'redeployEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['redeployEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function redeployEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['redeployEnvironment'][0])
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resumeEnvironment
     *
     * Resume a paused environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['resumeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function resumeEnvironment($project_id, $environment_id, string $contentType = self::contentTypes['resumeEnvironment'][0])
    {
        list($response) = $this->resumeEnvironmentWithHttpInfo($project_id, $environment_id, $contentType);
        return $response;
    }

    /**
     * Operation resumeEnvironmentWithHttpInfo
     *
     * Resume a paused environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['resumeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function resumeEnvironmentWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['resumeEnvironment'][0])
    {
        $request = $this->resumeEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Operation resumeEnvironmentAsync
     *
     * Resume a paused environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['resumeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resumeEnvironmentAsync($project_id, $environment_id, string $contentType = self::contentTypes['resumeEnvironment'][0])
    {
        return $this->resumeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['resumeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resumeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, string $contentType = self::contentTypes['resumeEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->resumeEnvironmentRequest($project_id, $environment_id, $contentType);

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
     * Create request for operation 'resumeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['resumeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function resumeEnvironmentRequest($project_id, $environment_id, string $contentType = self::contentTypes['resumeEnvironment'][0])
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation synchronizeEnvironment
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['synchronizeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function synchronizeEnvironment($project_id, $environment_id, $environment_synchronize_input, string $contentType = self::contentTypes['synchronizeEnvironment'][0])
    {
        list($response) = $this->synchronizeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_synchronize_input, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['synchronizeEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function synchronizeEnvironmentWithHttpInfo($project_id, $environment_id, $environment_synchronize_input, string $contentType = self::contentTypes['synchronizeEnvironment'][0])
    {
        $request = $this->synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input, $contentType);

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
     * Operation synchronizeEnvironmentAsync
     *
     * Synchronize a child environment with its parent
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['synchronizeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function synchronizeEnvironmentAsync($project_id, $environment_id, $environment_synchronize_input, string $contentType = self::contentTypes['synchronizeEnvironment'][0])
    {
        return $this->synchronizeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_synchronize_input, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['synchronizeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function synchronizeEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_synchronize_input, string $contentType = self::contentTypes['synchronizeEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input, $contentType);

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
     * Create request for operation 'synchronizeEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentSynchronizeInput $environment_synchronize_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['synchronizeEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function synchronizeEnvironmentRequest($project_id, $environment_id, $environment_synchronize_input, string $contentType = self::contentTypes['synchronizeEnvironment'][0])
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
        if (isset($environment_synchronize_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_synchronize_input));
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
     * Operation updateEnvironment
     *
     * Update an environment
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateEnvironment($project_id, $environment_id, $environment_patch, string $contentType = self::contentTypes['updateEnvironment'][0])
    {
        list($response) = $this->updateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_patch, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironment'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateEnvironmentWithHttpInfo($project_id, $environment_id, $environment_patch, string $contentType = self::contentTypes['updateEnvironment'][0])
    {
        $request = $this->updateEnvironmentRequest($project_id, $environment_id, $environment_patch, $contentType);

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
     * Operation updateEnvironmentAsync
     *
     * Update an environment
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateEnvironmentAsync($project_id, $environment_id, $environment_patch, string $contentType = self::contentTypes['updateEnvironment'][0])
    {
        return $this->updateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_patch, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateEnvironmentAsyncWithHttpInfo($project_id, $environment_id, $environment_patch, string $contentType = self::contentTypes['updateEnvironment'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateEnvironmentRequest($project_id, $environment_id, $environment_patch, $contentType);

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
     * Create request for operation 'updateEnvironment'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentPatch $environment_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironment'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateEnvironmentRequest($project_id, $environment_id, $environment_patch, string $contentType = self::contentTypes['updateEnvironment'][0])
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
        if (isset($environment_patch)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_patch));
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
     * Operation updateProjectsEnvironmentsVersions
     *
     * Update the version
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_id environment_id (required)
     * @param  string $version_id version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     */
    public function updateProjectsEnvironmentsVersions($project_id, $environment_id, $version_id, $version_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsVersions'][0])
    {
        list($response) = $this->updateProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $version_patch, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProjectsEnvironmentsVersionsWithHttpInfo($project_id, $environment_id, $version_id, $version_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsVersions'][0])
    {
        $request = $this->updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch, $contentType);

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
     * Operation updateProjectsEnvironmentsVersionsAsync
     *
     * Update the version
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsEnvironmentsVersionsAsync($project_id, $environment_id, $version_id, $version_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsVersions'][0])
    {
        return $this->updateProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $version_patch, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateProjectsEnvironmentsVersionsAsyncWithHttpInfo($project_id, $environment_id, $version_id, $version_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsVersions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch, $contentType);

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
     * Create request for operation 'updateProjectsEnvironmentsVersions'
     *
     * @param  string $project_id (required)
     * @param  string $environment_id (required)
     * @param  string $version_id (required)
     * @param  \OpenAPI\Client\Model\VersionPatch $version_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateProjectsEnvironmentsVersions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateProjectsEnvironmentsVersionsRequest($project_id, $environment_id, $version_id, $version_patch, string $contentType = self::contentTypes['updateProjectsEnvironmentsVersions'][0])
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
        if ($version_id !== null) {
            $resourcePath = str_replace(
                '{' . 'versionId' . '}',
                ObjectSerializer::toPathValue($version_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($version_patch)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($version_patch));
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
