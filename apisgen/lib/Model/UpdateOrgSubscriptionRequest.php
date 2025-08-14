<?php
/**
 * UpdateOrgSubscriptionRequest
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
 * UpdateOrgSubscriptionRequest Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UpdateOrgSubscriptionRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'update_org_subscription_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'project_title' => 'string',
        'plan' => 'string',
        'timezone' => 'string',
        'environments' => 'int',
        'storage' => 'int',
        'big_dev' => 'string',
        'big_dev_service' => 'string',
        'backups' => 'string',
        'observability_suite' => 'string',
        'blackfire' => 'string',
        'continuous_profiling' => 'string',
        'project_support_level' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'project_title' => null,
        'plan' => null,
        'timezone' => null,
        'environments' => null,
        'storage' => null,
        'big_dev' => null,
        'big_dev_service' => null,
        'backups' => null,
        'observability_suite' => null,
        'blackfire' => null,
        'continuous_profiling' => null,
        'project_support_level' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'project_title' => false,
        'plan' => false,
        'timezone' => false,
        'environments' => false,
        'storage' => false,
        'big_dev' => false,
        'big_dev_service' => false,
        'backups' => false,
        'observability_suite' => false,
        'blackfire' => false,
        'continuous_profiling' => false,
        'project_support_level' => false
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
        'project_title' => 'project_title',
        'plan' => 'plan',
        'timezone' => 'timezone',
        'environments' => 'environments',
        'storage' => 'storage',
        'big_dev' => 'big_dev',
        'big_dev_service' => 'big_dev_service',
        'backups' => 'backups',
        'observability_suite' => 'observability_suite',
        'blackfire' => 'blackfire',
        'continuous_profiling' => 'continuous_profiling',
        'project_support_level' => 'project_support_level'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'project_title' => 'setProjectTitle',
        'plan' => 'setPlan',
        'timezone' => 'setTimezone',
        'environments' => 'setEnvironments',
        'storage' => 'setStorage',
        'big_dev' => 'setBigDev',
        'big_dev_service' => 'setBigDevService',
        'backups' => 'setBackups',
        'observability_suite' => 'setObservabilitySuite',
        'blackfire' => 'setBlackfire',
        'continuous_profiling' => 'setContinuousProfiling',
        'project_support_level' => 'setProjectSupportLevel'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'project_title' => 'getProjectTitle',
        'plan' => 'getPlan',
        'timezone' => 'getTimezone',
        'environments' => 'getEnvironments',
        'storage' => 'getStorage',
        'big_dev' => 'getBigDev',
        'big_dev_service' => 'getBigDevService',
        'backups' => 'getBackups',
        'observability_suite' => 'getObservabilitySuite',
        'blackfire' => 'getBlackfire',
        'continuous_profiling' => 'getContinuousProfiling',
        'project_support_level' => 'getProjectSupportLevel'
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
        $this->setIfExists('project_title', $data ?? [], null);
        $this->setIfExists('plan', $data ?? [], null);
        $this->setIfExists('timezone', $data ?? [], null);
        $this->setIfExists('environments', $data ?? [], null);
        $this->setIfExists('storage', $data ?? [], null);
        $this->setIfExists('big_dev', $data ?? [], null);
        $this->setIfExists('big_dev_service', $data ?? [], null);
        $this->setIfExists('backups', $data ?? [], null);
        $this->setIfExists('observability_suite', $data ?? [], null);
        $this->setIfExists('blackfire', $data ?? [], null);
        $this->setIfExists('continuous_profiling', $data ?? [], null);
        $this->setIfExists('project_support_level', $data ?? [], null);
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
     * Gets project_title
     *
     * @return string|null
     */
    public function getProjectTitle()
    {
        return $this->container['project_title'];
    }

    /**
     * Sets project_title
     *
     * @param string|null $project_title The title of the project.
     *
     * @return self
     */
    public function setProjectTitle($project_title)
    {
        if (is_null($project_title)) {
            throw new \InvalidArgumentException('non-nullable project_title cannot be null');
        }
        $this->container['project_title'] = $project_title;

        return $this;
    }

    /**
     * Gets plan
     *
     * @return string|null
     */
    public function getPlan()
    {
        return $this->container['plan'];
    }

    /**
     * Sets plan
     *
     * @param string|null $plan The project plan.
     *
     * @return self
     */
    public function setPlan($plan)
    {
        if (is_null($plan)) {
            throw new \InvalidArgumentException('non-nullable plan cannot be null');
        }
        $this->container['plan'] = $plan;

        return $this;
    }

    /**
     * Gets timezone
     *
     * @return string|null
     */
    public function getTimezone()
    {
        return $this->container['timezone'];
    }

    /**
     * Sets timezone
     *
     * @param string|null $timezone Timezone of the project.
     *
     * @return self
     */
    public function setTimezone($timezone)
    {
        if (is_null($timezone)) {
            throw new \InvalidArgumentException('non-nullable timezone cannot be null');
        }
        $this->container['timezone'] = $timezone;

        return $this;
    }

    /**
     * Gets environments
     *
     * @return int|null
     */
    public function getEnvironments()
    {
        return $this->container['environments'];
    }

    /**
     * Sets environments
     *
     * @param int|null $environments The maximum number of environments which can be provisioned on the project.
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
     * Gets storage
     *
     * @return int|null
     */
    public function getStorage()
    {
        return $this->container['storage'];
    }

    /**
     * Sets storage
     *
     * @param int|null $storage The total storage available to each environment, in MiB.
     *
     * @return self
     */
    public function setStorage($storage)
    {
        if (is_null($storage)) {
            throw new \InvalidArgumentException('non-nullable storage cannot be null');
        }
        $this->container['storage'] = $storage;

        return $this;
    }

    /**
     * Gets big_dev
     *
     * @return string|null
     */
    public function getBigDev()
    {
        return $this->container['big_dev'];
    }

    /**
     * Sets big_dev
     *
     * @param string|null $big_dev The development environment plan.
     *
     * @return self
     */
    public function setBigDev($big_dev)
    {
        if (is_null($big_dev)) {
            throw new \InvalidArgumentException('non-nullable big_dev cannot be null');
        }
        $this->container['big_dev'] = $big_dev;

        return $this;
    }

    /**
     * Gets big_dev_service
     *
     * @return string|null
     */
    public function getBigDevService()
    {
        return $this->container['big_dev_service'];
    }

    /**
     * Sets big_dev_service
     *
     * @param string|null $big_dev_service The development service plan.
     *
     * @return self
     */
    public function setBigDevService($big_dev_service)
    {
        if (is_null($big_dev_service)) {
            throw new \InvalidArgumentException('non-nullable big_dev_service cannot be null');
        }
        $this->container['big_dev_service'] = $big_dev_service;

        return $this;
    }

    /**
     * Gets backups
     *
     * @return string|null
     */
    public function getBackups()
    {
        return $this->container['backups'];
    }

    /**
     * Sets backups
     *
     * @param string|null $backups The backups plan.
     *
     * @return self
     */
    public function setBackups($backups)
    {
        if (is_null($backups)) {
            throw new \InvalidArgumentException('non-nullable backups cannot be null');
        }
        $this->container['backups'] = $backups;

        return $this;
    }

    /**
     * Gets observability_suite
     *
     * @return string|null
     */
    public function getObservabilitySuite()
    {
        return $this->container['observability_suite'];
    }

    /**
     * Sets observability_suite
     *
     * @param string|null $observability_suite The observability suite option.
     *
     * @return self
     */
    public function setObservabilitySuite($observability_suite)
    {
        if (is_null($observability_suite)) {
            throw new \InvalidArgumentException('non-nullable observability_suite cannot be null');
        }
        $this->container['observability_suite'] = $observability_suite;

        return $this;
    }

    /**
     * Gets blackfire
     *
     * @return string|null
     */
    public function getBlackfire()
    {
        return $this->container['blackfire'];
    }

    /**
     * Sets blackfire
     *
     * @param string|null $blackfire The Blackfire integration option.
     *
     * @return self
     */
    public function setBlackfire($blackfire)
    {
        if (is_null($blackfire)) {
            throw new \InvalidArgumentException('non-nullable blackfire cannot be null');
        }
        $this->container['blackfire'] = $blackfire;

        return $this;
    }

    /**
     * Gets continuous_profiling
     *
     * @return string|null
     */
    public function getContinuousProfiling()
    {
        return $this->container['continuous_profiling'];
    }

    /**
     * Sets continuous_profiling
     *
     * @param string|null $continuous_profiling The Blackfire continuous profiling option.
     *
     * @return self
     */
    public function setContinuousProfiling($continuous_profiling)
    {
        if (is_null($continuous_profiling)) {
            throw new \InvalidArgumentException('non-nullable continuous_profiling cannot be null');
        }
        $this->container['continuous_profiling'] = $continuous_profiling;

        return $this;
    }

    /**
     * Gets project_support_level
     *
     * @return string|null
     */
    public function getProjectSupportLevel()
    {
        return $this->container['project_support_level'];
    }

    /**
     * Sets project_support_level
     *
     * @param string|null $project_support_level The project uptime option.
     *
     * @return self
     */
    public function setProjectSupportLevel($project_support_level)
    {
        if (is_null($project_support_level)) {
            throw new \InvalidArgumentException('non-nullable project_support_level cannot be null');
        }
        $this->container['project_support_level'] = $project_support_level;

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


