<?php
/**
 * UpdateProfileRequest
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
 * UpdateProfileRequest Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UpdateProfileRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'update_profile_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'display_name' => 'string',
        'username' => 'string',
        'current_password' => 'string',
        'password' => 'string',
        'company_type' => 'string',
        'company_name' => 'string',
        'vat_number' => 'string',
        'company_role' => 'string',
        'marketing' => 'bool',
        'ui_colorscheme' => 'string',
        'default_catalog' => 'string',
        'project_options_url' => 'string',
        'picture' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'display_name' => null,
        'username' => null,
        'current_password' => null,
        'password' => null,
        'company_type' => null,
        'company_name' => null,
        'vat_number' => null,
        'company_role' => null,
        'marketing' => null,
        'ui_colorscheme' => null,
        'default_catalog' => null,
        'project_options_url' => null,
        'picture' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'display_name' => false,
        'username' => false,
        'current_password' => false,
        'password' => false,
        'company_type' => false,
        'company_name' => false,
        'vat_number' => false,
        'company_role' => false,
        'marketing' => false,
        'ui_colorscheme' => false,
        'default_catalog' => false,
        'project_options_url' => false,
        'picture' => false
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
        'display_name' => 'display_name',
        'username' => 'username',
        'current_password' => 'current_password',
        'password' => 'password',
        'company_type' => 'company_type',
        'company_name' => 'company_name',
        'vat_number' => 'vat_number',
        'company_role' => 'company_role',
        'marketing' => 'marketing',
        'ui_colorscheme' => 'ui_colorscheme',
        'default_catalog' => 'default_catalog',
        'project_options_url' => 'project_options_url',
        'picture' => 'picture'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'display_name' => 'setDisplayName',
        'username' => 'setUsername',
        'current_password' => 'setCurrentPassword',
        'password' => 'setPassword',
        'company_type' => 'setCompanyType',
        'company_name' => 'setCompanyName',
        'vat_number' => 'setVatNumber',
        'company_role' => 'setCompanyRole',
        'marketing' => 'setMarketing',
        'ui_colorscheme' => 'setUiColorscheme',
        'default_catalog' => 'setDefaultCatalog',
        'project_options_url' => 'setProjectOptionsUrl',
        'picture' => 'setPicture'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'display_name' => 'getDisplayName',
        'username' => 'getUsername',
        'current_password' => 'getCurrentPassword',
        'password' => 'getPassword',
        'company_type' => 'getCompanyType',
        'company_name' => 'getCompanyName',
        'vat_number' => 'getVatNumber',
        'company_role' => 'getCompanyRole',
        'marketing' => 'getMarketing',
        'ui_colorscheme' => 'getUiColorscheme',
        'default_catalog' => 'getDefaultCatalog',
        'project_options_url' => 'getProjectOptionsUrl',
        'picture' => 'getPicture'
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
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('current_password', $data ?? [], null);
        $this->setIfExists('password', $data ?? [], null);
        $this->setIfExists('company_type', $data ?? [], null);
        $this->setIfExists('company_name', $data ?? [], null);
        $this->setIfExists('vat_number', $data ?? [], null);
        $this->setIfExists('company_role', $data ?? [], null);
        $this->setIfExists('marketing', $data ?? [], null);
        $this->setIfExists('ui_colorscheme', $data ?? [], null);
        $this->setIfExists('default_catalog', $data ?? [], null);
        $this->setIfExists('project_options_url', $data ?? [], null);
        $this->setIfExists('picture', $data ?? [], null);
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
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name The user's display name.
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string|null $username The user's username.
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
     * Gets current_password
     *
     * @return string|null
     */
    public function getCurrentPassword()
    {
        return $this->container['current_password'];
    }

    /**
     * Sets current_password
     *
     * @param string|null $current_password The user's current password.
     *
     * @return self
     */
    public function setCurrentPassword($current_password)
    {
        if (is_null($current_password)) {
            throw new \InvalidArgumentException('non-nullable current_password cannot be null');
        }
        $this->container['current_password'] = $current_password;

        return $this;
    }

    /**
     * Gets password
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->container['password'];
    }

    /**
     * Sets password
     *
     * @param string|null $password The user's new password.
     *
     * @return self
     */
    public function setPassword($password)
    {
        if (is_null($password)) {
            throw new \InvalidArgumentException('non-nullable password cannot be null');
        }
        $this->container['password'] = $password;

        return $this;
    }

    /**
     * Gets company_type
     *
     * @return string|null
     */
    public function getCompanyType()
    {
        return $this->container['company_type'];
    }

    /**
     * Sets company_type
     *
     * @param string|null $company_type The company type.
     *
     * @return self
     */
    public function setCompanyType($company_type)
    {
        if (is_null($company_type)) {
            throw new \InvalidArgumentException('non-nullable company_type cannot be null');
        }
        $this->container['company_type'] = $company_type;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string|null $company_name The name of the company.
     *
     * @return self
     */
    public function setCompanyName($company_name)
    {
        if (is_null($company_name)) {
            throw new \InvalidArgumentException('non-nullable company_name cannot be null');
        }
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets vat_number
     *
     * @return string|null
     */
    public function getVatNumber()
    {
        return $this->container['vat_number'];
    }

    /**
     * Sets vat_number
     *
     * @param string|null $vat_number The vat number of the user.
     *
     * @return self
     */
    public function setVatNumber($vat_number)
    {
        if (is_null($vat_number)) {
            throw new \InvalidArgumentException('non-nullable vat_number cannot be null');
        }
        $this->container['vat_number'] = $vat_number;

        return $this;
    }

    /**
     * Gets company_role
     *
     * @return string|null
     */
    public function getCompanyRole()
    {
        return $this->container['company_role'];
    }

    /**
     * Sets company_role
     *
     * @param string|null $company_role The role of the user in the company.
     *
     * @return self
     */
    public function setCompanyRole($company_role)
    {
        if (is_null($company_role)) {
            throw new \InvalidArgumentException('non-nullable company_role cannot be null');
        }
        $this->container['company_role'] = $company_role;

        return $this;
    }

    /**
     * Gets marketing
     *
     * @return bool|null
     */
    public function getMarketing()
    {
        return $this->container['marketing'];
    }

    /**
     * Sets marketing
     *
     * @param bool|null $marketing Flag if the user agreed to receive marketing communication.
     *
     * @return self
     */
    public function setMarketing($marketing)
    {
        if (is_null($marketing)) {
            throw new \InvalidArgumentException('non-nullable marketing cannot be null');
        }
        $this->container['marketing'] = $marketing;

        return $this;
    }

    /**
     * Gets ui_colorscheme
     *
     * @return string|null
     */
    public function getUiColorscheme()
    {
        return $this->container['ui_colorscheme'];
    }

    /**
     * Sets ui_colorscheme
     *
     * @param string|null $ui_colorscheme The user's chosen color scheme for user interfaces. Available values are 'light' and 'dark'.
     *
     * @return self
     */
    public function setUiColorscheme($ui_colorscheme)
    {
        if (is_null($ui_colorscheme)) {
            throw new \InvalidArgumentException('non-nullable ui_colorscheme cannot be null');
        }
        $this->container['ui_colorscheme'] = $ui_colorscheme;

        return $this;
    }

    /**
     * Gets default_catalog
     *
     * @return string|null
     */
    public function getDefaultCatalog()
    {
        return $this->container['default_catalog'];
    }

    /**
     * Sets default_catalog
     *
     * @param string|null $default_catalog The URL of a catalog file which overrides the default.
     *
     * @return self
     */
    public function setDefaultCatalog($default_catalog)
    {
        if (is_null($default_catalog)) {
            throw new \InvalidArgumentException('non-nullable default_catalog cannot be null');
        }
        $this->container['default_catalog'] = $default_catalog;

        return $this;
    }

    /**
     * Gets project_options_url
     *
     * @return string|null
     */
    public function getProjectOptionsUrl()
    {
        return $this->container['project_options_url'];
    }

    /**
     * Sets project_options_url
     *
     * @param string|null $project_options_url The URL of an account-wide project options file.
     *
     * @return self
     */
    public function setProjectOptionsUrl($project_options_url)
    {
        if (is_null($project_options_url)) {
            throw new \InvalidArgumentException('non-nullable project_options_url cannot be null');
        }
        $this->container['project_options_url'] = $project_options_url;

        return $this;
    }

    /**
     * Gets picture
     *
     * @return string|null
     */
    public function getPicture()
    {
        return $this->container['picture'];
    }

    /**
     * Sets picture
     *
     * @param string|null $picture Url of the user's picture.
     *
     * @return self
     */
    public function setPicture($picture)
    {
        if (is_null($picture)) {
            throw new \InvalidArgumentException('non-nullable picture cannot be null');
        }
        $this->container['picture'] = $picture;

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


