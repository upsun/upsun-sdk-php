<?php
/**
 * GitLabIntegrationCreateInput
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
 * Generator version: 7.13.0
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
 * GitLabIntegrationCreateInput Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GitLabIntegrationCreateInput implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'GitLabIntegrationCreateInput';

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
        'token' => 'string',
        'base_url' => 'string',
        'project' => 'string',
        'build_merge_requests' => 'bool',
        'build_wip_merge_requests' => 'bool',
        'merge_requests_clone_parent_data' => 'bool'
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
        'token' => null,
        'base_url' => null,
        'project' => null,
        'build_merge_requests' => null,
        'build_wip_merge_requests' => null,
        'merge_requests_clone_parent_data' => null
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
        'token' => false,
        'base_url' => false,
        'project' => false,
        'build_merge_requests' => false,
        'build_wip_merge_requests' => false,
        'merge_requests_clone_parent_data' => false
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
        'token' => 'token',
        'base_url' => 'base_url',
        'project' => 'project',
        'build_merge_requests' => 'build_merge_requests',
        'build_wip_merge_requests' => 'build_wip_merge_requests',
        'merge_requests_clone_parent_data' => 'merge_requests_clone_parent_data'
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
        'token' => 'setToken',
        'base_url' => 'setBaseUrl',
        'project' => 'setProject',
        'build_merge_requests' => 'setBuildMergeRequests',
        'build_wip_merge_requests' => 'setBuildWipMergeRequests',
        'merge_requests_clone_parent_data' => 'setMergeRequestsCloneParentData'
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
        'token' => 'getToken',
        'base_url' => 'getBaseUrl',
        'project' => 'getProject',
        'build_merge_requests' => 'getBuildMergeRequests',
        'build_wip_merge_requests' => 'getBuildWipMergeRequests',
        'merge_requests_clone_parent_data' => 'getMergeRequestsCloneParentData'
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
        $this->setIfExists('token', $data ?? [], null);
        $this->setIfExists('base_url', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('build_merge_requests', $data ?? [], null);
        $this->setIfExists('build_wip_merge_requests', $data ?? [], null);
        $this->setIfExists('merge_requests_clone_parent_data', $data ?? [], null);
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

        if ($this->container['token'] === null) {
            $invalidProperties[] = "'token' can't be null";
        }
        if ($this->container['project'] === null) {
            $invalidProperties[] = "'project' can't be null";
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


