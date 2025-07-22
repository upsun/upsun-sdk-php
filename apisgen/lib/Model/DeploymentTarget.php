<?php
/**
 * DeploymentTarget
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
 * DeploymentTarget Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class DeploymentTarget implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'DeploymentTarget';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type' => 'string',
        'name' => 'string',
        'deploy_host' => 'string',
        'deploy_port' => 'int',
        'ssh_host' => 'string',
        'hosts' => '\OpenAPI\Client\Model\TheHostsOfTheDeploymentTargetInner[]',
        'auto_mounts' => 'bool',
        'excluded_mounts' => 'string[]',
        'enforced_mounts' => 'object',
        'auto_crons' => 'bool',
        'auto_nginx' => 'bool',
        'maintenance_mode' => 'bool',
        'guardrails_phase' => 'int',
        'docroots' => 'array<string,\OpenAPI\Client\Model\MappingOfClustersToEnterpriseApplicationsValue>',
        'site_urls' => 'object',
        'ssh_hosts' => 'string[]',
        'enterprise_environments_mapping' => 'object',
        'use_dedicated_grid' => 'bool',
        'storage_type' => 'string'
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
        'name' => null,
        'deploy_host' => null,
        'deploy_port' => null,
        'ssh_host' => null,
        'hosts' => null,
        'auto_mounts' => null,
        'excluded_mounts' => null,
        'enforced_mounts' => null,
        'auto_crons' => null,
        'auto_nginx' => null,
        'maintenance_mode' => null,
        'guardrails_phase' => null,
        'docroots' => null,
        'site_urls' => null,
        'ssh_hosts' => null,
        'enterprise_environments_mapping' => null,
        'use_dedicated_grid' => null,
        'storage_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'type' => false,
        'name' => false,
        'deploy_host' => true,
        'deploy_port' => true,
        'ssh_host' => true,
        'hosts' => true,
        'auto_mounts' => false,
        'excluded_mounts' => false,
        'enforced_mounts' => false,
        'auto_crons' => false,
        'auto_nginx' => false,
        'maintenance_mode' => false,
        'guardrails_phase' => false,
        'docroots' => false,
        'site_urls' => false,
        'ssh_hosts' => false,
        'enterprise_environments_mapping' => false,
        'use_dedicated_grid' => false,
        'storage_type' => true
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
        'name' => 'name',
        'deploy_host' => 'deploy_host',
        'deploy_port' => 'deploy_port',
        'ssh_host' => 'ssh_host',
        'hosts' => 'hosts',
        'auto_mounts' => 'auto_mounts',
        'excluded_mounts' => 'excluded_mounts',
        'enforced_mounts' => 'enforced_mounts',
        'auto_crons' => 'auto_crons',
        'auto_nginx' => 'auto_nginx',
        'maintenance_mode' => 'maintenance_mode',
        'guardrails_phase' => 'guardrails_phase',
        'docroots' => 'docroots',
        'site_urls' => 'site_urls',
        'ssh_hosts' => 'ssh_hosts',
        'enterprise_environments_mapping' => 'enterprise_environments_mapping',
        'use_dedicated_grid' => 'use_dedicated_grid',
        'storage_type' => 'storage_type'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'name' => 'setName',
        'deploy_host' => 'setDeployHost',
        'deploy_port' => 'setDeployPort',
        'ssh_host' => 'setSshHost',
        'hosts' => 'setHosts',
        'auto_mounts' => 'setAutoMounts',
        'excluded_mounts' => 'setExcludedMounts',
        'enforced_mounts' => 'setEnforcedMounts',
        'auto_crons' => 'setAutoCrons',
        'auto_nginx' => 'setAutoNginx',
        'maintenance_mode' => 'setMaintenanceMode',
        'guardrails_phase' => 'setGuardrailsPhase',
        'docroots' => 'setDocroots',
        'site_urls' => 'setSiteUrls',
        'ssh_hosts' => 'setSshHosts',
        'enterprise_environments_mapping' => 'setEnterpriseEnvironmentsMapping',
        'use_dedicated_grid' => 'setUseDedicatedGrid',
        'storage_type' => 'setStorageType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'name' => 'getName',
        'deploy_host' => 'getDeployHost',
        'deploy_port' => 'getDeployPort',
        'ssh_host' => 'getSshHost',
        'hosts' => 'getHosts',
        'auto_mounts' => 'getAutoMounts',
        'excluded_mounts' => 'getExcludedMounts',
        'enforced_mounts' => 'getEnforcedMounts',
        'auto_crons' => 'getAutoCrons',
        'auto_nginx' => 'getAutoNginx',
        'maintenance_mode' => 'getMaintenanceMode',
        'guardrails_phase' => 'getGuardrailsPhase',
        'docroots' => 'getDocroots',
        'site_urls' => 'getSiteUrls',
        'ssh_hosts' => 'getSshHosts',
        'enterprise_environments_mapping' => 'getEnterpriseEnvironmentsMapping',
        'use_dedicated_grid' => 'getUseDedicatedGrid',
        'storage_type' => 'getStorageType'
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

    public const TYPE_DEDICATED = 'dedicated';
    public const TYPE_ENTERPRISE = 'enterprise';
    public const TYPE_LOCAL = 'local';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_DEDICATED,
            self::TYPE_ENTERPRISE,
            self::TYPE_LOCAL,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('deploy_host', $data ?? [], null);
        $this->setIfExists('deploy_port', $data ?? [], null);
        $this->setIfExists('ssh_host', $data ?? [], null);
        $this->setIfExists('hosts', $data ?? [], null);
        $this->setIfExists('auto_mounts', $data ?? [], null);
        $this->setIfExists('excluded_mounts', $data ?? [], null);
        $this->setIfExists('enforced_mounts', $data ?? [], null);
        $this->setIfExists('auto_crons', $data ?? [], null);
        $this->setIfExists('auto_nginx', $data ?? [], null);
        $this->setIfExists('maintenance_mode', $data ?? [], null);
        $this->setIfExists('guardrails_phase', $data ?? [], null);
        $this->setIfExists('docroots', $data ?? [], null);
        $this->setIfExists('site_urls', $data ?? [], null);
        $this->setIfExists('ssh_hosts', $data ?? [], null);
        $this->setIfExists('enterprise_environments_mapping', $data ?? [], null);
        $this->setIfExists('use_dedicated_grid', $data ?? [], null);
        $this->setIfExists('storage_type', $data ?? [], null);
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
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['deploy_host'] === null) {
            $invalidProperties[] = "'deploy_host' can't be null";
        }
        if ($this->container['deploy_port'] === null) {
            $invalidProperties[] = "'deploy_port' can't be null";
        }
        if ($this->container['ssh_host'] === null) {
            $invalidProperties[] = "'ssh_host' can't be null";
        }
        if ($this->container['hosts'] === null) {
            $invalidProperties[] = "'hosts' can't be null";
        }
        if ($this->container['auto_mounts'] === null) {
            $invalidProperties[] = "'auto_mounts' can't be null";
        }
        if ($this->container['excluded_mounts'] === null) {
            $invalidProperties[] = "'excluded_mounts' can't be null";
        }
        if ($this->container['enforced_mounts'] === null) {
            $invalidProperties[] = "'enforced_mounts' can't be null";
        }
        if ($this->container['auto_crons'] === null) {
            $invalidProperties[] = "'auto_crons' can't be null";
        }
        if ($this->container['auto_nginx'] === null) {
            $invalidProperties[] = "'auto_nginx' can't be null";
        }
        if ($this->container['maintenance_mode'] === null) {
            $invalidProperties[] = "'maintenance_mode' can't be null";
        }
        if ($this->container['guardrails_phase'] === null) {
            $invalidProperties[] = "'guardrails_phase' can't be null";
        }
        if ($this->container['docroots'] === null) {
            $invalidProperties[] = "'docroots' can't be null";
        }
        if ($this->container['site_urls'] === null) {
            $invalidProperties[] = "'site_urls' can't be null";
        }
        if ($this->container['ssh_hosts'] === null) {
            $invalidProperties[] = "'ssh_hosts' can't be null";
        }
        if ($this->container['use_dedicated_grid'] === null) {
            $invalidProperties[] = "'use_dedicated_grid' can't be null";
        }
        if ($this->container['storage_type'] === null) {
            $invalidProperties[] = "'storage_type' can't be null";
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
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets deploy_host
     *
     * @return string
     */
    public function getDeployHost()
    {
        return $this->container['deploy_host'];
    }

    /**
     * Sets deploy_host
     *
     * @param string $deploy_host deploy_host
     *
     * @return self
     */
    public function setDeployHost($deploy_host)
    {
        if (is_null($deploy_host)) {
            array_push($this->openAPINullablesSetToNull, 'deploy_host');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('deploy_host', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['deploy_host'] = $deploy_host;

        return $this;
    }

    /**
     * Gets deploy_port
     *
     * @return int
     */
    public function getDeployPort()
    {
        return $this->container['deploy_port'];
    }

    /**
     * Sets deploy_port
     *
     * @param int $deploy_port deploy_port
     *
     * @return self
     */
    public function setDeployPort($deploy_port)
    {
        if (is_null($deploy_port)) {
            array_push($this->openAPINullablesSetToNull, 'deploy_port');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('deploy_port', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['deploy_port'] = $deploy_port;

        return $this;
    }

    /**
     * Gets ssh_host
     *
     * @return string
     */
    public function getSshHost()
    {
        return $this->container['ssh_host'];
    }

    /**
     * Sets ssh_host
     *
     * @param string $ssh_host ssh_host
     *
     * @return self
     */
    public function setSshHost($ssh_host)
    {
        if (is_null($ssh_host)) {
            array_push($this->openAPINullablesSetToNull, 'ssh_host');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('ssh_host', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['ssh_host'] = $ssh_host;

        return $this;
    }

    /**
     * Gets hosts
     *
     * @return \OpenAPI\Client\Model\TheHostsOfTheDeploymentTargetInner[]
     */
    public function getHosts()
    {
        return $this->container['hosts'];
    }

    /**
     * Sets hosts
     *
     * @param \OpenAPI\Client\Model\TheHostsOfTheDeploymentTargetInner[] $hosts hosts
     *
     * @return self
     */
    public function setHosts($hosts)
    {
        if (is_null($hosts)) {
            array_push($this->openAPINullablesSetToNull, 'hosts');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('hosts', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['hosts'] = $hosts;

        return $this;
    }

    /**
     * Gets auto_mounts
     *
     * @return bool
     */
    public function getAutoMounts()
    {
        return $this->container['auto_mounts'];
    }

    /**
     * Sets auto_mounts
     *
     * @param bool $auto_mounts auto_mounts
     *
     * @return self
     */
    public function setAutoMounts($auto_mounts)
    {
        if (is_null($auto_mounts)) {
            throw new \InvalidArgumentException('non-nullable auto_mounts cannot be null');
        }
        $this->container['auto_mounts'] = $auto_mounts;

        return $this;
    }

    /**
     * Gets excluded_mounts
     *
     * @return string[]
     */
    public function getExcludedMounts()
    {
        return $this->container['excluded_mounts'];
    }

    /**
     * Sets excluded_mounts
     *
     * @param string[] $excluded_mounts excluded_mounts
     *
     * @return self
     */
    public function setExcludedMounts($excluded_mounts)
    {
        if (is_null($excluded_mounts)) {
            throw new \InvalidArgumentException('non-nullable excluded_mounts cannot be null');
        }
        $this->container['excluded_mounts'] = $excluded_mounts;

        return $this;
    }

    /**
     * Gets enforced_mounts
     *
     * @return object
     */
    public function getEnforcedMounts()
    {
        return $this->container['enforced_mounts'];
    }

    /**
     * Sets enforced_mounts
     *
     * @param object $enforced_mounts enforced_mounts
     *
     * @return self
     */
    public function setEnforcedMounts($enforced_mounts)
    {
        if (is_null($enforced_mounts)) {
            throw new \InvalidArgumentException('non-nullable enforced_mounts cannot be null');
        }
        $this->container['enforced_mounts'] = $enforced_mounts;

        return $this;
    }

    /**
     * Gets auto_crons
     *
     * @return bool
     */
    public function getAutoCrons()
    {
        return $this->container['auto_crons'];
    }

    /**
     * Sets auto_crons
     *
     * @param bool $auto_crons auto_crons
     *
     * @return self
     */
    public function setAutoCrons($auto_crons)
    {
        if (is_null($auto_crons)) {
            throw new \InvalidArgumentException('non-nullable auto_crons cannot be null');
        }
        $this->container['auto_crons'] = $auto_crons;

        return $this;
    }

    /**
     * Gets auto_nginx
     *
     * @return bool
     */
    public function getAutoNginx()
    {
        return $this->container['auto_nginx'];
    }

    /**
     * Sets auto_nginx
     *
     * @param bool $auto_nginx auto_nginx
     *
     * @return self
     */
    public function setAutoNginx($auto_nginx)
    {
        if (is_null($auto_nginx)) {
            throw new \InvalidArgumentException('non-nullable auto_nginx cannot be null');
        }
        $this->container['auto_nginx'] = $auto_nginx;

        return $this;
    }

    /**
     * Gets maintenance_mode
     *
     * @return bool
     */
    public function getMaintenanceMode()
    {
        return $this->container['maintenance_mode'];
    }

    /**
     * Sets maintenance_mode
     *
     * @param bool $maintenance_mode maintenance_mode
     *
     * @return self
     */
    public function setMaintenanceMode($maintenance_mode)
    {
        if (is_null($maintenance_mode)) {
            throw new \InvalidArgumentException('non-nullable maintenance_mode cannot be null');
        }
        $this->container['maintenance_mode'] = $maintenance_mode;

        return $this;
    }

    /**
     * Gets guardrails_phase
     *
     * @return int
     */
    public function getGuardrailsPhase()
    {
        return $this->container['guardrails_phase'];
    }

    /**
     * Sets guardrails_phase
     *
     * @param int $guardrails_phase guardrails_phase
     *
     * @return self
     */
    public function setGuardrailsPhase($guardrails_phase)
    {
        if (is_null($guardrails_phase)) {
            throw new \InvalidArgumentException('non-nullable guardrails_phase cannot be null');
        }
        $this->container['guardrails_phase'] = $guardrails_phase;

        return $this;
    }

    /**
     * Gets docroots
     *
     * @return array<string,\OpenAPI\Client\Model\MappingOfClustersToEnterpriseApplicationsValue>
     */
    public function getDocroots()
    {
        return $this->container['docroots'];
    }

    /**
     * Sets docroots
     *
     * @param array<string,\OpenAPI\Client\Model\MappingOfClustersToEnterpriseApplicationsValue> $docroots docroots
     *
     * @return self
     */
    public function setDocroots($docroots)
    {
        if (is_null($docroots)) {
            throw new \InvalidArgumentException('non-nullable docroots cannot be null');
        }
        $this->container['docroots'] = $docroots;

        return $this;
    }

    /**
     * Gets site_urls
     *
     * @return object
     */
    public function getSiteUrls()
    {
        return $this->container['site_urls'];
    }

    /**
     * Sets site_urls
     *
     * @param object $site_urls site_urls
     *
     * @return self
     */
    public function setSiteUrls($site_urls)
    {
        if (is_null($site_urls)) {
            throw new \InvalidArgumentException('non-nullable site_urls cannot be null');
        }
        $this->container['site_urls'] = $site_urls;

        return $this;
    }

    /**
     * Gets ssh_hosts
     *
     * @return string[]
     */
    public function getSshHosts()
    {
        return $this->container['ssh_hosts'];
    }

    /**
     * Sets ssh_hosts
     *
     * @param string[] $ssh_hosts ssh_hosts
     *
     * @return self
     */
    public function setSshHosts($ssh_hosts)
    {
        if (is_null($ssh_hosts)) {
            throw new \InvalidArgumentException('non-nullable ssh_hosts cannot be null');
        }
        $this->container['ssh_hosts'] = $ssh_hosts;

        return $this;
    }

    /**
     * Gets enterprise_environments_mapping
     *
     * @return object|null
     * @deprecated
     */
    public function getEnterpriseEnvironmentsMapping()
    {
        return $this->container['enterprise_environments_mapping'];
    }

    /**
     * Sets enterprise_environments_mapping
     *
     * @param object|null $enterprise_environments_mapping enterprise_environments_mapping
     *
     * @return self
     * @deprecated
     */
    public function setEnterpriseEnvironmentsMapping($enterprise_environments_mapping)
    {
        if (is_null($enterprise_environments_mapping)) {
            throw new \InvalidArgumentException('non-nullable enterprise_environments_mapping cannot be null');
        }
        $this->container['enterprise_environments_mapping'] = $enterprise_environments_mapping;

        return $this;
    }

    /**
     * Gets use_dedicated_grid
     *
     * @return bool
     */
    public function getUseDedicatedGrid()
    {
        return $this->container['use_dedicated_grid'];
    }

    /**
     * Sets use_dedicated_grid
     *
     * @param bool $use_dedicated_grid use_dedicated_grid
     *
     * @return self
     */
    public function setUseDedicatedGrid($use_dedicated_grid)
    {
        if (is_null($use_dedicated_grid)) {
            throw new \InvalidArgumentException('non-nullable use_dedicated_grid cannot be null');
        }
        $this->container['use_dedicated_grid'] = $use_dedicated_grid;

        return $this;
    }

    /**
     * Gets storage_type
     *
     * @return string
     */
    public function getStorageType()
    {
        return $this->container['storage_type'];
    }

    /**
     * Sets storage_type
     *
     * @param string $storage_type storage_type
     *
     * @return self
     */
    public function setStorageType($storage_type)
    {
        if (is_null($storage_type)) {
            array_push($this->openAPINullablesSetToNull, 'storage_type');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('storage_type', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['storage_type'] = $storage_type;

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


