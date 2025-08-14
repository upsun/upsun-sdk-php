<?php
/**
 * CurrentUserProjectsInner
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
 * CurrentUserProjectsInner Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CurrentUserProjectsInner implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CurrentUser_projects_inner';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'title' => 'string',
        'cluster' => 'string',
        'cluster_label' => 'string',
        'region' => 'string',
        'region_label' => 'string',
        'uri' => 'string',
        'endpoint' => 'string',
        'license_id' => 'int',
        'owner' => 'string',
        'owner_info' => '\OpenAPI\Client\Model\OwnerInfo',
        'plan' => 'string',
        'subscription_id' => 'int',
        'status' => 'string',
        'vendor' => 'string',
        'vendor_label' => 'string',
        'vendor_website' => 'string',
        'vendor_resources' => 'string',
        'created_at' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'title' => null,
        'cluster' => null,
        'cluster_label' => null,
        'region' => null,
        'region_label' => null,
        'uri' => null,
        'endpoint' => null,
        'license_id' => null,
        'owner' => 'uuid',
        'owner_info' => null,
        'plan' => null,
        'subscription_id' => null,
        'status' => null,
        'vendor' => null,
        'vendor_label' => null,
        'vendor_website' => 'url',
        'vendor_resources' => null,
        'created_at' => 'date-time'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'name' => false,
        'title' => false,
        'cluster' => false,
        'cluster_label' => false,
        'region' => false,
        'region_label' => false,
        'uri' => false,
        'endpoint' => false,
        'license_id' => false,
        'owner' => false,
        'owner_info' => false,
        'plan' => false,
        'subscription_id' => false,
        'status' => false,
        'vendor' => false,
        'vendor_label' => false,
        'vendor_website' => false,
        'vendor_resources' => false,
        'created_at' => false
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
        'name' => 'name',
        'title' => 'title',
        'cluster' => 'cluster',
        'cluster_label' => 'cluster_label',
        'region' => 'region',
        'region_label' => 'region_label',
        'uri' => 'uri',
        'endpoint' => 'endpoint',
        'license_id' => 'license_id',
        'owner' => 'owner',
        'owner_info' => 'owner_info',
        'plan' => 'plan',
        'subscription_id' => 'subscription_id',
        'status' => 'status',
        'vendor' => 'vendor',
        'vendor_label' => 'vendor_label',
        'vendor_website' => 'vendor_website',
        'vendor_resources' => 'vendor_resources',
        'created_at' => 'created_at'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'title' => 'setTitle',
        'cluster' => 'setCluster',
        'cluster_label' => 'setClusterLabel',
        'region' => 'setRegion',
        'region_label' => 'setRegionLabel',
        'uri' => 'setUri',
        'endpoint' => 'setEndpoint',
        'license_id' => 'setLicenseId',
        'owner' => 'setOwner',
        'owner_info' => 'setOwnerInfo',
        'plan' => 'setPlan',
        'subscription_id' => 'setSubscriptionId',
        'status' => 'setStatus',
        'vendor' => 'setVendor',
        'vendor_label' => 'setVendorLabel',
        'vendor_website' => 'setVendorWebsite',
        'vendor_resources' => 'setVendorResources',
        'created_at' => 'setCreatedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'title' => 'getTitle',
        'cluster' => 'getCluster',
        'cluster_label' => 'getClusterLabel',
        'region' => 'getRegion',
        'region_label' => 'getRegionLabel',
        'uri' => 'getUri',
        'endpoint' => 'getEndpoint',
        'license_id' => 'getLicenseId',
        'owner' => 'getOwner',
        'owner_info' => 'getOwnerInfo',
        'plan' => 'getPlan',
        'subscription_id' => 'getSubscriptionId',
        'status' => 'getStatus',
        'vendor' => 'getVendor',
        'vendor_label' => 'getVendorLabel',
        'vendor_website' => 'getVendorWebsite',
        'vendor_resources' => 'getVendorResources',
        'created_at' => 'getCreatedAt'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('cluster', $data ?? [], null);
        $this->setIfExists('cluster_label', $data ?? [], null);
        $this->setIfExists('region', $data ?? [], null);
        $this->setIfExists('region_label', $data ?? [], null);
        $this->setIfExists('uri', $data ?? [], null);
        $this->setIfExists('endpoint', $data ?? [], null);
        $this->setIfExists('license_id', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('owner_info', $data ?? [], null);
        $this->setIfExists('plan', $data ?? [], null);
        $this->setIfExists('subscription_id', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('vendor', $data ?? [], null);
        $this->setIfExists('vendor_label', $data ?? [], null);
        $this->setIfExists('vendor_website', $data ?? [], null);
        $this->setIfExists('vendor_resources', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
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
     * @param string|null $id The unique ID string of the project.
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
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name The name given to the project. Appears as the title in the user interface.
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
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The name given to the project. Appears as the title in the user interface.
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets cluster
     *
     * @return string|null
     */
    public function getCluster()
    {
        return $this->container['cluster'];
    }

    /**
     * Sets cluster
     *
     * @param string|null $cluster The machine name of the region where the project is located. Cannot be changed after project creation.
     *
     * @return self
     */
    public function setCluster($cluster)
    {
        if (is_null($cluster)) {
            throw new \InvalidArgumentException('non-nullable cluster cannot be null');
        }
        $this->container['cluster'] = $cluster;

        return $this;
    }

    /**
     * Gets cluster_label
     *
     * @return string|null
     */
    public function getClusterLabel()
    {
        return $this->container['cluster_label'];
    }

    /**
     * Sets cluster_label
     *
     * @param string|null $cluster_label The human-readable name of the region where the project is located.
     *
     * @return self
     */
    public function setClusterLabel($cluster_label)
    {
        if (is_null($cluster_label)) {
            throw new \InvalidArgumentException('non-nullable cluster_label cannot be null');
        }
        $this->container['cluster_label'] = $cluster_label;

        return $this;
    }

    /**
     * Gets region
     *
     * @return string|null
     */
    public function getRegion()
    {
        return $this->container['region'];
    }

    /**
     * Sets region
     *
     * @param string|null $region The machine name of the region where the project is located. Cannot be changed after project creation.
     *
     * @return self
     */
    public function setRegion($region)
    {
        if (is_null($region)) {
            throw new \InvalidArgumentException('non-nullable region cannot be null');
        }
        $this->container['region'] = $region;

        return $this;
    }

    /**
     * Gets region_label
     *
     * @return string|null
     */
    public function getRegionLabel()
    {
        return $this->container['region_label'];
    }

    /**
     * Sets region_label
     *
     * @param string|null $region_label The human-readable name of the region where the project is located.
     *
     * @return self
     */
    public function setRegionLabel($region_label)
    {
        if (is_null($region_label)) {
            throw new \InvalidArgumentException('non-nullable region_label cannot be null');
        }
        $this->container['region_label'] = $region_label;

        return $this;
    }

    /**
     * Gets uri
     *
     * @return string|null
     */
    public function getUri()
    {
        return $this->container['uri'];
    }

    /**
     * Sets uri
     *
     * @param string|null $uri The URL for the project's user interface.
     *
     * @return self
     */
    public function setUri($uri)
    {
        if (is_null($uri)) {
            throw new \InvalidArgumentException('non-nullable uri cannot be null');
        }
        $this->container['uri'] = $uri;

        return $this;
    }

    /**
     * Gets endpoint
     *
     * @return string|null
     */
    public function getEndpoint()
    {
        return $this->container['endpoint'];
    }

    /**
     * Sets endpoint
     *
     * @param string|null $endpoint The project API endpoint for the project.
     *
     * @return self
     */
    public function setEndpoint($endpoint)
    {
        if (is_null($endpoint)) {
            throw new \InvalidArgumentException('non-nullable endpoint cannot be null');
        }
        $this->container['endpoint'] = $endpoint;

        return $this;
    }

    /**
     * Gets license_id
     *
     * @return int|null
     */
    public function getLicenseId()
    {
        return $this->container['license_id'];
    }

    /**
     * Sets license_id
     *
     * @param int|null $license_id The ID of the subscription.
     *
     * @return self
     */
    public function setLicenseId($license_id)
    {
        if (is_null($license_id)) {
            throw new \InvalidArgumentException('non-nullable license_id cannot be null');
        }
        $this->container['license_id'] = $license_id;

        return $this;
    }

    /**
     * Gets owner
     *
     * @return string|null
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     *
     * @param string|null $owner The UUID of the owner.
     *
     * @return self
     */
    public function setOwner($owner)
    {
        if (is_null($owner)) {
            throw new \InvalidArgumentException('non-nullable owner cannot be null');
        }
        $this->container['owner'] = $owner;

        return $this;
    }

    /**
     * Gets owner_info
     *
     * @return \OpenAPI\Client\Model\OwnerInfo|null
     */
    public function getOwnerInfo()
    {
        return $this->container['owner_info'];
    }

    /**
     * Sets owner_info
     *
     * @param \OpenAPI\Client\Model\OwnerInfo|null $owner_info owner_info
     *
     * @return self
     */
    public function setOwnerInfo($owner_info)
    {
        if (is_null($owner_info)) {
            throw new \InvalidArgumentException('non-nullable owner_info cannot be null');
        }
        $this->container['owner_info'] = $owner_info;

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
     * @param string|null $plan The plan type of the subscription.
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
     * Gets subscription_id
     *
     * @return int|null
     */
    public function getSubscriptionId()
    {
        return $this->container['subscription_id'];
    }

    /**
     * Sets subscription_id
     *
     * @param int|null $subscription_id The ID of the subscription.
     *
     * @return self
     */
    public function setSubscriptionId($subscription_id)
    {
        if (is_null($subscription_id)) {
            throw new \InvalidArgumentException('non-nullable subscription_id cannot be null');
        }
        $this->container['subscription_id'] = $subscription_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The status of the project.
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
     * Gets vendor
     *
     * @return string|null
     */
    public function getVendor()
    {
        return $this->container['vendor'];
    }

    /**
     * Sets vendor
     *
     * @param string|null $vendor The machine name of the vendor the subscription belongs to.
     *
     * @return self
     */
    public function setVendor($vendor)
    {
        if (is_null($vendor)) {
            throw new \InvalidArgumentException('non-nullable vendor cannot be null');
        }
        $this->container['vendor'] = $vendor;

        return $this;
    }

    /**
     * Gets vendor_label
     *
     * @return string|null
     */
    public function getVendorLabel()
    {
        return $this->container['vendor_label'];
    }

    /**
     * Sets vendor_label
     *
     * @param string|null $vendor_label The machine name of the vendor the subscription belongs to.
     *
     * @return self
     */
    public function setVendorLabel($vendor_label)
    {
        if (is_null($vendor_label)) {
            throw new \InvalidArgumentException('non-nullable vendor_label cannot be null');
        }
        $this->container['vendor_label'] = $vendor_label;

        return $this;
    }

    /**
     * Gets vendor_website
     *
     * @return string|null
     */
    public function getVendorWebsite()
    {
        return $this->container['vendor_website'];
    }

    /**
     * Sets vendor_website
     *
     * @param string|null $vendor_website The URL of the vendor the subscription belongs to.
     *
     * @return self
     */
    public function setVendorWebsite($vendor_website)
    {
        if (is_null($vendor_website)) {
            throw new \InvalidArgumentException('non-nullable vendor_website cannot be null');
        }
        $this->container['vendor_website'] = $vendor_website;

        return $this;
    }

    /**
     * Gets vendor_resources
     *
     * @return string|null
     */
    public function getVendorResources()
    {
        return $this->container['vendor_resources'];
    }

    /**
     * Sets vendor_resources
     *
     * @param string|null $vendor_resources The link to the resources of the vendor the subscription belongs to.
     *
     * @return self
     */
    public function setVendorResources($vendor_resources)
    {
        if (is_null($vendor_resources)) {
            throw new \InvalidArgumentException('non-nullable vendor_resources cannot be null');
        }
        $this->container['vendor_resources'] = $vendor_resources;

        return $this;
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
     * @param \DateTime|null $created_at The creation date of the subscription.
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        if (is_null($created_at)) {
            throw new \InvalidArgumentException('non-nullable created_at cannot be null');
        }
        $this->container['created_at'] = $created_at;

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


