<?php
/**
 * OrganizationLinks
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
 * OrganizationLinks Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OrganizationLinks implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Organization__links';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'self' => '\Upsun\Model\OrganizationLinksSelf',
        'update' => '\Upsun\Model\OrganizationLinksUpdate',
        'delete' => '\Upsun\Model\OrganizationLinksDelete',
        'members' => '\Upsun\Model\OrganizationLinksMembers',
        'create_member' => '\Upsun\Model\OrganizationLinksCreateMember',
        'address' => '\Upsun\Model\OrganizationLinksAddress',
        'profile' => '\Upsun\Model\OrganizationLinksProfile',
        'payment_source' => '\Upsun\Model\OrganizationLinksPaymentSource',
        'orders' => '\Upsun\Model\OrganizationLinksOrders',
        'vouchers' => '\Upsun\Model\OrganizationLinksVouchers',
        'apply_voucher' => '\Upsun\Model\OrganizationLinksApplyVoucher',
        'subscriptions' => '\Upsun\Model\OrganizationLinksSubscriptions',
        'create_subscription' => '\Upsun\Model\OrganizationLinksCreateSubscription',
        'estimate_subscription' => '\Upsun\Model\OrganizationLinksEstimateSubscription',
        'mfa_enforcement' => '\Upsun\Model\OrganizationLinksMfaEnforcement'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'self' => null,
        'update' => null,
        'delete' => null,
        'members' => null,
        'create_member' => null,
        'address' => null,
        'profile' => null,
        'payment_source' => null,
        'orders' => null,
        'vouchers' => null,
        'apply_voucher' => null,
        'subscriptions' => null,
        'create_subscription' => null,
        'estimate_subscription' => null,
        'mfa_enforcement' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'self' => false,
        'update' => false,
        'delete' => false,
        'members' => false,
        'create_member' => false,
        'address' => false,
        'profile' => false,
        'payment_source' => false,
        'orders' => false,
        'vouchers' => false,
        'apply_voucher' => false,
        'subscriptions' => false,
        'create_subscription' => false,
        'estimate_subscription' => false,
        'mfa_enforcement' => false
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
        'self' => 'self',
        'update' => 'update',
        'delete' => 'delete',
        'members' => 'members',
        'create_member' => 'create-member',
        'address' => 'address',
        'profile' => 'profile',
        'payment_source' => 'payment-source',
        'orders' => 'orders',
        'vouchers' => 'vouchers',
        'apply_voucher' => 'apply-voucher',
        'subscriptions' => 'subscriptions',
        'create_subscription' => 'create-subscription',
        'estimate_subscription' => 'estimate-subscription',
        'mfa_enforcement' => 'mfa-enforcement'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'self' => 'setSelf',
        'update' => 'setUpdate',
        'delete' => 'setDelete',
        'members' => 'setMembers',
        'create_member' => 'setCreateMember',
        'address' => 'setAddress',
        'profile' => 'setProfile',
        'payment_source' => 'setPaymentSource',
        'orders' => 'setOrders',
        'vouchers' => 'setVouchers',
        'apply_voucher' => 'setApplyVoucher',
        'subscriptions' => 'setSubscriptions',
        'create_subscription' => 'setCreateSubscription',
        'estimate_subscription' => 'setEstimateSubscription',
        'mfa_enforcement' => 'setMfaEnforcement'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'self' => 'getSelf',
        'update' => 'getUpdate',
        'delete' => 'getDelete',
        'members' => 'getMembers',
        'create_member' => 'getCreateMember',
        'address' => 'getAddress',
        'profile' => 'getProfile',
        'payment_source' => 'getPaymentSource',
        'orders' => 'getOrders',
        'vouchers' => 'getVouchers',
        'apply_voucher' => 'getApplyVoucher',
        'subscriptions' => 'getSubscriptions',
        'create_subscription' => 'getCreateSubscription',
        'estimate_subscription' => 'getEstimateSubscription',
        'mfa_enforcement' => 'getMfaEnforcement'
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
        $this->setIfExists('self', $data ?? [], null);
        $this->setIfExists('update', $data ?? [], null);
        $this->setIfExists('delete', $data ?? [], null);
        $this->setIfExists('members', $data ?? [], null);
        $this->setIfExists('create_member', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('profile', $data ?? [], null);
        $this->setIfExists('payment_source', $data ?? [], null);
        $this->setIfExists('orders', $data ?? [], null);
        $this->setIfExists('vouchers', $data ?? [], null);
        $this->setIfExists('apply_voucher', $data ?? [], null);
        $this->setIfExists('subscriptions', $data ?? [], null);
        $this->setIfExists('create_subscription', $data ?? [], null);
        $this->setIfExists('estimate_subscription', $data ?? [], null);
        $this->setIfExists('mfa_enforcement', $data ?? [], null);
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
     * Gets self
     *
     * @return \Upsun\Model\OrganizationLinksSelf|null
     */
    public function getSelf()
    {
        return $this->container['self'];
    }

    /**
     * Sets self
     *
     * @param \Upsun\Model\OrganizationLinksSelf|null $self self
     *
     * @return self
     */
    public function setSelf($self)
    {
        if (is_null($self)) {
            throw new \InvalidArgumentException('non-nullable self cannot be null');
        }
        $this->container['self'] = $self;

        return $this;
    }

    /**
     * Gets update
     *
     * @return \Upsun\Model\OrganizationLinksUpdate|null
     */
    public function getUpdate()
    {
        return $this->container['update'];
    }

    /**
     * Sets update
     *
     * @param \Upsun\Model\OrganizationLinksUpdate|null $update update
     *
     * @return self
     */
    public function setUpdate($update)
    {
        if (is_null($update)) {
            throw new \InvalidArgumentException('non-nullable update cannot be null');
        }
        $this->container['update'] = $update;

        return $this;
    }

    /**
     * Gets delete
     *
     * @return \Upsun\Model\OrganizationLinksDelete|null
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     *
     * @param \Upsun\Model\OrganizationLinksDelete|null $delete delete
     *
     * @return self
     */
    public function setDelete($delete)
    {
        if (is_null($delete)) {
            throw new \InvalidArgumentException('non-nullable delete cannot be null');
        }
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets members
     *
     * @return \Upsun\Model\OrganizationLinksMembers|null
     */
    public function getMembers()
    {
        return $this->container['members'];
    }

    /**
     * Sets members
     *
     * @param \Upsun\Model\OrganizationLinksMembers|null $members members
     *
     * @return self
     */
    public function setMembers($members)
    {
        if (is_null($members)) {
            throw new \InvalidArgumentException('non-nullable members cannot be null');
        }
        $this->container['members'] = $members;

        return $this;
    }

    /**
     * Gets create_member
     *
     * @return \Upsun\Model\OrganizationLinksCreateMember|null
     */
    public function getCreateMember()
    {
        return $this->container['create_member'];
    }

    /**
     * Sets create_member
     *
     * @param \Upsun\Model\OrganizationLinksCreateMember|null $create_member create_member
     *
     * @return self
     */
    public function setCreateMember($create_member)
    {
        if (is_null($create_member)) {
            throw new \InvalidArgumentException('non-nullable create_member cannot be null');
        }
        $this->container['create_member'] = $create_member;

        return $this;
    }

    /**
     * Gets address
     *
     * @return \Upsun\Model\OrganizationLinksAddress|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \Upsun\Model\OrganizationLinksAddress|null $address address
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
     * Gets profile
     *
     * @return \Upsun\Model\OrganizationLinksProfile|null
     */
    public function getProfile()
    {
        return $this->container['profile'];
    }

    /**
     * Sets profile
     *
     * @param \Upsun\Model\OrganizationLinksProfile|null $profile profile
     *
     * @return self
     */
    public function setProfile($profile)
    {
        if (is_null($profile)) {
            throw new \InvalidArgumentException('non-nullable profile cannot be null');
        }
        $this->container['profile'] = $profile;

        return $this;
    }

    /**
     * Gets payment_source
     *
     * @return \Upsun\Model\OrganizationLinksPaymentSource|null
     */
    public function getPaymentSource()
    {
        return $this->container['payment_source'];
    }

    /**
     * Sets payment_source
     *
     * @param \Upsun\Model\OrganizationLinksPaymentSource|null $payment_source payment_source
     *
     * @return self
     */
    public function setPaymentSource($payment_source)
    {
        if (is_null($payment_source)) {
            throw new \InvalidArgumentException('non-nullable payment_source cannot be null');
        }
        $this->container['payment_source'] = $payment_source;

        return $this;
    }

    /**
     * Gets orders
     *
     * @return \Upsun\Model\OrganizationLinksOrders|null
     */
    public function getOrders()
    {
        return $this->container['orders'];
    }

    /**
     * Sets orders
     *
     * @param \Upsun\Model\OrganizationLinksOrders|null $orders orders
     *
     * @return self
     */
    public function setOrders($orders)
    {
        if (is_null($orders)) {
            throw new \InvalidArgumentException('non-nullable orders cannot be null');
        }
        $this->container['orders'] = $orders;

        return $this;
    }

    /**
     * Gets vouchers
     *
     * @return \Upsun\Model\OrganizationLinksVouchers|null
     */
    public function getVouchers()
    {
        return $this->container['vouchers'];
    }

    /**
     * Sets vouchers
     *
     * @param \Upsun\Model\OrganizationLinksVouchers|null $vouchers vouchers
     *
     * @return self
     */
    public function setVouchers($vouchers)
    {
        if (is_null($vouchers)) {
            throw new \InvalidArgumentException('non-nullable vouchers cannot be null');
        }
        $this->container['vouchers'] = $vouchers;

        return $this;
    }

    /**
     * Gets apply_voucher
     *
     * @return \Upsun\Model\OrganizationLinksApplyVoucher|null
     */
    public function getApplyVoucher()
    {
        return $this->container['apply_voucher'];
    }

    /**
     * Sets apply_voucher
     *
     * @param \Upsun\Model\OrganizationLinksApplyVoucher|null $apply_voucher apply_voucher
     *
     * @return self
     */
    public function setApplyVoucher($apply_voucher)
    {
        if (is_null($apply_voucher)) {
            throw new \InvalidArgumentException('non-nullable apply_voucher cannot be null');
        }
        $this->container['apply_voucher'] = $apply_voucher;

        return $this;
    }

    /**
     * Gets subscriptions
     *
     * @return \Upsun\Model\OrganizationLinksSubscriptions|null
     */
    public function getSubscriptions()
    {
        return $this->container['subscriptions'];
    }

    /**
     * Sets subscriptions
     *
     * @param \Upsun\Model\OrganizationLinksSubscriptions|null $subscriptions subscriptions
     *
     * @return self
     */
    public function setSubscriptions($subscriptions)
    {
        if (is_null($subscriptions)) {
            throw new \InvalidArgumentException('non-nullable subscriptions cannot be null');
        }
        $this->container['subscriptions'] = $subscriptions;

        return $this;
    }

    /**
     * Gets create_subscription
     *
     * @return \Upsun\Model\OrganizationLinksCreateSubscription|null
     */
    public function getCreateSubscription()
    {
        return $this->container['create_subscription'];
    }

    /**
     * Sets create_subscription
     *
     * @param \Upsun\Model\OrganizationLinksCreateSubscription|null $create_subscription create_subscription
     *
     * @return self
     */
    public function setCreateSubscription($create_subscription)
    {
        if (is_null($create_subscription)) {
            throw new \InvalidArgumentException('non-nullable create_subscription cannot be null');
        }
        $this->container['create_subscription'] = $create_subscription;

        return $this;
    }

    /**
     * Gets estimate_subscription
     *
     * @return \Upsun\Model\OrganizationLinksEstimateSubscription|null
     */
    public function getEstimateSubscription()
    {
        return $this->container['estimate_subscription'];
    }

    /**
     * Sets estimate_subscription
     *
     * @param \Upsun\Model\OrganizationLinksEstimateSubscription|null $estimate_subscription estimate_subscription
     *
     * @return self
     */
    public function setEstimateSubscription($estimate_subscription)
    {
        if (is_null($estimate_subscription)) {
            throw new \InvalidArgumentException('non-nullable estimate_subscription cannot be null');
        }
        $this->container['estimate_subscription'] = $estimate_subscription;

        return $this;
    }

    /**
     * Gets mfa_enforcement
     *
     * @return \Upsun\Model\OrganizationLinksMfaEnforcement|null
     */
    public function getMfaEnforcement()
    {
        return $this->container['mfa_enforcement'];
    }

    /**
     * Sets mfa_enforcement
     *
     * @param \Upsun\Model\OrganizationLinksMfaEnforcement|null $mfa_enforcement mfa_enforcement
     *
     * @return self
     */
    public function setMfaEnforcement($mfa_enforcement)
    {
        if (is_null($mfa_enforcement)) {
            throw new \InvalidArgumentException('non-nullable mfa_enforcement cannot be null');
        }
        $this->container['mfa_enforcement'] = $mfa_enforcement;

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


