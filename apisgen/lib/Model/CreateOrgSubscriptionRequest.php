<?php
/**
 * CreateOrgSubscriptionRequest
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
 * CreateOrgSubscriptionRequest Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreateOrgSubscriptionRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'create_org_subscription_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'plan' => '\OpenAPI\Client\Model\PlanType',
        'project_region' => 'string',
        'project_title' => 'string',
        'options_url' => 'string',
        'options_custom' => 'object',
        'default_branch' => 'string',
        'environments' => 'int',
        'storage' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'plan' => null,
        'project_region' => null,
        'project_title' => null,
        'options_url' => null,
        'options_custom' => null,
        'default_branch' => null,
        'environments' => null,
        'storage' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'plan' => false,
        'project_region' => false,
        'project_title' => false,
        'options_url' => false,
        'options_custom' => false,
        'default_branch' => false,
        'environments' => false,
        'storage' => false
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
        'plan' => 'plan',
        'project_region' => 'project_region',
        'project_title' => 'project_title',
        'options_url' => 'options_url',
        'options_custom' => 'options_custom',
        'default_branch' => 'default_branch',
        'environments' => 'environments',
        'storage' => 'storage'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'plan' => 'setPlan',
        'project_region' => 'setProjectRegion',
        'project_title' => 'setProjectTitle',
        'options_url' => 'setOptionsUrl',
        'options_custom' => 'setOptionsCustom',
        'default_branch' => 'setDefaultBranch',
        'environments' => 'setEnvironments',
        'storage' => 'setStorage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'plan' => 'getPlan',
        'project_region' => 'getProjectRegion',
        'project_title' => 'getProjectTitle',
        'options_url' => 'getOptionsUrl',
        'options_custom' => 'getOptionsCustom',
        'default_branch' => 'getDefaultBranch',
        'environments' => 'getEnvironments',
        'storage' => 'getStorage'
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
        $this->setIfExists('plan', $data ?? [], null);
        $this->setIfExists('project_region', $data ?? [], null);
        $this->setIfExists('project_title', $data ?? [], null);
        $this->setIfExists('options_url', $data ?? [], null);
        $this->setIfExists('options_custom', $data ?? [], null);
        $this->setIfExists('default_branch', $data ?? [], null);
        $this->setIfExists('environments', $data ?? [], null);
        $this->setIfExists('storage', $data ?? [], null);
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

        if ($this->container['project_region'] === null) {
            $invalidProperties[] = "'project_region' can't be null";
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
     * Gets plan
     *
     * @return \OpenAPI\Client\Model\PlanType|null
     */
    public function getPlan()
    {
        return $this->container['plan'];
    }

    /**
     * Sets plan
     *
     * @param \OpenAPI\Client\Model\PlanType|null $plan plan
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
     * Gets project_region
     *
     * @return string
     */
    public function getProjectRegion()
    {
        return $this->container['project_region'];
    }

    /**
     * Sets project_region
     *
     * @param string $project_region The machine name of the region where the project is located. Cannot be changed after project creation.
     *
     * @return self
     */
    public function setProjectRegion($project_region)
    {
        if (is_null($project_region)) {
            throw new \InvalidArgumentException('non-nullable project_region cannot be null');
        }
        $this->container['project_region'] = $project_region;

        return $this;
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
     * @param string|null $project_title The name given to the project. Appears as the title in the UI.
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
     * Gets options_url
     *
     * @return string|null
     */
    public function getOptionsUrl()
    {
        return $this->container['options_url'];
    }

    /**
     * Sets options_url
     *
     * @param string|null $options_url The URL of the project options file.
     *
     * @return self
     */
    public function setOptionsUrl($options_url)
    {
        if (is_null($options_url)) {
            throw new \InvalidArgumentException('non-nullable options_url cannot be null');
        }
        $this->container['options_url'] = $options_url;

        return $this;
    }

    /**
     * Gets options_custom
     *
     * @return object|null
     */
    public function getOptionsCustom()
    {
        return $this->container['options_custom'];
    }

    /**
     * Sets options_custom
     *
     * @param object|null $options_custom Customizations at creation time integrated into project options.
     *
     * @return self
     */
    public function setOptionsCustom($options_custom)
    {
        if (is_null($options_custom)) {
            throw new \InvalidArgumentException('non-nullable options_custom cannot be null');
        }
        $this->container['options_custom'] = $options_custom;

        return $this;
    }

    /**
     * Gets default_branch
     *
     * @return string|null
     */
    public function getDefaultBranch()
    {
        return $this->container['default_branch'];
    }

    /**
     * Sets default_branch
     *
     * @param string|null $default_branch The default Git branch name for the project.
     *
     * @return self
     */
    public function setDefaultBranch($default_branch)
    {
        if (is_null($default_branch)) {
            throw new \InvalidArgumentException('non-nullable default_branch cannot be null');
        }
        $this->container['default_branch'] = $default_branch;

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
     * @param int|null $environments The maximum number of active environments on the project.
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
     * @param int|null $storage The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values.
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


