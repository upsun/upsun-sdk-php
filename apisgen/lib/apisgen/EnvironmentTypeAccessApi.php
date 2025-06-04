<?php
/**
 * EnvironmentTypeAccessApi
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
 * EnvironmentTypeAccessApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EnvironmentTypeAccessApi
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
        'createEnvironmentTypeAccess' => [
            'application/json',
        ],
        'deleteEnvironmentTypeAccess' => [
            'application/json',
        ],
        'getEnvironmentTypeAccess' => [
            'application/json',
        ],
        'listEnvironmentTypeAccess' => [
            'application/json',
        ],
        'updateEnvironmentTypeAccess' => [
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
     * Operation createEnvironmentTypeAccess
     *
     * Add a user to an environment ACL
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_type_id environment_type_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput $environment_type_access_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     * @deprecated
     */
    public function createEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_create_input, string $contentType = self::contentTypes['createEnvironmentTypeAccess'][0])
    {
        list($response) = $this->createEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_create_input, $contentType);
        return $response;
    }

    /**
     * Operation createEnvironmentTypeAccessWithHttpInfo
     *
     * Add a user to an environment ACL
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput $environment_type_access_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     * @deprecated
     */
    public function createEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_create_input, string $contentType = self::contentTypes['createEnvironmentTypeAccess'][0])
    {
        $request = $this->createEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_create_input, $contentType);

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
     * Operation createEnvironmentTypeAccessAsync
     *
     * Add a user to an environment ACL
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput $environment_type_access_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function createEnvironmentTypeAccessAsync($project_id, $environment_type_id, $environment_type_access_create_input, string $contentType = self::contentTypes['createEnvironmentTypeAccess'][0])
    {
        return $this->createEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_create_input, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createEnvironmentTypeAccessAsyncWithHttpInfo
     *
     * Add a user to an environment ACL
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput $environment_type_access_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function createEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_create_input, string $contentType = self::contentTypes['createEnvironmentTypeAccess'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->createEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_create_input, $contentType);

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
     * Create request for operation 'createEnvironmentTypeAccess'
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput $environment_type_access_create_input  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     * @deprecated
     */
    public function createEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_create_input, string $contentType = self::contentTypes['createEnvironmentTypeAccess'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling createEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_id' is set
        if ($environment_type_id === null || (is_array($environment_type_id) && count($environment_type_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_id when calling createEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_access_create_input' is set
        if ($environment_type_access_create_input === null || (is_array($environment_type_access_create_input) && count($environment_type_access_create_input) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_access_create_input when calling createEnvironmentTypeAccess'
            );
        }


        $resourcePath = '/projects/{projectId}/environment-types/{environmentTypeId}/access';
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
        if ($environment_type_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeId' . '}',
                ObjectSerializer::toPathValue($environment_type_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_type_access_create_input)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_type_access_create_input));
            } else {
                $httpBody = $environment_type_access_create_input;
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
     * Operation deleteEnvironmentTypeAccess
     *
     * Remove a user from an environment type
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_type_id environment_type_id (required)
     * @param  string $environment_type_access_id environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     * @deprecated
     */
    public function deleteEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['deleteEnvironmentTypeAccess'][0])
    {
        list($response) = $this->deleteEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $contentType);
        return $response;
    }

    /**
     * Operation deleteEnvironmentTypeAccessWithHttpInfo
     *
     * Remove a user from an environment type
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     * @deprecated
     */
    public function deleteEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['deleteEnvironmentTypeAccess'][0])
    {
        $request = $this->deleteEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $contentType);

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
     * Operation deleteEnvironmentTypeAccessAsync
     *
     * Remove a user from an environment type
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function deleteEnvironmentTypeAccessAsync($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['deleteEnvironmentTypeAccess'][0])
    {
        return $this->deleteEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteEnvironmentTypeAccessAsyncWithHttpInfo
     *
     * Remove a user from an environment type
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function deleteEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['deleteEnvironmentTypeAccess'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->deleteEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $contentType);

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
     * Create request for operation 'deleteEnvironmentTypeAccess'
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     * @deprecated
     */
    public function deleteEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['deleteEnvironmentTypeAccess'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling deleteEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_id' is set
        if ($environment_type_id === null || (is_array($environment_type_id) && count($environment_type_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_id when calling deleteEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_access_id' is set
        if ($environment_type_access_id === null || (is_array($environment_type_access_id) && count($environment_type_access_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_access_id when calling deleteEnvironmentTypeAccess'
            );
        }


        $resourcePath = '/projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId}';
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
        if ($environment_type_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeId' . '}',
                ObjectSerializer::toPathValue($environment_type_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_type_access_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeAccessId' . '}',
                ObjectSerializer::toPathValue($environment_type_access_id),
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
     * Operation getEnvironmentTypeAccess
     *
     * Get a single environment type&#39;s ACL entry
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_type_id environment_type_id (required)
     * @param  string $environment_type_access_id environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\EnvironmentTypeAccess
     * @deprecated
     */
    public function getEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['getEnvironmentTypeAccess'][0])
    {
        list($response) = $this->getEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $contentType);
        return $response;
    }

    /**
     * Operation getEnvironmentTypeAccessWithHttpInfo
     *
     * Get a single environment type&#39;s ACL entry
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\EnvironmentTypeAccess, HTTP status code, HTTP response headers (array of strings)
     * @deprecated
     */
    public function getEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['getEnvironmentTypeAccess'][0])
    {
        $request = $this->getEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $contentType);

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
                        '\OpenAPI\Client\Model\EnvironmentTypeAccess',
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
                '\OpenAPI\Client\Model\EnvironmentTypeAccess',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\EnvironmentTypeAccess',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getEnvironmentTypeAccessAsync
     *
     * Get a single environment type&#39;s ACL entry
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function getEnvironmentTypeAccessAsync($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['getEnvironmentTypeAccess'][0])
    {
        return $this->getEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getEnvironmentTypeAccessAsyncWithHttpInfo
     *
     * Get a single environment type&#39;s ACL entry
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function getEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['getEnvironmentTypeAccess'][0])
    {
        $returnType = '\OpenAPI\Client\Model\EnvironmentTypeAccess';
        $request = $this->getEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $contentType);

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
     * Create request for operation 'getEnvironmentTypeAccess'
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     * @deprecated
     */
    public function getEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, string $contentType = self::contentTypes['getEnvironmentTypeAccess'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling getEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_id' is set
        if ($environment_type_id === null || (is_array($environment_type_id) && count($environment_type_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_id when calling getEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_access_id' is set
        if ($environment_type_access_id === null || (is_array($environment_type_access_id) && count($environment_type_access_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_access_id when calling getEnvironmentTypeAccess'
            );
        }


        $resourcePath = '/projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId}';
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
        if ($environment_type_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeId' . '}',
                ObjectSerializer::toPathValue($environment_type_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_type_access_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeAccessId' . '}',
                ObjectSerializer::toPathValue($environment_type_access_id),
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
     * Operation listEnvironmentTypeAccess
     *
     * Get an environment type&#39;s access control list
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_type_id environment_type_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\EnvironmentTypeAccess[]
     * @deprecated
     */
    public function listEnvironmentTypeAccess($project_id, $environment_type_id, string $contentType = self::contentTypes['listEnvironmentTypeAccess'][0])
    {
        list($response) = $this->listEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $contentType);
        return $response;
    }

    /**
     * Operation listEnvironmentTypeAccessWithHttpInfo
     *
     * Get an environment type&#39;s access control list
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\EnvironmentTypeAccess[], HTTP status code, HTTP response headers (array of strings)
     * @deprecated
     */
    public function listEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, string $contentType = self::contentTypes['listEnvironmentTypeAccess'][0])
    {
        $request = $this->listEnvironmentTypeAccessRequest($project_id, $environment_type_id, $contentType);

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
                        '\OpenAPI\Client\Model\EnvironmentTypeAccess[]',
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
                '\OpenAPI\Client\Model\EnvironmentTypeAccess[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\EnvironmentTypeAccess[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation listEnvironmentTypeAccessAsync
     *
     * Get an environment type&#39;s access control list
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function listEnvironmentTypeAccessAsync($project_id, $environment_type_id, string $contentType = self::contentTypes['listEnvironmentTypeAccess'][0])
    {
        return $this->listEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listEnvironmentTypeAccessAsyncWithHttpInfo
     *
     * Get an environment type&#39;s access control list
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function listEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, string $contentType = self::contentTypes['listEnvironmentTypeAccess'][0])
    {
        $returnType = '\OpenAPI\Client\Model\EnvironmentTypeAccess[]';
        $request = $this->listEnvironmentTypeAccessRequest($project_id, $environment_type_id, $contentType);

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
     * Create request for operation 'listEnvironmentTypeAccess'
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     * @deprecated
     */
    public function listEnvironmentTypeAccessRequest($project_id, $environment_type_id, string $contentType = self::contentTypes['listEnvironmentTypeAccess'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling listEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_id' is set
        if ($environment_type_id === null || (is_array($environment_type_id) && count($environment_type_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_id when calling listEnvironmentTypeAccess'
            );
        }


        $resourcePath = '/projects/{projectId}/environment-types/{environmentTypeId}/access';
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
        if ($environment_type_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeId' . '}',
                ObjectSerializer::toPathValue($environment_type_id),
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
     * Operation updateEnvironmentTypeAccess
     *
     * Update an environment type user&#39;s role
     *
     * @param  string $project_id project_id (required)
     * @param  string $environment_type_id environment_type_id (required)
     * @param  string $environment_type_access_id environment_type_access_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessPatch $environment_type_access_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AcceptedResponse
     * @deprecated
     */
    public function updateEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, string $contentType = self::contentTypes['updateEnvironmentTypeAccess'][0])
    {
        list($response) = $this->updateEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, $contentType);
        return $response;
    }

    /**
     * Operation updateEnvironmentTypeAccessWithHttpInfo
     *
     * Update an environment type user&#39;s role
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessPatch $environment_type_access_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AcceptedResponse, HTTP status code, HTTP response headers (array of strings)
     * @deprecated
     */
    public function updateEnvironmentTypeAccessWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, string $contentType = self::contentTypes['updateEnvironmentTypeAccess'][0])
    {
        $request = $this->updateEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, $contentType);

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
     * Operation updateEnvironmentTypeAccessAsync
     *
     * Update an environment type user&#39;s role
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessPatch $environment_type_access_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function updateEnvironmentTypeAccessAsync($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, string $contentType = self::contentTypes['updateEnvironmentTypeAccess'][0])
    {
        return $this->updateEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateEnvironmentTypeAccessAsyncWithHttpInfo
     *
     * Update an environment type user&#39;s role
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessPatch $environment_type_access_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @deprecated
     */
    public function updateEnvironmentTypeAccessAsyncWithHttpInfo($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, string $contentType = self::contentTypes['updateEnvironmentTypeAccess'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AcceptedResponse';
        $request = $this->updateEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, $contentType);

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
     * Create request for operation 'updateEnvironmentTypeAccess'
     *
     * @param  string $project_id (required)
     * @param  string $environment_type_id (required)
     * @param  string $environment_type_access_id (required)
     * @param  \OpenAPI\Client\Model\EnvironmentTypeAccessPatch $environment_type_access_patch  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateEnvironmentTypeAccess'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     * @deprecated
     */
    public function updateEnvironmentTypeAccessRequest($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch, string $contentType = self::contentTypes['updateEnvironmentTypeAccess'][0])
    {

        // verify the required parameter 'project_id' is set
        if ($project_id === null || (is_array($project_id) && count($project_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $project_id when calling updateEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_id' is set
        if ($environment_type_id === null || (is_array($environment_type_id) && count($environment_type_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_id when calling updateEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_access_id' is set
        if ($environment_type_access_id === null || (is_array($environment_type_access_id) && count($environment_type_access_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_access_id when calling updateEnvironmentTypeAccess'
            );
        }

        // verify the required parameter 'environment_type_access_patch' is set
        if ($environment_type_access_patch === null || (is_array($environment_type_access_patch) && count($environment_type_access_patch) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $environment_type_access_patch when calling updateEnvironmentTypeAccess'
            );
        }


        $resourcePath = '/projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId}';
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
        if ($environment_type_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeId' . '}',
                ObjectSerializer::toPathValue($environment_type_id),
                $resourcePath
            );
        }
        // path params
        if ($environment_type_access_id !== null) {
            $resourcePath = str_replace(
                '{' . 'environmentTypeAccessId' . '}',
                ObjectSerializer::toPathValue($environment_type_access_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($environment_type_access_patch)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($environment_type_access_patch));
            } else {
                $httpBody = $environment_type_access_patch;
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
