<?php
/**
 * Ticket
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
 * Ticket Class Doc Comment
 *
 * @category Class
 * @description The support ticket object.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Ticket implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Ticket';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'ticket_id' => 'int',
        'created' => '\DateTime',
        'updated' => '\DateTime',
        'type' => 'string',
        'subject' => 'string',
        'description' => 'string',
        'priority' => 'string',
        'followup_tid' => 'string',
        'status' => 'string',
        'recipient' => 'string',
        'requester_id' => 'string',
        'submitter_id' => 'string',
        'assignee_id' => 'string',
        'organization_id' => 'string',
        'collaborator_ids' => 'string[]',
        'has_incidents' => 'bool',
        'due' => '\DateTime',
        'tags' => 'string[]',
        'subscription_id' => 'string',
        'ticket_group' => 'string',
        'support_plan' => 'string',
        'affected_url' => 'string',
        'queue' => 'string',
        'issue_type' => 'string',
        'resolution_time' => '\DateTime',
        'response_time' => '\DateTime',
        'project_url' => 'string',
        'region' => 'string',
        'category' => 'string',
        'environment' => 'string',
        'ticket_sharing_status' => 'string',
        'application_ticket_url' => 'string',
        'infrastructure_ticket_url' => 'string',
        'jira' => '\OpenAPI\Client\Model\TicketJiraInner[]',
        'zd_ticket_url' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'ticket_id' => null,
        'created' => 'date-time',
        'updated' => 'date-time',
        'type' => null,
        'subject' => null,
        'description' => null,
        'priority' => null,
        'followup_tid' => null,
        'status' => null,
        'recipient' => null,
        'requester_id' => 'uuid',
        'submitter_id' => 'uuid',
        'assignee_id' => 'uuid',
        'organization_id' => null,
        'collaborator_ids' => null,
        'has_incidents' => null,
        'due' => 'date-time',
        'tags' => null,
        'subscription_id' => null,
        'ticket_group' => null,
        'support_plan' => null,
        'affected_url' => 'url',
        'queue' => null,
        'issue_type' => null,
        'resolution_time' => 'date-time',
        'response_time' => 'date-time',
        'project_url' => 'url',
        'region' => null,
        'category' => null,
        'environment' => null,
        'ticket_sharing_status' => null,
        'application_ticket_url' => 'url',
        'infrastructure_ticket_url' => 'url',
        'jira' => null,
        'zd_ticket_url' => 'url'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'ticket_id' => false,
        'created' => false,
        'updated' => false,
        'type' => false,
        'subject' => false,
        'description' => false,
        'priority' => false,
        'followup_tid' => false,
        'status' => false,
        'recipient' => false,
        'requester_id' => false,
        'submitter_id' => false,
        'assignee_id' => false,
        'organization_id' => false,
        'collaborator_ids' => false,
        'has_incidents' => false,
        'due' => false,
        'tags' => false,
        'subscription_id' => false,
        'ticket_group' => false,
        'support_plan' => false,
        'affected_url' => false,
        'queue' => false,
        'issue_type' => false,
        'resolution_time' => false,
        'response_time' => false,
        'project_url' => false,
        'region' => false,
        'category' => false,
        'environment' => false,
        'ticket_sharing_status' => false,
        'application_ticket_url' => false,
        'infrastructure_ticket_url' => false,
        'jira' => false,
        'zd_ticket_url' => false
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
        'ticket_id' => 'ticket_id',
        'created' => 'created',
        'updated' => 'updated',
        'type' => 'type',
        'subject' => 'subject',
        'description' => 'description',
        'priority' => 'priority',
        'followup_tid' => 'followup_tid',
        'status' => 'status',
        'recipient' => 'recipient',
        'requester_id' => 'requester_id',
        'submitter_id' => 'submitter_id',
        'assignee_id' => 'assignee_id',
        'organization_id' => 'organization_id',
        'collaborator_ids' => 'collaborator_ids',
        'has_incidents' => 'has_incidents',
        'due' => 'due',
        'tags' => 'tags',
        'subscription_id' => 'subscription_id',
        'ticket_group' => 'ticket_group',
        'support_plan' => 'support_plan',
        'affected_url' => 'affected_url',
        'queue' => 'queue',
        'issue_type' => 'issue_type',
        'resolution_time' => 'resolution_time',
        'response_time' => 'response_time',
        'project_url' => 'project_url',
        'region' => 'region',
        'category' => 'category',
        'environment' => 'environment',
        'ticket_sharing_status' => 'ticket_sharing_status',
        'application_ticket_url' => 'application_ticket_url',
        'infrastructure_ticket_url' => 'infrastructure_ticket_url',
        'jira' => 'jira',
        'zd_ticket_url' => 'zd_ticket_url'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'ticket_id' => 'setTicketId',
        'created' => 'setCreated',
        'updated' => 'setUpdated',
        'type' => 'setType',
        'subject' => 'setSubject',
        'description' => 'setDescription',
        'priority' => 'setPriority',
        'followup_tid' => 'setFollowupTid',
        'status' => 'setStatus',
        'recipient' => 'setRecipient',
        'requester_id' => 'setRequesterId',
        'submitter_id' => 'setSubmitterId',
        'assignee_id' => 'setAssigneeId',
        'organization_id' => 'setOrganizationId',
        'collaborator_ids' => 'setCollaboratorIds',
        'has_incidents' => 'setHasIncidents',
        'due' => 'setDue',
        'tags' => 'setTags',
        'subscription_id' => 'setSubscriptionId',
        'ticket_group' => 'setTicketGroup',
        'support_plan' => 'setSupportPlan',
        'affected_url' => 'setAffectedUrl',
        'queue' => 'setQueue',
        'issue_type' => 'setIssueType',
        'resolution_time' => 'setResolutionTime',
        'response_time' => 'setResponseTime',
        'project_url' => 'setProjectUrl',
        'region' => 'setRegion',
        'category' => 'setCategory',
        'environment' => 'setEnvironment',
        'ticket_sharing_status' => 'setTicketSharingStatus',
        'application_ticket_url' => 'setApplicationTicketUrl',
        'infrastructure_ticket_url' => 'setInfrastructureTicketUrl',
        'jira' => 'setJira',
        'zd_ticket_url' => 'setZdTicketUrl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'ticket_id' => 'getTicketId',
        'created' => 'getCreated',
        'updated' => 'getUpdated',
        'type' => 'getType',
        'subject' => 'getSubject',
        'description' => 'getDescription',
        'priority' => 'getPriority',
        'followup_tid' => 'getFollowupTid',
        'status' => 'getStatus',
        'recipient' => 'getRecipient',
        'requester_id' => 'getRequesterId',
        'submitter_id' => 'getSubmitterId',
        'assignee_id' => 'getAssigneeId',
        'organization_id' => 'getOrganizationId',
        'collaborator_ids' => 'getCollaboratorIds',
        'has_incidents' => 'getHasIncidents',
        'due' => 'getDue',
        'tags' => 'getTags',
        'subscription_id' => 'getSubscriptionId',
        'ticket_group' => 'getTicketGroup',
        'support_plan' => 'getSupportPlan',
        'affected_url' => 'getAffectedUrl',
        'queue' => 'getQueue',
        'issue_type' => 'getIssueType',
        'resolution_time' => 'getResolutionTime',
        'response_time' => 'getResponseTime',
        'project_url' => 'getProjectUrl',
        'region' => 'getRegion',
        'category' => 'getCategory',
        'environment' => 'getEnvironment',
        'ticket_sharing_status' => 'getTicketSharingStatus',
        'application_ticket_url' => 'getApplicationTicketUrl',
        'infrastructure_ticket_url' => 'getInfrastructureTicketUrl',
        'jira' => 'getJira',
        'zd_ticket_url' => 'getZdTicketUrl'
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

    public const TYPE_PROBLEM = 'problem';
    public const TYPE_TASK = 'task';
    public const TYPE_INCIDENT = 'incident';
    public const TYPE_QUESTION = 'question';
    public const PRIORITY_LOW = 'low';
    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_URGENT = 'urgent';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_DELETED = 'deleted';
    public const STATUS_HOLD = 'hold';
    public const STATUS__NEW = 'new';
    public const STATUS_OPEN = 'open';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SOLVED = 'solved';
    public const CATEGORY_ACCESS = 'access';
    public const CATEGORY_BILLING_QUESTION = 'billing_question';
    public const CATEGORY_COMPLAINT = 'complaint';
    public const CATEGORY_COMPLIANCE_QUESTION = 'compliance_question';
    public const CATEGORY_CONFIGURATION_CHANGE = 'configuration_change';
    public const CATEGORY_GENERAL_QUESTION = 'general_question';
    public const CATEGORY_INCIDENT_OUTAGE = 'incident_outage';
    public const CATEGORY_BUG_REPORT = 'bug_report';
    public const CATEGORY_ONBOARDING = 'onboarding';
    public const CATEGORY_REPORT_A_GUI_BUG = 'report_a_gui_bug';
    public const CATEGORY_CLOSE_MY_ACCOUNT = 'close_my_account';
    public const ENVIRONMENT_ENV_DEVELOPMENT = 'env_development';
    public const ENVIRONMENT_ENV_STAGING = 'env_staging';
    public const ENVIRONMENT_ENV_PRODUCTION = 'env_production';
    public const TICKET_SHARING_STATUS_TS_SENT_TO_PLATFORM = 'ts_sent_to_platform';
    public const TICKET_SHARING_STATUS_TS_ACCEPTED_BY_PLATFORM = 'ts_accepted_by_platform';
    public const TICKET_SHARING_STATUS_TS_RETURNED_FROM_PLATFORM = 'ts_returned_from_platform';
    public const TICKET_SHARING_STATUS_TS_SOLVED_BY_PLATFORM = 'ts_solved_by_platform';
    public const TICKET_SHARING_STATUS_TS_REJECTED_BY_PLATFORM = 'ts_rejected_by_platform';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_PROBLEM,
            self::TYPE_TASK,
            self::TYPE_INCIDENT,
            self::TYPE_QUESTION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPriorityAllowableValues()
    {
        return [
            self::PRIORITY_LOW,
            self::PRIORITY_NORMAL,
            self::PRIORITY_HIGH,
            self::PRIORITY_URGENT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_CLOSED,
            self::STATUS_DELETED,
            self::STATUS_HOLD,
            self::STATUS__NEW,
            self::STATUS_OPEN,
            self::STATUS_PENDING,
            self::STATUS_SOLVED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCategoryAllowableValues()
    {
        return [
            self::CATEGORY_ACCESS,
            self::CATEGORY_BILLING_QUESTION,
            self::CATEGORY_COMPLAINT,
            self::CATEGORY_COMPLIANCE_QUESTION,
            self::CATEGORY_CONFIGURATION_CHANGE,
            self::CATEGORY_GENERAL_QUESTION,
            self::CATEGORY_INCIDENT_OUTAGE,
            self::CATEGORY_BUG_REPORT,
            self::CATEGORY_ONBOARDING,
            self::CATEGORY_REPORT_A_GUI_BUG,
            self::CATEGORY_CLOSE_MY_ACCOUNT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEnvironmentAllowableValues()
    {
        return [
            self::ENVIRONMENT_ENV_DEVELOPMENT,
            self::ENVIRONMENT_ENV_STAGING,
            self::ENVIRONMENT_ENV_PRODUCTION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTicketSharingStatusAllowableValues()
    {
        return [
            self::TICKET_SHARING_STATUS_TS_SENT_TO_PLATFORM,
            self::TICKET_SHARING_STATUS_TS_ACCEPTED_BY_PLATFORM,
            self::TICKET_SHARING_STATUS_TS_RETURNED_FROM_PLATFORM,
            self::TICKET_SHARING_STATUS_TS_SOLVED_BY_PLATFORM,
            self::TICKET_SHARING_STATUS_TS_REJECTED_BY_PLATFORM,
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
        $this->setIfExists('ticket_id', $data ?? [], null);
        $this->setIfExists('created', $data ?? [], null);
        $this->setIfExists('updated', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('priority', $data ?? [], null);
        $this->setIfExists('followup_tid', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('recipient', $data ?? [], null);
        $this->setIfExists('requester_id', $data ?? [], null);
        $this->setIfExists('submitter_id', $data ?? [], null);
        $this->setIfExists('assignee_id', $data ?? [], null);
        $this->setIfExists('organization_id', $data ?? [], null);
        $this->setIfExists('collaborator_ids', $data ?? [], null);
        $this->setIfExists('has_incidents', $data ?? [], null);
        $this->setIfExists('due', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('subscription_id', $data ?? [], null);
        $this->setIfExists('ticket_group', $data ?? [], null);
        $this->setIfExists('support_plan', $data ?? [], null);
        $this->setIfExists('affected_url', $data ?? [], null);
        $this->setIfExists('queue', $data ?? [], null);
        $this->setIfExists('issue_type', $data ?? [], null);
        $this->setIfExists('resolution_time', $data ?? [], null);
        $this->setIfExists('response_time', $data ?? [], null);
        $this->setIfExists('project_url', $data ?? [], null);
        $this->setIfExists('region', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('environment', $data ?? [], null);
        $this->setIfExists('ticket_sharing_status', $data ?? [], null);
        $this->setIfExists('application_ticket_url', $data ?? [], null);
        $this->setIfExists('infrastructure_ticket_url', $data ?? [], null);
        $this->setIfExists('jira', $data ?? [], null);
        $this->setIfExists('zd_ticket_url', $data ?? [], null);
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

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPriorityAllowableValues();
        if (!is_null($this->container['priority']) && !in_array($this->container['priority'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'priority', must be one of '%s'",
                $this->container['priority'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getCategoryAllowableValues();
        if (!is_null($this->container['category']) && !in_array($this->container['category'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'category', must be one of '%s'",
                $this->container['category'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getEnvironmentAllowableValues();
        if (!is_null($this->container['environment']) && !in_array($this->container['environment'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'environment', must be one of '%s'",
                $this->container['environment'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTicketSharingStatusAllowableValues();
        if (!is_null($this->container['ticket_sharing_status']) && !in_array($this->container['ticket_sharing_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'ticket_sharing_status', must be one of '%s'",
                $this->container['ticket_sharing_status'],
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
     * Gets ticket_id
     *
     * @return int|null
     */
    public function getTicketId()
    {
        return $this->container['ticket_id'];
    }

    /**
     * Sets ticket_id
     *
     * @param int|null $ticket_id The ID of the ticket.
     *
     * @return self
     */
    public function setTicketId($ticket_id)
    {
        if (is_null($ticket_id)) {
            throw new \InvalidArgumentException('non-nullable ticket_id cannot be null');
        }
        $this->container['ticket_id'] = $ticket_id;

        return $this;
    }

    /**
     * Gets created
     *
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param \DateTime|null $created The time when the support ticket was created.
     *
     * @return self
     */
    public function setCreated($created)
    {
        if (is_null($created)) {
            throw new \InvalidArgumentException('non-nullable created cannot be null');
        }
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets updated
     *
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->container['updated'];
    }

    /**
     * Sets updated
     *
     * @param \DateTime|null $updated The time when the support ticket was updated.
     *
     * @return self
     */
    public function setUpdated($updated)
    {
        if (is_null($updated)) {
            throw new \InvalidArgumentException('non-nullable updated cannot be null');
        }
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type A type of the ticket.
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
     * Gets subject
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string|null $subject A title of the ticket.
     *
     * @return self
     */
    public function setSubject($subject)
    {
        if (is_null($subject)) {
            throw new \InvalidArgumentException('non-nullable subject cannot be null');
        }
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description The description body of the support ticket.
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets priority
     *
     * @return string|null
     */
    public function getPriority()
    {
        return $this->container['priority'];
    }

    /**
     * Sets priority
     *
     * @param string|null $priority A priority of the ticket.
     *
     * @return self
     */
    public function setPriority($priority)
    {
        if (is_null($priority)) {
            throw new \InvalidArgumentException('non-nullable priority cannot be null');
        }
        $allowedValues = $this->getPriorityAllowableValues();
        if (!in_array($priority, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'priority', must be one of '%s'",
                    $priority,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['priority'] = $priority;

        return $this;
    }

    /**
     * Gets followup_tid
     *
     * @return string|null
     */
    public function getFollowupTid()
    {
        return $this->container['followup_tid'];
    }

    /**
     * Sets followup_tid
     *
     * @param string|null $followup_tid Followup ticket ID. The unique ID of the ticket which this ticket is a follow-up to.
     *
     * @return self
     */
    public function setFollowupTid($followup_tid)
    {
        if (is_null($followup_tid)) {
            throw new \InvalidArgumentException('non-nullable followup_tid cannot be null');
        }
        $this->container['followup_tid'] = $followup_tid;

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
     * @param string|null $status The status of the support ticket.
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
     * Gets recipient
     *
     * @return string|null
     */
    public function getRecipient()
    {
        return $this->container['recipient'];
    }

    /**
     * Sets recipient
     *
     * @param string|null $recipient Email address of the ticket recipient, defaults to support@platform.sh.
     *
     * @return self
     */
    public function setRecipient($recipient)
    {
        if (is_null($recipient)) {
            throw new \InvalidArgumentException('non-nullable recipient cannot be null');
        }
        $this->container['recipient'] = $recipient;

        return $this;
    }

    /**
     * Gets requester_id
     *
     * @return string|null
     */
    public function getRequesterId()
    {
        return $this->container['requester_id'];
    }

    /**
     * Sets requester_id
     *
     * @param string|null $requester_id UUID of the ticket requester.
     *
     * @return self
     */
    public function setRequesterId($requester_id)
    {
        if (is_null($requester_id)) {
            throw new \InvalidArgumentException('non-nullable requester_id cannot be null');
        }
        $this->container['requester_id'] = $requester_id;

        return $this;
    }

    /**
     * Gets submitter_id
     *
     * @return string|null
     */
    public function getSubmitterId()
    {
        return $this->container['submitter_id'];
    }

    /**
     * Sets submitter_id
     *
     * @param string|null $submitter_id UUID of the ticket submitter.
     *
     * @return self
     */
    public function setSubmitterId($submitter_id)
    {
        if (is_null($submitter_id)) {
            throw new \InvalidArgumentException('non-nullable submitter_id cannot be null');
        }
        $this->container['submitter_id'] = $submitter_id;

        return $this;
    }

    /**
     * Gets assignee_id
     *
     * @return string|null
     */
    public function getAssigneeId()
    {
        return $this->container['assignee_id'];
    }

    /**
     * Sets assignee_id
     *
     * @param string|null $assignee_id UUID of the ticket assignee.
     *
     * @return self
     */
    public function setAssigneeId($assignee_id)
    {
        if (is_null($assignee_id)) {
            throw new \InvalidArgumentException('non-nullable assignee_id cannot be null');
        }
        $this->container['assignee_id'] = $assignee_id;

        return $this;
    }

    /**
     * Gets organization_id
     *
     * @return string|null
     */
    public function getOrganizationId()
    {
        return $this->container['organization_id'];
    }

    /**
     * Sets organization_id
     *
     * @param string|null $organization_id A reference id that is usable to find the commerce license.
     *
     * @return self
     */
    public function setOrganizationId($organization_id)
    {
        if (is_null($organization_id)) {
            throw new \InvalidArgumentException('non-nullable organization_id cannot be null');
        }
        $this->container['organization_id'] = $organization_id;

        return $this;
    }

    /**
     * Gets collaborator_ids
     *
     * @return string[]|null
     */
    public function getCollaboratorIds()
    {
        return $this->container['collaborator_ids'];
    }

    /**
     * Sets collaborator_ids
     *
     * @param string[]|null $collaborator_ids A list of the collaborators uuids for this ticket.
     *
     * @return self
     */
    public function setCollaboratorIds($collaborator_ids)
    {
        if (is_null($collaborator_ids)) {
            throw new \InvalidArgumentException('non-nullable collaborator_ids cannot be null');
        }
        $this->container['collaborator_ids'] = $collaborator_ids;

        return $this;
    }

    /**
     * Gets has_incidents
     *
     * @return bool|null
     */
    public function getHasIncidents()
    {
        return $this->container['has_incidents'];
    }

    /**
     * Sets has_incidents
     *
     * @param bool|null $has_incidents Whether or not this ticket has incidents.
     *
     * @return self
     */
    public function setHasIncidents($has_incidents)
    {
        if (is_null($has_incidents)) {
            throw new \InvalidArgumentException('non-nullable has_incidents cannot be null');
        }
        $this->container['has_incidents'] = $has_incidents;

        return $this;
    }

    /**
     * Gets due
     *
     * @return \DateTime|null
     */
    public function getDue()
    {
        return $this->container['due'];
    }

    /**
     * Sets due
     *
     * @param \DateTime|null $due A time that the ticket is due at.
     *
     * @return self
     */
    public function setDue($due)
    {
        if (is_null($due)) {
            throw new \InvalidArgumentException('non-nullable due cannot be null');
        }
        $this->container['due'] = $due;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string[]|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string[]|null $tags A list of tags assigned to the ticket.
     *
     * @return self
     */
    public function setTags($tags)
    {
        if (is_null($tags)) {
            throw new \InvalidArgumentException('non-nullable tags cannot be null');
        }
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets subscription_id
     *
     * @return string|null
     */
    public function getSubscriptionId()
    {
        return $this->container['subscription_id'];
    }

    /**
     * Sets subscription_id
     *
     * @param string|null $subscription_id The internal ID of the subscription.
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
     * Gets ticket_group
     *
     * @return string|null
     */
    public function getTicketGroup()
    {
        return $this->container['ticket_group'];
    }

    /**
     * Sets ticket_group
     *
     * @param string|null $ticket_group Maps to zendesk field 'Request group'.
     *
     * @return self
     */
    public function setTicketGroup($ticket_group)
    {
        if (is_null($ticket_group)) {
            throw new \InvalidArgumentException('non-nullable ticket_group cannot be null');
        }
        $this->container['ticket_group'] = $ticket_group;

        return $this;
    }

    /**
     * Gets support_plan
     *
     * @return string|null
     */
    public function getSupportPlan()
    {
        return $this->container['support_plan'];
    }

    /**
     * Sets support_plan
     *
     * @param string|null $support_plan Maps to zendesk field 'The support plan associated with this ticket.
     *
     * @return self
     */
    public function setSupportPlan($support_plan)
    {
        if (is_null($support_plan)) {
            throw new \InvalidArgumentException('non-nullable support_plan cannot be null');
        }
        $this->container['support_plan'] = $support_plan;

        return $this;
    }

    /**
     * Gets affected_url
     *
     * @return string|null
     */
    public function getAffectedUrl()
    {
        return $this->container['affected_url'];
    }

    /**
     * Sets affected_url
     *
     * @param string|null $affected_url The affected URL associated with the support ticket.
     *
     * @return self
     */
    public function setAffectedUrl($affected_url)
    {
        if (is_null($affected_url)) {
            throw new \InvalidArgumentException('non-nullable affected_url cannot be null');
        }
        $this->container['affected_url'] = $affected_url;

        return $this;
    }

    /**
     * Gets queue
     *
     * @return string|null
     */
    public function getQueue()
    {
        return $this->container['queue'];
    }

    /**
     * Sets queue
     *
     * @param string|null $queue The queue the support ticket is in.
     *
     * @return self
     */
    public function setQueue($queue)
    {
        if (is_null($queue)) {
            throw new \InvalidArgumentException('non-nullable queue cannot be null');
        }
        $this->container['queue'] = $queue;

        return $this;
    }

    /**
     * Gets issue_type
     *
     * @return string|null
     */
    public function getIssueType()
    {
        return $this->container['issue_type'];
    }

    /**
     * Sets issue_type
     *
     * @param string|null $issue_type The issue type of the support ticket.
     *
     * @return self
     */
    public function setIssueType($issue_type)
    {
        if (is_null($issue_type)) {
            throw new \InvalidArgumentException('non-nullable issue_type cannot be null');
        }
        $this->container['issue_type'] = $issue_type;

        return $this;
    }

    /**
     * Gets resolution_time
     *
     * @return \DateTime|null
     */
    public function getResolutionTime()
    {
        return $this->container['resolution_time'];
    }

    /**
     * Sets resolution_time
     *
     * @param \DateTime|null $resolution_time Maps to zendesk field 'Resolution Time'.
     *
     * @return self
     */
    public function setResolutionTime($resolution_time)
    {
        if (is_null($resolution_time)) {
            throw new \InvalidArgumentException('non-nullable resolution_time cannot be null');
        }
        $this->container['resolution_time'] = $resolution_time;

        return $this;
    }

    /**
     * Gets response_time
     *
     * @return \DateTime|null
     */
    public function getResponseTime()
    {
        return $this->container['response_time'];
    }

    /**
     * Sets response_time
     *
     * @param \DateTime|null $response_time Maps to zendesk field 'Response Time (time from request to reply).
     *
     * @return self
     */
    public function setResponseTime($response_time)
    {
        if (is_null($response_time)) {
            throw new \InvalidArgumentException('non-nullable response_time cannot be null');
        }
        $this->container['response_time'] = $response_time;

        return $this;
    }

    /**
     * Gets project_url
     *
     * @return string|null
     */
    public function getProjectUrl()
    {
        return $this->container['project_url'];
    }

    /**
     * Sets project_url
     *
     * @param string|null $project_url Maps to zendesk field 'Project URL'.
     *
     * @return self
     */
    public function setProjectUrl($project_url)
    {
        if (is_null($project_url)) {
            throw new \InvalidArgumentException('non-nullable project_url cannot be null');
        }
        $this->container['project_url'] = $project_url;

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
     * @param string|null $region Maps to zendesk field 'Region'.
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
     * Gets category
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string|null $category Maps to zendesk field 'Category'.
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $allowedValues = $this->getCategoryAllowableValues();
        if (!in_array($category, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'category', must be one of '%s'",
                    $category,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets environment
     *
     * @return string|null
     */
    public function getEnvironment()
    {
        return $this->container['environment'];
    }

    /**
     * Sets environment
     *
     * @param string|null $environment Maps to zendesk field 'Environment'.
     *
     * @return self
     */
    public function setEnvironment($environment)
    {
        if (is_null($environment)) {
            throw new \InvalidArgumentException('non-nullable environment cannot be null');
        }
        $allowedValues = $this->getEnvironmentAllowableValues();
        if (!in_array($environment, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'environment', must be one of '%s'",
                    $environment,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['environment'] = $environment;

        return $this;
    }

    /**
     * Gets ticket_sharing_status
     *
     * @return string|null
     */
    public function getTicketSharingStatus()
    {
        return $this->container['ticket_sharing_status'];
    }

    /**
     * Sets ticket_sharing_status
     *
     * @param string|null $ticket_sharing_status Maps to zendesk field 'Ticket Sharing Status'.
     *
     * @return self
     */
    public function setTicketSharingStatus($ticket_sharing_status)
    {
        if (is_null($ticket_sharing_status)) {
            throw new \InvalidArgumentException('non-nullable ticket_sharing_status cannot be null');
        }
        $allowedValues = $this->getTicketSharingStatusAllowableValues();
        if (!in_array($ticket_sharing_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'ticket_sharing_status', must be one of '%s'",
                    $ticket_sharing_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['ticket_sharing_status'] = $ticket_sharing_status;

        return $this;
    }

    /**
     * Gets application_ticket_url
     *
     * @return string|null
     */
    public function getApplicationTicketUrl()
    {
        return $this->container['application_ticket_url'];
    }

    /**
     * Sets application_ticket_url
     *
     * @param string|null $application_ticket_url Maps to zendesk field 'Application Ticket URL'.
     *
     * @return self
     */
    public function setApplicationTicketUrl($application_ticket_url)
    {
        if (is_null($application_ticket_url)) {
            throw new \InvalidArgumentException('non-nullable application_ticket_url cannot be null');
        }
        $this->container['application_ticket_url'] = $application_ticket_url;

        return $this;
    }

    /**
     * Gets infrastructure_ticket_url
     *
     * @return string|null
     */
    public function getInfrastructureTicketUrl()
    {
        return $this->container['infrastructure_ticket_url'];
    }

    /**
     * Sets infrastructure_ticket_url
     *
     * @param string|null $infrastructure_ticket_url Maps to zendesk field 'Infrastructure Ticket URL'.
     *
     * @return self
     */
    public function setInfrastructureTicketUrl($infrastructure_ticket_url)
    {
        if (is_null($infrastructure_ticket_url)) {
            throw new \InvalidArgumentException('non-nullable infrastructure_ticket_url cannot be null');
        }
        $this->container['infrastructure_ticket_url'] = $infrastructure_ticket_url;

        return $this;
    }

    /**
     * Gets jira
     *
     * @return \OpenAPI\Client\Model\TicketJiraInner[]|null
     */
    public function getJira()
    {
        return $this->container['jira'];
    }

    /**
     * Sets jira
     *
     * @param \OpenAPI\Client\Model\TicketJiraInner[]|null $jira A list of JIRA issues related to the support ticket.
     *
     * @return self
     */
    public function setJira($jira)
    {
        if (is_null($jira)) {
            throw new \InvalidArgumentException('non-nullable jira cannot be null');
        }
        $this->container['jira'] = $jira;

        return $this;
    }

    /**
     * Gets zd_ticket_url
     *
     * @return string|null
     */
    public function getZdTicketUrl()
    {
        return $this->container['zd_ticket_url'];
    }

    /**
     * Sets zd_ticket_url
     *
     * @param string|null $zd_ticket_url URL to the customer-facing ticket in Zendesk.
     *
     * @return self
     */
    public function setZdTicketUrl($zd_ticket_url)
    {
        if (is_null($zd_ticket_url)) {
            throw new \InvalidArgumentException('non-nullable zd_ticket_url cannot be null');
        }
        $this->container['zd_ticket_url'] = $zd_ticket_url;

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


