<?php
/**
 * Deployment
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
 * Deployment Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Deployment implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Deployment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'created_at' => '\DateTime',
        'updated_at' => '\DateTime',
        'fingerprint' => 'string',
        'cluster_name' => 'string',
        'project_info' => '\Upsun\Model\ProjectInfo',
        'environment_info' => '\Upsun\Model\EnvironmentInfo',
        'deployment_target' => 'string',
        'vpn' => '\Upsun\Model\VPNConfiguration',
        'http_access' => '\Upsun\Model\HttpAccessPermissions',
        'enable_smtp' => 'bool',
        'restrict_robots' => 'bool',
        'variables' => '\Upsun\Model\TheVariablesApplyingToThisEnvironmentInner[]',
        'access' => '\Upsun\Model\AccessControlDefinitionForThisEnviromentInner[]',
        'subscription' => '\Upsun\Model\Subscription1',
        'services' => 'array<string,\Upsun\Model\ServicesValue>',
        'routes' => 'array<string,\Upsun\Model\RoutesValue>',
        'webapps' => 'array<string,\Upsun\Model\WebApplicationsValue>',
        'workers' => 'array<string,\Upsun\Model\WorkersValue>',
        'container_profiles' => 'array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>>'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'created_at' => 'date-time',
        'updated_at' => 'date-time',
        'fingerprint' => null,
        'cluster_name' => null,
        'project_info' => null,
        'environment_info' => null,
        'deployment_target' => null,
        'vpn' => null,
        'http_access' => null,
        'enable_smtp' => null,
        'restrict_robots' => null,
        'variables' => null,
        'access' => null,
        'subscription' => null,
        'services' => null,
        'routes' => null,
        'webapps' => null,
        'workers' => null,
        'container_profiles' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'created_at' => true,
        'updated_at' => true,
        'fingerprint' => false,
        'cluster_name' => false,
        'project_info' => false,
        'environment_info' => false,
        'deployment_target' => false,
        'vpn' => true,
        'http_access' => false,
        'enable_smtp' => false,
        'restrict_robots' => false,
        'variables' => false,
        'access' => false,
        'subscription' => false,
        'services' => false,
        'routes' => false,
        'webapps' => false,
        'workers' => false,
        'container_profiles' => false
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
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fingerprint' => 'fingerprint',
        'cluster_name' => 'cluster_name',
        'project_info' => 'project_info',
        'environment_info' => 'environment_info',
        'deployment_target' => 'deployment_target',
        'vpn' => 'vpn',
        'http_access' => 'http_access',
        'enable_smtp' => 'enable_smtp',
        'restrict_robots' => 'restrict_robots',
        'variables' => 'variables',
        'access' => 'access',
        'subscription' => 'subscription',
        'services' => 'services',
        'routes' => 'routes',
        'webapps' => 'webapps',
        'workers' => 'workers',
        'container_profiles' => 'container_profiles'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'fingerprint' => 'setFingerprint',
        'cluster_name' => 'setClusterName',
        'project_info' => 'setProjectInfo',
        'environment_info' => 'setEnvironmentInfo',
        'deployment_target' => 'setDeploymentTarget',
        'vpn' => 'setVpn',
        'http_access' => 'setHttpAccess',
        'enable_smtp' => 'setEnableSmtp',
        'restrict_robots' => 'setRestrictRobots',
        'variables' => 'setVariables',
        'access' => 'setAccess',
        'subscription' => 'setSubscription',
        'services' => 'setServices',
        'routes' => 'setRoutes',
        'webapps' => 'setWebapps',
        'workers' => 'setWorkers',
        'container_profiles' => 'setContainerProfiles'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'fingerprint' => 'getFingerprint',
        'cluster_name' => 'getClusterName',
        'project_info' => 'getProjectInfo',
        'environment_info' => 'getEnvironmentInfo',
        'deployment_target' => 'getDeploymentTarget',
        'vpn' => 'getVpn',
        'http_access' => 'getHttpAccess',
        'enable_smtp' => 'getEnableSmtp',
        'restrict_robots' => 'getRestrictRobots',
        'variables' => 'getVariables',
        'access' => 'getAccess',
        'subscription' => 'getSubscription',
        'services' => 'getServices',
        'routes' => 'getRoutes',
        'webapps' => 'getWebapps',
        'workers' => 'getWorkers',
        'container_profiles' => 'getContainerProfiles'
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
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('fingerprint', $data ?? [], null);
        $this->setIfExists('cluster_name', $data ?? [], null);
        $this->setIfExists('project_info', $data ?? [], null);
        $this->setIfExists('environment_info', $data ?? [], null);
        $this->setIfExists('deployment_target', $data ?? [], null);
        $this->setIfExists('vpn', $data ?? [], null);
        $this->setIfExists('http_access', $data ?? [], null);
        $this->setIfExists('enable_smtp', $data ?? [], null);
        $this->setIfExists('restrict_robots', $data ?? [], null);
        $this->setIfExists('variables', $data ?? [], null);
        $this->setIfExists('access', $data ?? [], null);
        $this->setIfExists('subscription', $data ?? [], null);
        $this->setIfExists('services', $data ?? [], null);
        $this->setIfExists('routes', $data ?? [], null);
        $this->setIfExists('webapps', $data ?? [], null);
        $this->setIfExists('workers', $data ?? [], null);
        $this->setIfExists('container_profiles', $data ?? [], null);
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

        if ($this->container['cluster_name'] === null) {
            $invalidProperties[] = "'cluster_name' can't be null";
        }
        if ($this->container['project_info'] === null) {
            $invalidProperties[] = "'project_info' can't be null";
        }
        if ($this->container['environment_info'] === null) {
            $invalidProperties[] = "'environment_info' can't be null";
        }
        if ($this->container['deployment_target'] === null) {
            $invalidProperties[] = "'deployment_target' can't be null";
        }
        if ($this->container['vpn'] === null) {
            $invalidProperties[] = "'vpn' can't be null";
        }
        if ($this->container['http_access'] === null) {
            $invalidProperties[] = "'http_access' can't be null";
        }
        if ($this->container['enable_smtp'] === null) {
            $invalidProperties[] = "'enable_smtp' can't be null";
        }
        if ($this->container['restrict_robots'] === null) {
            $invalidProperties[] = "'restrict_robots' can't be null";
        }
        if ($this->container['variables'] === null) {
            $invalidProperties[] = "'variables' can't be null";
        }
        if ($this->container['access'] === null) {
            $invalidProperties[] = "'access' can't be null";
        }
        if ($this->container['subscription'] === null) {
            $invalidProperties[] = "'subscription' can't be null";
        }
        if ($this->container['services'] === null) {
            $invalidProperties[] = "'services' can't be null";
        }
        if ($this->container['routes'] === null) {
            $invalidProperties[] = "'routes' can't be null";
        }
        if ($this->container['webapps'] === null) {
            $invalidProperties[] = "'webapps' can't be null";
        }
        if ($this->container['workers'] === null) {
            $invalidProperties[] = "'workers' can't be null";
        }
        if ($this->container['container_profiles'] === null) {
            $invalidProperties[] = "'container_profiles' can't be null";
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
     * Gets created_at
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime|null $created_at created_at
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        if (is_null($created_at)) {
            array_push($this->openAPINullablesSetToNull, 'created_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('created_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param \DateTime|null $updated_at updated_at
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        if (is_null($updated_at)) {
            array_push($this->openAPINullablesSetToNull, 'updated_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('updated_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets fingerprint
     *
     * @return string|null
     */
    public function getFingerprint()
    {
        return $this->container['fingerprint'];
    }

    /**
     * Sets fingerprint
     *
     * @param string|null $fingerprint fingerprint
     *
     * @return self
     */
    public function setFingerprint($fingerprint)
    {
        if (is_null($fingerprint)) {
            throw new \InvalidArgumentException('non-nullable fingerprint cannot be null');
        }
        $this->container['fingerprint'] = $fingerprint;

        return $this;
    }

    /**
     * Gets cluster_name
     *
     * @return string
     */
    public function getClusterName()
    {
        return $this->container['cluster_name'];
    }

    /**
     * Sets cluster_name
     *
     * @param string $cluster_name cluster_name
     *
     * @return self
     */
    public function setClusterName($cluster_name)
    {
        if (is_null($cluster_name)) {
            throw new \InvalidArgumentException('non-nullable cluster_name cannot be null');
        }
        $this->container['cluster_name'] = $cluster_name;

        return $this;
    }

    /**
     * Gets project_info
     *
     * @return \Upsun\Model\ProjectInfo
     */
    public function getProjectInfo()
    {
        return $this->container['project_info'];
    }

    /**
     * Sets project_info
     *
     * @param \Upsun\Model\ProjectInfo $project_info project_info
     *
     * @return self
     */
    public function setProjectInfo($project_info)
    {
        if (is_null($project_info)) {
            throw new \InvalidArgumentException('non-nullable project_info cannot be null');
        }
        $this->container['project_info'] = $project_info;

        return $this;
    }

    /**
     * Gets environment_info
     *
     * @return \Upsun\Model\EnvironmentInfo
     */
    public function getEnvironmentInfo()
    {
        return $this->container['environment_info'];
    }

    /**
     * Sets environment_info
     *
     * @param \Upsun\Model\EnvironmentInfo $environment_info environment_info
     *
     * @return self
     */
    public function setEnvironmentInfo($environment_info)
    {
        if (is_null($environment_info)) {
            throw new \InvalidArgumentException('non-nullable environment_info cannot be null');
        }
        $this->container['environment_info'] = $environment_info;

        return $this;
    }

    /**
     * Gets deployment_target
     *
     * @return string
     */
    public function getDeploymentTarget()
    {
        return $this->container['deployment_target'];
    }

    /**
     * Sets deployment_target
     *
     * @param string $deployment_target deployment_target
     *
     * @return self
     */
    public function setDeploymentTarget($deployment_target)
    {
        if (is_null($deployment_target)) {
            throw new \InvalidArgumentException('non-nullable deployment_target cannot be null');
        }
        $this->container['deployment_target'] = $deployment_target;

        return $this;
    }

    /**
     * Gets vpn
     *
     * @return \Upsun\Model\VPNConfiguration
     */
    public function getVpn()
    {
        return $this->container['vpn'];
    }

    /**
     * Sets vpn
     *
     * @param \Upsun\Model\VPNConfiguration $vpn vpn
     *
     * @return self
     */
    public function setVpn($vpn)
    {
        if (is_null($vpn)) {
            array_push($this->openAPINullablesSetToNull, 'vpn');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('vpn', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['vpn'] = $vpn;

        return $this;
    }

    /**
     * Gets http_access
     *
     * @return \Upsun\Model\HttpAccessPermissions
     */
    public function getHttpAccess()
    {
        return $this->container['http_access'];
    }

    /**
     * Sets http_access
     *
     * @param \Upsun\Model\HttpAccessPermissions $http_access http_access
     *
     * @return self
     */
    public function setHttpAccess($http_access)
    {
        if (is_null($http_access)) {
            throw new \InvalidArgumentException('non-nullable http_access cannot be null');
        }
        $this->container['http_access'] = $http_access;

        return $this;
    }

    /**
     * Gets enable_smtp
     *
     * @return bool
     */
    public function getEnableSmtp()
    {
        return $this->container['enable_smtp'];
    }

    /**
     * Sets enable_smtp
     *
     * @param bool $enable_smtp enable_smtp
     *
     * @return self
     */
    public function setEnableSmtp($enable_smtp)
    {
        if (is_null($enable_smtp)) {
            throw new \InvalidArgumentException('non-nullable enable_smtp cannot be null');
        }
        $this->container['enable_smtp'] = $enable_smtp;

        return $this;
    }

    /**
     * Gets restrict_robots
     *
     * @return bool
     */
    public function getRestrictRobots()
    {
        return $this->container['restrict_robots'];
    }

    /**
     * Sets restrict_robots
     *
     * @param bool $restrict_robots restrict_robots
     *
     * @return self
     */
    public function setRestrictRobots($restrict_robots)
    {
        if (is_null($restrict_robots)) {
            throw new \InvalidArgumentException('non-nullable restrict_robots cannot be null');
        }
        $this->container['restrict_robots'] = $restrict_robots;

        return $this;
    }

    /**
     * Gets variables
     *
     * @return \Upsun\Model\TheVariablesApplyingToThisEnvironmentInner[]
     */
    public function getVariables()
    {
        return $this->container['variables'];
    }

    /**
     * Sets variables
     *
     * @param \Upsun\Model\TheVariablesApplyingToThisEnvironmentInner[] $variables variables
     *
     * @return self
     */
    public function setVariables($variables)
    {
        if (is_null($variables)) {
            throw new \InvalidArgumentException('non-nullable variables cannot be null');
        }
        $this->container['variables'] = $variables;

        return $this;
    }

    /**
     * Gets access
     *
     * @return \Upsun\Model\AccessControlDefinitionForThisEnviromentInner[]
     */
    public function getAccess()
    {
        return $this->container['access'];
    }

    /**
     * Sets access
     *
     * @param \Upsun\Model\AccessControlDefinitionForThisEnviromentInner[] $access access
     *
     * @return self
     */
    public function setAccess($access)
    {
        if (is_null($access)) {
            throw new \InvalidArgumentException('non-nullable access cannot be null');
        }
        $this->container['access'] = $access;

        return $this;
    }

    /**
     * Gets subscription
     *
     * @return \Upsun\Model\Subscription1
     */
    public function getSubscription()
    {
        return $this->container['subscription'];
    }

    /**
     * Sets subscription
     *
     * @param \Upsun\Model\Subscription1 $subscription subscription
     *
     * @return self
     */
    public function setSubscription($subscription)
    {
        if (is_null($subscription)) {
            throw new \InvalidArgumentException('non-nullable subscription cannot be null');
        }
        $this->container['subscription'] = $subscription;

        return $this;
    }

    /**
     * Gets services
     *
     * @return array<string,\Upsun\Model\ServicesValue>
     */
    public function getServices()
    {
        return $this->container['services'];
    }

    /**
     * Sets services
     *
     * @param array<string,\Upsun\Model\ServicesValue> $services services
     *
     * @return self
     */
    public function setServices($services)
    {
        if (is_null($services)) {
            throw new \InvalidArgumentException('non-nullable services cannot be null');
        }
        $this->container['services'] = $services;

        return $this;
    }

    /**
     * Gets routes
     *
     * @return array<string,\Upsun\Model\RoutesValue>
     */
    public function getRoutes()
    {
        return $this->container['routes'];
    }

    /**
     * Sets routes
     *
     * @param array<string,\Upsun\Model\RoutesValue> $routes routes
     *
     * @return self
     */
    public function setRoutes($routes)
    {
        if (is_null($routes)) {
            throw new \InvalidArgumentException('non-nullable routes cannot be null');
        }
        $this->container['routes'] = $routes;

        return $this;
    }

    /**
     * Gets webapps
     *
     * @return array<string,\Upsun\Model\WebApplicationsValue>
     */
    public function getWebapps()
    {
        return $this->container['webapps'];
    }

    /**
     * Sets webapps
     *
     * @param array<string,\Upsun\Model\WebApplicationsValue> $webapps webapps
     *
     * @return self
     */
    public function setWebapps($webapps)
    {
        if (is_null($webapps)) {
            throw new \InvalidArgumentException('non-nullable webapps cannot be null');
        }
        $this->container['webapps'] = $webapps;

        return $this;
    }

    /**
     * Gets workers
     *
     * @return array<string,\Upsun\Model\WorkersValue>
     */
    public function getWorkers()
    {
        return $this->container['workers'];
    }

    /**
     * Sets workers
     *
     * @param array<string,\Upsun\Model\WorkersValue> $workers workers
     *
     * @return self
     */
    public function setWorkers($workers)
    {
        if (is_null($workers)) {
            throw new \InvalidArgumentException('non-nullable workers cannot be null');
        }
        $this->container['workers'] = $workers;

        return $this;
    }

    /**
     * Gets container_profiles
     *
     * @return array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>>
     */
    public function getContainerProfiles()
    {
        return $this->container['container_profiles'];
    }

    /**
     * Sets container_profiles
     *
     * @param array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>> $container_profiles container_profiles
     *
     * @return self
     */
    public function setContainerProfiles($container_profiles)
    {
        if (is_null($container_profiles)) {
            throw new \InvalidArgumentException('non-nullable container_profiles cannot be null');
        }
        $this->container['container_profiles'] = $container_profiles;

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


