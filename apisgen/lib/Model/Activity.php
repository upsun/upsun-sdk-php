<?php
/**
 * Activity
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
 * Activity Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Activity implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Activity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'created_at' => '\DateTime',
        'updated_at' => '\DateTime',
        'type' => 'string',
        'parameters' => 'object',
        'project' => 'string',
        'integration' => 'string',
        'environments' => 'string[]',
        'state' => 'string',
        'result' => 'string',
        'started_at' => '\DateTime',
        'completed_at' => '\DateTime',
        'completion_percent' => 'int',
        'cancelled_at' => '\DateTime',
        'timings' => 'array<string,float>',
        'log' => 'string',
        'payload' => 'object',
        'description' => 'string',
        'text' => 'string',
        'expires_at' => '\DateTime'
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
        'type' => null,
        'parameters' => null,
        'project' => null,
        'integration' => null,
        'environments' => null,
        'state' => null,
        'result' => null,
        'started_at' => 'date-time',
        'completed_at' => 'date-time',
        'completion_percent' => null,
        'cancelled_at' => 'date-time',
        'timings' => 'float',
        'log' => null,
        'payload' => null,
        'description' => null,
        'text' => null,
        'expires_at' => 'date-time'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'created_at' => true,
        'updated_at' => true,
        'type' => false,
        'parameters' => false,
        'project' => false,
        'integration' => false,
        'environments' => false,
        'state' => false,
        'result' => true,
        'started_at' => true,
        'completed_at' => true,
        'completion_percent' => false,
        'cancelled_at' => true,
        'timings' => false,
        'log' => false,
        'payload' => false,
        'description' => true,
        'text' => true,
        'expires_at' => true
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
        'type' => 'type',
        'parameters' => 'parameters',
        'project' => 'project',
        'integration' => 'integration',
        'environments' => 'environments',
        'state' => 'state',
        'result' => 'result',
        'started_at' => 'started_at',
        'completed_at' => 'completed_at',
        'completion_percent' => 'completion_percent',
        'cancelled_at' => 'cancelled_at',
        'timings' => 'timings',
        'log' => 'log',
        'payload' => 'payload',
        'description' => 'description',
        'text' => 'text',
        'expires_at' => 'expires_at'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'type' => 'setType',
        'parameters' => 'setParameters',
        'project' => 'setProject',
        'integration' => 'setIntegration',
        'environments' => 'setEnvironments',
        'state' => 'setState',
        'result' => 'setResult',
        'started_at' => 'setStartedAt',
        'completed_at' => 'setCompletedAt',
        'completion_percent' => 'setCompletionPercent',
        'cancelled_at' => 'setCancelledAt',
        'timings' => 'setTimings',
        'log' => 'setLog',
        'payload' => 'setPayload',
        'description' => 'setDescription',
        'text' => 'setText',
        'expires_at' => 'setExpiresAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'type' => 'getType',
        'parameters' => 'getParameters',
        'project' => 'getProject',
        'integration' => 'getIntegration',
        'environments' => 'getEnvironments',
        'state' => 'getState',
        'result' => 'getResult',
        'started_at' => 'getStartedAt',
        'completed_at' => 'getCompletedAt',
        'completion_percent' => 'getCompletionPercent',
        'cancelled_at' => 'getCancelledAt',
        'timings' => 'getTimings',
        'log' => 'getLog',
        'payload' => 'getPayload',
        'description' => 'getDescription',
        'text' => 'getText',
        'expires_at' => 'getExpiresAt'
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

    public const STATE_CANCELLED = 'cancelled';
    public const STATE_COMPLETE = 'complete';
    public const STATE_IN_PROGRESS = 'in_progress';
    public const STATE_PENDING = 'pending';
    public const STATE_SCHEDULED = 'scheduled';
    public const RESULT_FAILURE = 'failure';
    public const RESULT_SUCCESS = 'success';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStateAllowableValues()
    {
        return [
            self::STATE_CANCELLED,
            self::STATE_COMPLETE,
            self::STATE_IN_PROGRESS,
            self::STATE_PENDING,
            self::STATE_SCHEDULED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getResultAllowableValues()
    {
        return [
            self::RESULT_FAILURE,
            self::RESULT_SUCCESS,
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
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('parameters', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('integration', $data ?? [], null);
        $this->setIfExists('environments', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], null);
        $this->setIfExists('result', $data ?? [], null);
        $this->setIfExists('started_at', $data ?? [], null);
        $this->setIfExists('completed_at', $data ?? [], null);
        $this->setIfExists('completion_percent', $data ?? [], null);
        $this->setIfExists('cancelled_at', $data ?? [], null);
        $this->setIfExists('timings', $data ?? [], null);
        $this->setIfExists('log', $data ?? [], null);
        $this->setIfExists('payload', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('text', $data ?? [], null);
        $this->setIfExists('expires_at', $data ?? [], null);
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

        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['updated_at'] === null) {
            $invalidProperties[] = "'updated_at' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['parameters'] === null) {
            $invalidProperties[] = "'parameters' can't be null";
        }
        if ($this->container['project'] === null) {
            $invalidProperties[] = "'project' can't be null";
        }
        if ($this->container['state'] === null) {
            $invalidProperties[] = "'state' can't be null";
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($this->container['state']) && !in_array($this->container['state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'state', must be one of '%s'",
                $this->container['state'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['result'] === null) {
            $invalidProperties[] = "'result' can't be null";
        }
        $allowedValues = $this->getResultAllowableValues();
        if (!is_null($this->container['result']) && !in_array($this->container['result'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'result', must be one of '%s'",
                $this->container['result'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['started_at'] === null) {
            $invalidProperties[] = "'started_at' can't be null";
        }
        if ($this->container['completed_at'] === null) {
            $invalidProperties[] = "'completed_at' can't be null";
        }
        if ($this->container['completion_percent'] === null) {
            $invalidProperties[] = "'completion_percent' can't be null";
        }
        if ($this->container['cancelled_at'] === null) {
            $invalidProperties[] = "'cancelled_at' can't be null";
        }
        if ($this->container['timings'] === null) {
            $invalidProperties[] = "'timings' can't be null";
        }
        if ($this->container['log'] === null) {
            $invalidProperties[] = "'log' can't be null";
        }
        if ($this->container['payload'] === null) {
            $invalidProperties[] = "'payload' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['text'] === null) {
            $invalidProperties[] = "'text' can't be null";
        }
        if ($this->container['expires_at'] === null) {
            $invalidProperties[] = "'expires_at' can't be null";
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime $created_at created_at
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
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param \DateTime $updated_at updated_at
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
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets parameters
     *
     * @return object
     */
    public function getParameters()
    {
        return $this->container['parameters'];
    }

    /**
     * Sets parameters
     *
     * @param object $parameters parameters
     *
     * @return self
     */
    public function setParameters($parameters)
    {
        if (is_null($parameters)) {
            throw new \InvalidArgumentException('non-nullable parameters cannot be null');
        }
        $this->container['parameters'] = $parameters;

        return $this;
    }

    /**
     * Gets project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param string $project project
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets integration
     *
     * @return string|null
     */
    public function getIntegration()
    {
        return $this->container['integration'];
    }

    /**
     * Sets integration
     *
     * @param string|null $integration integration
     *
     * @return self
     */
    public function setIntegration($integration)
    {
        if (is_null($integration)) {
            throw new \InvalidArgumentException('non-nullable integration cannot be null');
        }
        $this->container['integration'] = $integration;

        return $this;
    }

    /**
     * Gets environments
     *
     * @return string[]|null
     */
    public function getEnvironments()
    {
        return $this->container['environments'];
    }

    /**
     * Sets environments
     *
     * @param string[]|null $environments environments
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
     * Gets state
     *
     * @return string
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string $state state
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            throw new \InvalidArgumentException('non-nullable state cannot be null');
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!in_array($state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'state', must be one of '%s'",
                    $state,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->container['result'];
    }

    /**
     * Sets result
     *
     * @param string $result result
     *
     * @return self
     */
    public function setResult($result)
    {
        if (is_null($result)) {
            array_push($this->openAPINullablesSetToNull, 'result');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('result', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $allowedValues = $this->getResultAllowableValues();
        if (!is_null($result) && !in_array($result, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'result', must be one of '%s'",
                    $result,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['result'] = $result;

        return $this;
    }

    /**
     * Gets started_at
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->container['started_at'];
    }

    /**
     * Sets started_at
     *
     * @param \DateTime $started_at started_at
     *
     * @return self
     */
    public function setStartedAt($started_at)
    {
        if (is_null($started_at)) {
            array_push($this->openAPINullablesSetToNull, 'started_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('started_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['started_at'] = $started_at;

        return $this;
    }

    /**
     * Gets completed_at
     *
     * @return \DateTime
     */
    public function getCompletedAt()
    {
        return $this->container['completed_at'];
    }

    /**
     * Sets completed_at
     *
     * @param \DateTime $completed_at completed_at
     *
     * @return self
     */
    public function setCompletedAt($completed_at)
    {
        if (is_null($completed_at)) {
            array_push($this->openAPINullablesSetToNull, 'completed_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('completed_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['completed_at'] = $completed_at;

        return $this;
    }

    /**
     * Gets completion_percent
     *
     * @return int
     */
    public function getCompletionPercent()
    {
        return $this->container['completion_percent'];
    }

    /**
     * Sets completion_percent
     *
     * @param int $completion_percent completion_percent
     *
     * @return self
     */
    public function setCompletionPercent($completion_percent)
    {
        if (is_null($completion_percent)) {
            throw new \InvalidArgumentException('non-nullable completion_percent cannot be null');
        }
        $this->container['completion_percent'] = $completion_percent;

        return $this;
    }

    /**
     * Gets cancelled_at
     *
     * @return \DateTime
     */
    public function getCancelledAt()
    {
        return $this->container['cancelled_at'];
    }

    /**
     * Sets cancelled_at
     *
     * @param \DateTime $cancelled_at cancelled_at
     *
     * @return self
     */
    public function setCancelledAt($cancelled_at)
    {
        if (is_null($cancelled_at)) {
            array_push($this->openAPINullablesSetToNull, 'cancelled_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('cancelled_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['cancelled_at'] = $cancelled_at;

        return $this;
    }

    /**
     * Gets timings
     *
     * @return array<string,float>
     */
    public function getTimings()
    {
        return $this->container['timings'];
    }

    /**
     * Sets timings
     *
     * @param array<string,float> $timings timings
     *
     * @return self
     */
    public function setTimings($timings)
    {
        if (is_null($timings)) {
            throw new \InvalidArgumentException('non-nullable timings cannot be null');
        }
        $this->container['timings'] = $timings;

        return $this;
    }

    /**
     * Gets log
     *
     * @return string
     * @deprecated
     */
    public function getLog()
    {
        return $this->container['log'];
    }

    /**
     * Sets log
     *
     * @param string $log log
     *
     * @return self
     * @deprecated
     */
    public function setLog($log)
    {
        if (is_null($log)) {
            throw new \InvalidArgumentException('non-nullable log cannot be null');
        }
        $this->container['log'] = $log;

        return $this;
    }

    /**
     * Gets payload
     *
     * @return object
     */
    public function getPayload()
    {
        return $this->container['payload'];
    }

    /**
     * Sets payload
     *
     * @param object $payload payload
     *
     * @return self
     */
    public function setPayload($payload)
    {
        if (is_null($payload)) {
            throw new \InvalidArgumentException('non-nullable payload cannot be null');
        }
        $this->container['payload'] = $payload;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            array_push($this->openAPINullablesSetToNull, 'description');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('description', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets text
     *
     * @return string
     */
    public function getText()
    {
        return $this->container['text'];
    }

    /**
     * Sets text
     *
     * @param string $text text
     *
     * @return self
     */
    public function setText($text)
    {
        if (is_null($text)) {
            array_push($this->openAPINullablesSetToNull, 'text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['text'] = $text;

        return $this;
    }

    /**
     * Gets expires_at
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->container['expires_at'];
    }

    /**
     * Sets expires_at
     *
     * @param \DateTime $expires_at expires_at
     *
     * @return self
     */
    public function setExpiresAt($expires_at)
    {
        if (is_null($expires_at)) {
            array_push($this->openAPINullablesSetToNull, 'expires_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('expires_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['expires_at'] = $expires_at;

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


