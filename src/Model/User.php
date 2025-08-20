<?php
/**
 * User
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
 * User Class Doc Comment
 *
 * @category Class
 * @description 
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class User implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'User';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'deactivated' => 'bool',
        'namespace' => 'string',
        'username' => 'string',
        'email' => 'string',
        'email_verified' => 'bool',
        'first_name' => 'string',
        'last_name' => 'string',
        'picture' => 'string',
        'company' => 'string',
        'website' => 'string',
        'country' => 'string',
        'created_at' => '\DateTime',
        'updated_at' => '\DateTime',
        'consented_at' => '\DateTime',
        'consent_method' => 'string'
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
        'deactivated' => null,
        'namespace' => null,
        'username' => null,
        'email' => 'email',
        'email_verified' => null,
        'first_name' => null,
        'last_name' => null,
        'picture' => 'uri',
        'company' => null,
        'website' => 'uri',
        'country' => null,
        'created_at' => 'date-time',
        'updated_at' => 'date-time',
        'consented_at' => 'date-time',
        'consent_method' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'deactivated' => false,
        'namespace' => false,
        'username' => false,
        'email' => false,
        'email_verified' => false,
        'first_name' => false,
        'last_name' => false,
        'picture' => false,
        'company' => false,
        'website' => false,
        'country' => false,
        'created_at' => false,
        'updated_at' => false,
        'consented_at' => false,
        'consent_method' => false
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
        'deactivated' => 'deactivated',
        'namespace' => 'namespace',
        'username' => 'username',
        'email' => 'email',
        'email_verified' => 'email_verified',
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'picture' => 'picture',
        'company' => 'company',
        'website' => 'website',
        'country' => 'country',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'consented_at' => 'consented_at',
        'consent_method' => 'consent_method'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'deactivated' => 'setDeactivated',
        'namespace' => 'setNamespace',
        'username' => 'setUsername',
        'email' => 'setEmail',
        'email_verified' => 'setEmailVerified',
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'picture' => 'setPicture',
        'company' => 'setCompany',
        'website' => 'setWebsite',
        'country' => 'setCountry',
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'consented_at' => 'setConsentedAt',
        'consent_method' => 'setConsentMethod'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'deactivated' => 'getDeactivated',
        'namespace' => 'getNamespace',
        'username' => 'getUsername',
        'email' => 'getEmail',
        'email_verified' => 'getEmailVerified',
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'picture' => 'getPicture',
        'company' => 'getCompany',
        'website' => 'getWebsite',
        'country' => 'getCountry',
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'consented_at' => 'getConsentedAt',
        'consent_method' => 'getConsentMethod'
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

    public const CONSENT_METHOD_OPT_IN = 'opt-in';
    public const CONSENT_METHOD_TEXT_REF = 'text-ref';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getConsentMethodAllowableValues()
    {
        return [
            self::CONSENT_METHOD_OPT_IN,
            self::CONSENT_METHOD_TEXT_REF,
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('deactivated', $data ?? [], null);
        $this->setIfExists('namespace', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('email_verified', $data ?? [], null);
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('picture', $data ?? [], null);
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('website', $data ?? [], null);
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('consented_at', $data ?? [], null);
        $this->setIfExists('consent_method', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['deactivated'] === null) {
            $invalidProperties[] = "'deactivated' can't be null";
        }
        if ($this->container['namespace'] === null) {
            $invalidProperties[] = "'namespace' can't be null";
        }
        if ($this->container['username'] === null) {
            $invalidProperties[] = "'username' can't be null";
        }
        if ($this->container['email'] === null) {
            $invalidProperties[] = "'email' can't be null";
        }
        if ($this->container['email_verified'] === null) {
            $invalidProperties[] = "'email_verified' can't be null";
        }
        if ($this->container['first_name'] === null) {
            $invalidProperties[] = "'first_name' can't be null";
        }
        if ($this->container['last_name'] === null) {
            $invalidProperties[] = "'last_name' can't be null";
        }
        if ($this->container['picture'] === null) {
            $invalidProperties[] = "'picture' can't be null";
        }
        if ($this->container['company'] === null) {
            $invalidProperties[] = "'company' can't be null";
        }
        if ($this->container['website'] === null) {
            $invalidProperties[] = "'website' can't be null";
        }
        if ($this->container['country'] === null) {
            $invalidProperties[] = "'country' can't be null";
        }
        if ((mb_strlen($this->container['country']) > 2)) {
            $invalidProperties[] = "invalid value for 'country', the character length must be smaller than or equal to 2.";
        }

        if ((mb_strlen($this->container['country']) < 2)) {
            $invalidProperties[] = "invalid value for 'country', the character length must be bigger than or equal to 2.";
        }

        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['updated_at'] === null) {
            $invalidProperties[] = "'updated_at' can't be null";
        }
        $allowedValues = $this->getConsentMethodAllowableValues();
        if (!is_null($this->container['consent_method']) && !in_array($this->container['consent_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'consent_method', must be one of '%s'",
                $this->container['consent_method'],
                implode("', '", $allowedValues)
            );
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
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id The ID of the user.
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
     * Gets deactivated
     *
     * @return bool
     */
    public function getDeactivated()
    {
        return $this->container['deactivated'];
    }

    /**
     * Sets deactivated
     *
     * @param bool $deactivated Whether the user has been deactivated.
     *
     * @return self
     */
    public function setDeactivated($deactivated)
    {
        if (is_null($deactivated)) {
            throw new \InvalidArgumentException('non-nullable deactivated cannot be null');
        }
        $this->container['deactivated'] = $deactivated;

        return $this;
    }

    /**
     * Gets namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->container['namespace'];
    }

    /**
     * Sets namespace
     *
     * @param string $namespace The namespace in which the user's username is unique.
     *
     * @return self
     */
    public function setNamespace($namespace)
    {
        if (is_null($namespace)) {
            throw new \InvalidArgumentException('non-nullable namespace cannot be null');
        }
        $this->container['namespace'] = $namespace;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string $username The user's username.
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
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email The user's email address.
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets email_verified
     *
     * @return bool
     */
    public function getEmailVerified()
    {
        return $this->container['email_verified'];
    }

    /**
     * Sets email_verified
     *
     * @param bool $email_verified Whether the user's email address has been verified.
     *
     * @return self
     */
    public function setEmailVerified($email_verified)
    {
        if (is_null($email_verified)) {
            throw new \InvalidArgumentException('non-nullable email_verified cannot be null');
        }
        $this->container['email_verified'] = $email_verified;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name The user's first name.
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        if (is_null($first_name)) {
            throw new \InvalidArgumentException('non-nullable first_name cannot be null');
        }
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string $last_name The user's last name.
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        if (is_null($last_name)) {
            throw new \InvalidArgumentException('non-nullable last_name cannot be null');
        }
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->container['picture'];
    }

    /**
     * Sets picture
     *
     * @param string $picture The user's picture.
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
     * Gets company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param string $company The user's company.
     *
     * @return self
     */
    public function setCompany($company)
    {
        if (is_null($company)) {
            throw new \InvalidArgumentException('non-nullable company cannot be null');
        }
        $this->container['company'] = $company;

        return $this;
    }

    /**
     * Gets website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->container['website'];
    }

    /**
     * Sets website
     *
     * @param string $website The user's website.
     *
     * @return self
     */
    public function setWebsite($website)
    {
        if (is_null($website)) {
            throw new \InvalidArgumentException('non-nullable website cannot be null');
        }
        $this->container['website'] = $website;

        return $this;
    }

    /**
     * Gets country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param string $country The user's ISO 3166-1 alpha-2 country code.
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        if ((mb_strlen($country) > 2)) {
            throw new \InvalidArgumentException('invalid length for $country when calling User., must be smaller than or equal to 2.');
        }
        if ((mb_strlen($country) < 2)) {
            throw new \InvalidArgumentException('invalid length for $country when calling User., must be bigger than or equal to 2.');
        }

        $this->container['country'] = $country;

        return $this;
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
     * @param \DateTime $created_at The date and time when the user was created.
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
     * @param \DateTime $updated_at The date and time when the user was last updated.
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        if (is_null($updated_at)) {
            throw new \InvalidArgumentException('non-nullable updated_at cannot be null');
        }
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets consented_at
     *
     * @return \DateTime|null
     */
    public function getConsentedAt()
    {
        return $this->container['consented_at'];
    }

    /**
     * Sets consented_at
     *
     * @param \DateTime|null $consented_at The date and time when the user consented to the Terms of Service.
     *
     * @return self
     */
    public function setConsentedAt($consented_at)
    {
        if (is_null($consented_at)) {
            throw new \InvalidArgumentException('non-nullable consented_at cannot be null');
        }
        $this->container['consented_at'] = $consented_at;

        return $this;
    }

    /**
     * Gets consent_method
     *
     * @return string|null
     */
    public function getConsentMethod()
    {
        return $this->container['consent_method'];
    }

    /**
     * Sets consent_method
     *
     * @param string|null $consent_method The method by which the user consented to the Terms of Service.
     *
     * @return self
     */
    public function setConsentMethod($consent_method)
    {
        if (is_null($consent_method)) {
            throw new \InvalidArgumentException('non-nullable consent_method cannot be null');
        }
        $allowedValues = $this->getConsentMethodAllowableValues();
        if (!in_array($consent_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'consent_method', must be one of '%s'",
                    $consent_method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['consent_method'] = $consent_method;

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


