<?php
/**
 * Config
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
 * Config Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Config implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Config';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'newrelic' => '\Upsun\Model\NewRelicLogForwardingIntegrationConfigurations',
        'sumologic' => '\Upsun\Model\SumoLogicLogForwardingIntegrationConfigurations',
        'splunk' => '\Upsun\Model\SplunkLogForwardingIntegrationConfigurations',
        'httplog' => '\Upsun\Model\HTTPLogForwardingIntegrationConfigurations',
        'syslog' => '\Upsun\Model\SyslogLogForwardingIntegrationConfigurations',
        'webhook' => '\Upsun\Model\WebhookIntegrationConfigurations',
        'script' => '\Upsun\Model\ScriptIntegrationConfigurations',
        'github' => '\Upsun\Model\GitHubIntegrationConfigurations',
        'gitlab' => '\Upsun\Model\GitLabIntegrationConfigurations',
        'bitbucket' => '\Upsun\Model\BitbucketIntegrationConfigurations',
        'bitbucket_server' => '\Upsun\Model\BitbucketServerIntegrationConfigurations',
        'health_email' => '\Upsun\Model\HealthEmailNotificationIntegrationConfigurations',
        'health_webhook' => '\Upsun\Model\HealthWebhookNotificationIntegrationConfigurations',
        'health_pagerduty' => '\Upsun\Model\HealthPagerDutyNotificationIntegrationConfigurations',
        'health_slack' => '\Upsun\Model\HealthSlackNotificationIntegrationConfigurations',
        'cdn_fastly' => '\Upsun\Model\FastlyCDNIntegrationConfigurations',
        'blackfire' => '\Upsun\Model\BlackfireIntegrationConfigurations'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'newrelic' => null,
        'sumologic' => null,
        'splunk' => null,
        'httplog' => null,
        'syslog' => null,
        'webhook' => null,
        'script' => null,
        'github' => null,
        'gitlab' => null,
        'bitbucket' => null,
        'bitbucket_server' => null,
        'health_email' => null,
        'health_webhook' => null,
        'health_pagerduty' => null,
        'health_slack' => null,
        'cdn_fastly' => null,
        'blackfire' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'newrelic' => false,
        'sumologic' => false,
        'splunk' => false,
        'httplog' => false,
        'syslog' => false,
        'webhook' => false,
        'script' => false,
        'github' => false,
        'gitlab' => false,
        'bitbucket' => false,
        'bitbucket_server' => false,
        'health_email' => false,
        'health_webhook' => false,
        'health_pagerduty' => false,
        'health_slack' => false,
        'cdn_fastly' => false,
        'blackfire' => false
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
        'newrelic' => 'newrelic',
        'sumologic' => 'sumologic',
        'splunk' => 'splunk',
        'httplog' => 'httplog',
        'syslog' => 'syslog',
        'webhook' => 'webhook',
        'script' => 'script',
        'github' => 'github',
        'gitlab' => 'gitlab',
        'bitbucket' => 'bitbucket',
        'bitbucket_server' => 'bitbucket_server',
        'health_email' => 'health.email',
        'health_webhook' => 'health.webhook',
        'health_pagerduty' => 'health.pagerduty',
        'health_slack' => 'health.slack',
        'cdn_fastly' => 'cdn.fastly',
        'blackfire' => 'blackfire'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'newrelic' => 'setNewrelic',
        'sumologic' => 'setSumologic',
        'splunk' => 'setSplunk',
        'httplog' => 'setHttplog',
        'syslog' => 'setSyslog',
        'webhook' => 'setWebhook',
        'script' => 'setScript',
        'github' => 'setGithub',
        'gitlab' => 'setGitlab',
        'bitbucket' => 'setBitbucket',
        'bitbucket_server' => 'setBitbucketServer',
        'health_email' => 'setHealthEmail',
        'health_webhook' => 'setHealthWebhook',
        'health_pagerduty' => 'setHealthPagerduty',
        'health_slack' => 'setHealthSlack',
        'cdn_fastly' => 'setCdnFastly',
        'blackfire' => 'setBlackfire'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'newrelic' => 'getNewrelic',
        'sumologic' => 'getSumologic',
        'splunk' => 'getSplunk',
        'httplog' => 'getHttplog',
        'syslog' => 'getSyslog',
        'webhook' => 'getWebhook',
        'script' => 'getScript',
        'github' => 'getGithub',
        'gitlab' => 'getGitlab',
        'bitbucket' => 'getBitbucket',
        'bitbucket_server' => 'getBitbucketServer',
        'health_email' => 'getHealthEmail',
        'health_webhook' => 'getHealthWebhook',
        'health_pagerduty' => 'getHealthPagerduty',
        'health_slack' => 'getHealthSlack',
        'cdn_fastly' => 'getCdnFastly',
        'blackfire' => 'getBlackfire'
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
        $this->setIfExists('newrelic', $data ?? [], null);
        $this->setIfExists('sumologic', $data ?? [], null);
        $this->setIfExists('splunk', $data ?? [], null);
        $this->setIfExists('httplog', $data ?? [], null);
        $this->setIfExists('syslog', $data ?? [], null);
        $this->setIfExists('webhook', $data ?? [], null);
        $this->setIfExists('script', $data ?? [], null);
        $this->setIfExists('github', $data ?? [], null);
        $this->setIfExists('gitlab', $data ?? [], null);
        $this->setIfExists('bitbucket', $data ?? [], null);
        $this->setIfExists('bitbucket_server', $data ?? [], null);
        $this->setIfExists('health_email', $data ?? [], null);
        $this->setIfExists('health_webhook', $data ?? [], null);
        $this->setIfExists('health_pagerduty', $data ?? [], null);
        $this->setIfExists('health_slack', $data ?? [], null);
        $this->setIfExists('cdn_fastly', $data ?? [], null);
        $this->setIfExists('blackfire', $data ?? [], null);
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
     * Gets newrelic
     *
     * @return \Upsun\Model\NewRelicLogForwardingIntegrationConfigurations|null
     */
    public function getNewrelic()
    {
        return $this->container['newrelic'];
    }

    /**
     * Sets newrelic
     *
     * @param \Upsun\Model\NewRelicLogForwardingIntegrationConfigurations|null $newrelic newrelic
     *
     * @return self
     */
    public function setNewrelic($newrelic)
    {
        if (is_null($newrelic)) {
            throw new \InvalidArgumentException('non-nullable newrelic cannot be null');
        }
        $this->container['newrelic'] = $newrelic;

        return $this;
    }

    /**
     * Gets sumologic
     *
     * @return \Upsun\Model\SumoLogicLogForwardingIntegrationConfigurations|null
     */
    public function getSumologic()
    {
        return $this->container['sumologic'];
    }

    /**
     * Sets sumologic
     *
     * @param \Upsun\Model\SumoLogicLogForwardingIntegrationConfigurations|null $sumologic sumologic
     *
     * @return self
     */
    public function setSumologic($sumologic)
    {
        if (is_null($sumologic)) {
            throw new \InvalidArgumentException('non-nullable sumologic cannot be null');
        }
        $this->container['sumologic'] = $sumologic;

        return $this;
    }

    /**
     * Gets splunk
     *
     * @return \Upsun\Model\SplunkLogForwardingIntegrationConfigurations|null
     */
    public function getSplunk()
    {
        return $this->container['splunk'];
    }

    /**
     * Sets splunk
     *
     * @param \Upsun\Model\SplunkLogForwardingIntegrationConfigurations|null $splunk splunk
     *
     * @return self
     */
    public function setSplunk($splunk)
    {
        if (is_null($splunk)) {
            throw new \InvalidArgumentException('non-nullable splunk cannot be null');
        }
        $this->container['splunk'] = $splunk;

        return $this;
    }

    /**
     * Gets httplog
     *
     * @return \Upsun\Model\HTTPLogForwardingIntegrationConfigurations|null
     */
    public function getHttplog()
    {
        return $this->container['httplog'];
    }

    /**
     * Sets httplog
     *
     * @param \Upsun\Model\HTTPLogForwardingIntegrationConfigurations|null $httplog httplog
     *
     * @return self
     */
    public function setHttplog($httplog)
    {
        if (is_null($httplog)) {
            throw new \InvalidArgumentException('non-nullable httplog cannot be null');
        }
        $this->container['httplog'] = $httplog;

        return $this;
    }

    /**
     * Gets syslog
     *
     * @return \Upsun\Model\SyslogLogForwardingIntegrationConfigurations|null
     */
    public function getSyslog()
    {
        return $this->container['syslog'];
    }

    /**
     * Sets syslog
     *
     * @param \Upsun\Model\SyslogLogForwardingIntegrationConfigurations|null $syslog syslog
     *
     * @return self
     */
    public function setSyslog($syslog)
    {
        if (is_null($syslog)) {
            throw new \InvalidArgumentException('non-nullable syslog cannot be null');
        }
        $this->container['syslog'] = $syslog;

        return $this;
    }

    /**
     * Gets webhook
     *
     * @return \Upsun\Model\WebhookIntegrationConfigurations|null
     */
    public function getWebhook()
    {
        return $this->container['webhook'];
    }

    /**
     * Sets webhook
     *
     * @param \Upsun\Model\WebhookIntegrationConfigurations|null $webhook webhook
     *
     * @return self
     */
    public function setWebhook($webhook)
    {
        if (is_null($webhook)) {
            throw new \InvalidArgumentException('non-nullable webhook cannot be null');
        }
        $this->container['webhook'] = $webhook;

        return $this;
    }

    /**
     * Gets script
     *
     * @return \Upsun\Model\ScriptIntegrationConfigurations|null
     */
    public function getScript()
    {
        return $this->container['script'];
    }

    /**
     * Sets script
     *
     * @param \Upsun\Model\ScriptIntegrationConfigurations|null $script script
     *
     * @return self
     */
    public function setScript($script)
    {
        if (is_null($script)) {
            throw new \InvalidArgumentException('non-nullable script cannot be null');
        }
        $this->container['script'] = $script;

        return $this;
    }

    /**
     * Gets github
     *
     * @return \Upsun\Model\GitHubIntegrationConfigurations|null
     */
    public function getGithub()
    {
        return $this->container['github'];
    }

    /**
     * Sets github
     *
     * @param \Upsun\Model\GitHubIntegrationConfigurations|null $github github
     *
     * @return self
     */
    public function setGithub($github)
    {
        if (is_null($github)) {
            throw new \InvalidArgumentException('non-nullable github cannot be null');
        }
        $this->container['github'] = $github;

        return $this;
    }

    /**
     * Gets gitlab
     *
     * @return \Upsun\Model\GitLabIntegrationConfigurations|null
     */
    public function getGitlab()
    {
        return $this->container['gitlab'];
    }

    /**
     * Sets gitlab
     *
     * @param \Upsun\Model\GitLabIntegrationConfigurations|null $gitlab gitlab
     *
     * @return self
     */
    public function setGitlab($gitlab)
    {
        if (is_null($gitlab)) {
            throw new \InvalidArgumentException('non-nullable gitlab cannot be null');
        }
        $this->container['gitlab'] = $gitlab;

        return $this;
    }

    /**
     * Gets bitbucket
     *
     * @return \Upsun\Model\BitbucketIntegrationConfigurations|null
     */
    public function getBitbucket()
    {
        return $this->container['bitbucket'];
    }

    /**
     * Sets bitbucket
     *
     * @param \Upsun\Model\BitbucketIntegrationConfigurations|null $bitbucket bitbucket
     *
     * @return self
     */
    public function setBitbucket($bitbucket)
    {
        if (is_null($bitbucket)) {
            throw new \InvalidArgumentException('non-nullable bitbucket cannot be null');
        }
        $this->container['bitbucket'] = $bitbucket;

        return $this;
    }

    /**
     * Gets bitbucket_server
     *
     * @return \Upsun\Model\BitbucketServerIntegrationConfigurations|null
     */
    public function getBitbucketServer()
    {
        return $this->container['bitbucket_server'];
    }

    /**
     * Sets bitbucket_server
     *
     * @param \Upsun\Model\BitbucketServerIntegrationConfigurations|null $bitbucket_server bitbucket_server
     *
     * @return self
     */
    public function setBitbucketServer($bitbucket_server)
    {
        if (is_null($bitbucket_server)) {
            throw new \InvalidArgumentException('non-nullable bitbucket_server cannot be null');
        }
        $this->container['bitbucket_server'] = $bitbucket_server;

        return $this;
    }

    /**
     * Gets health_email
     *
     * @return \Upsun\Model\HealthEmailNotificationIntegrationConfigurations|null
     */
    public function getHealthEmail()
    {
        return $this->container['health_email'];
    }

    /**
     * Sets health_email
     *
     * @param \Upsun\Model\HealthEmailNotificationIntegrationConfigurations|null $health_email health_email
     *
     * @return self
     */
    public function setHealthEmail($health_email)
    {
        if (is_null($health_email)) {
            throw new \InvalidArgumentException('non-nullable health_email cannot be null');
        }
        $this->container['health_email'] = $health_email;

        return $this;
    }

    /**
     * Gets health_webhook
     *
     * @return \Upsun\Model\HealthWebhookNotificationIntegrationConfigurations|null
     */
    public function getHealthWebhook()
    {
        return $this->container['health_webhook'];
    }

    /**
     * Sets health_webhook
     *
     * @param \Upsun\Model\HealthWebhookNotificationIntegrationConfigurations|null $health_webhook health_webhook
     *
     * @return self
     */
    public function setHealthWebhook($health_webhook)
    {
        if (is_null($health_webhook)) {
            throw new \InvalidArgumentException('non-nullable health_webhook cannot be null');
        }
        $this->container['health_webhook'] = $health_webhook;

        return $this;
    }

    /**
     * Gets health_pagerduty
     *
     * @return \Upsun\Model\HealthPagerDutyNotificationIntegrationConfigurations|null
     */
    public function getHealthPagerduty()
    {
        return $this->container['health_pagerduty'];
    }

    /**
     * Sets health_pagerduty
     *
     * @param \Upsun\Model\HealthPagerDutyNotificationIntegrationConfigurations|null $health_pagerduty health_pagerduty
     *
     * @return self
     */
    public function setHealthPagerduty($health_pagerduty)
    {
        if (is_null($health_pagerduty)) {
            throw new \InvalidArgumentException('non-nullable health_pagerduty cannot be null');
        }
        $this->container['health_pagerduty'] = $health_pagerduty;

        return $this;
    }

    /**
     * Gets health_slack
     *
     * @return \Upsun\Model\HealthSlackNotificationIntegrationConfigurations|null
     */
    public function getHealthSlack()
    {
        return $this->container['health_slack'];
    }

    /**
     * Sets health_slack
     *
     * @param \Upsun\Model\HealthSlackNotificationIntegrationConfigurations|null $health_slack health_slack
     *
     * @return self
     */
    public function setHealthSlack($health_slack)
    {
        if (is_null($health_slack)) {
            throw new \InvalidArgumentException('non-nullable health_slack cannot be null');
        }
        $this->container['health_slack'] = $health_slack;

        return $this;
    }

    /**
     * Gets cdn_fastly
     *
     * @return \Upsun\Model\FastlyCDNIntegrationConfigurations|null
     */
    public function getCdnFastly()
    {
        return $this->container['cdn_fastly'];
    }

    /**
     * Sets cdn_fastly
     *
     * @param \Upsun\Model\FastlyCDNIntegrationConfigurations|null $cdn_fastly cdn_fastly
     *
     * @return self
     */
    public function setCdnFastly($cdn_fastly)
    {
        if (is_null($cdn_fastly)) {
            throw new \InvalidArgumentException('non-nullable cdn_fastly cannot be null');
        }
        $this->container['cdn_fastly'] = $cdn_fastly;

        return $this;
    }

    /**
     * Gets blackfire
     *
     * @return \Upsun\Model\BlackfireIntegrationConfigurations|null
     */
    public function getBlackfire()
    {
        return $this->container['blackfire'];
    }

    /**
     * Sets blackfire
     *
     * @param \Upsun\Model\BlackfireIntegrationConfigurations|null $blackfire blackfire
     *
     * @return self
     */
    public function setBlackfire($blackfire)
    {
        if (is_null($blackfire)) {
            throw new \InvalidArgumentException('non-nullable blackfire cannot be null');
        }
        $this->container['blackfire'] = $blackfire;

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


