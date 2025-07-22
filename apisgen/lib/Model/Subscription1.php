<?php
/**
 * Subscription1
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
 * Subscription1 Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Subscription1 implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Subscription_1';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'license_uri' => 'string',
        'plan' => 'string',
        'environments' => 'int',
        'storage' => 'int',
        'included_users' => 'int',
        'subscription_management_uri' => 'string',
        'restricted' => 'bool',
        'suspended' => 'bool',
        'user_licenses' => 'int',
        'resources' => '\OpenAPI\Client\Model\ResourcesLimits',
        'resource_validation_url' => 'string',
        'image_types' => '\OpenAPI\Client\Model\RestrictedAndDeniedImageTypes'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'license_uri' => null,
        'plan' => null,
        'environments' => null,
        'storage' => null,
        'included_users' => null,
        'subscription_management_uri' => null,
        'restricted' => null,
        'suspended' => null,
        'user_licenses' => null,
        'resources' => null,
        'resource_validation_url' => null,
        'image_types' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'license_uri' => false,
        'plan' => false,
        'environments' => false,
        'storage' => false,
        'included_users' => false,
        'subscription_management_uri' => false,
        'restricted' => false,
        'suspended' => false,
        'user_licenses' => false,
        'resources' => false,
        'resource_validation_url' => false,
        'image_types' => false
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
        'license_uri' => 'license_uri',
        'plan' => 'plan',
        'environments' => 'environments',
        'storage' => 'storage',
        'included_users' => 'included_users',
        'subscription_management_uri' => 'subscription_management_uri',
        'restricted' => 'restricted',
        'suspended' => 'suspended',
        'user_licenses' => 'user_licenses',
        'resources' => 'resources',
        'resource_validation_url' => 'resource_validation_url',
        'image_types' => 'image_types'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'license_uri' => 'setLicenseUri',
        'plan' => 'setPlan',
        'environments' => 'setEnvironments',
        'storage' => 'setStorage',
        'included_users' => 'setIncludedUsers',
        'subscription_management_uri' => 'setSubscriptionManagementUri',
        'restricted' => 'setRestricted',
        'suspended' => 'setSuspended',
        'user_licenses' => 'setUserLicenses',
        'resources' => 'setResources',
        'resource_validation_url' => 'setResourceValidationUrl',
        'image_types' => 'setImageTypes'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'license_uri' => 'getLicenseUri',
        'plan' => 'getPlan',
        'environments' => 'getEnvironments',
        'storage' => 'getStorage',
        'included_users' => 'getIncludedUsers',
        'subscription_management_uri' => 'getSubscriptionManagementUri',
        'restricted' => 'getRestricted',
        'suspended' => 'getSuspended',
        'user_licenses' => 'getUserLicenses',
        'resources' => 'getResources',
        'resource_validation_url' => 'getResourceValidationUrl',
        'image_types' => 'getImageTypes'
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

    public const PLAN__2XLARGE = '2xlarge';
    public const PLAN__4XLARGE = '4xlarge';
    public const PLAN__8XLARGE = '8xlarge';
    public const PLAN_DEVELOPMENT = 'development';
    public const PLAN_LARGE = 'large';
    public const PLAN_MEDIUM = 'medium';
    public const PLAN_STANDARD = 'standard';
    public const PLAN_XLARGE = 'xlarge';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPlanAllowableValues()
    {
        return [
            self::PLAN__2XLARGE,
            self::PLAN__4XLARGE,
            self::PLAN__8XLARGE,
            self::PLAN_DEVELOPMENT,
            self::PLAN_LARGE,
            self::PLAN_MEDIUM,
            self::PLAN_STANDARD,
            self::PLAN_XLARGE,
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
        $this->setIfExists('license_uri', $data ?? [], null);
        $this->setIfExists('plan', $data ?? [], null);
        $this->setIfExists('environments', $data ?? [], null);
        $this->setIfExists('storage', $data ?? [], null);
        $this->setIfExists('included_users', $data ?? [], null);
        $this->setIfExists('subscription_management_uri', $data ?? [], null);
        $this->setIfExists('restricted', $data ?? [], null);
        $this->setIfExists('suspended', $data ?? [], null);
        $this->setIfExists('user_licenses', $data ?? [], null);
        $this->setIfExists('resources', $data ?? [], null);
        $this->setIfExists('resource_validation_url', $data ?? [], null);
        $this->setIfExists('image_types', $data ?? [], null);
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

        if ($this->container['license_uri'] === null) {
            $invalidProperties[] = "'license_uri' can't be null";
        }
        $allowedValues = $this->getPlanAllowableValues();
        if (!is_null($this->container['plan']) && !in_array($this->container['plan'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'plan', must be one of '%s'",
                $this->container['plan'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['storage'] === null) {
            $invalidProperties[] = "'storage' can't be null";
        }
        if ($this->container['included_users'] === null) {
            $invalidProperties[] = "'included_users' can't be null";
        }
        if ($this->container['subscription_management_uri'] === null) {
            $invalidProperties[] = "'subscription_management_uri' can't be null";
        }
        if ($this->container['restricted'] === null) {
            $invalidProperties[] = "'restricted' can't be null";
        }
        if ($this->container['suspended'] === null) {
            $invalidProperties[] = "'suspended' can't be null";
        }
        if ($this->container['user_licenses'] === null) {
            $invalidProperties[] = "'user_licenses' can't be null";
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
     * Gets license_uri
     *
     * @return string
     */
    public function getLicenseUri()
    {
        return $this->container['license_uri'];
    }

    /**
     * Sets license_uri
     *
     * @param string $license_uri license_uri
     *
     * @return self
     */
    public function setLicenseUri($license_uri)
    {
        if (is_null($license_uri)) {
            throw new \InvalidArgumentException('non-nullable license_uri cannot be null');
        }
        $this->container['license_uri'] = $license_uri;

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
     * @param string|null $plan plan
     *
     * @return self
     */
    public function setPlan($plan)
    {
        if (is_null($plan)) {
            throw new \InvalidArgumentException('non-nullable plan cannot be null');
        }
        $allowedValues = $this->getPlanAllowableValues();
        if (!in_array($plan, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'plan', must be one of '%s'",
                    $plan,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['plan'] = $plan;

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
     * @param int|null $environments environments
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
     * @return int
     */
    public function getStorage()
    {
        return $this->container['storage'];
    }

    /**
     * Sets storage
     *
     * @param int $storage storage
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
     * Gets included_users
     *
     * @return int
     */
    public function getIncludedUsers()
    {
        return $this->container['included_users'];
    }

    /**
     * Sets included_users
     *
     * @param int $included_users included_users
     *
     * @return self
     */
    public function setIncludedUsers($included_users)
    {
        if (is_null($included_users)) {
            throw new \InvalidArgumentException('non-nullable included_users cannot be null');
        }
        $this->container['included_users'] = $included_users;

        return $this;
    }

    /**
     * Gets subscription_management_uri
     *
     * @return string
     */
    public function getSubscriptionManagementUri()
    {
        return $this->container['subscription_management_uri'];
    }

    /**
     * Sets subscription_management_uri
     *
     * @param string $subscription_management_uri subscription_management_uri
     *
     * @return self
     */
    public function setSubscriptionManagementUri($subscription_management_uri)
    {
        if (is_null($subscription_management_uri)) {
            throw new \InvalidArgumentException('non-nullable subscription_management_uri cannot be null');
        }
        $this->container['subscription_management_uri'] = $subscription_management_uri;

        return $this;
    }

    /**
     * Gets restricted
     *
     * @return bool
     */
    public function getRestricted()
    {
        return $this->container['restricted'];
    }

    /**
     * Sets restricted
     *
     * @param bool $restricted restricted
     *
     * @return self
     */
    public function setRestricted($restricted)
    {
        if (is_null($restricted)) {
            throw new \InvalidArgumentException('non-nullable restricted cannot be null');
        }
        $this->container['restricted'] = $restricted;

        return $this;
    }

    /**
     * Gets suspended
     *
     * @return bool
     */
    public function getSuspended()
    {
        return $this->container['suspended'];
    }

    /**
     * Sets suspended
     *
     * @param bool $suspended suspended
     *
     * @return self
     */
    public function setSuspended($suspended)
    {
        if (is_null($suspended)) {
            throw new \InvalidArgumentException('non-nullable suspended cannot be null');
        }
        $this->container['suspended'] = $suspended;

        return $this;
    }

    /**
     * Gets user_licenses
     *
     * @return int
     */
    public function getUserLicenses()
    {
        return $this->container['user_licenses'];
    }

    /**
     * Sets user_licenses
     *
     * @param int $user_licenses user_licenses
     *
     * @return self
     */
    public function setUserLicenses($user_licenses)
    {
        if (is_null($user_licenses)) {
            throw new \InvalidArgumentException('non-nullable user_licenses cannot be null');
        }
        $this->container['user_licenses'] = $user_licenses;

        return $this;
    }

    /**
     * Gets resources
     *
     * @return \OpenAPI\Client\Model\ResourcesLimits|null
     */
    public function getResources()
    {
        return $this->container['resources'];
    }

    /**
     * Sets resources
     *
     * @param \OpenAPI\Client\Model\ResourcesLimits|null $resources resources
     *
     * @return self
     */
    public function setResources($resources)
    {
        if (is_null($resources)) {
            throw new \InvalidArgumentException('non-nullable resources cannot be null');
        }
        $this->container['resources'] = $resources;

        return $this;
    }

    /**
     * Gets resource_validation_url
     *
     * @return string|null
     */
    public function getResourceValidationUrl()
    {
        return $this->container['resource_validation_url'];
    }

    /**
     * Sets resource_validation_url
     *
     * @param string|null $resource_validation_url resource_validation_url
     *
     * @return self
     */
    public function setResourceValidationUrl($resource_validation_url)
    {
        if (is_null($resource_validation_url)) {
            throw new \InvalidArgumentException('non-nullable resource_validation_url cannot be null');
        }
        $this->container['resource_validation_url'] = $resource_validation_url;

        return $this;
    }

    /**
     * Gets image_types
     *
     * @return \OpenAPI\Client\Model\RestrictedAndDeniedImageTypes|null
     */
    public function getImageTypes()
    {
        return $this->container['image_types'];
    }

    /**
     * Sets image_types
     *
     * @param \OpenAPI\Client\Model\RestrictedAndDeniedImageTypes|null $image_types image_types
     *
     * @return self
     */
    public function setImageTypes($image_types)
    {
        if (is_null($image_types)) {
            throw new \InvalidArgumentException('non-nullable image_types cannot be null');
        }
        $this->container['image_types'] = $image_types;

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


