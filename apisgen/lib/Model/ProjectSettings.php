<?php
/**
 * ProjectSettings
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
 * ProjectSettings Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectSettings implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProjectSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'initialize' => 'object',
        'product_name' => 'string',
        'product_code' => 'string',
        'ui_uri_template' => 'string',
        'variables_prefix' => 'string',
        'bot_email' => 'string',
        'application_config_file' => 'string',
        'project_config_dir' => 'string',
        'use_drupal_defaults' => 'bool',
        'use_legacy_subdomains' => 'bool',
        'development_service_size' => 'string',
        'development_application_size' => 'string',
        'enable_certificate_provisioning' => 'bool',
        'certificate_style' => 'string',
        'certificate_renewal_activity' => 'bool',
        'development_domain_template' => 'string',
        'enable_state_api_deployments' => 'bool',
        'temporary_disk_size' => 'int',
        'local_disk_size' => 'int',
        'cron_minimum_interval' => 'int',
        'cron_maximum_jitter' => 'int',
        'concurrency_limits' => 'array<string,int>',
        'flexible_build_cache' => 'bool',
        'strict_configuration' => 'bool',
        'has_sleepy_crons' => 'bool',
        'crons_in_git' => 'bool',
        'custom_error_template' => 'string',
        'app_error_page_template' => 'string',
        'environment_name_strategy' => 'string',
        'data_retention' => 'array<string,\OpenAPI\Client\Model\DataRetentionConfigurationValue>',
        'enable_codesource_integration_push' => 'bool',
        'enforce_mfa' => 'bool',
        'systemd' => 'bool',
        'router_gen2' => 'bool',
        'build_resources' => '\OpenAPI\Client\Model\BuildResources1',
        'outbound_restrictions_default_policy' => 'string',
        'self_upgrade' => 'bool',
        'additional_hosts' => 'array<string,string>',
        'max_allowed_routes' => 'int',
        'max_allowed_redirects_paths' => 'int',
        'enable_incremental_backups' => 'bool',
        'sizing_api_enabled' => 'bool',
        'enable_cache_grace_period' => 'bool',
        'enable_zero_downtime_deployments' => 'bool',
        'enable_admin_agent' => 'bool',
        'certifier_url' => 'string',
        'centralized_permissions' => 'bool',
        'glue_server_max_request_size' => 'int',
        'persistent_endpoints_ssh' => 'bool',
        'persistent_endpoints_ssl_certificates' => 'bool',
        'enable_disk_health_monitoring' => 'bool',
        'enable_paused_environments' => 'bool',
        'enable_unified_configuration' => 'bool',
        'enable_routes_tracing' => 'bool',
        'image_deployment_validation' => 'bool',
        'support_generic_images' => 'bool',
        'enable_github_app_token_exchange' => 'bool',
        'enable_marefs' => 'bool',
        'continuous_profiling' => '\OpenAPI\Client\Model\TheContinuousProfilingConfiguration'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'initialize' => null,
        'product_name' => null,
        'product_code' => null,
        'ui_uri_template' => null,
        'variables_prefix' => null,
        'bot_email' => null,
        'application_config_file' => null,
        'project_config_dir' => null,
        'use_drupal_defaults' => null,
        'use_legacy_subdomains' => null,
        'development_service_size' => null,
        'development_application_size' => null,
        'enable_certificate_provisioning' => null,
        'certificate_style' => null,
        'certificate_renewal_activity' => null,
        'development_domain_template' => null,
        'enable_state_api_deployments' => null,
        'temporary_disk_size' => null,
        'local_disk_size' => null,
        'cron_minimum_interval' => null,
        'cron_maximum_jitter' => null,
        'concurrency_limits' => null,
        'flexible_build_cache' => null,
        'strict_configuration' => null,
        'has_sleepy_crons' => null,
        'crons_in_git' => null,
        'custom_error_template' => null,
        'app_error_page_template' => null,
        'environment_name_strategy' => null,
        'data_retention' => null,
        'enable_codesource_integration_push' => null,
        'enforce_mfa' => null,
        'systemd' => null,
        'router_gen2' => null,
        'build_resources' => null,
        'outbound_restrictions_default_policy' => null,
        'self_upgrade' => null,
        'additional_hosts' => null,
        'max_allowed_routes' => null,
        'max_allowed_redirects_paths' => null,
        'enable_incremental_backups' => null,
        'sizing_api_enabled' => null,
        'enable_cache_grace_period' => null,
        'enable_zero_downtime_deployments' => null,
        'enable_admin_agent' => null,
        'certifier_url' => null,
        'centralized_permissions' => null,
        'glue_server_max_request_size' => null,
        'persistent_endpoints_ssh' => null,
        'persistent_endpoints_ssl_certificates' => null,
        'enable_disk_health_monitoring' => null,
        'enable_paused_environments' => null,
        'enable_unified_configuration' => null,
        'enable_routes_tracing' => null,
        'image_deployment_validation' => null,
        'support_generic_images' => null,
        'enable_github_app_token_exchange' => null,
        'enable_marefs' => null,
        'continuous_profiling' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'initialize' => false,
        'product_name' => false,
        'product_code' => false,
        'ui_uri_template' => false,
        'variables_prefix' => false,
        'bot_email' => false,
        'application_config_file' => false,
        'project_config_dir' => false,
        'use_drupal_defaults' => false,
        'use_legacy_subdomains' => false,
        'development_service_size' => false,
        'development_application_size' => false,
        'enable_certificate_provisioning' => false,
        'certificate_style' => false,
        'certificate_renewal_activity' => false,
        'development_domain_template' => true,
        'enable_state_api_deployments' => false,
        'temporary_disk_size' => true,
        'local_disk_size' => true,
        'cron_minimum_interval' => false,
        'cron_maximum_jitter' => false,
        'concurrency_limits' => false,
        'flexible_build_cache' => false,
        'strict_configuration' => false,
        'has_sleepy_crons' => false,
        'crons_in_git' => false,
        'custom_error_template' => true,
        'app_error_page_template' => true,
        'environment_name_strategy' => false,
        'data_retention' => true,
        'enable_codesource_integration_push' => false,
        'enforce_mfa' => false,
        'systemd' => false,
        'router_gen2' => false,
        'build_resources' => false,
        'outbound_restrictions_default_policy' => false,
        'self_upgrade' => false,
        'additional_hosts' => false,
        'max_allowed_routes' => false,
        'max_allowed_redirects_paths' => false,
        'enable_incremental_backups' => false,
        'sizing_api_enabled' => false,
        'enable_cache_grace_period' => false,
        'enable_zero_downtime_deployments' => false,
        'enable_admin_agent' => false,
        'certifier_url' => false,
        'centralized_permissions' => false,
        'glue_server_max_request_size' => false,
        'persistent_endpoints_ssh' => false,
        'persistent_endpoints_ssl_certificates' => false,
        'enable_disk_health_monitoring' => false,
        'enable_paused_environments' => false,
        'enable_unified_configuration' => false,
        'enable_routes_tracing' => false,
        'image_deployment_validation' => false,
        'support_generic_images' => false,
        'enable_github_app_token_exchange' => false,
        'enable_marefs' => false,
        'continuous_profiling' => false
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
        'initialize' => 'initialize',
        'product_name' => 'product_name',
        'product_code' => 'product_code',
        'ui_uri_template' => 'ui_uri_template',
        'variables_prefix' => 'variables_prefix',
        'bot_email' => 'bot_email',
        'application_config_file' => 'application_config_file',
        'project_config_dir' => 'project_config_dir',
        'use_drupal_defaults' => 'use_drupal_defaults',
        'use_legacy_subdomains' => 'use_legacy_subdomains',
        'development_service_size' => 'development_service_size',
        'development_application_size' => 'development_application_size',
        'enable_certificate_provisioning' => 'enable_certificate_provisioning',
        'certificate_style' => 'certificate_style',
        'certificate_renewal_activity' => 'certificate_renewal_activity',
        'development_domain_template' => 'development_domain_template',
        'enable_state_api_deployments' => 'enable_state_api_deployments',
        'temporary_disk_size' => 'temporary_disk_size',
        'local_disk_size' => 'local_disk_size',
        'cron_minimum_interval' => 'cron_minimum_interval',
        'cron_maximum_jitter' => 'cron_maximum_jitter',
        'concurrency_limits' => 'concurrency_limits',
        'flexible_build_cache' => 'flexible_build_cache',
        'strict_configuration' => 'strict_configuration',
        'has_sleepy_crons' => 'has_sleepy_crons',
        'crons_in_git' => 'crons_in_git',
        'custom_error_template' => 'custom_error_template',
        'app_error_page_template' => 'app_error_page_template',
        'environment_name_strategy' => 'environment_name_strategy',
        'data_retention' => 'data_retention',
        'enable_codesource_integration_push' => 'enable_codesource_integration_push',
        'enforce_mfa' => 'enforce_mfa',
        'systemd' => 'systemd',
        'router_gen2' => 'router_gen2',
        'build_resources' => 'build_resources',
        'outbound_restrictions_default_policy' => 'outbound_restrictions_default_policy',
        'self_upgrade' => 'self_upgrade',
        'additional_hosts' => 'additional_hosts',
        'max_allowed_routes' => 'max_allowed_routes',
        'max_allowed_redirects_paths' => 'max_allowed_redirects_paths',
        'enable_incremental_backups' => 'enable_incremental_backups',
        'sizing_api_enabled' => 'sizing_api_enabled',
        'enable_cache_grace_period' => 'enable_cache_grace_period',
        'enable_zero_downtime_deployments' => 'enable_zero_downtime_deployments',
        'enable_admin_agent' => 'enable_admin_agent',
        'certifier_url' => 'certifier_url',
        'centralized_permissions' => 'centralized_permissions',
        'glue_server_max_request_size' => 'glue_server_max_request_size',
        'persistent_endpoints_ssh' => 'persistent_endpoints_ssh',
        'persistent_endpoints_ssl_certificates' => 'persistent_endpoints_ssl_certificates',
        'enable_disk_health_monitoring' => 'enable_disk_health_monitoring',
        'enable_paused_environments' => 'enable_paused_environments',
        'enable_unified_configuration' => 'enable_unified_configuration',
        'enable_routes_tracing' => 'enable_routes_tracing',
        'image_deployment_validation' => 'image_deployment_validation',
        'support_generic_images' => 'support_generic_images',
        'enable_github_app_token_exchange' => 'enable_github_app_token_exchange',
        'enable_marefs' => 'enable_marefs',
        'continuous_profiling' => 'continuous_profiling'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'initialize' => 'setInitialize',
        'product_name' => 'setProductName',
        'product_code' => 'setProductCode',
        'ui_uri_template' => 'setUiUriTemplate',
        'variables_prefix' => 'setVariablesPrefix',
        'bot_email' => 'setBotEmail',
        'application_config_file' => 'setApplicationConfigFile',
        'project_config_dir' => 'setProjectConfigDir',
        'use_drupal_defaults' => 'setUseDrupalDefaults',
        'use_legacy_subdomains' => 'setUseLegacySubdomains',
        'development_service_size' => 'setDevelopmentServiceSize',
        'development_application_size' => 'setDevelopmentApplicationSize',
        'enable_certificate_provisioning' => 'setEnableCertificateProvisioning',
        'certificate_style' => 'setCertificateStyle',
        'certificate_renewal_activity' => 'setCertificateRenewalActivity',
        'development_domain_template' => 'setDevelopmentDomainTemplate',
        'enable_state_api_deployments' => 'setEnableStateApiDeployments',
        'temporary_disk_size' => 'setTemporaryDiskSize',
        'local_disk_size' => 'setLocalDiskSize',
        'cron_minimum_interval' => 'setCronMinimumInterval',
        'cron_maximum_jitter' => 'setCronMaximumJitter',
        'concurrency_limits' => 'setConcurrencyLimits',
        'flexible_build_cache' => 'setFlexibleBuildCache',
        'strict_configuration' => 'setStrictConfiguration',
        'has_sleepy_crons' => 'setHasSleepyCrons',
        'crons_in_git' => 'setCronsInGit',
        'custom_error_template' => 'setCustomErrorTemplate',
        'app_error_page_template' => 'setAppErrorPageTemplate',
        'environment_name_strategy' => 'setEnvironmentNameStrategy',
        'data_retention' => 'setDataRetention',
        'enable_codesource_integration_push' => 'setEnableCodesourceIntegrationPush',
        'enforce_mfa' => 'setEnforceMfa',
        'systemd' => 'setSystemd',
        'router_gen2' => 'setRouterGen2',
        'build_resources' => 'setBuildResources',
        'outbound_restrictions_default_policy' => 'setOutboundRestrictionsDefaultPolicy',
        'self_upgrade' => 'setSelfUpgrade',
        'additional_hosts' => 'setAdditionalHosts',
        'max_allowed_routes' => 'setMaxAllowedRoutes',
        'max_allowed_redirects_paths' => 'setMaxAllowedRedirectsPaths',
        'enable_incremental_backups' => 'setEnableIncrementalBackups',
        'sizing_api_enabled' => 'setSizingApiEnabled',
        'enable_cache_grace_period' => 'setEnableCacheGracePeriod',
        'enable_zero_downtime_deployments' => 'setEnableZeroDowntimeDeployments',
        'enable_admin_agent' => 'setEnableAdminAgent',
        'certifier_url' => 'setCertifierUrl',
        'centralized_permissions' => 'setCentralizedPermissions',
        'glue_server_max_request_size' => 'setGlueServerMaxRequestSize',
        'persistent_endpoints_ssh' => 'setPersistentEndpointsSsh',
        'persistent_endpoints_ssl_certificates' => 'setPersistentEndpointsSslCertificates',
        'enable_disk_health_monitoring' => 'setEnableDiskHealthMonitoring',
        'enable_paused_environments' => 'setEnablePausedEnvironments',
        'enable_unified_configuration' => 'setEnableUnifiedConfiguration',
        'enable_routes_tracing' => 'setEnableRoutesTracing',
        'image_deployment_validation' => 'setImageDeploymentValidation',
        'support_generic_images' => 'setSupportGenericImages',
        'enable_github_app_token_exchange' => 'setEnableGithubAppTokenExchange',
        'enable_marefs' => 'setEnableMarefs',
        'continuous_profiling' => 'setContinuousProfiling'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'initialize' => 'getInitialize',
        'product_name' => 'getProductName',
        'product_code' => 'getProductCode',
        'ui_uri_template' => 'getUiUriTemplate',
        'variables_prefix' => 'getVariablesPrefix',
        'bot_email' => 'getBotEmail',
        'application_config_file' => 'getApplicationConfigFile',
        'project_config_dir' => 'getProjectConfigDir',
        'use_drupal_defaults' => 'getUseDrupalDefaults',
        'use_legacy_subdomains' => 'getUseLegacySubdomains',
        'development_service_size' => 'getDevelopmentServiceSize',
        'development_application_size' => 'getDevelopmentApplicationSize',
        'enable_certificate_provisioning' => 'getEnableCertificateProvisioning',
        'certificate_style' => 'getCertificateStyle',
        'certificate_renewal_activity' => 'getCertificateRenewalActivity',
        'development_domain_template' => 'getDevelopmentDomainTemplate',
        'enable_state_api_deployments' => 'getEnableStateApiDeployments',
        'temporary_disk_size' => 'getTemporaryDiskSize',
        'local_disk_size' => 'getLocalDiskSize',
        'cron_minimum_interval' => 'getCronMinimumInterval',
        'cron_maximum_jitter' => 'getCronMaximumJitter',
        'concurrency_limits' => 'getConcurrencyLimits',
        'flexible_build_cache' => 'getFlexibleBuildCache',
        'strict_configuration' => 'getStrictConfiguration',
        'has_sleepy_crons' => 'getHasSleepyCrons',
        'crons_in_git' => 'getCronsInGit',
        'custom_error_template' => 'getCustomErrorTemplate',
        'app_error_page_template' => 'getAppErrorPageTemplate',
        'environment_name_strategy' => 'getEnvironmentNameStrategy',
        'data_retention' => 'getDataRetention',
        'enable_codesource_integration_push' => 'getEnableCodesourceIntegrationPush',
        'enforce_mfa' => 'getEnforceMfa',
        'systemd' => 'getSystemd',
        'router_gen2' => 'getRouterGen2',
        'build_resources' => 'getBuildResources',
        'outbound_restrictions_default_policy' => 'getOutboundRestrictionsDefaultPolicy',
        'self_upgrade' => 'getSelfUpgrade',
        'additional_hosts' => 'getAdditionalHosts',
        'max_allowed_routes' => 'getMaxAllowedRoutes',
        'max_allowed_redirects_paths' => 'getMaxAllowedRedirectsPaths',
        'enable_incremental_backups' => 'getEnableIncrementalBackups',
        'sizing_api_enabled' => 'getSizingApiEnabled',
        'enable_cache_grace_period' => 'getEnableCacheGracePeriod',
        'enable_zero_downtime_deployments' => 'getEnableZeroDowntimeDeployments',
        'enable_admin_agent' => 'getEnableAdminAgent',
        'certifier_url' => 'getCertifierUrl',
        'centralized_permissions' => 'getCentralizedPermissions',
        'glue_server_max_request_size' => 'getGlueServerMaxRequestSize',
        'persistent_endpoints_ssh' => 'getPersistentEndpointsSsh',
        'persistent_endpoints_ssl_certificates' => 'getPersistentEndpointsSslCertificates',
        'enable_disk_health_monitoring' => 'getEnableDiskHealthMonitoring',
        'enable_paused_environments' => 'getEnablePausedEnvironments',
        'enable_unified_configuration' => 'getEnableUnifiedConfiguration',
        'enable_routes_tracing' => 'getEnableRoutesTracing',
        'image_deployment_validation' => 'getImageDeploymentValidation',
        'support_generic_images' => 'getSupportGenericImages',
        'enable_github_app_token_exchange' => 'getEnableGithubAppTokenExchange',
        'enable_marefs' => 'getEnableMarefs',
        'continuous_profiling' => 'getContinuousProfiling'
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

    public const DEVELOPMENT_SERVICE_SIZE__2_XL = '2XL';
    public const DEVELOPMENT_SERVICE_SIZE__4_XL = '4XL';
    public const DEVELOPMENT_SERVICE_SIZE_L = 'L';
    public const DEVELOPMENT_SERVICE_SIZE_M = 'M';
    public const DEVELOPMENT_SERVICE_SIZE_S = 'S';
    public const DEVELOPMENT_SERVICE_SIZE_XL = 'XL';
    public const DEVELOPMENT_APPLICATION_SIZE__2_XL = '2XL';
    public const DEVELOPMENT_APPLICATION_SIZE__4_XL = '4XL';
    public const DEVELOPMENT_APPLICATION_SIZE_L = 'L';
    public const DEVELOPMENT_APPLICATION_SIZE_M = 'M';
    public const DEVELOPMENT_APPLICATION_SIZE_S = 'S';
    public const DEVELOPMENT_APPLICATION_SIZE_XL = 'XL';
    public const CERTIFICATE_STYLE_ECDSA = 'ecdsa';
    public const CERTIFICATE_STYLE_RSA = 'rsa';
    public const ENVIRONMENT_NAME_STRATEGY_HASH = 'hash';
    public const ENVIRONMENT_NAME_STRATEGY_NAME_AND_HASH = 'name-and-hash';
    public const OUTBOUND_RESTRICTIONS_DEFAULT_POLICY_ALLOW = 'allow';
    public const OUTBOUND_RESTRICTIONS_DEFAULT_POLICY_DENY = 'deny';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDevelopmentServiceSizeAllowableValues()
    {
        return [
            self::DEVELOPMENT_SERVICE_SIZE__2_XL,
            self::DEVELOPMENT_SERVICE_SIZE__4_XL,
            self::DEVELOPMENT_SERVICE_SIZE_L,
            self::DEVELOPMENT_SERVICE_SIZE_M,
            self::DEVELOPMENT_SERVICE_SIZE_S,
            self::DEVELOPMENT_SERVICE_SIZE_XL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDevelopmentApplicationSizeAllowableValues()
    {
        return [
            self::DEVELOPMENT_APPLICATION_SIZE__2_XL,
            self::DEVELOPMENT_APPLICATION_SIZE__4_XL,
            self::DEVELOPMENT_APPLICATION_SIZE_L,
            self::DEVELOPMENT_APPLICATION_SIZE_M,
            self::DEVELOPMENT_APPLICATION_SIZE_S,
            self::DEVELOPMENT_APPLICATION_SIZE_XL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCertificateStyleAllowableValues()
    {
        return [
            self::CERTIFICATE_STYLE_ECDSA,
            self::CERTIFICATE_STYLE_RSA,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEnvironmentNameStrategyAllowableValues()
    {
        return [
            self::ENVIRONMENT_NAME_STRATEGY_HASH,
            self::ENVIRONMENT_NAME_STRATEGY_NAME_AND_HASH,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOutboundRestrictionsDefaultPolicyAllowableValues()
    {
        return [
            self::OUTBOUND_RESTRICTIONS_DEFAULT_POLICY_ALLOW,
            self::OUTBOUND_RESTRICTIONS_DEFAULT_POLICY_DENY,
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
        $this->setIfExists('initialize', $data ?? [], null);
        $this->setIfExists('product_name', $data ?? [], null);
        $this->setIfExists('product_code', $data ?? [], null);
        $this->setIfExists('ui_uri_template', $data ?? [], null);
        $this->setIfExists('variables_prefix', $data ?? [], null);
        $this->setIfExists('bot_email', $data ?? [], null);
        $this->setIfExists('application_config_file', $data ?? [], null);
        $this->setIfExists('project_config_dir', $data ?? [], null);
        $this->setIfExists('use_drupal_defaults', $data ?? [], null);
        $this->setIfExists('use_legacy_subdomains', $data ?? [], null);
        $this->setIfExists('development_service_size', $data ?? [], null);
        $this->setIfExists('development_application_size', $data ?? [], null);
        $this->setIfExists('enable_certificate_provisioning', $data ?? [], null);
        $this->setIfExists('certificate_style', $data ?? [], null);
        $this->setIfExists('certificate_renewal_activity', $data ?? [], null);
        $this->setIfExists('development_domain_template', $data ?? [], null);
        $this->setIfExists('enable_state_api_deployments', $data ?? [], null);
        $this->setIfExists('temporary_disk_size', $data ?? [], null);
        $this->setIfExists('local_disk_size', $data ?? [], null);
        $this->setIfExists('cron_minimum_interval', $data ?? [], null);
        $this->setIfExists('cron_maximum_jitter', $data ?? [], null);
        $this->setIfExists('concurrency_limits', $data ?? [], null);
        $this->setIfExists('flexible_build_cache', $data ?? [], null);
        $this->setIfExists('strict_configuration', $data ?? [], null);
        $this->setIfExists('has_sleepy_crons', $data ?? [], null);
        $this->setIfExists('crons_in_git', $data ?? [], null);
        $this->setIfExists('custom_error_template', $data ?? [], null);
        $this->setIfExists('app_error_page_template', $data ?? [], null);
        $this->setIfExists('environment_name_strategy', $data ?? [], null);
        $this->setIfExists('data_retention', $data ?? [], null);
        $this->setIfExists('enable_codesource_integration_push', $data ?? [], null);
        $this->setIfExists('enforce_mfa', $data ?? [], null);
        $this->setIfExists('systemd', $data ?? [], null);
        $this->setIfExists('router_gen2', $data ?? [], null);
        $this->setIfExists('build_resources', $data ?? [], null);
        $this->setIfExists('outbound_restrictions_default_policy', $data ?? [], null);
        $this->setIfExists('self_upgrade', $data ?? [], null);
        $this->setIfExists('additional_hosts', $data ?? [], null);
        $this->setIfExists('max_allowed_routes', $data ?? [], null);
        $this->setIfExists('max_allowed_redirects_paths', $data ?? [], null);
        $this->setIfExists('enable_incremental_backups', $data ?? [], null);
        $this->setIfExists('sizing_api_enabled', $data ?? [], null);
        $this->setIfExists('enable_cache_grace_period', $data ?? [], null);
        $this->setIfExists('enable_zero_downtime_deployments', $data ?? [], null);
        $this->setIfExists('enable_admin_agent', $data ?? [], null);
        $this->setIfExists('certifier_url', $data ?? [], null);
        $this->setIfExists('centralized_permissions', $data ?? [], null);
        $this->setIfExists('glue_server_max_request_size', $data ?? [], null);
        $this->setIfExists('persistent_endpoints_ssh', $data ?? [], null);
        $this->setIfExists('persistent_endpoints_ssl_certificates', $data ?? [], null);
        $this->setIfExists('enable_disk_health_monitoring', $data ?? [], null);
        $this->setIfExists('enable_paused_environments', $data ?? [], null);
        $this->setIfExists('enable_unified_configuration', $data ?? [], null);
        $this->setIfExists('enable_routes_tracing', $data ?? [], null);
        $this->setIfExists('image_deployment_validation', $data ?? [], null);
        $this->setIfExists('support_generic_images', $data ?? [], null);
        $this->setIfExists('enable_github_app_token_exchange', $data ?? [], null);
        $this->setIfExists('enable_marefs', $data ?? [], null);
        $this->setIfExists('continuous_profiling', $data ?? [], null);
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

        if ($this->container['initialize'] === null) {
            $invalidProperties[] = "'initialize' can't be null";
        }
        if ($this->container['product_name'] === null) {
            $invalidProperties[] = "'product_name' can't be null";
        }
        if ($this->container['product_code'] === null) {
            $invalidProperties[] = "'product_code' can't be null";
        }
        if ($this->container['ui_uri_template'] === null) {
            $invalidProperties[] = "'ui_uri_template' can't be null";
        }
        if ($this->container['variables_prefix'] === null) {
            $invalidProperties[] = "'variables_prefix' can't be null";
        }
        if ($this->container['bot_email'] === null) {
            $invalidProperties[] = "'bot_email' can't be null";
        }
        if ($this->container['application_config_file'] === null) {
            $invalidProperties[] = "'application_config_file' can't be null";
        }
        if ($this->container['project_config_dir'] === null) {
            $invalidProperties[] = "'project_config_dir' can't be null";
        }
        if ($this->container['use_drupal_defaults'] === null) {
            $invalidProperties[] = "'use_drupal_defaults' can't be null";
        }
        if ($this->container['use_legacy_subdomains'] === null) {
            $invalidProperties[] = "'use_legacy_subdomains' can't be null";
        }
        if ($this->container['development_service_size'] === null) {
            $invalidProperties[] = "'development_service_size' can't be null";
        }
        $allowedValues = $this->getDevelopmentServiceSizeAllowableValues();
        if (!is_null($this->container['development_service_size']) && !in_array($this->container['development_service_size'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'development_service_size', must be one of '%s'",
                $this->container['development_service_size'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['development_application_size'] === null) {
            $invalidProperties[] = "'development_application_size' can't be null";
        }
        $allowedValues = $this->getDevelopmentApplicationSizeAllowableValues();
        if (!is_null($this->container['development_application_size']) && !in_array($this->container['development_application_size'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'development_application_size', must be one of '%s'",
                $this->container['development_application_size'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['enable_certificate_provisioning'] === null) {
            $invalidProperties[] = "'enable_certificate_provisioning' can't be null";
        }
        if ($this->container['certificate_style'] === null) {
            $invalidProperties[] = "'certificate_style' can't be null";
        }
        $allowedValues = $this->getCertificateStyleAllowableValues();
        if (!is_null($this->container['certificate_style']) && !in_array($this->container['certificate_style'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'certificate_style', must be one of '%s'",
                $this->container['certificate_style'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['certificate_renewal_activity'] === null) {
            $invalidProperties[] = "'certificate_renewal_activity' can't be null";
        }
        if ($this->container['development_domain_template'] === null) {
            $invalidProperties[] = "'development_domain_template' can't be null";
        }
        if ($this->container['enable_state_api_deployments'] === null) {
            $invalidProperties[] = "'enable_state_api_deployments' can't be null";
        }
        if ($this->container['temporary_disk_size'] === null) {
            $invalidProperties[] = "'temporary_disk_size' can't be null";
        }
        if ($this->container['local_disk_size'] === null) {
            $invalidProperties[] = "'local_disk_size' can't be null";
        }
        if ($this->container['cron_minimum_interval'] === null) {
            $invalidProperties[] = "'cron_minimum_interval' can't be null";
        }
        if ($this->container['cron_maximum_jitter'] === null) {
            $invalidProperties[] = "'cron_maximum_jitter' can't be null";
        }
        if ($this->container['concurrency_limits'] === null) {
            $invalidProperties[] = "'concurrency_limits' can't be null";
        }
        if ($this->container['flexible_build_cache'] === null) {
            $invalidProperties[] = "'flexible_build_cache' can't be null";
        }
        if ($this->container['strict_configuration'] === null) {
            $invalidProperties[] = "'strict_configuration' can't be null";
        }
        if ($this->container['has_sleepy_crons'] === null) {
            $invalidProperties[] = "'has_sleepy_crons' can't be null";
        }
        if ($this->container['crons_in_git'] === null) {
            $invalidProperties[] = "'crons_in_git' can't be null";
        }
        if ($this->container['custom_error_template'] === null) {
            $invalidProperties[] = "'custom_error_template' can't be null";
        }
        if ($this->container['app_error_page_template'] === null) {
            $invalidProperties[] = "'app_error_page_template' can't be null";
        }
        if ($this->container['environment_name_strategy'] === null) {
            $invalidProperties[] = "'environment_name_strategy' can't be null";
        }
        $allowedValues = $this->getEnvironmentNameStrategyAllowableValues();
        if (!is_null($this->container['environment_name_strategy']) && !in_array($this->container['environment_name_strategy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'environment_name_strategy', must be one of '%s'",
                $this->container['environment_name_strategy'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['data_retention'] === null) {
            $invalidProperties[] = "'data_retention' can't be null";
        }
        if ($this->container['enable_codesource_integration_push'] === null) {
            $invalidProperties[] = "'enable_codesource_integration_push' can't be null";
        }
        if ($this->container['enforce_mfa'] === null) {
            $invalidProperties[] = "'enforce_mfa' can't be null";
        }
        if ($this->container['systemd'] === null) {
            $invalidProperties[] = "'systemd' can't be null";
        }
        if ($this->container['router_gen2'] === null) {
            $invalidProperties[] = "'router_gen2' can't be null";
        }
        if ($this->container['build_resources'] === null) {
            $invalidProperties[] = "'build_resources' can't be null";
        }
        if ($this->container['outbound_restrictions_default_policy'] === null) {
            $invalidProperties[] = "'outbound_restrictions_default_policy' can't be null";
        }
        $allowedValues = $this->getOutboundRestrictionsDefaultPolicyAllowableValues();
        if (!is_null($this->container['outbound_restrictions_default_policy']) && !in_array($this->container['outbound_restrictions_default_policy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'outbound_restrictions_default_policy', must be one of '%s'",
                $this->container['outbound_restrictions_default_policy'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['self_upgrade'] === null) {
            $invalidProperties[] = "'self_upgrade' can't be null";
        }
        if ($this->container['additional_hosts'] === null) {
            $invalidProperties[] = "'additional_hosts' can't be null";
        }
        if ($this->container['max_allowed_routes'] === null) {
            $invalidProperties[] = "'max_allowed_routes' can't be null";
        }
        if ($this->container['max_allowed_redirects_paths'] === null) {
            $invalidProperties[] = "'max_allowed_redirects_paths' can't be null";
        }
        if ($this->container['enable_incremental_backups'] === null) {
            $invalidProperties[] = "'enable_incremental_backups' can't be null";
        }
        if ($this->container['sizing_api_enabled'] === null) {
            $invalidProperties[] = "'sizing_api_enabled' can't be null";
        }
        if ($this->container['enable_cache_grace_period'] === null) {
            $invalidProperties[] = "'enable_cache_grace_period' can't be null";
        }
        if ($this->container['enable_zero_downtime_deployments'] === null) {
            $invalidProperties[] = "'enable_zero_downtime_deployments' can't be null";
        }
        if ($this->container['enable_admin_agent'] === null) {
            $invalidProperties[] = "'enable_admin_agent' can't be null";
        }
        if ($this->container['certifier_url'] === null) {
            $invalidProperties[] = "'certifier_url' can't be null";
        }
        if ($this->container['centralized_permissions'] === null) {
            $invalidProperties[] = "'centralized_permissions' can't be null";
        }
        if ($this->container['glue_server_max_request_size'] === null) {
            $invalidProperties[] = "'glue_server_max_request_size' can't be null";
        }
        if ($this->container['persistent_endpoints_ssh'] === null) {
            $invalidProperties[] = "'persistent_endpoints_ssh' can't be null";
        }
        if ($this->container['persistent_endpoints_ssl_certificates'] === null) {
            $invalidProperties[] = "'persistent_endpoints_ssl_certificates' can't be null";
        }
        if ($this->container['enable_disk_health_monitoring'] === null) {
            $invalidProperties[] = "'enable_disk_health_monitoring' can't be null";
        }
        if ($this->container['enable_paused_environments'] === null) {
            $invalidProperties[] = "'enable_paused_environments' can't be null";
        }
        if ($this->container['enable_unified_configuration'] === null) {
            $invalidProperties[] = "'enable_unified_configuration' can't be null";
        }
        if ($this->container['enable_routes_tracing'] === null) {
            $invalidProperties[] = "'enable_routes_tracing' can't be null";
        }
        if ($this->container['image_deployment_validation'] === null) {
            $invalidProperties[] = "'image_deployment_validation' can't be null";
        }
        if ($this->container['support_generic_images'] === null) {
            $invalidProperties[] = "'support_generic_images' can't be null";
        }
        if ($this->container['enable_github_app_token_exchange'] === null) {
            $invalidProperties[] = "'enable_github_app_token_exchange' can't be null";
        }
        if ($this->container['enable_marefs'] === null) {
            $invalidProperties[] = "'enable_marefs' can't be null";
        }
        if ($this->container['continuous_profiling'] === null) {
            $invalidProperties[] = "'continuous_profiling' can't be null";
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
     * Gets initialize
     *
     * @return object
     */
    public function getInitialize()
    {
        return $this->container['initialize'];
    }

    /**
     * Sets initialize
     *
     * @param object $initialize initialize
     *
     * @return self
     */
    public function setInitialize($initialize)
    {
        if (is_null($initialize)) {
            throw new \InvalidArgumentException('non-nullable initialize cannot be null');
        }
        $this->container['initialize'] = $initialize;

        return $this;
    }

    /**
     * Gets product_name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->container['product_name'];
    }

    /**
     * Sets product_name
     *
     * @param string $product_name product_name
     *
     * @return self
     */
    public function setProductName($product_name)
    {
        if (is_null($product_name)) {
            throw new \InvalidArgumentException('non-nullable product_name cannot be null');
        }
        $this->container['product_name'] = $product_name;

        return $this;
    }

    /**
     * Gets product_code
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->container['product_code'];
    }

    /**
     * Sets product_code
     *
     * @param string $product_code product_code
     *
     * @return self
     */
    public function setProductCode($product_code)
    {
        if (is_null($product_code)) {
            throw new \InvalidArgumentException('non-nullable product_code cannot be null');
        }
        $this->container['product_code'] = $product_code;

        return $this;
    }

    /**
     * Gets ui_uri_template
     *
     * @return string
     */
    public function getUiUriTemplate()
    {
        return $this->container['ui_uri_template'];
    }

    /**
     * Sets ui_uri_template
     *
     * @param string $ui_uri_template ui_uri_template
     *
     * @return self
     */
    public function setUiUriTemplate($ui_uri_template)
    {
        if (is_null($ui_uri_template)) {
            throw new \InvalidArgumentException('non-nullable ui_uri_template cannot be null');
        }
        $this->container['ui_uri_template'] = $ui_uri_template;

        return $this;
    }

    /**
     * Gets variables_prefix
     *
     * @return string
     */
    public function getVariablesPrefix()
    {
        return $this->container['variables_prefix'];
    }

    /**
     * Sets variables_prefix
     *
     * @param string $variables_prefix variables_prefix
     *
     * @return self
     */
    public function setVariablesPrefix($variables_prefix)
    {
        if (is_null($variables_prefix)) {
            throw new \InvalidArgumentException('non-nullable variables_prefix cannot be null');
        }
        $this->container['variables_prefix'] = $variables_prefix;

        return $this;
    }

    /**
     * Gets bot_email
     *
     * @return string
     */
    public function getBotEmail()
    {
        return $this->container['bot_email'];
    }

    /**
     * Sets bot_email
     *
     * @param string $bot_email bot_email
     *
     * @return self
     */
    public function setBotEmail($bot_email)
    {
        if (is_null($bot_email)) {
            throw new \InvalidArgumentException('non-nullable bot_email cannot be null');
        }
        $this->container['bot_email'] = $bot_email;

        return $this;
    }

    /**
     * Gets application_config_file
     *
     * @return string
     */
    public function getApplicationConfigFile()
    {
        return $this->container['application_config_file'];
    }

    /**
     * Sets application_config_file
     *
     * @param string $application_config_file application_config_file
     *
     * @return self
     */
    public function setApplicationConfigFile($application_config_file)
    {
        if (is_null($application_config_file)) {
            throw new \InvalidArgumentException('non-nullable application_config_file cannot be null');
        }
        $this->container['application_config_file'] = $application_config_file;

        return $this;
    }

    /**
     * Gets project_config_dir
     *
     * @return string
     */
    public function getProjectConfigDir()
    {
        return $this->container['project_config_dir'];
    }

    /**
     * Sets project_config_dir
     *
     * @param string $project_config_dir project_config_dir
     *
     * @return self
     */
    public function setProjectConfigDir($project_config_dir)
    {
        if (is_null($project_config_dir)) {
            throw new \InvalidArgumentException('non-nullable project_config_dir cannot be null');
        }
        $this->container['project_config_dir'] = $project_config_dir;

        return $this;
    }

    /**
     * Gets use_drupal_defaults
     *
     * @return bool
     */
    public function getUseDrupalDefaults()
    {
        return $this->container['use_drupal_defaults'];
    }

    /**
     * Sets use_drupal_defaults
     *
     * @param bool $use_drupal_defaults use_drupal_defaults
     *
     * @return self
     */
    public function setUseDrupalDefaults($use_drupal_defaults)
    {
        if (is_null($use_drupal_defaults)) {
            throw new \InvalidArgumentException('non-nullable use_drupal_defaults cannot be null');
        }
        $this->container['use_drupal_defaults'] = $use_drupal_defaults;

        return $this;
    }

    /**
     * Gets use_legacy_subdomains
     *
     * @return bool
     */
    public function getUseLegacySubdomains()
    {
        return $this->container['use_legacy_subdomains'];
    }

    /**
     * Sets use_legacy_subdomains
     *
     * @param bool $use_legacy_subdomains use_legacy_subdomains
     *
     * @return self
     */
    public function setUseLegacySubdomains($use_legacy_subdomains)
    {
        if (is_null($use_legacy_subdomains)) {
            throw new \InvalidArgumentException('non-nullable use_legacy_subdomains cannot be null');
        }
        $this->container['use_legacy_subdomains'] = $use_legacy_subdomains;

        return $this;
    }

    /**
     * Gets development_service_size
     *
     * @return string
     */
    public function getDevelopmentServiceSize()
    {
        return $this->container['development_service_size'];
    }

    /**
     * Sets development_service_size
     *
     * @param string $development_service_size development_service_size
     *
     * @return self
     */
    public function setDevelopmentServiceSize($development_service_size)
    {
        if (is_null($development_service_size)) {
            throw new \InvalidArgumentException('non-nullable development_service_size cannot be null');
        }
        $allowedValues = $this->getDevelopmentServiceSizeAllowableValues();
        if (!in_array($development_service_size, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'development_service_size', must be one of '%s'",
                    $development_service_size,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['development_service_size'] = $development_service_size;

        return $this;
    }

    /**
     * Gets development_application_size
     *
     * @return string
     */
    public function getDevelopmentApplicationSize()
    {
        return $this->container['development_application_size'];
    }

    /**
     * Sets development_application_size
     *
     * @param string $development_application_size development_application_size
     *
     * @return self
     */
    public function setDevelopmentApplicationSize($development_application_size)
    {
        if (is_null($development_application_size)) {
            throw new \InvalidArgumentException('non-nullable development_application_size cannot be null');
        }
        $allowedValues = $this->getDevelopmentApplicationSizeAllowableValues();
        if (!in_array($development_application_size, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'development_application_size', must be one of '%s'",
                    $development_application_size,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['development_application_size'] = $development_application_size;

        return $this;
    }

    /**
     * Gets enable_certificate_provisioning
     *
     * @return bool
     */
    public function getEnableCertificateProvisioning()
    {
        return $this->container['enable_certificate_provisioning'];
    }

    /**
     * Sets enable_certificate_provisioning
     *
     * @param bool $enable_certificate_provisioning enable_certificate_provisioning
     *
     * @return self
     */
    public function setEnableCertificateProvisioning($enable_certificate_provisioning)
    {
        if (is_null($enable_certificate_provisioning)) {
            throw new \InvalidArgumentException('non-nullable enable_certificate_provisioning cannot be null');
        }
        $this->container['enable_certificate_provisioning'] = $enable_certificate_provisioning;

        return $this;
    }

    /**
     * Gets certificate_style
     *
     * @return string
     */
    public function getCertificateStyle()
    {
        return $this->container['certificate_style'];
    }

    /**
     * Sets certificate_style
     *
     * @param string $certificate_style certificate_style
     *
     * @return self
     */
    public function setCertificateStyle($certificate_style)
    {
        if (is_null($certificate_style)) {
            throw new \InvalidArgumentException('non-nullable certificate_style cannot be null');
        }
        $allowedValues = $this->getCertificateStyleAllowableValues();
        if (!in_array($certificate_style, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'certificate_style', must be one of '%s'",
                    $certificate_style,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['certificate_style'] = $certificate_style;

        return $this;
    }

    /**
     * Gets certificate_renewal_activity
     *
     * @return bool
     */
    public function getCertificateRenewalActivity()
    {
        return $this->container['certificate_renewal_activity'];
    }

    /**
     * Sets certificate_renewal_activity
     *
     * @param bool $certificate_renewal_activity certificate_renewal_activity
     *
     * @return self
     */
    public function setCertificateRenewalActivity($certificate_renewal_activity)
    {
        if (is_null($certificate_renewal_activity)) {
            throw new \InvalidArgumentException('non-nullable certificate_renewal_activity cannot be null');
        }
        $this->container['certificate_renewal_activity'] = $certificate_renewal_activity;

        return $this;
    }

    /**
     * Gets development_domain_template
     *
     * @return string
     */
    public function getDevelopmentDomainTemplate()
    {
        return $this->container['development_domain_template'];
    }

    /**
     * Sets development_domain_template
     *
     * @param string $development_domain_template development_domain_template
     *
     * @return self
     */
    public function setDevelopmentDomainTemplate($development_domain_template)
    {
        if (is_null($development_domain_template)) {
            array_push($this->openAPINullablesSetToNull, 'development_domain_template');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('development_domain_template', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['development_domain_template'] = $development_domain_template;

        return $this;
    }

    /**
     * Gets enable_state_api_deployments
     *
     * @return bool
     */
    public function getEnableStateApiDeployments()
    {
        return $this->container['enable_state_api_deployments'];
    }

    /**
     * Sets enable_state_api_deployments
     *
     * @param bool $enable_state_api_deployments enable_state_api_deployments
     *
     * @return self
     */
    public function setEnableStateApiDeployments($enable_state_api_deployments)
    {
        if (is_null($enable_state_api_deployments)) {
            throw new \InvalidArgumentException('non-nullable enable_state_api_deployments cannot be null');
        }
        $this->container['enable_state_api_deployments'] = $enable_state_api_deployments;

        return $this;
    }

    /**
     * Gets temporary_disk_size
     *
     * @return int
     */
    public function getTemporaryDiskSize()
    {
        return $this->container['temporary_disk_size'];
    }

    /**
     * Sets temporary_disk_size
     *
     * @param int $temporary_disk_size temporary_disk_size
     *
     * @return self
     */
    public function setTemporaryDiskSize($temporary_disk_size)
    {
        if (is_null($temporary_disk_size)) {
            array_push($this->openAPINullablesSetToNull, 'temporary_disk_size');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('temporary_disk_size', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['temporary_disk_size'] = $temporary_disk_size;

        return $this;
    }

    /**
     * Gets local_disk_size
     *
     * @return int
     */
    public function getLocalDiskSize()
    {
        return $this->container['local_disk_size'];
    }

    /**
     * Sets local_disk_size
     *
     * @param int $local_disk_size local_disk_size
     *
     * @return self
     */
    public function setLocalDiskSize($local_disk_size)
    {
        if (is_null($local_disk_size)) {
            array_push($this->openAPINullablesSetToNull, 'local_disk_size');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('local_disk_size', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['local_disk_size'] = $local_disk_size;

        return $this;
    }

    /**
     * Gets cron_minimum_interval
     *
     * @return int
     */
    public function getCronMinimumInterval()
    {
        return $this->container['cron_minimum_interval'];
    }

    /**
     * Sets cron_minimum_interval
     *
     * @param int $cron_minimum_interval cron_minimum_interval
     *
     * @return self
     */
    public function setCronMinimumInterval($cron_minimum_interval)
    {
        if (is_null($cron_minimum_interval)) {
            throw new \InvalidArgumentException('non-nullable cron_minimum_interval cannot be null');
        }
        $this->container['cron_minimum_interval'] = $cron_minimum_interval;

        return $this;
    }

    /**
     * Gets cron_maximum_jitter
     *
     * @return int
     */
    public function getCronMaximumJitter()
    {
        return $this->container['cron_maximum_jitter'];
    }

    /**
     * Sets cron_maximum_jitter
     *
     * @param int $cron_maximum_jitter cron_maximum_jitter
     *
     * @return self
     */
    public function setCronMaximumJitter($cron_maximum_jitter)
    {
        if (is_null($cron_maximum_jitter)) {
            throw new \InvalidArgumentException('non-nullable cron_maximum_jitter cannot be null');
        }
        $this->container['cron_maximum_jitter'] = $cron_maximum_jitter;

        return $this;
    }

    /**
     * Gets concurrency_limits
     *
     * @return array<string,int>
     */
    public function getConcurrencyLimits()
    {
        return $this->container['concurrency_limits'];
    }

    /**
     * Sets concurrency_limits
     *
     * @param array<string,int> $concurrency_limits concurrency_limits
     *
     * @return self
     */
    public function setConcurrencyLimits($concurrency_limits)
    {
        if (is_null($concurrency_limits)) {
            throw new \InvalidArgumentException('non-nullable concurrency_limits cannot be null');
        }
        $this->container['concurrency_limits'] = $concurrency_limits;

        return $this;
    }

    /**
     * Gets flexible_build_cache
     *
     * @return bool
     */
    public function getFlexibleBuildCache()
    {
        return $this->container['flexible_build_cache'];
    }

    /**
     * Sets flexible_build_cache
     *
     * @param bool $flexible_build_cache flexible_build_cache
     *
     * @return self
     */
    public function setFlexibleBuildCache($flexible_build_cache)
    {
        if (is_null($flexible_build_cache)) {
            throw new \InvalidArgumentException('non-nullable flexible_build_cache cannot be null');
        }
        $this->container['flexible_build_cache'] = $flexible_build_cache;

        return $this;
    }

    /**
     * Gets strict_configuration
     *
     * @return bool
     */
    public function getStrictConfiguration()
    {
        return $this->container['strict_configuration'];
    }

    /**
     * Sets strict_configuration
     *
     * @param bool $strict_configuration strict_configuration
     *
     * @return self
     */
    public function setStrictConfiguration($strict_configuration)
    {
        if (is_null($strict_configuration)) {
            throw new \InvalidArgumentException('non-nullable strict_configuration cannot be null');
        }
        $this->container['strict_configuration'] = $strict_configuration;

        return $this;
    }

    /**
     * Gets has_sleepy_crons
     *
     * @return bool
     */
    public function getHasSleepyCrons()
    {
        return $this->container['has_sleepy_crons'];
    }

    /**
     * Sets has_sleepy_crons
     *
     * @param bool $has_sleepy_crons has_sleepy_crons
     *
     * @return self
     */
    public function setHasSleepyCrons($has_sleepy_crons)
    {
        if (is_null($has_sleepy_crons)) {
            throw new \InvalidArgumentException('non-nullable has_sleepy_crons cannot be null');
        }
        $this->container['has_sleepy_crons'] = $has_sleepy_crons;

        return $this;
    }

    /**
     * Gets crons_in_git
     *
     * @return bool
     */
    public function getCronsInGit()
    {
        return $this->container['crons_in_git'];
    }

    /**
     * Sets crons_in_git
     *
     * @param bool $crons_in_git crons_in_git
     *
     * @return self
     */
    public function setCronsInGit($crons_in_git)
    {
        if (is_null($crons_in_git)) {
            throw new \InvalidArgumentException('non-nullable crons_in_git cannot be null');
        }
        $this->container['crons_in_git'] = $crons_in_git;

        return $this;
    }

    /**
     * Gets custom_error_template
     *
     * @return string
     */
    public function getCustomErrorTemplate()
    {
        return $this->container['custom_error_template'];
    }

    /**
     * Sets custom_error_template
     *
     * @param string $custom_error_template custom_error_template
     *
     * @return self
     */
    public function setCustomErrorTemplate($custom_error_template)
    {
        if (is_null($custom_error_template)) {
            array_push($this->openAPINullablesSetToNull, 'custom_error_template');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('custom_error_template', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['custom_error_template'] = $custom_error_template;

        return $this;
    }

    /**
     * Gets app_error_page_template
     *
     * @return string
     */
    public function getAppErrorPageTemplate()
    {
        return $this->container['app_error_page_template'];
    }

    /**
     * Sets app_error_page_template
     *
     * @param string $app_error_page_template app_error_page_template
     *
     * @return self
     */
    public function setAppErrorPageTemplate($app_error_page_template)
    {
        if (is_null($app_error_page_template)) {
            array_push($this->openAPINullablesSetToNull, 'app_error_page_template');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('app_error_page_template', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['app_error_page_template'] = $app_error_page_template;

        return $this;
    }

    /**
     * Gets environment_name_strategy
     *
     * @return string
     */
    public function getEnvironmentNameStrategy()
    {
        return $this->container['environment_name_strategy'];
    }

    /**
     * Sets environment_name_strategy
     *
     * @param string $environment_name_strategy environment_name_strategy
     *
     * @return self
     */
    public function setEnvironmentNameStrategy($environment_name_strategy)
    {
        if (is_null($environment_name_strategy)) {
            throw new \InvalidArgumentException('non-nullable environment_name_strategy cannot be null');
        }
        $allowedValues = $this->getEnvironmentNameStrategyAllowableValues();
        if (!in_array($environment_name_strategy, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'environment_name_strategy', must be one of '%s'",
                    $environment_name_strategy,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['environment_name_strategy'] = $environment_name_strategy;

        return $this;
    }

    /**
     * Gets data_retention
     *
     * @return array<string,\OpenAPI\Client\Model\DataRetentionConfigurationValue>
     */
    public function getDataRetention()
    {
        return $this->container['data_retention'];
    }

    /**
     * Sets data_retention
     *
     * @param array<string,\OpenAPI\Client\Model\DataRetentionConfigurationValue> $data_retention data_retention
     *
     * @return self
     */
    public function setDataRetention($data_retention)
    {
        if (is_null($data_retention)) {
            array_push($this->openAPINullablesSetToNull, 'data_retention');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('data_retention', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['data_retention'] = $data_retention;

        return $this;
    }

    /**
     * Gets enable_codesource_integration_push
     *
     * @return bool
     */
    public function getEnableCodesourceIntegrationPush()
    {
        return $this->container['enable_codesource_integration_push'];
    }

    /**
     * Sets enable_codesource_integration_push
     *
     * @param bool $enable_codesource_integration_push enable_codesource_integration_push
     *
     * @return self
     */
    public function setEnableCodesourceIntegrationPush($enable_codesource_integration_push)
    {
        if (is_null($enable_codesource_integration_push)) {
            throw new \InvalidArgumentException('non-nullable enable_codesource_integration_push cannot be null');
        }
        $this->container['enable_codesource_integration_push'] = $enable_codesource_integration_push;

        return $this;
    }

    /**
     * Gets enforce_mfa
     *
     * @return bool
     */
    public function getEnforceMfa()
    {
        return $this->container['enforce_mfa'];
    }

    /**
     * Sets enforce_mfa
     *
     * @param bool $enforce_mfa enforce_mfa
     *
     * @return self
     */
    public function setEnforceMfa($enforce_mfa)
    {
        if (is_null($enforce_mfa)) {
            throw new \InvalidArgumentException('non-nullable enforce_mfa cannot be null');
        }
        $this->container['enforce_mfa'] = $enforce_mfa;

        return $this;
    }

    /**
     * Gets systemd
     *
     * @return bool
     */
    public function getSystemd()
    {
        return $this->container['systemd'];
    }

    /**
     * Sets systemd
     *
     * @param bool $systemd systemd
     *
     * @return self
     */
    public function setSystemd($systemd)
    {
        if (is_null($systemd)) {
            throw new \InvalidArgumentException('non-nullable systemd cannot be null');
        }
        $this->container['systemd'] = $systemd;

        return $this;
    }

    /**
     * Gets router_gen2
     *
     * @return bool
     */
    public function getRouterGen2()
    {
        return $this->container['router_gen2'];
    }

    /**
     * Sets router_gen2
     *
     * @param bool $router_gen2 router_gen2
     *
     * @return self
     */
    public function setRouterGen2($router_gen2)
    {
        if (is_null($router_gen2)) {
            throw new \InvalidArgumentException('non-nullable router_gen2 cannot be null');
        }
        $this->container['router_gen2'] = $router_gen2;

        return $this;
    }

    /**
     * Gets build_resources
     *
     * @return \OpenAPI\Client\Model\BuildResources1
     */
    public function getBuildResources()
    {
        return $this->container['build_resources'];
    }

    /**
     * Sets build_resources
     *
     * @param \OpenAPI\Client\Model\BuildResources1 $build_resources build_resources
     *
     * @return self
     */
    public function setBuildResources($build_resources)
    {
        if (is_null($build_resources)) {
            throw new \InvalidArgumentException('non-nullable build_resources cannot be null');
        }
        $this->container['build_resources'] = $build_resources;

        return $this;
    }

    /**
     * Gets outbound_restrictions_default_policy
     *
     * @return string
     */
    public function getOutboundRestrictionsDefaultPolicy()
    {
        return $this->container['outbound_restrictions_default_policy'];
    }

    /**
     * Sets outbound_restrictions_default_policy
     *
     * @param string $outbound_restrictions_default_policy outbound_restrictions_default_policy
     *
     * @return self
     */
    public function setOutboundRestrictionsDefaultPolicy($outbound_restrictions_default_policy)
    {
        if (is_null($outbound_restrictions_default_policy)) {
            throw new \InvalidArgumentException('non-nullable outbound_restrictions_default_policy cannot be null');
        }
        $allowedValues = $this->getOutboundRestrictionsDefaultPolicyAllowableValues();
        if (!in_array($outbound_restrictions_default_policy, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'outbound_restrictions_default_policy', must be one of '%s'",
                    $outbound_restrictions_default_policy,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['outbound_restrictions_default_policy'] = $outbound_restrictions_default_policy;

        return $this;
    }

    /**
     * Gets self_upgrade
     *
     * @return bool
     */
    public function getSelfUpgrade()
    {
        return $this->container['self_upgrade'];
    }

    /**
     * Sets self_upgrade
     *
     * @param bool $self_upgrade self_upgrade
     *
     * @return self
     */
    public function setSelfUpgrade($self_upgrade)
    {
        if (is_null($self_upgrade)) {
            throw new \InvalidArgumentException('non-nullable self_upgrade cannot be null');
        }
        $this->container['self_upgrade'] = $self_upgrade;

        return $this;
    }

    /**
     * Gets additional_hosts
     *
     * @return array<string,string>
     */
    public function getAdditionalHosts()
    {
        return $this->container['additional_hosts'];
    }

    /**
     * Sets additional_hosts
     *
     * @param array<string,string> $additional_hosts additional_hosts
     *
     * @return self
     */
    public function setAdditionalHosts($additional_hosts)
    {
        if (is_null($additional_hosts)) {
            throw new \InvalidArgumentException('non-nullable additional_hosts cannot be null');
        }
        $this->container['additional_hosts'] = $additional_hosts;

        return $this;
    }

    /**
     * Gets max_allowed_routes
     *
     * @return int
     */
    public function getMaxAllowedRoutes()
    {
        return $this->container['max_allowed_routes'];
    }

    /**
     * Sets max_allowed_routes
     *
     * @param int $max_allowed_routes max_allowed_routes
     *
     * @return self
     */
    public function setMaxAllowedRoutes($max_allowed_routes)
    {
        if (is_null($max_allowed_routes)) {
            throw new \InvalidArgumentException('non-nullable max_allowed_routes cannot be null');
        }
        $this->container['max_allowed_routes'] = $max_allowed_routes;

        return $this;
    }

    /**
     * Gets max_allowed_redirects_paths
     *
     * @return int
     */
    public function getMaxAllowedRedirectsPaths()
    {
        return $this->container['max_allowed_redirects_paths'];
    }

    /**
     * Sets max_allowed_redirects_paths
     *
     * @param int $max_allowed_redirects_paths max_allowed_redirects_paths
     *
     * @return self
     */
    public function setMaxAllowedRedirectsPaths($max_allowed_redirects_paths)
    {
        if (is_null($max_allowed_redirects_paths)) {
            throw new \InvalidArgumentException('non-nullable max_allowed_redirects_paths cannot be null');
        }
        $this->container['max_allowed_redirects_paths'] = $max_allowed_redirects_paths;

        return $this;
    }

    /**
     * Gets enable_incremental_backups
     *
     * @return bool
     */
    public function getEnableIncrementalBackups()
    {
        return $this->container['enable_incremental_backups'];
    }

    /**
     * Sets enable_incremental_backups
     *
     * @param bool $enable_incremental_backups enable_incremental_backups
     *
     * @return self
     */
    public function setEnableIncrementalBackups($enable_incremental_backups)
    {
        if (is_null($enable_incremental_backups)) {
            throw new \InvalidArgumentException('non-nullable enable_incremental_backups cannot be null');
        }
        $this->container['enable_incremental_backups'] = $enable_incremental_backups;

        return $this;
    }

    /**
     * Gets sizing_api_enabled
     *
     * @return bool
     */
    public function getSizingApiEnabled()
    {
        return $this->container['sizing_api_enabled'];
    }

    /**
     * Sets sizing_api_enabled
     *
     * @param bool $sizing_api_enabled sizing_api_enabled
     *
     * @return self
     */
    public function setSizingApiEnabled($sizing_api_enabled)
    {
        if (is_null($sizing_api_enabled)) {
            throw new \InvalidArgumentException('non-nullable sizing_api_enabled cannot be null');
        }
        $this->container['sizing_api_enabled'] = $sizing_api_enabled;

        return $this;
    }

    /**
     * Gets enable_cache_grace_period
     *
     * @return bool
     */
    public function getEnableCacheGracePeriod()
    {
        return $this->container['enable_cache_grace_period'];
    }

    /**
     * Sets enable_cache_grace_period
     *
     * @param bool $enable_cache_grace_period enable_cache_grace_period
     *
     * @return self
     */
    public function setEnableCacheGracePeriod($enable_cache_grace_period)
    {
        if (is_null($enable_cache_grace_period)) {
            throw new \InvalidArgumentException('non-nullable enable_cache_grace_period cannot be null');
        }
        $this->container['enable_cache_grace_period'] = $enable_cache_grace_period;

        return $this;
    }

    /**
     * Gets enable_zero_downtime_deployments
     *
     * @return bool
     */
    public function getEnableZeroDowntimeDeployments()
    {
        return $this->container['enable_zero_downtime_deployments'];
    }

    /**
     * Sets enable_zero_downtime_deployments
     *
     * @param bool $enable_zero_downtime_deployments enable_zero_downtime_deployments
     *
     * @return self
     */
    public function setEnableZeroDowntimeDeployments($enable_zero_downtime_deployments)
    {
        if (is_null($enable_zero_downtime_deployments)) {
            throw new \InvalidArgumentException('non-nullable enable_zero_downtime_deployments cannot be null');
        }
        $this->container['enable_zero_downtime_deployments'] = $enable_zero_downtime_deployments;

        return $this;
    }

    /**
     * Gets enable_admin_agent
     *
     * @return bool
     */
    public function getEnableAdminAgent()
    {
        return $this->container['enable_admin_agent'];
    }

    /**
     * Sets enable_admin_agent
     *
     * @param bool $enable_admin_agent enable_admin_agent
     *
     * @return self
     */
    public function setEnableAdminAgent($enable_admin_agent)
    {
        if (is_null($enable_admin_agent)) {
            throw new \InvalidArgumentException('non-nullable enable_admin_agent cannot be null');
        }
        $this->container['enable_admin_agent'] = $enable_admin_agent;

        return $this;
    }

    /**
     * Gets certifier_url
     *
     * @return string
     */
    public function getCertifierUrl()
    {
        return $this->container['certifier_url'];
    }

    /**
     * Sets certifier_url
     *
     * @param string $certifier_url certifier_url
     *
     * @return self
     */
    public function setCertifierUrl($certifier_url)
    {
        if (is_null($certifier_url)) {
            throw new \InvalidArgumentException('non-nullable certifier_url cannot be null');
        }
        $this->container['certifier_url'] = $certifier_url;

        return $this;
    }

    /**
     * Gets centralized_permissions
     *
     * @return bool
     */
    public function getCentralizedPermissions()
    {
        return $this->container['centralized_permissions'];
    }

    /**
     * Sets centralized_permissions
     *
     * @param bool $centralized_permissions centralized_permissions
     *
     * @return self
     */
    public function setCentralizedPermissions($centralized_permissions)
    {
        if (is_null($centralized_permissions)) {
            throw new \InvalidArgumentException('non-nullable centralized_permissions cannot be null');
        }
        $this->container['centralized_permissions'] = $centralized_permissions;

        return $this;
    }

    /**
     * Gets glue_server_max_request_size
     *
     * @return int
     */
    public function getGlueServerMaxRequestSize()
    {
        return $this->container['glue_server_max_request_size'];
    }

    /**
     * Sets glue_server_max_request_size
     *
     * @param int $glue_server_max_request_size glue_server_max_request_size
     *
     * @return self
     */
    public function setGlueServerMaxRequestSize($glue_server_max_request_size)
    {
        if (is_null($glue_server_max_request_size)) {
            throw new \InvalidArgumentException('non-nullable glue_server_max_request_size cannot be null');
        }
        $this->container['glue_server_max_request_size'] = $glue_server_max_request_size;

        return $this;
    }

    /**
     * Gets persistent_endpoints_ssh
     *
     * @return bool
     */
    public function getPersistentEndpointsSsh()
    {
        return $this->container['persistent_endpoints_ssh'];
    }

    /**
     * Sets persistent_endpoints_ssh
     *
     * @param bool $persistent_endpoints_ssh persistent_endpoints_ssh
     *
     * @return self
     */
    public function setPersistentEndpointsSsh($persistent_endpoints_ssh)
    {
        if (is_null($persistent_endpoints_ssh)) {
            throw new \InvalidArgumentException('non-nullable persistent_endpoints_ssh cannot be null');
        }
        $this->container['persistent_endpoints_ssh'] = $persistent_endpoints_ssh;

        return $this;
    }

    /**
     * Gets persistent_endpoints_ssl_certificates
     *
     * @return bool
     */
    public function getPersistentEndpointsSslCertificates()
    {
        return $this->container['persistent_endpoints_ssl_certificates'];
    }

    /**
     * Sets persistent_endpoints_ssl_certificates
     *
     * @param bool $persistent_endpoints_ssl_certificates persistent_endpoints_ssl_certificates
     *
     * @return self
     */
    public function setPersistentEndpointsSslCertificates($persistent_endpoints_ssl_certificates)
    {
        if (is_null($persistent_endpoints_ssl_certificates)) {
            throw new \InvalidArgumentException('non-nullable persistent_endpoints_ssl_certificates cannot be null');
        }
        $this->container['persistent_endpoints_ssl_certificates'] = $persistent_endpoints_ssl_certificates;

        return $this;
    }

    /**
     * Gets enable_disk_health_monitoring
     *
     * @return bool
     */
    public function getEnableDiskHealthMonitoring()
    {
        return $this->container['enable_disk_health_monitoring'];
    }

    /**
     * Sets enable_disk_health_monitoring
     *
     * @param bool $enable_disk_health_monitoring enable_disk_health_monitoring
     *
     * @return self
     */
    public function setEnableDiskHealthMonitoring($enable_disk_health_monitoring)
    {
        if (is_null($enable_disk_health_monitoring)) {
            throw new \InvalidArgumentException('non-nullable enable_disk_health_monitoring cannot be null');
        }
        $this->container['enable_disk_health_monitoring'] = $enable_disk_health_monitoring;

        return $this;
    }

    /**
     * Gets enable_paused_environments
     *
     * @return bool
     */
    public function getEnablePausedEnvironments()
    {
        return $this->container['enable_paused_environments'];
    }

    /**
     * Sets enable_paused_environments
     *
     * @param bool $enable_paused_environments enable_paused_environments
     *
     * @return self
     */
    public function setEnablePausedEnvironments($enable_paused_environments)
    {
        if (is_null($enable_paused_environments)) {
            throw new \InvalidArgumentException('non-nullable enable_paused_environments cannot be null');
        }
        $this->container['enable_paused_environments'] = $enable_paused_environments;

        return $this;
    }

    /**
     * Gets enable_unified_configuration
     *
     * @return bool
     */
    public function getEnableUnifiedConfiguration()
    {
        return $this->container['enable_unified_configuration'];
    }

    /**
     * Sets enable_unified_configuration
     *
     * @param bool $enable_unified_configuration enable_unified_configuration
     *
     * @return self
     */
    public function setEnableUnifiedConfiguration($enable_unified_configuration)
    {
        if (is_null($enable_unified_configuration)) {
            throw new \InvalidArgumentException('non-nullable enable_unified_configuration cannot be null');
        }
        $this->container['enable_unified_configuration'] = $enable_unified_configuration;

        return $this;
    }

    /**
     * Gets enable_routes_tracing
     *
     * @return bool
     */
    public function getEnableRoutesTracing()
    {
        return $this->container['enable_routes_tracing'];
    }

    /**
     * Sets enable_routes_tracing
     *
     * @param bool $enable_routes_tracing enable_routes_tracing
     *
     * @return self
     */
    public function setEnableRoutesTracing($enable_routes_tracing)
    {
        if (is_null($enable_routes_tracing)) {
            throw new \InvalidArgumentException('non-nullable enable_routes_tracing cannot be null');
        }
        $this->container['enable_routes_tracing'] = $enable_routes_tracing;

        return $this;
    }

    /**
     * Gets image_deployment_validation
     *
     * @return bool
     */
    public function getImageDeploymentValidation()
    {
        return $this->container['image_deployment_validation'];
    }

    /**
     * Sets image_deployment_validation
     *
     * @param bool $image_deployment_validation image_deployment_validation
     *
     * @return self
     */
    public function setImageDeploymentValidation($image_deployment_validation)
    {
        if (is_null($image_deployment_validation)) {
            throw new \InvalidArgumentException('non-nullable image_deployment_validation cannot be null');
        }
        $this->container['image_deployment_validation'] = $image_deployment_validation;

        return $this;
    }

    /**
     * Gets support_generic_images
     *
     * @return bool
     */
    public function getSupportGenericImages()
    {
        return $this->container['support_generic_images'];
    }

    /**
     * Sets support_generic_images
     *
     * @param bool $support_generic_images support_generic_images
     *
     * @return self
     */
    public function setSupportGenericImages($support_generic_images)
    {
        if (is_null($support_generic_images)) {
            throw new \InvalidArgumentException('non-nullable support_generic_images cannot be null');
        }
        $this->container['support_generic_images'] = $support_generic_images;

        return $this;
    }

    /**
     * Gets enable_github_app_token_exchange
     *
     * @return bool
     */
    public function getEnableGithubAppTokenExchange()
    {
        return $this->container['enable_github_app_token_exchange'];
    }

    /**
     * Sets enable_github_app_token_exchange
     *
     * @param bool $enable_github_app_token_exchange enable_github_app_token_exchange
     *
     * @return self
     */
    public function setEnableGithubAppTokenExchange($enable_github_app_token_exchange)
    {
        if (is_null($enable_github_app_token_exchange)) {
            throw new \InvalidArgumentException('non-nullable enable_github_app_token_exchange cannot be null');
        }
        $this->container['enable_github_app_token_exchange'] = $enable_github_app_token_exchange;

        return $this;
    }

    /**
     * Gets enable_marefs
     *
     * @return bool
     */
    public function getEnableMarefs()
    {
        return $this->container['enable_marefs'];
    }

    /**
     * Sets enable_marefs
     *
     * @param bool $enable_marefs enable_marefs
     *
     * @return self
     */
    public function setEnableMarefs($enable_marefs)
    {
        if (is_null($enable_marefs)) {
            throw new \InvalidArgumentException('non-nullable enable_marefs cannot be null');
        }
        $this->container['enable_marefs'] = $enable_marefs;

        return $this;
    }

    /**
     * Gets continuous_profiling
     *
     * @return \OpenAPI\Client\Model\TheContinuousProfilingConfiguration
     */
    public function getContinuousProfiling()
    {
        return $this->container['continuous_profiling'];
    }

    /**
     * Sets continuous_profiling
     *
     * @param \OpenAPI\Client\Model\TheContinuousProfilingConfiguration $continuous_profiling continuous_profiling
     *
     * @return self
     */
    public function setContinuousProfiling($continuous_profiling)
    {
        if (is_null($continuous_profiling)) {
            throw new \InvalidArgumentException('non-nullable continuous_profiling cannot be null');
        }
        $this->container['continuous_profiling'] = $continuous_profiling;

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


