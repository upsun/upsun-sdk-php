<?php
/**
 * ConfigurationForAccessingThisApplicationViaHTTP
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
 * ConfigurationForAccessingThisApplicationViaHTTP Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ConfigurationForAccessingThisApplicationViaHTTP implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Configuration_for_accessing_this_application_via_HTTP_';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'locations' => 'array<string,\OpenAPI\Client\Model\TheSpecificationOfTheWebLocationsServedByThisApplicationValue>',
        'commands' => '\OpenAPI\Client\Model\CommandsToManageTheApplicationSLifecycle',
        'upstream' => '\OpenAPI\Client\Model\ConfigurationOnHowTheWebServerCommunicatesWithTheApplication',
        'document_root' => 'string',
        'passthru' => 'string',
        'index_files' => 'string[]',
        'whitelist' => 'string[]',
        'blacklist' => 'string[]',
        'expires' => 'string',
        'move_to_root' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'locations' => null,
        'commands' => null,
        'upstream' => null,
        'document_root' => null,
        'passthru' => null,
        'index_files' => null,
        'whitelist' => null,
        'blacklist' => null,
        'expires' => null,
        'move_to_root' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'locations' => false,
        'commands' => false,
        'upstream' => false,
        'document_root' => true,
        'passthru' => true,
        'index_files' => true,
        'whitelist' => true,
        'blacklist' => true,
        'expires' => true,
        'move_to_root' => false
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
        'locations' => 'locations',
        'commands' => 'commands',
        'upstream' => 'upstream',
        'document_root' => 'document_root',
        'passthru' => 'passthru',
        'index_files' => 'index_files',
        'whitelist' => 'whitelist',
        'blacklist' => 'blacklist',
        'expires' => 'expires',
        'move_to_root' => 'move_to_root'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'locations' => 'setLocations',
        'commands' => 'setCommands',
        'upstream' => 'setUpstream',
        'document_root' => 'setDocumentRoot',
        'passthru' => 'setPassthru',
        'index_files' => 'setIndexFiles',
        'whitelist' => 'setWhitelist',
        'blacklist' => 'setBlacklist',
        'expires' => 'setExpires',
        'move_to_root' => 'setMoveToRoot'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'locations' => 'getLocations',
        'commands' => 'getCommands',
        'upstream' => 'getUpstream',
        'document_root' => 'getDocumentRoot',
        'passthru' => 'getPassthru',
        'index_files' => 'getIndexFiles',
        'whitelist' => 'getWhitelist',
        'blacklist' => 'getBlacklist',
        'expires' => 'getExpires',
        'move_to_root' => 'getMoveToRoot'
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
        $this->setIfExists('locations', $data ?? [], null);
        $this->setIfExists('commands', $data ?? [], null);
        $this->setIfExists('upstream', $data ?? [], null);
        $this->setIfExists('document_root', $data ?? [], null);
        $this->setIfExists('passthru', $data ?? [], null);
        $this->setIfExists('index_files', $data ?? [], null);
        $this->setIfExists('whitelist', $data ?? [], null);
        $this->setIfExists('blacklist', $data ?? [], null);
        $this->setIfExists('expires', $data ?? [], null);
        $this->setIfExists('move_to_root', $data ?? [], null);
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

        if ($this->container['locations'] === null) {
            $invalidProperties[] = "'locations' can't be null";
        }
        if ($this->container['move_to_root'] === null) {
            $invalidProperties[] = "'move_to_root' can't be null";
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
     * Gets locations
     *
     * @return array<string,\OpenAPI\Client\Model\TheSpecificationOfTheWebLocationsServedByThisApplicationValue>
     */
    public function getLocations()
    {
        return $this->container['locations'];
    }

    /**
     * Sets locations
     *
     * @param array<string,\OpenAPI\Client\Model\TheSpecificationOfTheWebLocationsServedByThisApplicationValue> $locations locations
     *
     * @return self
     */
    public function setLocations($locations)
    {
        if (is_null($locations)) {
            throw new \InvalidArgumentException('non-nullable locations cannot be null');
        }
        $this->container['locations'] = $locations;

        return $this;
    }

    /**
     * Gets commands
     *
     * @return \OpenAPI\Client\Model\CommandsToManageTheApplicationSLifecycle|null
     */
    public function getCommands()
    {
        return $this->container['commands'];
    }

    /**
     * Sets commands
     *
     * @param \OpenAPI\Client\Model\CommandsToManageTheApplicationSLifecycle|null $commands commands
     *
     * @return self
     */
    public function setCommands($commands)
    {
        if (is_null($commands)) {
            throw new \InvalidArgumentException('non-nullable commands cannot be null');
        }
        $this->container['commands'] = $commands;

        return $this;
    }

    /**
     * Gets upstream
     *
     * @return \OpenAPI\Client\Model\ConfigurationOnHowTheWebServerCommunicatesWithTheApplication|null
     */
    public function getUpstream()
    {
        return $this->container['upstream'];
    }

    /**
     * Sets upstream
     *
     * @param \OpenAPI\Client\Model\ConfigurationOnHowTheWebServerCommunicatesWithTheApplication|null $upstream upstream
     *
     * @return self
     */
    public function setUpstream($upstream)
    {
        if (is_null($upstream)) {
            throw new \InvalidArgumentException('non-nullable upstream cannot be null');
        }
        $this->container['upstream'] = $upstream;

        return $this;
    }

    /**
     * Gets document_root
     *
     * @return string|null
     */
    public function getDocumentRoot()
    {
        return $this->container['document_root'];
    }

    /**
     * Sets document_root
     *
     * @param string|null $document_root document_root
     *
     * @return self
     */
    public function setDocumentRoot($document_root)
    {
        if (is_null($document_root)) {
            array_push($this->openAPINullablesSetToNull, 'document_root');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('document_root', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['document_root'] = $document_root;

        return $this;
    }

    /**
     * Gets passthru
     *
     * @return string|null
     */
    public function getPassthru()
    {
        return $this->container['passthru'];
    }

    /**
     * Sets passthru
     *
     * @param string|null $passthru passthru
     *
     * @return self
     */
    public function setPassthru($passthru)
    {
        if (is_null($passthru)) {
            array_push($this->openAPINullablesSetToNull, 'passthru');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('passthru', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['passthru'] = $passthru;

        return $this;
    }

    /**
     * Gets index_files
     *
     * @return string[]|null
     */
    public function getIndexFiles()
    {
        return $this->container['index_files'];
    }

    /**
     * Sets index_files
     *
     * @param string[]|null $index_files index_files
     *
     * @return self
     */
    public function setIndexFiles($index_files)
    {
        if (is_null($index_files)) {
            array_push($this->openAPINullablesSetToNull, 'index_files');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('index_files', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['index_files'] = $index_files;

        return $this;
    }

    /**
     * Gets whitelist
     *
     * @return string[]|null
     */
    public function getWhitelist()
    {
        return $this->container['whitelist'];
    }

    /**
     * Sets whitelist
     *
     * @param string[]|null $whitelist whitelist
     *
     * @return self
     */
    public function setWhitelist($whitelist)
    {
        if (is_null($whitelist)) {
            array_push($this->openAPINullablesSetToNull, 'whitelist');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('whitelist', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['whitelist'] = $whitelist;

        return $this;
    }

    /**
     * Gets blacklist
     *
     * @return string[]|null
     */
    public function getBlacklist()
    {
        return $this->container['blacklist'];
    }

    /**
     * Sets blacklist
     *
     * @param string[]|null $blacklist blacklist
     *
     * @return self
     */
    public function setBlacklist($blacklist)
    {
        if (is_null($blacklist)) {
            array_push($this->openAPINullablesSetToNull, 'blacklist');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('blacklist', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['blacklist'] = $blacklist;

        return $this;
    }

    /**
     * Gets expires
     *
     * @return string|null
     */
    public function getExpires()
    {
        return $this->container['expires'];
    }

    /**
     * Sets expires
     *
     * @param string|null $expires expires
     *
     * @return self
     */
    public function setExpires($expires)
    {
        if (is_null($expires)) {
            array_push($this->openAPINullablesSetToNull, 'expires');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('expires', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['expires'] = $expires;

        return $this;
    }

    /**
     * Gets move_to_root
     *
     * @return bool
     */
    public function getMoveToRoot()
    {
        return $this->container['move_to_root'];
    }

    /**
     * Sets move_to_root
     *
     * @param bool $move_to_root move_to_root
     *
     * @return self
     */
    public function setMoveToRoot($move_to_root)
    {
        if (is_null($move_to_root)) {
            throw new \InvalidArgumentException('non-nullable move_to_root cannot be null');
        }
        $this->container['move_to_root'] = $move_to_root;

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


