<?php
/**
 * ProjectSettingsTest
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
 * Please update the test case below to test the model.
 */

namespace Upsun\Test\Model;

use PHPUnit\Framework\TestCase;

/**
 * ProjectSettingsTest Class Doc Comment
 *
 * @category    Class
 * @description ProjectSettings
 * @package     Upsun
 * @author      OpenAPI Generator team
 * @link        https://openapi-generator.tech
 */
class ProjectSettingsTest extends TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test "ProjectSettings"
     */
    public function testProjectSettings()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "initialize"
     */
    public function testPropertyInitialize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "product_name"
     */
    public function testPropertyProductName()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "product_code"
     */
    public function testPropertyProductCode()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "ui_uri_template"
     */
    public function testPropertyUiUriTemplate()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "variables_prefix"
     */
    public function testPropertyVariablesPrefix()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "bot_email"
     */
    public function testPropertyBotEmail()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "application_config_file"
     */
    public function testPropertyApplicationConfigFile()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "project_config_dir"
     */
    public function testPropertyProjectConfigDir()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "use_drupal_defaults"
     */
    public function testPropertyUseDrupalDefaults()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "use_legacy_subdomains"
     */
    public function testPropertyUseLegacySubdomains()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "development_service_size"
     */
    public function testPropertyDevelopmentServiceSize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "development_application_size"
     */
    public function testPropertyDevelopmentApplicationSize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_certificate_provisioning"
     */
    public function testPropertyEnableCertificateProvisioning()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "certificate_style"
     */
    public function testPropertyCertificateStyle()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "certificate_renewal_activity"
     */
    public function testPropertyCertificateRenewalActivity()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "development_domain_template"
     */
    public function testPropertyDevelopmentDomainTemplate()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_state_api_deployments"
     */
    public function testPropertyEnableStateApiDeployments()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "temporary_disk_size"
     */
    public function testPropertyTemporaryDiskSize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "local_disk_size"
     */
    public function testPropertyLocalDiskSize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "cron_minimum_interval"
     */
    public function testPropertyCronMinimumInterval()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "cron_maximum_jitter"
     */
    public function testPropertyCronMaximumJitter()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "concurrency_limits"
     */
    public function testPropertyConcurrencyLimits()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "flexible_build_cache"
     */
    public function testPropertyFlexibleBuildCache()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "strict_configuration"
     */
    public function testPropertyStrictConfiguration()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "has_sleepy_crons"
     */
    public function testPropertyHasSleepyCrons()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "crons_in_git"
     */
    public function testPropertyCronsInGit()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "custom_error_template"
     */
    public function testPropertyCustomErrorTemplate()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "app_error_page_template"
     */
    public function testPropertyAppErrorPageTemplate()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "environment_name_strategy"
     */
    public function testPropertyEnvironmentNameStrategy()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "data_retention"
     */
    public function testPropertyDataRetention()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_codesource_integration_push"
     */
    public function testPropertyEnableCodesourceIntegrationPush()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enforce_mfa"
     */
    public function testPropertyEnforceMfa()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "systemd"
     */
    public function testPropertySystemd()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "router_gen2"
     */
    public function testPropertyRouterGen2()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "build_resources"
     */
    public function testPropertyBuildResources()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "outbound_restrictions_default_policy"
     */
    public function testPropertyOutboundRestrictionsDefaultPolicy()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "self_upgrade"
     */
    public function testPropertySelfUpgrade()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "additional_hosts"
     */
    public function testPropertyAdditionalHosts()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "max_allowed_routes"
     */
    public function testPropertyMaxAllowedRoutes()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "max_allowed_redirects_paths"
     */
    public function testPropertyMaxAllowedRedirectsPaths()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_incremental_backups"
     */
    public function testPropertyEnableIncrementalBackups()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "sizing_api_enabled"
     */
    public function testPropertySizingApiEnabled()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_cache_grace_period"
     */
    public function testPropertyEnableCacheGracePeriod()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_zero_downtime_deployments"
     */
    public function testPropertyEnableZeroDowntimeDeployments()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_admin_agent"
     */
    public function testPropertyEnableAdminAgent()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "certifier_url"
     */
    public function testPropertyCertifierUrl()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "centralized_permissions"
     */
    public function testPropertyCentralizedPermissions()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "glue_server_max_request_size"
     */
    public function testPropertyGlueServerMaxRequestSize()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "persistent_endpoints_ssh"
     */
    public function testPropertyPersistentEndpointsSsh()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "persistent_endpoints_ssl_certificates"
     */
    public function testPropertyPersistentEndpointsSslCertificates()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_disk_health_monitoring"
     */
    public function testPropertyEnableDiskHealthMonitoring()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_paused_environments"
     */
    public function testPropertyEnablePausedEnvironments()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_unified_configuration"
     */
    public function testPropertyEnableUnifiedConfiguration()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_routes_tracing"
     */
    public function testPropertyEnableRoutesTracing()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "image_deployment_validation"
     */
    public function testPropertyImageDeploymentValidation()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "support_generic_images"
     */
    public function testPropertySupportGenericImages()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "enable_github_app_token_exchange"
     */
    public function testPropertyEnableGithubAppTokenExchange()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "continuous_profiling"
     */
    public function testPropertyContinuousProfiling()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "disable_agent_error_reporter"
     */
    public function testPropertyDisableAgentErrorReporter()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "requires_domain_ownership"
     */
    public function testPropertyRequiresDomainOwnership()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }
}
