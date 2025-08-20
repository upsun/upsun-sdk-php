<?php
/**
 * ProjectCapabilities
 *
 * PHP version 8.1
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

namespace Upsun\Model;

use \ArrayAccess;
use \Upsun\ObjectSerializer;

/**
 * ProjectCapabilities Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectCapabilities implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProjectCapabilities';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'custom_domains' => '\Upsun\Model\CustomDomains',
        'source_operations' => '\Upsun\Model\SourceOperations',
        'runtime_operations' => '\Upsun\Model\RuntimeOperations',
        'outbound_firewall' => '\Upsun\Model\OutboundFirewall',
        'metrics' => '\Upsun\Model\Metrics',
        'logs_forwarding' => '\Upsun\Model\LogsForwarding',
        'images' => 'array<string,array<string,\Upsun\Model\ImagesValueValue>>',
        'instance_limit' => 'int',
        'build_resources' => '\Upsun\Model\BuildResources',
        'data_retention' => '\Upsun\Model\DataRetention',
        'integrations' => '\Upsun\Model\Integrations'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'custom_domains' => null,
        'source_operations' => null,
        'runtime_operations' => null,
        'outbound_firewall' => null,
        'metrics' => null,
        'logs_forwarding' => null,
        'images' => null,
        'instance_limit' => null,
        'build_resources' => null,
        'data_retention' => null,
        'integrations' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'custom_domains' => false,
        'source_operations' => false,
        'runtime_operations' => false,
        'outbound_firewall' => false,
        'metrics' => false,
        'logs_forwarding' => false,
        'images' => false,
        'instance_limit' => false,
        'build_resources' => false,
        'data_retention' => false,
        'integrations' => false
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
        'custom_domains' => 'custom_domains',
        'source_operations' => 'source_operations',
        'runtime_operations' => 'runtime_operations',
        'outbound_firewall' => 'outbound_firewall',
        'metrics' => 'metrics',
        'logs_forwarding' => 'logs_forwarding',
        'images' => 'images',
        'instance_limit' => 'instance_limit',
        'build_resources' => 'build_resources',
        'data_retention' => 'data_retention',
        'integrations' => 'integrations'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'custom_domains' => 'setCustomDomains',
        'source_operations' => 'setSourceOperations',
        'runtime_operations' => 'setRuntimeOperations',
        'outbound_firewall' => 'setOutboundFirewall',
        'metrics' => 'setMetrics',
        'logs_forwarding' => 'setLogsForwarding',
        'images' => 'setImages',
        'instance_limit' => 'setInstanceLimit',
        'build_resources' => 'setBuildResources',
        'data_retention' => 'setDataRetention',
        'integrations' => 'setIntegrations'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'custom_domains' => 'getCustomDomains',
        'source_operations' => 'getSourceOperations',
        'runtime_operations' => 'getRuntimeOperations',
        'outbound_firewall' => 'getOutboundFirewall',
        'metrics' => 'getMetrics',
        'logs_forwarding' => 'getLogsForwarding',
        'images' => 'getImages',
        'instance_limit' => 'getInstanceLimit',
        'build_resources' => 'getBuildResources',
        'data_retention' => 'getDataRetention',
        'integrations' => 'getIntegrations'
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
        $this->setIfExists('custom_domains', $data ?? [], null);
        $this->setIfExists('source_operations', $data ?? [], null);
        $this->setIfExists('runtime_operations', $data ?? [], null);
        $this->setIfExists('outbound_firewall', $data ?? [], null);
        $this->setIfExists('metrics', $data ?? [], null);
        $this->setIfExists('logs_forwarding', $data ?? [], null);
        $this->setIfExists('images', $data ?? [], null);
        $this->setIfExists('instance_limit', $data ?? [], null);
        $this->setIfExists('build_resources', $data ?? [], null);
        $this->setIfExists('data_retention', $data ?? [], null);
        $this->setIfExists('integrations', $data ?? [], null);
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

        if ($this->container['metrics'] === null) {
            $invalidProperties[] = "'metrics' can't be null";
        }
        if ($this->container['logs_forwarding'] === null) {
            $invalidProperties[] = "'logs_forwarding' can't be null";
        }
        if ($this->container['images'] === null) {
            $invalidProperties[] = "'images' can't be null";
        }
        if ($this->container['instance_limit'] === null) {
            $invalidProperties[] = "'instance_limit' can't be null";
        }
        if ($this->container['build_resources'] === null) {
            $invalidProperties[] = "'build_resources' can't be null";
        }
        if ($this->container['data_retention'] === null) {
            $invalidProperties[] = "'data_retention' can't be null";
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
     * Gets custom_domains
     *
     * @return \Upsun\Model\CustomDomains|null
     */
    public function getCustomDomains()
    {
        return $this->container['custom_domains'];
    }

    /**
     * Sets custom_domains
     *
     * @param \Upsun\Model\CustomDomains|null $custom_domains custom_domains
     *
     * @return self
     */
    public function setCustomDomains($custom_domains)
    {
        if (is_null($custom_domains)) {
            throw new \InvalidArgumentException('non-nullable custom_domains cannot be null');
        }
        $this->container['custom_domains'] = $custom_domains;

        return $this;
    }

    /**
     * Gets source_operations
     *
     * @return \Upsun\Model\SourceOperations|null
     */
    public function getSourceOperations()
    {
        return $this->container['source_operations'];
    }

    /**
     * Sets source_operations
     *
     * @param \Upsun\Model\SourceOperations|null $source_operations source_operations
     *
     * @return self
     */
    public function setSourceOperations($source_operations)
    {
        if (is_null($source_operations)) {
            throw new \InvalidArgumentException('non-nullable source_operations cannot be null');
        }
        $this->container['source_operations'] = $source_operations;

        return $this;
    }

    /**
     * Gets runtime_operations
     *
     * @return \Upsun\Model\RuntimeOperations|null
     */
    public function getRuntimeOperations()
    {
        return $this->container['runtime_operations'];
    }

    /**
     * Sets runtime_operations
     *
     * @param \Upsun\Model\RuntimeOperations|null $runtime_operations runtime_operations
     *
     * @return self
     */
    public function setRuntimeOperations($runtime_operations)
    {
        if (is_null($runtime_operations)) {
            throw new \InvalidArgumentException('non-nullable runtime_operations cannot be null');
        }
        $this->container['runtime_operations'] = $runtime_operations;

        return $this;
    }

    /**
     * Gets outbound_firewall
     *
     * @return \Upsun\Model\OutboundFirewall|null
     */
    public function getOutboundFirewall()
    {
        return $this->container['outbound_firewall'];
    }

    /**
     * Sets outbound_firewall
     *
     * @param \Upsun\Model\OutboundFirewall|null $outbound_firewall outbound_firewall
     *
     * @return self
     */
    public function setOutboundFirewall($outbound_firewall)
    {
        if (is_null($outbound_firewall)) {
            throw new \InvalidArgumentException('non-nullable outbound_firewall cannot be null');
        }
        $this->container['outbound_firewall'] = $outbound_firewall;

        return $this;
    }

    /**
     * Gets metrics
     *
     * @return \Upsun\Model\Metrics
     */
    public function getMetrics()
    {
        return $this->container['metrics'];
    }

    /**
     * Sets metrics
     *
     * @param \Upsun\Model\Metrics $metrics metrics
     *
     * @return self
     */
    public function setMetrics($metrics)
    {
        if (is_null($metrics)) {
            throw new \InvalidArgumentException('non-nullable metrics cannot be null');
        }
        $this->container['metrics'] = $metrics;

        return $this;
    }

    /**
     * Gets logs_forwarding
     *
     * @return \Upsun\Model\LogsForwarding
     */
    public function getLogsForwarding()
    {
        return $this->container['logs_forwarding'];
    }

    /**
     * Sets logs_forwarding
     *
     * @param \Upsun\Model\LogsForwarding $logs_forwarding logs_forwarding
     *
     * @return self
     */
    public function setLogsForwarding($logs_forwarding)
    {
        if (is_null($logs_forwarding)) {
            throw new \InvalidArgumentException('non-nullable logs_forwarding cannot be null');
        }
        $this->container['logs_forwarding'] = $logs_forwarding;

        return $this;
    }

    /**
     * Gets images
     *
     * @return array<string,array<string,\Upsun\Model\ImagesValueValue>>
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param array<string,array<string,\Upsun\Model\ImagesValueValue>> $images images
     *
     * @return self
     */
    public function setImages($images)
    {
        if (is_null($images)) {
            throw new \InvalidArgumentException('non-nullable images cannot be null');
        }
        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets instance_limit
     *
     * @return int
     */
    public function getInstanceLimit()
    {
        return $this->container['instance_limit'];
    }

    /**
     * Sets instance_limit
     *
     * @param int $instance_limit instance_limit
     *
     * @return self
     */
    public function setInstanceLimit($instance_limit)
    {
        if (is_null($instance_limit)) {
            throw new \InvalidArgumentException('non-nullable instance_limit cannot be null');
        }
        $this->container['instance_limit'] = $instance_limit;

        return $this;
    }

    /**
     * Gets build_resources
     *
     * @return \Upsun\Model\BuildResources
     */
    public function getBuildResources()
    {
        return $this->container['build_resources'];
    }

    /**
     * Sets build_resources
     *
     * @param \Upsun\Model\BuildResources $build_resources build_resources
     *
     * @return self
     */
    public function setBuildResources($build_resources)
    {
        if (is_null($build_resources)) {
            throw new \InvalidArgumentException('non-nullable build_resources cannot be null');
        }
        $this->container['build_resources'] = $build_resources;

        return $this;
    }

    /**
     * Gets data_retention
     *
     * @return \Upsun\Model\DataRetention
     */
    public function getDataRetention()
    {
        return $this->container['data_retention'];
    }

    /**
     * Sets data_retention
     *
     * @param \Upsun\Model\DataRetention $data_retention data_retention
     *
     * @return self
     */
    public function setDataRetention($data_retention)
    {
        if (is_null($data_retention)) {
            throw new \InvalidArgumentException('non-nullable data_retention cannot be null');
        }
        $this->container['data_retention'] = $data_retention;

        return $this;
    }

    /**
     * Gets integrations
     *
     * @return \Upsun\Model\Integrations|null
     */
    public function getIntegrations()
    {
        return $this->container['integrations'];
    }

    /**
     * Sets integrations
     *
     * @param \Upsun\Model\Integrations|null $integrations integrations
     *
     * @return self
     */
    public function setIntegrations($integrations)
    {
        if (is_null($integrations)) {
            throw new \InvalidArgumentException('non-nullable integrations cannot be null');
        }
        $this->container['integrations'] = $integrations;

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


