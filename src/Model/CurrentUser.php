<?php
/**
 * CurrentUser
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
 * CurrentUser Class Doc Comment
 *
 * @category Class
 * @description The user object.
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CurrentUser implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CurrentUser';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'uuid' => 'string',
        'username' => 'string',
        'display_name' => 'string',
        'status' => 'int',
        'mail' => 'string',
        'ssh_keys' => '\Upsun\Model\SSHKey[]',
        'has_key' => 'bool',
        'projects' => '\Upsun\Model\CurrentUserProjectsInner[]',
        'sequence' => 'int',
        'roles' => 'string[]',
        'picture' => 'string',
        'tickets' => 'object',
        'trial' => 'bool',
        'current_trial' => '\Upsun\Model\CurrentUserCurrentTrialInner[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => 'uuid',
        'uuid' => 'uuid',
        'username' => null,
        'display_name' => null,
        'status' => null,
        'mail' => 'email',
        'ssh_keys' => null,
        'has_key' => null,
        'projects' => null,
        'sequence' => null,
        'roles' => null,
        'picture' => 'url',
        'tickets' => null,
        'trial' => null,
        'current_trial' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'uuid' => false,
        'username' => false,
        'display_name' => false,
        'status' => false,
        'mail' => false,
        'ssh_keys' => false,
        'has_key' => false,
        'projects' => false,
        'sequence' => false,
        'roles' => false,
        'picture' => false,
        'tickets' => false,
        'trial' => false,
        'current_trial' => false
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
        'id' => 'id',
        'uuid' => 'uuid',
        'username' => 'username',
        'display_name' => 'display_name',
        'status' => 'status',
        'mail' => 'mail',
        'ssh_keys' => 'ssh_keys',
        'has_key' => 'has_key',
        'projects' => 'projects',
        'sequence' => 'sequence',
        'roles' => 'roles',
        'picture' => 'picture',
        'tickets' => 'tickets',
        'trial' => 'trial',
        'current_trial' => 'current_trial'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'uuid' => 'setUuid',
        'username' => 'setUsername',
        'display_name' => 'setDisplayName',
        'status' => 'setStatus',
        'mail' => 'setMail',
        'ssh_keys' => 'setSshKeys',
        'has_key' => 'setHasKey',
        'projects' => 'setProjects',
        'sequence' => 'setSequence',
        'roles' => 'setRoles',
        'picture' => 'setPicture',
        'tickets' => 'setTickets',
        'trial' => 'setTrial',
        'current_trial' => 'setCurrentTrial'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'uuid' => 'getUuid',
        'username' => 'getUsername',
        'display_name' => 'getDisplayName',
        'status' => 'getStatus',
        'mail' => 'getMail',
        'ssh_keys' => 'getSshKeys',
        'has_key' => 'getHasKey',
        'projects' => 'getProjects',
        'sequence' => 'getSequence',
        'roles' => 'getRoles',
        'picture' => 'getPicture',
        'tickets' => 'getTickets',
        'trial' => 'getTrial',
        'current_trial' => 'getCurrentTrial'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('uuid', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('mail', $data ?? [], null);
        $this->setIfExists('ssh_keys', $data ?? [], null);
        $this->setIfExists('has_key', $data ?? [], null);
        $this->setIfExists('projects', $data ?? [], null);
        $this->setIfExists('sequence', $data ?? [], null);
        $this->setIfExists('roles', $data ?? [], null);
        $this->setIfExists('picture', $data ?? [], null);
        $this->setIfExists('tickets', $data ?? [], null);
        $this->setIfExists('trial', $data ?? [], null);
        $this->setIfExists('current_trial', $data ?? [], null);
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id The UUID of the owner.
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets uuid
     *
     * @return string|null
     */
    public function getUuid()
    {
        return $this->container['uuid'];
    }

    /**
     * Sets uuid
     *
     * @param string|null $uuid The UUID of the owner.
     *
     * @return self
     */
    public function setUuid($uuid)
    {
        if (is_null($uuid)) {
            throw new \InvalidArgumentException('non-nullable uuid cannot be null');
        }
        $this->container['uuid'] = $uuid;

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
     * @param string|null $username The username of the owner.
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
     * @param string|null $display_name The full name of the owner.
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
     * Gets status
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param int|null $status Status of the user. 0 = blocked; 1 = active.
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets mail
     *
     * @return string|null
     */
    public function getMail()
    {
        return $this->container['mail'];
    }

    /**
     * Sets mail
     *
     * @param string|null $mail The email address of the owner.
     *
     * @return self
     */
    public function setMail($mail)
    {
        if (is_null($mail)) {
            throw new \InvalidArgumentException('non-nullable mail cannot be null');
        }
        $this->container['mail'] = $mail;

        return $this;
    }

    /**
     * Gets ssh_keys
     *
     * @return \Upsun\Model\SSHKey[]|null
     */
    public function getSshKeys()
    {
        return $this->container['ssh_keys'];
    }

    /**
     * Sets ssh_keys
     *
     * @param \Upsun\Model\SSHKey[]|null $ssh_keys The list of user's public SSH keys.
     *
     * @return self
     */
    public function setSshKeys($ssh_keys)
    {
        if (is_null($ssh_keys)) {
            throw new \InvalidArgumentException('non-nullable ssh_keys cannot be null');
        }
        $this->container['ssh_keys'] = $ssh_keys;

        return $this;
    }

    /**
     * Gets has_key
     *
     * @return bool|null
     */
    public function getHasKey()
    {
        return $this->container['has_key'];
    }

    /**
     * Sets has_key
     *
     * @param bool|null $has_key The indicator whether the user has a public ssh key on file or not.
     *
     * @return self
     */
    public function setHasKey($has_key)
    {
        if (is_null($has_key)) {
            throw new \InvalidArgumentException('non-nullable has_key cannot be null');
        }
        $this->container['has_key'] = $has_key;

        return $this;
    }

    /**
     * Gets projects
     *
     * @return \Upsun\Model\CurrentUserProjectsInner[]|null
     */
    public function getProjects()
    {
        return $this->container['projects'];
    }

    /**
     * Sets projects
     *
     * @param \Upsun\Model\CurrentUserProjectsInner[]|null $projects projects
     *
     * @return self
     */
    public function setProjects($projects)
    {
        if (is_null($projects)) {
            throw new \InvalidArgumentException('non-nullable projects cannot be null');
        }
        $this->container['projects'] = $projects;

        return $this;
    }

    /**
     * Gets sequence
     *
     * @return int|null
     */
    public function getSequence()
    {
        return $this->container['sequence'];
    }

    /**
     * Sets sequence
     *
     * @param int|null $sequence The sequential ID of the user.
     *
     * @return self
     */
    public function setSequence($sequence)
    {
        if (is_null($sequence)) {
            throw new \InvalidArgumentException('non-nullable sequence cannot be null');
        }
        $this->container['sequence'] = $sequence;

        return $this;
    }

    /**
     * Gets roles
     *
     * @return string[]|null
     */
    public function getRoles()
    {
        return $this->container['roles'];
    }

    /**
     * Sets roles
     *
     * @param string[]|null $roles roles
     *
     * @return self
     */
    public function setRoles($roles)
    {
        if (is_null($roles)) {
            throw new \InvalidArgumentException('non-nullable roles cannot be null');
        }
        $this->container['roles'] = $roles;

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
     * @param string|null $picture The URL of the user image.
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
     * Gets tickets
     *
     * @return object|null
     */
    public function getTickets()
    {
        return $this->container['tickets'];
    }

    /**
     * Sets tickets
     *
     * @param object|null $tickets Number of support tickets by status.
     *
     * @return self
     */
    public function setTickets($tickets)
    {
        if (is_null($tickets)) {
            throw new \InvalidArgumentException('non-nullable tickets cannot be null');
        }
        $this->container['tickets'] = $tickets;

        return $this;
    }

    /**
     * Gets trial
     *
     * @return bool|null
     */
    public function getTrial()
    {
        return $this->container['trial'];
    }

    /**
     * Sets trial
     *
     * @param bool|null $trial The indicator whether the user is in trial or not.
     *
     * @return self
     */
    public function setTrial($trial)
    {
        if (is_null($trial)) {
            throw new \InvalidArgumentException('non-nullable trial cannot be null');
        }
        $this->container['trial'] = $trial;

        return $this;
    }

    /**
     * Gets current_trial
     *
     * @return \Upsun\Model\CurrentUserCurrentTrialInner[]|null
     */
    public function getCurrentTrial()
    {
        return $this->container['current_trial'];
    }

    /**
     * Sets current_trial
     *
     * @param \Upsun\Model\CurrentUserCurrentTrialInner[]|null $current_trial current_trial
     *
     * @return self
     */
    public function setCurrentTrial($current_trial)
    {
        if (is_null($current_trial)) {
            throw new \InvalidArgumentException('non-nullable current_trial cannot be null');
        }
        $this->container['current_trial'] = $current_trial;

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


