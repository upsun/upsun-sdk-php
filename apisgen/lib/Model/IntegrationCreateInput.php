<?php
/**
 * IntegrationCreateInput
 *
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

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * IntegrationCreateInput Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class IntegrationCreateInput implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'IntegrationCreateInput';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type' => 'string',
        'fetch_branches' => 'bool',
        'prune_branches' => 'bool',
        'environment_init_resources' => 'string',
        'app_credentials' => '\OpenAPI\Client\Model\TheOAuth2ConsumerInformationOptional1',
        'addon_credentials' => '\OpenAPI\Client\Model\TheAddonCredentialInformationOptional1',
        'repository' => 'string',
        'build_pull_requests' => 'bool',
        'pull_requests_clone_parent_data' => 'bool',
        'resync_pull_requests' => 'bool',
        'url' => 'string',
        'username' => 'string',
        'token' => 'string',
        'project' => 'string',
        'events' => 'string[]',
        'environments' => 'string[]',
        'excluded_environments' => 'string[]',
        'states' => 'string[]',
        'result' => 'string',
        'service_id' => 'string',
        'base_url' => 'string',
        'build_draft_pull_requests' => 'bool',
        'build_pull_requests_post_merge' => 'bool',
        'build_merge_requests' => 'bool',
        'build_wip_merge_requests' => 'bool',
        'merge_requests_clone_parent_data' => 'bool',
        'from_address' => 'string',
        'recipients' => 'string[]',
        'routing_key' => 'string',
        'channel' => 'string',
        'shared_key' => 'string',
        'extra' => 'array<string,string>',
        'headers' => 'array<string,string>',
        'tls_verify' => 'bool',
        'license_key' => 'string',
        'script' => 'string',
        'index' => 'string',
        'sourcetype' => 'string',
        'category' => 'string',
        'host' => 'string',
        'port' => 'int',
        'protocol' => 'string',
        'facility' => 'int',
        'message_format' => 'string',
        'auth_token' => 'string',
        'auth_mode' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'type' => null,
        'fetch_branches' => null,
        'prune_branches' => null,
        'environment_init_resources' => null,
        'app_credentials' => null,
        'addon_credentials' => null,
        'repository' => null,
        'build_pull_requests' => null,
        'pull_requests_clone_parent_data' => null,
        'resync_pull_requests' => null,
        'url' => null,
        'username' => null,
        'token' => null,
        'project' => null,
        'events' => null,
        'environments' => null,
        'excluded_environments' => null,
        'states' => null,
        'result' => null,
        'service_id' => null,
        'base_url' => null,
        'build_draft_pull_requests' => null,
        'build_pull_requests_post_merge' => null,
        'build_merge_requests' => null,
        'build_wip_merge_requests' => null,
        'merge_requests_clone_parent_data' => null,
        'from_address' => null,
        'recipients' => null,
        'routing_key' => null,
        'channel' => null,
        'shared_key' => null,
        'extra' => null,
        'headers' => null,
        'tls_verify' => null,
        'license_key' => null,
        'script' => null,
        'index' => null,
        'sourcetype' => null,
        'category' => null,
        'host' => null,
        'port' => null,
        'protocol' => null,
        'facility' => null,
        'message_format' => null,
        'auth_token' => null,
        'auth_mode' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'type' => false,
        'fetch_branches' => false,
        'prune_branches' => false,
        'environment_init_resources' => false,
        'app_credentials' => true,
        'addon_credentials' => true,
        'repository' => false,
        'build_pull_requests' => false,
        'pull_requests_clone_parent_data' => false,
        'resync_pull_requests' => false,
        'url' => false,
        'username' => false,
        'token' => false,
        'project' => false,
        'events' => false,
        'environments' => false,
        'excluded_environments' => false,
        'states' => false,
        'result' => false,
        'service_id' => false,
        'base_url' => false,
        'build_draft_pull_requests' => false,
        'build_pull_requests_post_merge' => false,
        'build_merge_requests' => false,
        'build_wip_merge_requests' => false,
        'merge_requests_clone_parent_data' => false,
        'from_address' => true,
        'recipients' => false,
        'routing_key' => false,
        'channel' => false,
        'shared_key' => true,
        'extra' => false,
        'headers' => false,
        'tls_verify' => false,
        'license_key' => false,
        'script' => false,
        'index' => false,
        'sourcetype' => false,
        'category' => false,
        'host' => false,
        'port' => false,
        'protocol' => false,
        'facility' => false,
        'message_format' => false,
        'auth_token' => false,
        'auth_mode' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'type' => 'type',
        'fetch_branches' => 'fetch_branches',
        'prune_branches' => 'prune_branches',
        'environment_init_resources' => 'environment_init_resources',
        'app_credentials' => 'app_credentials',
        'addon_credentials' => 'addon_credentials',
        'repository' => 'repository',
        'build_pull_requests' => 'build_pull_requests',
        'pull_requests_clone_parent_data' => 'pull_requests_clone_parent_data',
        'resync_pull_requests' => 'resync_pull_requests',
        'url' => 'url',
        'username' => 'username',
        'token' => 'token',
        'project' => 'project',
        'events' => 'events',
        'environments' => 'environments',
        'excluded_environments' => 'excluded_environments',
        'states' => 'states',
        'result' => 'result',
        'service_id' => 'service_id',
        'base_url' => 'base_url',
        'build_draft_pull_requests' => 'build_draft_pull_requests',
        'build_pull_requests_post_merge' => 'build_pull_requests_post_merge',
        'build_merge_requests' => 'build_merge_requests',
        'build_wip_merge_requests' => 'build_wip_merge_requests',
        'merge_requests_clone_parent_data' => 'merge_requests_clone_parent_data',
        'from_address' => 'from_address',
        'recipients' => 'recipients',
        'routing_key' => 'routing_key',
        'channel' => 'channel',
        'shared_key' => 'shared_key',
        'extra' => 'extra',
        'headers' => 'headers',
        'tls_verify' => 'tls_verify',
        'license_key' => 'license_key',
        'script' => 'script',
        'index' => 'index',
        'sourcetype' => 'sourcetype',
        'category' => 'category',
        'host' => 'host',
        'port' => 'port',
        'protocol' => 'protocol',
        'facility' => 'facility',
        'message_format' => 'message_format',
        'auth_token' => 'auth_token',
        'auth_mode' => 'auth_mode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'fetch_branches' => 'setFetchBranches',
        'prune_branches' => 'setPruneBranches',
        'environment_init_resources' => 'setEnvironmentInitResources',
        'app_credentials' => 'setAppCredentials',
        'addon_credentials' => 'setAddonCredentials',
        'repository' => 'setRepository',
        'build_pull_requests' => 'setBuildPullRequests',
        'pull_requests_clone_parent_data' => 'setPullRequestsCloneParentData',
        'resync_pull_requests' => 'setResyncPullRequests',
        'url' => 'setUrl',
        'username' => 'setUsername',
        'token' => 'setToken',
        'project' => 'setProject',
        'events' => 'setEvents',
        'environments' => 'setEnvironments',
        'excluded_environments' => 'setExcludedEnvironments',
        'states' => 'setStates',
        'result' => 'setResult',
        'service_id' => 'setServiceId',
        'base_url' => 'setBaseUrl',
        'build_draft_pull_requests' => 'setBuildDraftPullRequests',
        'build_pull_requests_post_merge' => 'setBuildPullRequestsPostMerge',
        'build_merge_requests' => 'setBuildMergeRequests',
        'build_wip_merge_requests' => 'setBuildWipMergeRequests',
        'merge_requests_clone_parent_data' => 'setMergeRequestsCloneParentData',
        'from_address' => 'setFromAddress',
        'recipients' => 'setRecipients',
        'routing_key' => 'setRoutingKey',
        'channel' => 'setChannel',
        'shared_key' => 'setSharedKey',
        'extra' => 'setExtra',
        'headers' => 'setHeaders',
        'tls_verify' => 'setTlsVerify',
        'license_key' => 'setLicenseKey',
        'script' => 'setScript',
        'index' => 'setIndex',
        'sourcetype' => 'setSourcetype',
        'category' => 'setCategory',
        'host' => 'setHost',
        'port' => 'setPort',
        'protocol' => 'setProtocol',
        'facility' => 'setFacility',
        'message_format' => 'setMessageFormat',
        'auth_token' => 'setAuthToken',
        'auth_mode' => 'setAuthMode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'fetch_branches' => 'getFetchBranches',
        'prune_branches' => 'getPruneBranches',
        'environment_init_resources' => 'getEnvironmentInitResources',
        'app_credentials' => 'getAppCredentials',
        'addon_credentials' => 'getAddonCredentials',
        'repository' => 'getRepository',
        'build_pull_requests' => 'getBuildPullRequests',
        'pull_requests_clone_parent_data' => 'getPullRequestsCloneParentData',
        'resync_pull_requests' => 'getResyncPullRequests',
        'url' => 'getUrl',
        'username' => 'getUsername',
        'token' => 'getToken',
        'project' => 'getProject',
        'events' => 'getEvents',
        'environments' => 'getEnvironments',
        'excluded_environments' => 'getExcludedEnvironments',
        'states' => 'getStates',
        'result' => 'getResult',
        'service_id' => 'getServiceId',
        'base_url' => 'getBaseUrl',
        'build_draft_pull_requests' => 'getBuildDraftPullRequests',
        'build_pull_requests_post_merge' => 'getBuildPullRequestsPostMerge',
        'build_merge_requests' => 'getBuildMergeRequests',
        'build_wip_merge_requests' => 'getBuildWipMergeRequests',
        'merge_requests_clone_parent_data' => 'getMergeRequestsCloneParentData',
        'from_address' => 'getFromAddress',
        'recipients' => 'getRecipients',
        'routing_key' => 'getRoutingKey',
        'channel' => 'getChannel',
        'shared_key' => 'getSharedKey',
        'extra' => 'getExtra',
        'headers' => 'getHeaders',
        'tls_verify' => 'getTlsVerify',
        'license_key' => 'getLicenseKey',
        'script' => 'getScript',
        'index' => 'getIndex',
        'sourcetype' => 'getSourcetype',
        'category' => 'getCategory',
        'host' => 'getHost',
        'port' => 'getPort',
        'protocol' => 'getProtocol',
        'facility' => 'getFacility',
        'message_format' => 'getMessageFormat',
        'auth_token' => 'getAuthToken',
        'auth_mode' => 'getAuthMode'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const ENVIRONMENT_INIT_RESOURCES__DEFAULT = 'default';
    public const ENVIRONMENT_INIT_RESOURCES_MANUAL = 'manual';
    public const ENVIRONMENT_INIT_RESOURCES_MINIMUM = 'minimum';
    public const ENVIRONMENT_INIT_RESOURCES_PARENT = 'parent';
    public const RESULT_STAR = '*';
    public const RESULT_FAILURE = 'failure';
    public const RESULT_SUCCESS = 'success';
    public const PROTOCOL_TCP = 'tcp';
    public const PROTOCOL_TLS = 'tls';
    public const PROTOCOL_UDP = 'udp';
    public const MESSAGE_FORMAT_RFC3164 = 'rfc3164';
    public const MESSAGE_FORMAT_RFC5424 = 'rfc5424';
    public const AUTH_MODE_PREFIX = 'prefix';
    public const AUTH_MODE_STRUCTURED_DATA = 'structured_data';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEnvironmentInitResourcesAllowableValues()
    {
        return [
            self::ENVIRONMENT_INIT_RESOURCES__DEFAULT,
            self::ENVIRONMENT_INIT_RESOURCES_MANUAL,
            self::ENVIRONMENT_INIT_RESOURCES_MINIMUM,
            self::ENVIRONMENT_INIT_RESOURCES_PARENT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getResultAllowableValues()
    {
        return [
            self::RESULT_STAR,
            self::RESULT_FAILURE,
            self::RESULT_SUCCESS,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProtocolAllowableValues()
    {
        return [
            self::PROTOCOL_TCP,
            self::PROTOCOL_TLS,
            self::PROTOCOL_UDP,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMessageFormatAllowableValues()
    {
        return [
            self::MESSAGE_FORMAT_RFC3164,
            self::MESSAGE_FORMAT_RFC5424,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAuthModeAllowableValues()
    {
        return [
            self::AUTH_MODE_PREFIX,
            self::AUTH_MODE_STRUCTURED_DATA,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('fetch_branches', $data ?? [], null);
        $this->setIfExists('prune_branches', $data ?? [], null);
        $this->setIfExists('environment_init_resources', $data ?? [], null);
        $this->setIfExists('app_credentials', $data ?? [], null);
        $this->setIfExists('addon_credentials', $data ?? [], null);
        $this->setIfExists('repository', $data ?? [], null);
        $this->setIfExists('build_pull_requests', $data ?? [], null);
        $this->setIfExists('pull_requests_clone_parent_data', $data ?? [], null);
        $this->setIfExists('resync_pull_requests', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('token', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('events', $data ?? [], null);
        $this->setIfExists('environments', $data ?? [], null);
        $this->setIfExists('excluded_environments', $data ?? [], null);
        $this->setIfExists('states', $data ?? [], null);
        $this->setIfExists('result', $data ?? [], null);
        $this->setIfExists('service_id', $data ?? [], null);
        $this->setIfExists('base_url', $data ?? [], null);
        $this->setIfExists('build_draft_pull_requests', $data ?? [], null);
        $this->setIfExists('build_pull_requests_post_merge', $data ?? [], null);
        $this->setIfExists('build_merge_requests', $data ?? [], null);
        $this->setIfExists('build_wip_merge_requests', $data ?? [], null);
        $this->setIfExists('merge_requests_clone_parent_data', $data ?? [], null);
        $this->setIfExists('from_address', $data ?? [], null);
        $this->setIfExists('recipients', $data ?? [], null);
        $this->setIfExists('routing_key', $data ?? [], null);
        $this->setIfExists('channel', $data ?? [], null);
        $this->setIfExists('shared_key', $data ?? [], null);
        $this->setIfExists('extra', $data ?? [], null);
        $this->setIfExists('headers', $data ?? [], null);
        $this->setIfExists('tls_verify', $data ?? [], null);
        $this->setIfExists('license_key', $data ?? [], null);
        $this->setIfExists('script', $data ?? [], null);
        $this->setIfExists('index', $data ?? [], null);
        $this->setIfExists('sourcetype', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('host', $data ?? [], null);
        $this->setIfExists('port', $data ?? [], null);
        $this->setIfExists('protocol', $data ?? [], null);
        $this->setIfExists('facility', $data ?? [], null);
        $this->setIfExists('message_format', $data ?? [], null);
        $this->setIfExists('auth_token', $data ?? [], null);
        $this->setIfExists('auth_mode', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getEnvironmentInitResourcesAllowableValues();
        if (!is_null($this->container['environment_init_resources']) && !in_array($this->container['environment_init_resources'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'environment_init_resources', must be one of '%s'",
                $this->container['environment_init_resources'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['repository'] === null) {
            $invalidProperties[] = "'repository' can't be null";
        }
        if ($this->container['url'] === null) {
            $invalidProperties[] = "'url' can't be null";
        }
        if ($this->container['username'] === null) {
            $invalidProperties[] = "'username' can't be null";
        }
        if ($this->container['token'] === null) {
            $invalidProperties[] = "'token' can't be null";
        }
        if ($this->container['project'] === null) {
            $invalidProperties[] = "'project' can't be null";
        }
        $allowedValues = $this->getResultAllowableValues();
        if (!is_null($this->container['result']) && !in_array($this->container['result'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'result', must be one of '%s'",
                $this->container['result'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['service_id'] === null) {
            $invalidProperties[] = "'service_id' can't be null";
        }
        if ($this->container['recipients'] === null) {
            $invalidProperties[] = "'recipients' can't be null";
        }
        if ($this->container['routing_key'] === null) {
            $invalidProperties[] = "'routing_key' can't be null";
        }
        if ($this->container['channel'] === null) {
            $invalidProperties[] = "'channel' can't be null";
        }
        if ($this->container['license_key'] === null) {
            $invalidProperties[] = "'license_key' can't be null";
        }
        if ($this->container['script'] === null) {
            $invalidProperties[] = "'script' can't be null";
        }
        if ($this->container['index'] === null) {
            $invalidProperties[] = "'index' can't be null";
        }
        $allowedValues = $this->getProtocolAllowableValues();
        if (!is_null($this->container['protocol']) && !in_array($this->container['protocol'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'protocol', must be one of '%s'",
                $this->container['protocol'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getMessageFormatAllowableValues();
        if (!is_null($this->container['message_format']) && !in_array($this->container['message_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'message_format', must be one of '%s'",
                $this->container['message_format'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAuthModeAllowableValues();
        if (!is_null($this->container['auth_mode']) && !in_array($this->container['auth_mode'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'auth_mode', must be one of '%s'",
                $this->container['auth_mode'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets fetch_branches
     *
     * @return bool|null
     */
    public function getFetchBranches()
    {
        return $this->container['fetch_branches'];
    }

    /**
     * Sets fetch_branches
     *
     * @param bool|null $fetch_branches fetch_branches
     *
     * @return self
     */
    public function setFetchBranches($fetch_branches)
    {
        if (is_null($fetch_branches)) {
            throw new \InvalidArgumentException('non-nullable fetch_branches cannot be null');
        }
        $this->container['fetch_branches'] = $fetch_branches;

        return $this;
    }

    /**
     * Gets prune_branches
     *
     * @return bool|null
     */
    public function getPruneBranches()
    {
        return $this->container['prune_branches'];
    }

    /**
     * Sets prune_branches
     *
     * @param bool|null $prune_branches prune_branches
     *
     * @return self
     */
    public function setPruneBranches($prune_branches)
    {
        if (is_null($prune_branches)) {
            throw new \InvalidArgumentException('non-nullable prune_branches cannot be null');
        }
        $this->container['prune_branches'] = $prune_branches;

        return $this;
    }

    /**
     * Gets environment_init_resources
     *
     * @return string|null
     */
    public function getEnvironmentInitResources()
    {
        return $this->container['environment_init_resources'];
    }

    /**
     * Sets environment_init_resources
     *
     * @param string|null $environment_init_resources environment_init_resources
     *
     * @return self
     */
    public function setEnvironmentInitResources($environment_init_resources)
    {
        if (is_null($environment_init_resources)) {
            throw new \InvalidArgumentException('non-nullable environment_init_resources cannot be null');
        }
        $allowedValues = $this->getEnvironmentInitResourcesAllowableValues();
        if (!in_array($environment_init_resources, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'environment_init_resources', must be one of '%s'",
                    $environment_init_resources,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['environment_init_resources'] = $environment_init_resources;

        return $this;
    }

    /**
     * Gets app_credentials
     *
     * @return \OpenAPI\Client\Model\TheOAuth2ConsumerInformationOptional1|null
     */
    public function getAppCredentials()
    {
        return $this->container['app_credentials'];
    }

    /**
     * Sets app_credentials
     *
     * @param \OpenAPI\Client\Model\TheOAuth2ConsumerInformationOptional1|null $app_credentials app_credentials
     *
     * @return self
     */
    public function setAppCredentials($app_credentials)
    {
        if (is_null($app_credentials)) {
            array_push($this->openAPINullablesSetToNull, 'app_credentials');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('app_credentials', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['app_credentials'] = $app_credentials;

        return $this;
    }

    /**
     * Gets addon_credentials
     *
     * @return \OpenAPI\Client\Model\TheAddonCredentialInformationOptional1|null
     */
    public function getAddonCredentials()
    {
        return $this->container['addon_credentials'];
    }

    /**
     * Sets addon_credentials
     *
     * @param \OpenAPI\Client\Model\TheAddonCredentialInformationOptional1|null $addon_credentials addon_credentials
     *
     * @return self
     */
    public function setAddonCredentials($addon_credentials)
    {
        if (is_null($addon_credentials)) {
            array_push($this->openAPINullablesSetToNull, 'addon_credentials');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('addon_credentials', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['addon_credentials'] = $addon_credentials;

        return $this;
    }

    /**
     * Gets repository
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->container['repository'];
    }

    /**
     * Sets repository
     *
     * @param string $repository repository
     *
     * @return self
     */
    public function setRepository($repository)
    {
        if (is_null($repository)) {
            throw new \InvalidArgumentException('non-nullable repository cannot be null');
        }
        $this->container['repository'] = $repository;

        return $this;
    }

    /**
     * Gets build_pull_requests
     *
     * @return bool|null
     */
    public function getBuildPullRequests()
    {
        return $this->container['build_pull_requests'];
    }

    /**
     * Sets build_pull_requests
     *
     * @param bool|null $build_pull_requests build_pull_requests
     *
     * @return self
     */
    public function setBuildPullRequests($build_pull_requests)
    {
        if (is_null($build_pull_requests)) {
            throw new \InvalidArgumentException('non-nullable build_pull_requests cannot be null');
        }
        $this->container['build_pull_requests'] = $build_pull_requests;

        return $this;
    }

    /**
     * Gets pull_requests_clone_parent_data
     *
     * @return bool|null
     */
    public function getPullRequestsCloneParentData()
    {
        return $this->container['pull_requests_clone_parent_data'];
    }

    /**
     * Sets pull_requests_clone_parent_data
     *
     * @param bool|null $pull_requests_clone_parent_data pull_requests_clone_parent_data
     *
     * @return self
     */
    public function setPullRequestsCloneParentData($pull_requests_clone_parent_data)
    {
        if (is_null($pull_requests_clone_parent_data)) {
            throw new \InvalidArgumentException('non-nullable pull_requests_clone_parent_data cannot be null');
        }
        $this->container['pull_requests_clone_parent_data'] = $pull_requests_clone_parent_data;

        return $this;
    }

    /**
     * Gets resync_pull_requests
     *
     * @return bool|null
     */
    public function getResyncPullRequests()
    {
        return $this->container['resync_pull_requests'];
    }

    /**
     * Sets resync_pull_requests
     *
     * @param bool|null $resync_pull_requests resync_pull_requests
     *
     * @return self
     */
    public function setResyncPullRequests($resync_pull_requests)
    {
        if (is_null($resync_pull_requests)) {
            throw new \InvalidArgumentException('non-nullable resync_pull_requests cannot be null');
        }
        $this->container['resync_pull_requests'] = $resync_pull_requests;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return self
     */
    public function setUrl($url)
    {
        if (is_null($url)) {
            throw new \InvalidArgumentException('non-nullable url cannot be null');
        }
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string $username username
     *
     * @return self
     */
    public function setUsername($username)
    {
        if (is_null($username)) {
            throw new \InvalidArgumentException('non-nullable username cannot be null');
        }
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->container['token'];
    }

    /**
     * Sets token
     *
     * @param string $token token
     *
     * @return self
     */
    public function setToken($token)
    {
        if (is_null($token)) {
            throw new \InvalidArgumentException('non-nullable token cannot be null');
        }
        $this->container['token'] = $token;

        return $this;
    }

    /**
     * Gets project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param string $project project
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets events
     *
     * @return string[]|null
     */
    public function getEvents()
    {
        return $this->container['events'];
    }

    /**
     * Sets events
     *
     * @param string[]|null $events events
     *
     * @return self
     */
    public function setEvents($events)
    {
        if (is_null($events)) {
            throw new \InvalidArgumentException('non-nullable events cannot be null');
        }
        $this->container['events'] = $events;

        return $this;
    }

    /**
     * Gets environments
     *
     * @return string[]|null
     */
    public function getEnvironments()
    {
        return $this->container['environments'];
    }

    /**
     * Sets environments
     *
     * @param string[]|null $environments environments
     *
     * @return self
     */
    public function setEnvironments($environments)
    {
        if (is_null($environments)) {
            throw new \InvalidArgumentException('non-nullable environments cannot be null');
        }
        $this->container['environments'] = $environments;

        return $this;
    }

    /**
     * Gets excluded_environments
     *
     * @return string[]|null
     */
    public function getExcludedEnvironments()
    {
        return $this->container['excluded_environments'];
    }

    /**
     * Sets excluded_environments
     *
     * @param string[]|null $excluded_environments excluded_environments
     *
     * @return self
     */
    public function setExcludedEnvironments($excluded_environments)
    {
        if (is_null($excluded_environments)) {
            throw new \InvalidArgumentException('non-nullable excluded_environments cannot be null');
        }
        $this->container['excluded_environments'] = $excluded_environments;

        return $this;
    }

    /**
     * Gets states
     *
     * @return string[]|null
     */
    public function getStates()
    {
        return $this->container['states'];
    }

    /**
     * Sets states
     *
     * @param string[]|null $states states
     *
     * @return self
     */
    public function setStates($states)
    {
        if (is_null($states)) {
            throw new \InvalidArgumentException('non-nullable states cannot be null');
        }
        $this->container['states'] = $states;

        return $this;
    }

    /**
     * Gets result
     *
     * @return string|null
     */
    public function getResult()
    {
        return $this->container['result'];
    }

    /**
     * Sets result
     *
     * @param string|null $result result
     *
     * @return self
     */
    public function setResult($result)
    {
        if (is_null($result)) {
            throw new \InvalidArgumentException('non-nullable result cannot be null');
        }
        $allowedValues = $this->getResultAllowableValues();
        if (!in_array($result, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'result', must be one of '%s'",
                    $result,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['result'] = $result;

        return $this;
    }

    /**
     * Gets service_id
     *
     * @return string
     */
    public function getServiceId()
    {
        return $this->container['service_id'];
    }

    /**
     * Sets service_id
     *
     * @param string $service_id service_id
     *
     * @return self
     */
    public function setServiceId($service_id)
    {
        if (is_null($service_id)) {
            throw new \InvalidArgumentException('non-nullable service_id cannot be null');
        }
        $this->container['service_id'] = $service_id;

        return $this;
    }

    /**
     * Gets base_url
     *
     * @return string|null
     */
    public function getBaseUrl()
    {
        return $this->container['base_url'];
    }

    /**
     * Sets base_url
     *
     * @param string|null $base_url base_url
     *
     * @return self
     */
    public function setBaseUrl($base_url)
    {
        if (is_null($base_url)) {
            throw new \InvalidArgumentException('non-nullable base_url cannot be null');
        }
        $this->container['base_url'] = $base_url;

        return $this;
    }

    /**
     * Gets build_draft_pull_requests
     *
     * @return bool|null
     */
    public function getBuildDraftPullRequests()
    {
        return $this->container['build_draft_pull_requests'];
    }

    /**
     * Sets build_draft_pull_requests
     *
     * @param bool|null $build_draft_pull_requests build_draft_pull_requests
     *
     * @return self
     */
    public function setBuildDraftPullRequests($build_draft_pull_requests)
    {
        if (is_null($build_draft_pull_requests)) {
            throw new \InvalidArgumentException('non-nullable build_draft_pull_requests cannot be null');
        }
        $this->container['build_draft_pull_requests'] = $build_draft_pull_requests;

        return $this;
    }

    /**
     * Gets build_pull_requests_post_merge
     *
     * @return bool|null
     */
    public function getBuildPullRequestsPostMerge()
    {
        return $this->container['build_pull_requests_post_merge'];
    }

    /**
     * Sets build_pull_requests_post_merge
     *
     * @param bool|null $build_pull_requests_post_merge build_pull_requests_post_merge
     *
     * @return self
     */
    public function setBuildPullRequestsPostMerge($build_pull_requests_post_merge)
    {
        if (is_null($build_pull_requests_post_merge)) {
            throw new \InvalidArgumentException('non-nullable build_pull_requests_post_merge cannot be null');
        }
        $this->container['build_pull_requests_post_merge'] = $build_pull_requests_post_merge;

        return $this;
    }

    /**
     * Gets build_merge_requests
     *
     * @return bool|null
     */
    public function getBuildMergeRequests()
    {
        return $this->container['build_merge_requests'];
    }

    /**
     * Sets build_merge_requests
     *
     * @param bool|null $build_merge_requests build_merge_requests
     *
     * @return self
     */
    public function setBuildMergeRequests($build_merge_requests)
    {
        if (is_null($build_merge_requests)) {
            throw new \InvalidArgumentException('non-nullable build_merge_requests cannot be null');
        }
        $this->container['build_merge_requests'] = $build_merge_requests;

        return $this;
    }

    /**
     * Gets build_wip_merge_requests
     *
     * @return bool|null
     */
    public function getBuildWipMergeRequests()
    {
        return $this->container['build_wip_merge_requests'];
    }

    /**
     * Sets build_wip_merge_requests
     *
     * @param bool|null $build_wip_merge_requests build_wip_merge_requests
     *
     * @return self
     */
    public function setBuildWipMergeRequests($build_wip_merge_requests)
    {
        if (is_null($build_wip_merge_requests)) {
            throw new \InvalidArgumentException('non-nullable build_wip_merge_requests cannot be null');
        }
        $this->container['build_wip_merge_requests'] = $build_wip_merge_requests;

        return $this;
    }

    /**
     * Gets merge_requests_clone_parent_data
     *
     * @return bool|null
     */
    public function getMergeRequestsCloneParentData()
    {
        return $this->container['merge_requests_clone_parent_data'];
    }

    /**
     * Sets merge_requests_clone_parent_data
     *
     * @param bool|null $merge_requests_clone_parent_data merge_requests_clone_parent_data
     *
     * @return self
     */
    public function setMergeRequestsCloneParentData($merge_requests_clone_parent_data)
    {
        if (is_null($merge_requests_clone_parent_data)) {
            throw new \InvalidArgumentException('non-nullable merge_requests_clone_parent_data cannot be null');
        }
        $this->container['merge_requests_clone_parent_data'] = $merge_requests_clone_parent_data;

        return $this;
    }

    /**
     * Gets from_address
     *
     * @return string|null
     */
    public function getFromAddress()
    {
        return $this->container['from_address'];
    }

    /**
     * Sets from_address
     *
     * @param string|null $from_address from_address
     *
     * @return self
     */
    public function setFromAddress($from_address)
    {
        if (is_null($from_address)) {
            array_push($this->openAPINullablesSetToNull, 'from_address');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('from_address', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['from_address'] = $from_address;

        return $this;
    }

    /**
     * Gets recipients
     *
     * @return string[]
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     *
     * @param string[] $recipients recipients
     *
     * @return self
     */
    public function setRecipients($recipients)
    {
        if (is_null($recipients)) {
            throw new \InvalidArgumentException('non-nullable recipients cannot be null');
        }
        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets routing_key
     *
     * @return string
     */
    public function getRoutingKey()
    {
        return $this->container['routing_key'];
    }

    /**
     * Sets routing_key
     *
     * @param string $routing_key routing_key
     *
     * @return self
     */
    public function setRoutingKey($routing_key)
    {
        if (is_null($routing_key)) {
            throw new \InvalidArgumentException('non-nullable routing_key cannot be null');
        }
        $this->container['routing_key'] = $routing_key;

        return $this;
    }

    /**
     * Gets channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->container['channel'];
    }

    /**
     * Sets channel
     *
     * @param string $channel channel
     *
     * @return self
     */
    public function setChannel($channel)
    {
        if (is_null($channel)) {
            throw new \InvalidArgumentException('non-nullable channel cannot be null');
        }
        $this->container['channel'] = $channel;

        return $this;
    }

    /**
     * Gets shared_key
     *
     * @return string|null
     */
    public function getSharedKey()
    {
        return $this->container['shared_key'];
    }

    /**
     * Sets shared_key
     *
     * @param string|null $shared_key shared_key
     *
     * @return self
     */
    public function setSharedKey($shared_key)
    {
        if (is_null($shared_key)) {
            array_push($this->openAPINullablesSetToNull, 'shared_key');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('shared_key', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['shared_key'] = $shared_key;

        return $this;
    }

    /**
     * Gets extra
     *
     * @return array<string,string>|null
     */
    public function getExtra()
    {
        return $this->container['extra'];
    }

    /**
     * Sets extra
     *
     * @param array<string,string>|null $extra extra
     *
     * @return self
     */
    public function setExtra($extra)
    {
        if (is_null($extra)) {
            throw new \InvalidArgumentException('non-nullable extra cannot be null');
        }
        $this->container['extra'] = $extra;

        return $this;
    }

    /**
     * Gets headers
     *
     * @return array<string,string>|null
     */
    public function getHeaders()
    {
        return $this->container['headers'];
    }

    /**
     * Sets headers
     *
     * @param array<string,string>|null $headers headers
     *
     * @return self
     */
    public function setHeaders($headers)
    {
        if (is_null($headers)) {
            throw new \InvalidArgumentException('non-nullable headers cannot be null');
        }
        $this->container['headers'] = $headers;

        return $this;
    }

    /**
     * Gets tls_verify
     *
     * @return bool|null
     */
    public function getTlsVerify()
    {
        return $this->container['tls_verify'];
    }

    /**
     * Sets tls_verify
     *
     * @param bool|null $tls_verify tls_verify
     *
     * @return self
     */
    public function setTlsVerify($tls_verify)
    {
        if (is_null($tls_verify)) {
            throw new \InvalidArgumentException('non-nullable tls_verify cannot be null');
        }
        $this->container['tls_verify'] = $tls_verify;

        return $this;
    }

    /**
     * Gets license_key
     *
     * @return string
     */
    public function getLicenseKey()
    {
        return $this->container['license_key'];
    }

    /**
     * Sets license_key
     *
     * @param string $license_key license_key
     *
     * @return self
     */
    public function setLicenseKey($license_key)
    {
        if (is_null($license_key)) {
            throw new \InvalidArgumentException('non-nullable license_key cannot be null');
        }
        $this->container['license_key'] = $license_key;

        return $this;
    }

    /**
     * Gets script
     *
     * @return string
     */
    public function getScript()
    {
        return $this->container['script'];
    }

    /**
     * Sets script
     *
     * @param string $script script
     *
     * @return self
     */
    public function setScript($script)
    {
        if (is_null($script)) {
            throw new \InvalidArgumentException('non-nullable script cannot be null');
        }
        $this->container['script'] = $script;

        return $this;
    }

    /**
     * Gets index
     *
     * @return string
     */
    public function getIndex()
    {
        return $this->container['index'];
    }

    /**
     * Sets index
     *
     * @param string $index index
     *
     * @return self
     */
    public function setIndex($index)
    {
        if (is_null($index)) {
            throw new \InvalidArgumentException('non-nullable index cannot be null');
        }
        $this->container['index'] = $index;

        return $this;
    }

    /**
     * Gets sourcetype
     *
     * @return string|null
     */
    public function getSourcetype()
    {
        return $this->container['sourcetype'];
    }

    /**
     * Sets sourcetype
     *
     * @param string|null $sourcetype sourcetype
     *
     * @return self
     */
    public function setSourcetype($sourcetype)
    {
        if (is_null($sourcetype)) {
            throw new \InvalidArgumentException('non-nullable sourcetype cannot be null');
        }
        $this->container['sourcetype'] = $sourcetype;

        return $this;
    }

    /**
     * Gets category
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string|null $category category
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets host
     *
     * @return string|null
     */
    public function getHost()
    {
        return $this->container['host'];
    }

    /**
     * Sets host
     *
     * @param string|null $host host
     *
     * @return self
     */
    public function setHost($host)
    {
        if (is_null($host)) {
            throw new \InvalidArgumentException('non-nullable host cannot be null');
        }
        $this->container['host'] = $host;

        return $this;
    }

    /**
     * Gets port
     *
     * @return int|null
     */
    public function getPort()
    {
        return $this->container['port'];
    }

    /**
     * Sets port
     *
     * @param int|null $port port
     *
     * @return self
     */
    public function setPort($port)
    {
        if (is_null($port)) {
            throw new \InvalidArgumentException('non-nullable port cannot be null');
        }
        $this->container['port'] = $port;

        return $this;
    }

    /**
     * Gets protocol
     *
     * @return string|null
     */
    public function getProtocol()
    {
        return $this->container['protocol'];
    }

    /**
     * Sets protocol
     *
     * @param string|null $protocol protocol
     *
     * @return self
     */
    public function setProtocol($protocol)
    {
        if (is_null($protocol)) {
            throw new \InvalidArgumentException('non-nullable protocol cannot be null');
        }
        $allowedValues = $this->getProtocolAllowableValues();
        if (!in_array($protocol, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'protocol', must be one of '%s'",
                    $protocol,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets facility
     *
     * @return int|null
     */
    public function getFacility()
    {
        return $this->container['facility'];
    }

    /**
     * Sets facility
     *
     * @param int|null $facility facility
     *
     * @return self
     */
    public function setFacility($facility)
    {
        if (is_null($facility)) {
            throw new \InvalidArgumentException('non-nullable facility cannot be null');
        }
        $this->container['facility'] = $facility;

        return $this;
    }

    /**
     * Gets message_format
     *
     * @return string|null
     */
    public function getMessageFormat()
    {
        return $this->container['message_format'];
    }

    /**
     * Sets message_format
     *
     * @param string|null $message_format message_format
     *
     * @return self
     */
    public function setMessageFormat($message_format)
    {
        if (is_null($message_format)) {
            throw new \InvalidArgumentException('non-nullable message_format cannot be null');
        }
        $allowedValues = $this->getMessageFormatAllowableValues();
        if (!in_array($message_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'message_format', must be one of '%s'",
                    $message_format,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['message_format'] = $message_format;

        return $this;
    }

    /**
     * Gets auth_token
     *
     * @return string|null
     */
    public function getAuthToken()
    {
        return $this->container['auth_token'];
    }

    /**
     * Sets auth_token
     *
     * @param string|null $auth_token auth_token
     *
     * @return self
     */
    public function setAuthToken($auth_token)
    {
        if (is_null($auth_token)) {
            throw new \InvalidArgumentException('non-nullable auth_token cannot be null');
        }
        $this->container['auth_token'] = $auth_token;

        return $this;
    }

    /**
     * Gets auth_mode
     *
     * @return string|null
     */
    public function getAuthMode()
    {
        return $this->container['auth_mode'];
    }

    /**
     * Sets auth_mode
     *
     * @param string|null $auth_mode auth_mode
     *
     * @return self
     */
    public function setAuthMode($auth_mode)
    {
        if (is_null($auth_mode)) {
            throw new \InvalidArgumentException('non-nullable auth_mode cannot be null');
        }
        $allowedValues = $this->getAuthModeAllowableValues();
        if (!in_array($auth_mode, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'auth_mode', must be one of '%s'",
                    $auth_mode,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['auth_mode'] = $auth_mode;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


