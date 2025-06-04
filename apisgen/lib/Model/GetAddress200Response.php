<?php
/**
 * GetAddress200Response
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
 * GetAddress200Response Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GetAddress200Response implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'get_address_200_response';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'country' => 'string',
        'name_line' => 'string',
        'premise' => 'string',
        'sub_premise' => 'string',
        'thoroughfare' => 'string',
        'administrative_area' => 'string',
        'sub_administrative_area' => 'string',
        'locality' => 'string',
        'dependent_locality' => 'string',
        'postal_code' => 'string',
        'metadata' => '\OpenAPI\Client\Model\AddressMetadataMetadata'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'country' => 'ISO ALPHA-2',
        'name_line' => null,
        'premise' => null,
        'sub_premise' => null,
        'thoroughfare' => null,
        'administrative_area' => 'ISO ALPHA-2',
        'sub_administrative_area' => null,
        'locality' => null,
        'dependent_locality' => null,
        'postal_code' => null,
        'metadata' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'country' => false,
        'name_line' => false,
        'premise' => false,
        'sub_premise' => false,
        'thoroughfare' => false,
        'administrative_area' => false,
        'sub_administrative_area' => false,
        'locality' => false,
        'dependent_locality' => false,
        'postal_code' => false,
        'metadata' => false
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
        'country' => 'country',
        'name_line' => 'name_line',
        'premise' => 'premise',
        'sub_premise' => 'sub_premise',
        'thoroughfare' => 'thoroughfare',
        'administrative_area' => 'administrative_area',
        'sub_administrative_area' => 'sub_administrative_area',
        'locality' => 'locality',
        'dependent_locality' => 'dependent_locality',
        'postal_code' => 'postal_code',
        'metadata' => 'metadata'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'country' => 'setCountry',
        'name_line' => 'setNameLine',
        'premise' => 'setPremise',
        'sub_premise' => 'setSubPremise',
        'thoroughfare' => 'setThoroughfare',
        'administrative_area' => 'setAdministrativeArea',
        'sub_administrative_area' => 'setSubAdministrativeArea',
        'locality' => 'setLocality',
        'dependent_locality' => 'setDependentLocality',
        'postal_code' => 'setPostalCode',
        'metadata' => 'setMetadata'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'country' => 'getCountry',
        'name_line' => 'getNameLine',
        'premise' => 'getPremise',
        'sub_premise' => 'getSubPremise',
        'thoroughfare' => 'getThoroughfare',
        'administrative_area' => 'getAdministrativeArea',
        'sub_administrative_area' => 'getSubAdministrativeArea',
        'locality' => 'getLocality',
        'dependent_locality' => 'getDependentLocality',
        'postal_code' => 'getPostalCode',
        'metadata' => 'getMetadata'
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
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('name_line', $data ?? [], null);
        $this->setIfExists('premise', $data ?? [], null);
        $this->setIfExists('sub_premise', $data ?? [], null);
        $this->setIfExists('thoroughfare', $data ?? [], null);
        $this->setIfExists('administrative_area', $data ?? [], null);
        $this->setIfExists('sub_administrative_area', $data ?? [], null);
        $this->setIfExists('locality', $data ?? [], null);
        $this->setIfExists('dependent_locality', $data ?? [], null);
        $this->setIfExists('postal_code', $data ?? [], null);
        $this->setIfExists('metadata', $data ?? [], null);
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
     * Gets country
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param string|null $country Two-letter country codes are used to represent countries and states
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets name_line
     *
     * @return string|null
     */
    public function getNameLine()
    {
        return $this->container['name_line'];
    }

    /**
     * Sets name_line
     *
     * @param string|null $name_line The full name of the user
     *
     * @return self
     */
    public function setNameLine($name_line)
    {
        if (is_null($name_line)) {
            throw new \InvalidArgumentException('non-nullable name_line cannot be null');
        }
        $this->container['name_line'] = $name_line;

        return $this;
    }

    /**
     * Gets premise
     *
     * @return string|null
     */
    public function getPremise()
    {
        return $this->container['premise'];
    }

    /**
     * Sets premise
     *
     * @param string|null $premise Premise (i.e. Apt, Suite, Bldg.)
     *
     * @return self
     */
    public function setPremise($premise)
    {
        if (is_null($premise)) {
            throw new \InvalidArgumentException('non-nullable premise cannot be null');
        }
        $this->container['premise'] = $premise;

        return $this;
    }

    /**
     * Gets sub_premise
     *
     * @return string|null
     */
    public function getSubPremise()
    {
        return $this->container['sub_premise'];
    }

    /**
     * Sets sub_premise
     *
     * @param string|null $sub_premise Sub Premise (i.e. Suite, Apartment, Floor, Unknown.
     *
     * @return self
     */
    public function setSubPremise($sub_premise)
    {
        if (is_null($sub_premise)) {
            throw new \InvalidArgumentException('non-nullable sub_premise cannot be null');
        }
        $this->container['sub_premise'] = $sub_premise;

        return $this;
    }

    /**
     * Gets thoroughfare
     *
     * @return string|null
     */
    public function getThoroughfare()
    {
        return $this->container['thoroughfare'];
    }

    /**
     * Sets thoroughfare
     *
     * @param string|null $thoroughfare The address of the user
     *
     * @return self
     */
    public function setThoroughfare($thoroughfare)
    {
        if (is_null($thoroughfare)) {
            throw new \InvalidArgumentException('non-nullable thoroughfare cannot be null');
        }
        $this->container['thoroughfare'] = $thoroughfare;

        return $this;
    }

    /**
     * Gets administrative_area
     *
     * @return string|null
     */
    public function getAdministrativeArea()
    {
        return $this->container['administrative_area'];
    }

    /**
     * Sets administrative_area
     *
     * @param string|null $administrative_area The administrative area of the user address
     *
     * @return self
     */
    public function setAdministrativeArea($administrative_area)
    {
        if (is_null($administrative_area)) {
            throw new \InvalidArgumentException('non-nullable administrative_area cannot be null');
        }
        $this->container['administrative_area'] = $administrative_area;

        return $this;
    }

    /**
     * Gets sub_administrative_area
     *
     * @return string|null
     */
    public function getSubAdministrativeArea()
    {
        return $this->container['sub_administrative_area'];
    }

    /**
     * Sets sub_administrative_area
     *
     * @param string|null $sub_administrative_area The sub-administrative area of the user address
     *
     * @return self
     */
    public function setSubAdministrativeArea($sub_administrative_area)
    {
        if (is_null($sub_administrative_area)) {
            throw new \InvalidArgumentException('non-nullable sub_administrative_area cannot be null');
        }
        $this->container['sub_administrative_area'] = $sub_administrative_area;

        return $this;
    }

    /**
     * Gets locality
     *
     * @return string|null
     */
    public function getLocality()
    {
        return $this->container['locality'];
    }

    /**
     * Sets locality
     *
     * @param string|null $locality The locality of the user address
     *
     * @return self
     */
    public function setLocality($locality)
    {
        if (is_null($locality)) {
            throw new \InvalidArgumentException('non-nullable locality cannot be null');
        }
        $this->container['locality'] = $locality;

        return $this;
    }

    /**
     * Gets dependent_locality
     *
     * @return string|null
     */
    public function getDependentLocality()
    {
        return $this->container['dependent_locality'];
    }

    /**
     * Sets dependent_locality
     *
     * @param string|null $dependent_locality The dependant_locality area of the user address
     *
     * @return self
     */
    public function setDependentLocality($dependent_locality)
    {
        if (is_null($dependent_locality)) {
            throw new \InvalidArgumentException('non-nullable dependent_locality cannot be null');
        }
        $this->container['dependent_locality'] = $dependent_locality;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string|null $postal_code The postal code area of the user address
     *
     * @return self
     */
    public function setPostalCode($postal_code)
    {
        if (is_null($postal_code)) {
            throw new \InvalidArgumentException('non-nullable postal_code cannot be null');
        }
        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets metadata
     *
     * @return \OpenAPI\Client\Model\AddressMetadataMetadata|null
     */
    public function getMetadata()
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata
     *
     * @param \OpenAPI\Client\Model\AddressMetadataMetadata|null $metadata metadata
     *
     * @return self
     */
    public function setMetadata($metadata)
    {
        if (is_null($metadata)) {
            throw new \InvalidArgumentException('non-nullable metadata cannot be null');
        }
        $this->container['metadata'] = $metadata;

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


