<?php
/**
 * SubscriptionCurrentUsageObject
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
 * SubscriptionCurrentUsageObject Class Doc Comment
 *
 * @category Class
 * @description A subscription&#39;s usage group current usage object.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SubscriptionCurrentUsageObject implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SubscriptionCurrentUsageObject';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'cpu_app' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'storage_app_services' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'memory_app' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'cpu_services' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'memory_services' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'backup_storage' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'build_cpu' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'build_memory' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'egress_bandwidth' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'ingress_requests' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'logs_fwd_content_size' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'fastly_bandwidth' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties',
        'fastly_requests' => '\OpenAPI\Client\Model\UsageGroupCurrentUsageProperties'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'cpu_app' => null,
        'storage_app_services' => null,
        'memory_app' => null,
        'cpu_services' => null,
        'memory_services' => null,
        'backup_storage' => null,
        'build_cpu' => null,
        'build_memory' => null,
        'egress_bandwidth' => null,
        'ingress_requests' => null,
        'logs_fwd_content_size' => null,
        'fastly_bandwidth' => null,
        'fastly_requests' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'cpu_app' => false,
        'storage_app_services' => false,
        'memory_app' => false,
        'cpu_services' => false,
        'memory_services' => false,
        'backup_storage' => false,
        'build_cpu' => false,
        'build_memory' => false,
        'egress_bandwidth' => false,
        'ingress_requests' => false,
        'logs_fwd_content_size' => false,
        'fastly_bandwidth' => false,
        'fastly_requests' => false
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
        'cpu_app' => 'cpu_app',
        'storage_app_services' => 'storage_app_services',
        'memory_app' => 'memory_app',
        'cpu_services' => 'cpu_services',
        'memory_services' => 'memory_services',
        'backup_storage' => 'backup_storage',
        'build_cpu' => 'build_cpu',
        'build_memory' => 'build_memory',
        'egress_bandwidth' => 'egress_bandwidth',
        'ingress_requests' => 'ingress_requests',
        'logs_fwd_content_size' => 'logs_fwd_content_size',
        'fastly_bandwidth' => 'fastly_bandwidth',
        'fastly_requests' => 'fastly_requests'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cpu_app' => 'setCpuApp',
        'storage_app_services' => 'setStorageAppServices',
        'memory_app' => 'setMemoryApp',
        'cpu_services' => 'setCpuServices',
        'memory_services' => 'setMemoryServices',
        'backup_storage' => 'setBackupStorage',
        'build_cpu' => 'setBuildCpu',
        'build_memory' => 'setBuildMemory',
        'egress_bandwidth' => 'setEgressBandwidth',
        'ingress_requests' => 'setIngressRequests',
        'logs_fwd_content_size' => 'setLogsFwdContentSize',
        'fastly_bandwidth' => 'setFastlyBandwidth',
        'fastly_requests' => 'setFastlyRequests'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cpu_app' => 'getCpuApp',
        'storage_app_services' => 'getStorageAppServices',
        'memory_app' => 'getMemoryApp',
        'cpu_services' => 'getCpuServices',
        'memory_services' => 'getMemoryServices',
        'backup_storage' => 'getBackupStorage',
        'build_cpu' => 'getBuildCpu',
        'build_memory' => 'getBuildMemory',
        'egress_bandwidth' => 'getEgressBandwidth',
        'ingress_requests' => 'getIngressRequests',
        'logs_fwd_content_size' => 'getLogsFwdContentSize',
        'fastly_bandwidth' => 'getFastlyBandwidth',
        'fastly_requests' => 'getFastlyRequests'
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
        $this->setIfExists('cpu_app', $data ?? [], null);
        $this->setIfExists('storage_app_services', $data ?? [], null);
        $this->setIfExists('memory_app', $data ?? [], null);
        $this->setIfExists('cpu_services', $data ?? [], null);
        $this->setIfExists('memory_services', $data ?? [], null);
        $this->setIfExists('backup_storage', $data ?? [], null);
        $this->setIfExists('build_cpu', $data ?? [], null);
        $this->setIfExists('build_memory', $data ?? [], null);
        $this->setIfExists('egress_bandwidth', $data ?? [], null);
        $this->setIfExists('ingress_requests', $data ?? [], null);
        $this->setIfExists('logs_fwd_content_size', $data ?? [], null);
        $this->setIfExists('fastly_bandwidth', $data ?? [], null);
        $this->setIfExists('fastly_requests', $data ?? [], null);
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
     * Gets cpu_app
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getCpuApp()
    {
        return $this->container['cpu_app'];
    }

    /**
     * Sets cpu_app
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $cpu_app cpu_app
     *
     * @return self
     */
    public function setCpuApp($cpu_app)
    {
        if (is_null($cpu_app)) {
            throw new \InvalidArgumentException('non-nullable cpu_app cannot be null');
        }
        $this->container['cpu_app'] = $cpu_app;

        return $this;
    }

    /**
     * Gets storage_app_services
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getStorageAppServices()
    {
        return $this->container['storage_app_services'];
    }

    /**
     * Sets storage_app_services
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $storage_app_services storage_app_services
     *
     * @return self
     */
    public function setStorageAppServices($storage_app_services)
    {
        if (is_null($storage_app_services)) {
            throw new \InvalidArgumentException('non-nullable storage_app_services cannot be null');
        }
        $this->container['storage_app_services'] = $storage_app_services;

        return $this;
    }

    /**
     * Gets memory_app
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getMemoryApp()
    {
        return $this->container['memory_app'];
    }

    /**
     * Sets memory_app
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $memory_app memory_app
     *
     * @return self
     */
    public function setMemoryApp($memory_app)
    {
        if (is_null($memory_app)) {
            throw new \InvalidArgumentException('non-nullable memory_app cannot be null');
        }
        $this->container['memory_app'] = $memory_app;

        return $this;
    }

    /**
     * Gets cpu_services
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getCpuServices()
    {
        return $this->container['cpu_services'];
    }

    /**
     * Sets cpu_services
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $cpu_services cpu_services
     *
     * @return self
     */
    public function setCpuServices($cpu_services)
    {
        if (is_null($cpu_services)) {
            throw new \InvalidArgumentException('non-nullable cpu_services cannot be null');
        }
        $this->container['cpu_services'] = $cpu_services;

        return $this;
    }

    /**
     * Gets memory_services
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getMemoryServices()
    {
        return $this->container['memory_services'];
    }

    /**
     * Sets memory_services
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $memory_services memory_services
     *
     * @return self
     */
    public function setMemoryServices($memory_services)
    {
        if (is_null($memory_services)) {
            throw new \InvalidArgumentException('non-nullable memory_services cannot be null');
        }
        $this->container['memory_services'] = $memory_services;

        return $this;
    }

    /**
     * Gets backup_storage
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getBackupStorage()
    {
        return $this->container['backup_storage'];
    }

    /**
     * Sets backup_storage
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $backup_storage backup_storage
     *
     * @return self
     */
    public function setBackupStorage($backup_storage)
    {
        if (is_null($backup_storage)) {
            throw new \InvalidArgumentException('non-nullable backup_storage cannot be null');
        }
        $this->container['backup_storage'] = $backup_storage;

        return $this;
    }

    /**
     * Gets build_cpu
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getBuildCpu()
    {
        return $this->container['build_cpu'];
    }

    /**
     * Sets build_cpu
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $build_cpu build_cpu
     *
     * @return self
     */
    public function setBuildCpu($build_cpu)
    {
        if (is_null($build_cpu)) {
            throw new \InvalidArgumentException('non-nullable build_cpu cannot be null');
        }
        $this->container['build_cpu'] = $build_cpu;

        return $this;
    }

    /**
     * Gets build_memory
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getBuildMemory()
    {
        return $this->container['build_memory'];
    }

    /**
     * Sets build_memory
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $build_memory build_memory
     *
     * @return self
     */
    public function setBuildMemory($build_memory)
    {
        if (is_null($build_memory)) {
            throw new \InvalidArgumentException('non-nullable build_memory cannot be null');
        }
        $this->container['build_memory'] = $build_memory;

        return $this;
    }

    /**
     * Gets egress_bandwidth
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getEgressBandwidth()
    {
        return $this->container['egress_bandwidth'];
    }

    /**
     * Sets egress_bandwidth
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $egress_bandwidth egress_bandwidth
     *
     * @return self
     */
    public function setEgressBandwidth($egress_bandwidth)
    {
        if (is_null($egress_bandwidth)) {
            throw new \InvalidArgumentException('non-nullable egress_bandwidth cannot be null');
        }
        $this->container['egress_bandwidth'] = $egress_bandwidth;

        return $this;
    }

    /**
     * Gets ingress_requests
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getIngressRequests()
    {
        return $this->container['ingress_requests'];
    }

    /**
     * Sets ingress_requests
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $ingress_requests ingress_requests
     *
     * @return self
     */
    public function setIngressRequests($ingress_requests)
    {
        if (is_null($ingress_requests)) {
            throw new \InvalidArgumentException('non-nullable ingress_requests cannot be null');
        }
        $this->container['ingress_requests'] = $ingress_requests;

        return $this;
    }

    /**
     * Gets logs_fwd_content_size
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getLogsFwdContentSize()
    {
        return $this->container['logs_fwd_content_size'];
    }

    /**
     * Sets logs_fwd_content_size
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $logs_fwd_content_size logs_fwd_content_size
     *
     * @return self
     */
    public function setLogsFwdContentSize($logs_fwd_content_size)
    {
        if (is_null($logs_fwd_content_size)) {
            throw new \InvalidArgumentException('non-nullable logs_fwd_content_size cannot be null');
        }
        $this->container['logs_fwd_content_size'] = $logs_fwd_content_size;

        return $this;
    }

    /**
     * Gets fastly_bandwidth
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getFastlyBandwidth()
    {
        return $this->container['fastly_bandwidth'];
    }

    /**
     * Sets fastly_bandwidth
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $fastly_bandwidth fastly_bandwidth
     *
     * @return self
     */
    public function setFastlyBandwidth($fastly_bandwidth)
    {
        if (is_null($fastly_bandwidth)) {
            throw new \InvalidArgumentException('non-nullable fastly_bandwidth cannot be null');
        }
        $this->container['fastly_bandwidth'] = $fastly_bandwidth;

        return $this;
    }

    /**
     * Gets fastly_requests
     *
     * @return \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null
     */
    public function getFastlyRequests()
    {
        return $this->container['fastly_requests'];
    }

    /**
     * Sets fastly_requests
     *
     * @param \OpenAPI\Client\Model\UsageGroupCurrentUsageProperties|null $fastly_requests fastly_requests
     *
     * @return self
     */
    public function setFastlyRequests($fastly_requests)
    {
        if (is_null($fastly_requests)) {
            throw new \InvalidArgumentException('non-nullable fastly_requests cannot be null');
        }
        $this->container['fastly_requests'] = $fastly_requests;

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


