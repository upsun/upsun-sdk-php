<?php
/**
 * Order
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
 * Order Class Doc Comment
 *
 * @category Class
 * @description The order object.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Order implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Order';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'status' => 'string',
        'owner' => 'string',
        'address' => '\OpenAPI\Client\Model\Address',
        'company' => 'string',
        'vat_number' => 'string',
        'billing_period_start' => '\DateTime',
        'billing_period_end' => '\DateTime',
        'billing_period_label' => '\OpenAPI\Client\Model\OrderBillingPeriodLabel',
        'billing_period_duration' => 'int',
        'paid_on' => '\DateTime',
        'total' => 'int',
        'total_formatted' => 'int',
        'components' => '\OpenAPI\Client\Model\Components',
        'currency' => 'string',
        'invoice_url' => 'string',
        'last_refreshed' => '\DateTime',
        'invoiced' => 'bool',
        'line_items' => '\OpenAPI\Client\Model\LineItem[]',
        '_links' => '\OpenAPI\Client\Model\OrderLinks'
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
        'status' => null,
        'owner' => 'uuid',
        'address' => null,
        'company' => null,
        'vat_number' => null,
        'billing_period_start' => 'date-time',
        'billing_period_end' => 'date-time',
        'billing_period_label' => null,
        'billing_period_duration' => null,
        'paid_on' => 'date-time',
        'total' => null,
        'total_formatted' => null,
        'components' => null,
        'currency' => null,
        'invoice_url' => null,
        'last_refreshed' => 'date-time',
        'invoiced' => null,
        'line_items' => null,
        '_links' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'status' => false,
        'owner' => false,
        'address' => false,
        'company' => false,
        'vat_number' => false,
        'billing_period_start' => false,
        'billing_period_end' => false,
        'billing_period_label' => false,
        'billing_period_duration' => false,
        'paid_on' => true,
        'total' => false,
        'total_formatted' => false,
        'components' => false,
        'currency' => false,
        'invoice_url' => false,
        'last_refreshed' => false,
        'invoiced' => false,
        'line_items' => false,
        '_links' => false
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
        'status' => 'status',
        'owner' => 'owner',
        'address' => 'address',
        'company' => 'company',
        'vat_number' => 'vat_number',
        'billing_period_start' => 'billing_period_start',
        'billing_period_end' => 'billing_period_end',
        'billing_period_label' => 'billing_period_label',
        'billing_period_duration' => 'billing_period_duration',
        'paid_on' => 'paid_on',
        'total' => 'total',
        'total_formatted' => 'total_formatted',
        'components' => 'components',
        'currency' => 'currency',
        'invoice_url' => 'invoice_url',
        'last_refreshed' => 'last_refreshed',
        'invoiced' => 'invoiced',
        'line_items' => 'line_items',
        '_links' => '_links'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'status' => 'setStatus',
        'owner' => 'setOwner',
        'address' => 'setAddress',
        'company' => 'setCompany',
        'vat_number' => 'setVatNumber',
        'billing_period_start' => 'setBillingPeriodStart',
        'billing_period_end' => 'setBillingPeriodEnd',
        'billing_period_label' => 'setBillingPeriodLabel',
        'billing_period_duration' => 'setBillingPeriodDuration',
        'paid_on' => 'setPaidOn',
        'total' => 'setTotal',
        'total_formatted' => 'setTotalFormatted',
        'components' => 'setComponents',
        'currency' => 'setCurrency',
        'invoice_url' => 'setInvoiceUrl',
        'last_refreshed' => 'setLastRefreshed',
        'invoiced' => 'setInvoiced',
        'line_items' => 'setLineItems',
        '_links' => 'setLinks'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'status' => 'getStatus',
        'owner' => 'getOwner',
        'address' => 'getAddress',
        'company' => 'getCompany',
        'vat_number' => 'getVatNumber',
        'billing_period_start' => 'getBillingPeriodStart',
        'billing_period_end' => 'getBillingPeriodEnd',
        'billing_period_label' => 'getBillingPeriodLabel',
        'billing_period_duration' => 'getBillingPeriodDuration',
        'paid_on' => 'getPaidOn',
        'total' => 'getTotal',
        'total_formatted' => 'getTotalFormatted',
        'components' => 'getComponents',
        'currency' => 'getCurrency',
        'invoice_url' => 'getInvoiceUrl',
        'last_refreshed' => 'getLastRefreshed',
        'invoiced' => 'getInvoiced',
        'line_items' => 'getLineItems',
        '_links' => 'getLinks'
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

    public const STATUS_COMPLETED = 'completed';
    public const STATUS_PAST_DUE = 'past_due';
    public const STATUS_PENDING = 'pending';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_PAYMENT_FAILED_SOFT_DECLINE = 'payment_failed_soft_decline';
    public const STATUS_PAYMENT_FAILED_HARD_DECLINE = 'payment_failed_hard_decline';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_COMPLETED,
            self::STATUS_PAST_DUE,
            self::STATUS_PENDING,
            self::STATUS_CANCELED,
            self::STATUS_PAYMENT_FAILED_SOFT_DECLINE,
            self::STATUS_PAYMENT_FAILED_HARD_DECLINE,
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
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('vat_number', $data ?? [], null);
        $this->setIfExists('billing_period_start', $data ?? [], null);
        $this->setIfExists('billing_period_end', $data ?? [], null);
        $this->setIfExists('billing_period_label', $data ?? [], null);
        $this->setIfExists('billing_period_duration', $data ?? [], null);
        $this->setIfExists('paid_on', $data ?? [], null);
        $this->setIfExists('total', $data ?? [], null);
        $this->setIfExists('total_formatted', $data ?? [], null);
        $this->setIfExists('components', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('invoice_url', $data ?? [], null);
        $this->setIfExists('last_refreshed', $data ?? [], null);
        $this->setIfExists('invoiced', $data ?? [], null);
        $this->setIfExists('line_items', $data ?? [], null);
        $this->setIfExists('_links', $data ?? [], null);
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

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
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
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id The ID of the order.
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
     * @param string|null $status The status of the subscription.
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

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
     * Gets address
     *
     * @return \OpenAPI\Client\Model\Address|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \OpenAPI\Client\Model\Address|null $address address
     *
     * @return self
     */
    public function setAddress($address)
    {
        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets company
     *
     * @return string|null
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param string|null $company The company name.
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
     * @param string|null $vat_number An identifier used in many countries for value added tax purposes.
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
     * Gets billing_period_start
     *
     * @return \DateTime|null
     */
    public function getBillingPeriodStart()
    {
        return $this->container['billing_period_start'];
    }

    /**
     * Sets billing_period_start
     *
     * @param \DateTime|null $billing_period_start The time when the billing period of the order started.
     *
     * @return self
     */
    public function setBillingPeriodStart($billing_period_start)
    {
        if (is_null($billing_period_start)) {
            throw new \InvalidArgumentException('non-nullable billing_period_start cannot be null');
        }
        $this->container['billing_period_start'] = $billing_period_start;

        return $this;
    }

    /**
     * Gets billing_period_end
     *
     * @return \DateTime|null
     */
    public function getBillingPeriodEnd()
    {
        return $this->container['billing_period_end'];
    }

    /**
     * Sets billing_period_end
     *
     * @param \DateTime|null $billing_period_end The time when the billing period of the order ended.
     *
     * @return self
     */
    public function setBillingPeriodEnd($billing_period_end)
    {
        if (is_null($billing_period_end)) {
            throw new \InvalidArgumentException('non-nullable billing_period_end cannot be null');
        }
        $this->container['billing_period_end'] = $billing_period_end;

        return $this;
    }

    /**
     * Gets billing_period_label
     *
     * @return \OpenAPI\Client\Model\OrderBillingPeriodLabel|null
     */
    public function getBillingPeriodLabel()
    {
        return $this->container['billing_period_label'];
    }

    /**
     * Sets billing_period_label
     *
     * @param \OpenAPI\Client\Model\OrderBillingPeriodLabel|null $billing_period_label billing_period_label
     *
     * @return self
     */
    public function setBillingPeriodLabel($billing_period_label)
    {
        if (is_null($billing_period_label)) {
            throw new \InvalidArgumentException('non-nullable billing_period_label cannot be null');
        }
        $this->container['billing_period_label'] = $billing_period_label;

        return $this;
    }

    /**
     * Gets billing_period_duration
     *
     * @return int|null
     */
    public function getBillingPeriodDuration()
    {
        return $this->container['billing_period_duration'];
    }

    /**
     * Sets billing_period_duration
     *
     * @param int|null $billing_period_duration The duration of the billing period of the order in seconds.
     *
     * @return self
     */
    public function setBillingPeriodDuration($billing_period_duration)
    {
        if (is_null($billing_period_duration)) {
            throw new \InvalidArgumentException('non-nullable billing_period_duration cannot be null');
        }
        $this->container['billing_period_duration'] = $billing_period_duration;

        return $this;
    }

    /**
     * Gets paid_on
     *
     * @return \DateTime|null
     */
    public function getPaidOn()
    {
        return $this->container['paid_on'];
    }

    /**
     * Sets paid_on
     *
     * @param \DateTime|null $paid_on The time when the order was successfully charged.
     *
     * @return self
     */
    public function setPaidOn($paid_on)
    {
        if (is_null($paid_on)) {
            array_push($this->openAPINullablesSetToNull, 'paid_on');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('paid_on', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['paid_on'] = $paid_on;

        return $this;
    }

    /**
     * Gets total
     *
     * @return int|null
     */
    public function getTotal()
    {
        return $this->container['total'];
    }

    /**
     * Sets total
     *
     * @param int|null $total The total of the order.
     *
     * @return self
     */
    public function setTotal($total)
    {
        if (is_null($total)) {
            throw new \InvalidArgumentException('non-nullable total cannot be null');
        }
        $this->container['total'] = $total;

        return $this;
    }

    /**
     * Gets total_formatted
     *
     * @return int|null
     */
    public function getTotalFormatted()
    {
        return $this->container['total_formatted'];
    }

    /**
     * Sets total_formatted
     *
     * @param int|null $total_formatted The total of the order, formatted with currency.
     *
     * @return self
     */
    public function setTotalFormatted($total_formatted)
    {
        if (is_null($total_formatted)) {
            throw new \InvalidArgumentException('non-nullable total_formatted cannot be null');
        }
        $this->container['total_formatted'] = $total_formatted;

        return $this;
    }

    /**
     * Gets components
     *
     * @return \OpenAPI\Client\Model\Components|null
     */
    public function getComponents()
    {
        return $this->container['components'];
    }

    /**
     * Sets components
     *
     * @param \OpenAPI\Client\Model\Components|null $components components
     *
     * @return self
     */
    public function setComponents($components)
    {
        if (is_null($components)) {
            throw new \InvalidArgumentException('non-nullable components cannot be null');
        }
        $this->container['components'] = $components;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency The order currency code.
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets invoice_url
     *
     * @return string|null
     */
    public function getInvoiceUrl()
    {
        return $this->container['invoice_url'];
    }

    /**
     * Sets invoice_url
     *
     * @param string|null $invoice_url A link to the PDF invoice.
     *
     * @return self
     */
    public function setInvoiceUrl($invoice_url)
    {
        if (is_null($invoice_url)) {
            throw new \InvalidArgumentException('non-nullable invoice_url cannot be null');
        }
        $this->container['invoice_url'] = $invoice_url;

        return $this;
    }

    /**
     * Gets last_refreshed
     *
     * @return \DateTime|null
     */
    public function getLastRefreshed()
    {
        return $this->container['last_refreshed'];
    }

    /**
     * Sets last_refreshed
     *
     * @param \DateTime|null $last_refreshed The time when the order was last refreshed.
     *
     * @return self
     */
    public function setLastRefreshed($last_refreshed)
    {
        if (is_null($last_refreshed)) {
            throw new \InvalidArgumentException('non-nullable last_refreshed cannot be null');
        }
        $this->container['last_refreshed'] = $last_refreshed;

        return $this;
    }

    /**
     * Gets invoiced
     *
     * @return bool|null
     */
    public function getInvoiced()
    {
        return $this->container['invoiced'];
    }

    /**
     * Sets invoiced
     *
     * @param bool|null $invoiced The customer is invoiced.
     *
     * @return self
     */
    public function setInvoiced($invoiced)
    {
        if (is_null($invoiced)) {
            throw new \InvalidArgumentException('non-nullable invoiced cannot be null');
        }
        $this->container['invoiced'] = $invoiced;

        return $this;
    }

    /**
     * Gets line_items
     *
     * @return \OpenAPI\Client\Model\LineItem[]|null
     */
    public function getLineItems()
    {
        return $this->container['line_items'];
    }

    /**
     * Sets line_items
     *
     * @param \OpenAPI\Client\Model\LineItem[]|null $line_items The line items that comprise the order.
     *
     * @return self
     */
    public function setLineItems($line_items)
    {
        if (is_null($line_items)) {
            throw new \InvalidArgumentException('non-nullable line_items cannot be null');
        }
        $this->container['line_items'] = $line_items;

        return $this;
    }

    /**
     * Gets _links
     *
     * @return \OpenAPI\Client\Model\OrderLinks|null
     */
    public function getLinks()
    {
        return $this->container['_links'];
    }

    /**
     * Sets _links
     *
     * @param \OpenAPI\Client\Model\OrderLinks|null $_links _links
     *
     * @return self
     */
    public function setLinks($_links)
    {
        if (is_null($_links)) {
            throw new \InvalidArgumentException('non-nullable _links cannot be null');
        }
        $this->container['_links'] = $_links;

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


