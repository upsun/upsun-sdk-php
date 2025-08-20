<?php
/**
 * VPNConfiguration
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
 * VPNConfiguration Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class VPNConfiguration implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'VPN_configuration';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'version' => 'int',
        'aggressive' => 'string',
        'modeconfig' => 'string',
        'authentication' => 'string',
        'gateway_ip' => 'string',
        'identity' => 'string',
        'second_identity' => 'string',
        'remote_identity' => 'string',
        'remote_subnets' => 'string[]',
        'ike' => 'string',
        'esp' => 'string',
        'ikelifetime' => 'string',
        'lifetime' => 'string',
        'margintime' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'version' => null,
        'aggressive' => null,
        'modeconfig' => null,
        'authentication' => null,
        'gateway_ip' => null,
        'identity' => null,
        'second_identity' => null,
        'remote_identity' => null,
        'remote_subnets' => null,
        'ike' => null,
        'esp' => null,
        'ikelifetime' => null,
        'lifetime' => null,
        'margintime' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'version' => false,
        'aggressive' => false,
        'modeconfig' => false,
        'authentication' => false,
        'gateway_ip' => false,
        'identity' => true,
        'second_identity' => true,
        'remote_identity' => true,
        'remote_subnets' => false,
        'ike' => false,
        'esp' => false,
        'ikelifetime' => false,
        'lifetime' => false,
        'margintime' => false
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
        'version' => 'version',
        'aggressive' => 'aggressive',
        'modeconfig' => 'modeconfig',
        'authentication' => 'authentication',
        'gateway_ip' => 'gateway_ip',
        'identity' => 'identity',
        'second_identity' => 'second_identity',
        'remote_identity' => 'remote_identity',
        'remote_subnets' => 'remote_subnets',
        'ike' => 'ike',
        'esp' => 'esp',
        'ikelifetime' => 'ikelifetime',
        'lifetime' => 'lifetime',
        'margintime' => 'margintime'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'version' => 'setVersion',
        'aggressive' => 'setAggressive',
        'modeconfig' => 'setModeconfig',
        'authentication' => 'setAuthentication',
        'gateway_ip' => 'setGatewayIp',
        'identity' => 'setIdentity',
        'second_identity' => 'setSecondIdentity',
        'remote_identity' => 'setRemoteIdentity',
        'remote_subnets' => 'setRemoteSubnets',
        'ike' => 'setIke',
        'esp' => 'setEsp',
        'ikelifetime' => 'setIkelifetime',
        'lifetime' => 'setLifetime',
        'margintime' => 'setMargintime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'version' => 'getVersion',
        'aggressive' => 'getAggressive',
        'modeconfig' => 'getModeconfig',
        'authentication' => 'getAuthentication',
        'gateway_ip' => 'getGatewayIp',
        'identity' => 'getIdentity',
        'second_identity' => 'getSecondIdentity',
        'remote_identity' => 'getRemoteIdentity',
        'remote_subnets' => 'getRemoteSubnets',
        'ike' => 'getIke',
        'esp' => 'getEsp',
        'ikelifetime' => 'getIkelifetime',
        'lifetime' => 'getLifetime',
        'margintime' => 'getMargintime'
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

    public const VERSION_NUMBER_1 = 1;
    public const VERSION_NUMBER_2 = 2;
    public const AGGRESSIVE_NO = 'no';
    public const AGGRESSIVE_YES = 'yes';
    public const MODECONFIG_PULL = 'pull';
    public const MODECONFIG_PUSH = 'push';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVersionAllowableValues()
    {
        return [
            self::VERSION_NUMBER_1,
            self::VERSION_NUMBER_2,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAggressiveAllowableValues()
    {
        return [
            self::AGGRESSIVE_NO,
            self::AGGRESSIVE_YES,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModeconfigAllowableValues()
    {
        return [
            self::MODECONFIG_PULL,
            self::MODECONFIG_PUSH,
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
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('aggressive', $data ?? [], null);
        $this->setIfExists('modeconfig', $data ?? [], null);
        $this->setIfExists('authentication', $data ?? [], null);
        $this->setIfExists('gateway_ip', $data ?? [], null);
        $this->setIfExists('identity', $data ?? [], null);
        $this->setIfExists('second_identity', $data ?? [], null);
        $this->setIfExists('remote_identity', $data ?? [], null);
        $this->setIfExists('remote_subnets', $data ?? [], null);
        $this->setIfExists('ike', $data ?? [], null);
        $this->setIfExists('esp', $data ?? [], null);
        $this->setIfExists('ikelifetime', $data ?? [], null);
        $this->setIfExists('lifetime', $data ?? [], null);
        $this->setIfExists('margintime', $data ?? [], null);
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

        if ($this->container['version'] === null) {
            $invalidProperties[] = "'version' can't be null";
        }
        $allowedValues = $this->getVersionAllowableValues();
        if (!is_null($this->container['version']) && !in_array($this->container['version'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'version', must be one of '%s'",
                $this->container['version'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['aggressive'] === null) {
            $invalidProperties[] = "'aggressive' can't be null";
        }
        $allowedValues = $this->getAggressiveAllowableValues();
        if (!is_null($this->container['aggressive']) && !in_array($this->container['aggressive'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'aggressive', must be one of '%s'",
                $this->container['aggressive'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['modeconfig'] === null) {
            $invalidProperties[] = "'modeconfig' can't be null";
        }
        $allowedValues = $this->getModeconfigAllowableValues();
        if (!is_null($this->container['modeconfig']) && !in_array($this->container['modeconfig'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'modeconfig', must be one of '%s'",
                $this->container['modeconfig'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['authentication'] === null) {
            $invalidProperties[] = "'authentication' can't be null";
        }
        if ($this->container['gateway_ip'] === null) {
            $invalidProperties[] = "'gateway_ip' can't be null";
        }
        if ($this->container['identity'] === null) {
            $invalidProperties[] = "'identity' can't be null";
        }
        if ($this->container['second_identity'] === null) {
            $invalidProperties[] = "'second_identity' can't be null";
        }
        if ($this->container['remote_identity'] === null) {
            $invalidProperties[] = "'remote_identity' can't be null";
        }
        if ($this->container['remote_subnets'] === null) {
            $invalidProperties[] = "'remote_subnets' can't be null";
        }
        if ($this->container['ike'] === null) {
            $invalidProperties[] = "'ike' can't be null";
        }
        if ($this->container['esp'] === null) {
            $invalidProperties[] = "'esp' can't be null";
        }
        if ($this->container['ikelifetime'] === null) {
            $invalidProperties[] = "'ikelifetime' can't be null";
        }
        if ($this->container['lifetime'] === null) {
            $invalidProperties[] = "'lifetime' can't be null";
        }
        if ($this->container['margintime'] === null) {
            $invalidProperties[] = "'margintime' can't be null";
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
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int $version version
     *
     * @return self
     */
    public function setVersion($version)
    {
        if (is_null($version)) {
            throw new \InvalidArgumentException('non-nullable version cannot be null');
        }
        $allowedValues = $this->getVersionAllowableValues();
        if (!in_array($version, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'version', must be one of '%s'",
                    $version,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets aggressive
     *
     * @return string
     */
    public function getAggressive()
    {
        return $this->container['aggressive'];
    }

    /**
     * Sets aggressive
     *
     * @param string $aggressive aggressive
     *
     * @return self
     */
    public function setAggressive($aggressive)
    {
        if (is_null($aggressive)) {
            throw new \InvalidArgumentException('non-nullable aggressive cannot be null');
        }
        $allowedValues = $this->getAggressiveAllowableValues();
        if (!in_array($aggressive, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'aggressive', must be one of '%s'",
                    $aggressive,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['aggressive'] = $aggressive;

        return $this;
    }

    /**
     * Gets modeconfig
     *
     * @return string
     */
    public function getModeconfig()
    {
        return $this->container['modeconfig'];
    }

    /**
     * Sets modeconfig
     *
     * @param string $modeconfig modeconfig
     *
     * @return self
     */
    public function setModeconfig($modeconfig)
    {
        if (is_null($modeconfig)) {
            throw new \InvalidArgumentException('non-nullable modeconfig cannot be null');
        }
        $allowedValues = $this->getModeconfigAllowableValues();
        if (!in_array($modeconfig, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'modeconfig', must be one of '%s'",
                    $modeconfig,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['modeconfig'] = $modeconfig;

        return $this;
    }

    /**
     * Gets authentication
     *
     * @return string
     */
    public function getAuthentication()
    {
        return $this->container['authentication'];
    }

    /**
     * Sets authentication
     *
     * @param string $authentication authentication
     *
     * @return self
     */
    public function setAuthentication($authentication)
    {
        if (is_null($authentication)) {
            throw new \InvalidArgumentException('non-nullable authentication cannot be null');
        }
        $this->container['authentication'] = $authentication;

        return $this;
    }

    /**
     * Gets gateway_ip
     *
     * @return string
     */
    public function getGatewayIp()
    {
        return $this->container['gateway_ip'];
    }

    /**
     * Sets gateway_ip
     *
     * @param string $gateway_ip gateway_ip
     *
     * @return self
     */
    public function setGatewayIp($gateway_ip)
    {
        if (is_null($gateway_ip)) {
            throw new \InvalidArgumentException('non-nullable gateway_ip cannot be null');
        }
        $this->container['gateway_ip'] = $gateway_ip;

        return $this;
    }

    /**
     * Gets identity
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->container['identity'];
    }

    /**
     * Sets identity
     *
     * @param string $identity identity
     *
     * @return self
     */
    public function setIdentity($identity)
    {
        if (is_null($identity)) {
            array_push($this->openAPINullablesSetToNull, 'identity');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('identity', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['identity'] = $identity;

        return $this;
    }

    /**
     * Gets second_identity
     *
     * @return string
     */
    public function getSecondIdentity()
    {
        return $this->container['second_identity'];
    }

    /**
     * Sets second_identity
     *
     * @param string $second_identity second_identity
     *
     * @return self
     */
    public function setSecondIdentity($second_identity)
    {
        if (is_null($second_identity)) {
            array_push($this->openAPINullablesSetToNull, 'second_identity');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_identity', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_identity'] = $second_identity;

        return $this;
    }

    /**
     * Gets remote_identity
     *
     * @return string
     */
    public function getRemoteIdentity()
    {
        return $this->container['remote_identity'];
    }

    /**
     * Sets remote_identity
     *
     * @param string $remote_identity remote_identity
     *
     * @return self
     */
    public function setRemoteIdentity($remote_identity)
    {
        if (is_null($remote_identity)) {
            array_push($this->openAPINullablesSetToNull, 'remote_identity');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('remote_identity', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['remote_identity'] = $remote_identity;

        return $this;
    }

    /**
     * Gets remote_subnets
     *
     * @return string[]
     */
    public function getRemoteSubnets()
    {
        return $this->container['remote_subnets'];
    }

    /**
     * Sets remote_subnets
     *
     * @param string[] $remote_subnets remote_subnets
     *
     * @return self
     */
    public function setRemoteSubnets($remote_subnets)
    {
        if (is_null($remote_subnets)) {
            throw new \InvalidArgumentException('non-nullable remote_subnets cannot be null');
        }
        $this->container['remote_subnets'] = $remote_subnets;

        return $this;
    }

    /**
     * Gets ike
     *
     * @return string
     */
    public function getIke()
    {
        return $this->container['ike'];
    }

    /**
     * Sets ike
     *
     * @param string $ike ike
     *
     * @return self
     */
    public function setIke($ike)
    {
        if (is_null($ike)) {
            throw new \InvalidArgumentException('non-nullable ike cannot be null');
        }
        $this->container['ike'] = $ike;

        return $this;
    }

    /**
     * Gets esp
     *
     * @return string
     */
    public function getEsp()
    {
        return $this->container['esp'];
    }

    /**
     * Sets esp
     *
     * @param string $esp esp
     *
     * @return self
     */
    public function setEsp($esp)
    {
        if (is_null($esp)) {
            throw new \InvalidArgumentException('non-nullable esp cannot be null');
        }
        $this->container['esp'] = $esp;

        return $this;
    }

    /**
     * Gets ikelifetime
     *
     * @return string
     */
    public function getIkelifetime()
    {
        return $this->container['ikelifetime'];
    }

    /**
     * Sets ikelifetime
     *
     * @param string $ikelifetime ikelifetime
     *
     * @return self
     */
    public function setIkelifetime($ikelifetime)
    {
        if (is_null($ikelifetime)) {
            throw new \InvalidArgumentException('non-nullable ikelifetime cannot be null');
        }
        $this->container['ikelifetime'] = $ikelifetime;

        return $this;
    }

    /**
     * Gets lifetime
     *
     * @return string
     */
    public function getLifetime()
    {
        return $this->container['lifetime'];
    }

    /**
     * Sets lifetime
     *
     * @param string $lifetime lifetime
     *
     * @return self
     */
    public function setLifetime($lifetime)
    {
        if (is_null($lifetime)) {
            throw new \InvalidArgumentException('non-nullable lifetime cannot be null');
        }
        $this->container['lifetime'] = $lifetime;

        return $this;
    }

    /**
     * Gets margintime
     *
     * @return string
     */
    public function getMargintime()
    {
        return $this->container['margintime'];
    }

    /**
     * Sets margintime
     *
     * @param string $margintime margintime
     *
     * @return self
     */
    public function setMargintime($margintime)
    {
        if (is_null($margintime)) {
            throw new \InvalidArgumentException('non-nullable margintime cannot be null');
        }
        $this->container['margintime'] = $margintime;

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


