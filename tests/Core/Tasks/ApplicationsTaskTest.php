<?php

namespace Upsun\Tests\Core\Tasks;

use GuzzleHttp\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\DeploymentApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\TokenProvider;
use Upsun\UpsunClient;

class ApplicationsTaskTest extends BaseTestCase
{
    private ApplicationsTask $applicationsTask;
    private EnvironmentsTask $environmentsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            new class implements TokenProvider
            {
                public function __invoke(bool $force = false): string
                {
                    return 'Bearer test-token';
                }
            },
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        // Mock EnvironmentsTask for $client->environments->getDeployment()
        $this->environmentsTask = new class (
            $upsunClient,
            new EnvironmentApi(...$apiClassParams),
            new EnvironmentTypeApi(...$apiClassParams),
            new DeploymentApi(...$apiClassParams)
        ) extends EnvironmentsTask {
        };
        $upsunClient->environments = $this->environmentsTask;

        $this->applicationsTask = new class (
            $upsunClient,
        ) extends ApplicationsTask {
        };
    }

    public function testListReturnsWebappsArray(): void
    {
        $projectId = 'test-project';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'fake-deploy-2-0001abcd2345efgh6789ijkl0123mnop4567qrst',
                    '_links' => [
                        'self' => ['href' => 'href'],
                        '#topology' => ['href' => 'href'],
                    ],
                    'created_at' => '2025-09-10T08:30:00+00:00',
                    'updated_at' => null,
                    'fingerprint' => 'deadbeefcafebabef00d1234567890abcdef1234',
                    'cluster_name' => 'fakeproj-dev-cluster',
                    'project_info' => [
                        'title' => 'Fake Project Test',
                        'name' => 'fakeproj',
                        'entropy' => 'ABC123XYZ456FAKEENTROPY====',
                        'namespace' => 'upsun',
                        'organization' => 'ORG1234567890',
                        'capabilities' => [
                            'autoscaling' => ['enabled' => true],
                            'build_resources' => [
                                'enabled' => true,
                                'max_cpu' => 4.0,
                                'max_memory' => 10240,
                            ],
                            'custom_domains' => [
                                'enabled' => true,
                                'environments_with_domains_limit' => 5,
                            ],
                            'data_retention' => ['enabled' => true],
                            'guaranteed_resources' => [
                                'enabled' => false,
                                'instance_limit' => 32,
                            ],
                            'images' => [
                                'elasticsearch-enterprise' => ['*' => ['available' => false]],
                                'mongodb-enterprise' => ['*' => ['available' => false]],
                            ],
                            'instance_limit' => 8,
                            'integrations' => [
                                'enabled' => true,
                                'config' => [
                                    'newrelic' => ['enabled' => true],
                                    'sumologic' => ['enabled' => true],
                                    'splunk' => ['enabled' => true],
                                    'httplog' => ['enabled' => true],
                                    'syslog' => ['enabled' => true],
                                    'webhook' => ['enabled' => true],
                                    'script' => ['enabled' => true],
                                    'github' => ['enabled' => true],
                                    'gitlab' => ['enabled' => true],
                                    'bitbucket' => ['enabled' => true],
                                    'bitbucket_server' => ['enabled' => true],
                                    'health.email' => ['enabled' => true],
                                    'health.webhook' => ['enabled' => true],
                                    'health.pagerduty' => ['enabled' => true],
                                    'health.slack' => ['enabled' => true],
                                    'cdn.fastly' => ['enabled' => true],
                                    'blackfire' => ['enabled' => true, 'role' => 'admin'],
                                    'otlp' => ['enabled' => false],
                                ],
                                'allowed_integrations' => [
                                    'sumologic', 'newrelic', 'splunk', 'httplog', 'syslog', 'webhook', 'script',
                                    'github', 'gitlab', 'bitbucket', 'bitbucket_server', 'health.email',
                                    'health.webhook', 'health.pagerduty', 'health.slack', 'cdn.fastly', 'blackfire',
                                ],
                            ],
                            'logs_forwarding' => ['max_extra_payload_size' => 1048576],
                            'metrics' => ['max_range' => '30d'],
                            'runtime_operations' => ['enabled' => true],
                            'source_operations' => ['enabled' => true],
                        ],
                        'settings' => [
                            'activity_logs_max_size' => 67108864,
                            'additional_hosts' => [],
                            'allow_burst' => true,
                            'allow_manual_deployments' => true,
                            'allow_rolling_deployments' => false,
                            'app_error_page_template' => null,
                            'application_config_file' => '.upsun.app.yaml',
                            'bot_email' => 'bot@fakeproj.com',
                            'build_resources' => [
                                'cpu' => 1.0,
                                'memory' => 2048,
                            ],
                            'centralized_permissions' => true,
                            'certificate_renewal_activity' => true,
                            'certificate_style' => 'ecdsa',
                            'certifier_url' => 'https://ssh.api.platform.sh',
                            'concurrency_limits' => [
                                'internal' => 1,
                                'integration' => 4,
                                'backup' => 2,
                                'cron' => 5,
                                'cron:production' => 1,
                                'default' => 2,
                            ],
                            'continuous_profiling' => [
                                'supported_runtimes' => [
                                    'python', 'golang', 'java', 'ruby', 'php', 'rust', 'nodejs'
                                ],
                            ],
                            'cron_maximum_jitter' => 20,
                            'cron_minimum_interval' => 5,
                            'cron_non_production_expiry_interval' => 30,
                            'cron_production_expiry_interval' => 30,
                            'crons_in_git' => true,
                            'custom_error_template' => null,
                            'data_retention' => [
                                'production' => [
                                    'max_backups' => 4,
                                    'default_config' => [
                                        'manual_count' => 2,
                                        'schedule' => [['interval' => '1d', 'count' => 2]],
                                    ],
                                ],
                                'development' => [
                                    'max_backups' => 2,
                                    'default_config' => ['manual_count' => 2, 'schedule' => []],
                                ],
                            ],
                            'development_application_size' => 'S',
                            'development_domain_template' => null,
                            'development_service_size' => 'S',
                            'disable_agent_error_reporter' => false,
                            'enable_admin_agent' => false,
                            'enable_cache_grace_period' => true,
                            'enable_certificate_provisioning' => true,
                            'enable_codesource_integration_push' => true,
                            'enable_disk_health_monitoring' => true,
                            'enable_github_app_token_exchange' => false,
                            'enable_guaranteed_resources' => false,
                            'enable_incremental_backups' => true,
                            'enable_paused_environments' => true,
                            'enable_routes_tracing' => true,
                            'enable_state_api_deployments' => true,
                            'enable_unified_configuration' => true,
                            'enable_zero_downtime_deployments' => false,
                            'enforce_mfa' => false,
                            'environment_name_strategy' => 'name-and-hash',
                            'flexible_build_cache' => false,
                            'git_server' => ['push_size_hard_limit' => 100],
                            'glue_server_max_request_size' => 10,
                            'has_sleepy_crons' => true,
                            'image_deployment_validation' => true,
                            'initialize' => [],
                            'local_disk_size' => 8192,
                            'max_allowed_redirects_paths' => 50000,
                            'max_allowed_routes' => 50000,
                            'outbound_restrictions_default_policy' => 'allow',
                            'persistent_endpoints_ssh' => true,
                            'persistent_endpoints_ssl_certificates' => true,
                            'product_code' => 'fake',
                            'product_name' => 'FakeProduct',
                            'project_config_dir' => '.fakeproj',
                            'requires_domain_ownership' => false,
                            'router_gen2' => false,
                            'router_resources' => [
                                'baseline_cpu' => 0.05,
                                'baseline_memory' => 128,
                                'max_cpu' => 1.0,
                                'max_memory' => 1024,
                            ],
                            'self_upgrade' => true,
                            'sizing_api_enabled' => true,
                            'strict_configuration' => true,
                            'support_generic_images' => true,
                            'systemd' => false,
                            'temporary_disk_size' => 8192,
                            'ui_uri_template' => 'https://console.fake.com/{organization}/{project}',
                            'use_drupal_defaults' => false,
                            'use_legacy_subdomains' => false,
                            'variables_prefix' => 'FAKE_',
                        ],
                    ],
                    'environment_info' => [
                        'name' => 'dev',
                        'status' => 'active',
                        'is_main' => false,
                        'is_production' => false,
                        'constraints' => [
                            'cluster_type' => 'environment',
                            'deployment_type' => 'development',
                        ],
                        'reference' => 'refs/heads/dev',
                        'machine_name' => 'dev-abc123',
                        'environment_type' => 'development',
                        'links' => [
                            '#ui' => ['href' => 'https://console.fake.com/ORG1234567890/fakeproj/dev'],
                        ],
                    ],
                    'deployment_target' => 'local',
                    'vpn' => null,
                    'http_access' => [
                        'is_enabled' => true,
                        'addresses' => [],
                        'basic_auth' => [],
                    ],
                    'enable_smtp' => false,
                    'restrict_robots' => false,
                    'variables' => [],
                    'access' => [
                        ['entity_id' => 'user-123', 'role' => 'admin'],
                        ['entity_id' => 'user-456', 'role' => 'contributor'],
                    ],
                    'subscription' => [
                        'license_uri' => 'https://accounts.platform.sh/api/v1/licenses/FAKE123',
                        'storage' => 512,
                        'included_users' => 2,
                        'subscription_management_uri' => 'https://console.fake.com/fakeorg/-/billing/plan/FAKE123',
                        'restricted' => false,
                        'suspended' => false,
                        'user_licenses' => 2,
                        'resource_validation_url' => 'href',
                    ],
                    'services' => [],
                    'routes' => [
                        'https://dev-fakeproj.eu-5.platformsh.site/' => [
                            'primary' => true,
                            'id' => 'route4',
                            'production_url' => 'https://dev-fakeproj.eu-5.platformsh.site/',
                            'attributes' => [],
                            'type' => 'upstream',
                            'tls' => [
                                'strict_transport_security' => [
                                    'enabled' => true,
                                    'include_subdomains' => true,
                                    'preload' => false,
                                ],
                                'min_version' => 'TLSv1.2',
                                'client_authentication' => null,
                                'client_certificate_authorities' => [],
                            ],
                            'original_url' => 'https://{all}/',
                            'http_access' => [
                                'is_enabled' => true, 'addresses' => [], 'basic_auth' => []
                            ],
                            'restrict_robots' => false,
                            'cache' => [
                                'enabled' => true,
                                'default_ttl' => 3600,
                                'cookies' => ['SESSIONID'],
                                'headers' => ['Accept', 'Accept-Language'],
                            ],
                            'ssi' => ['enabled' => false],
                            'upstream' => 'app:http',
                            'redirects' => ['expires' => '-1s', 'paths' => []],
                            'sticky' => ['enabled' => false],
                        ],
                        'http://dev-fakeproj.eu-5.platformsh.site/' => [
                            'primary' => false,
                            'id' => 'route5',
                            'production_url' => 'http://dev-fakeproj.eu-5.platformsh.site/',
                            'attributes' => [],
                            'type' => 'redirect',
                            'tls' => [
                                'strict_transport_security' => [
                                    'enabled' => null, 'include_subdomains' => null, 'preload' => null
                                ],
                                'min_version' => null,
                                'client_authentication' => null,
                                'client_certificate_authorities' => [],
                            ],
                            'original_url' => 'http://{all}/',
                            'http_access' => ['is_enabled' => true, 'addresses' => [], 'basic_auth' => []],
                            'restrict_robots' => false,
                            'to' => 'https://dev-fakeproj.eu-5.platformsh.site/',
                            'redirects' => ['expires' => '-1s', 'paths' => []],
                        ],
                    ],
                    'webapps' => [
                        'app' => [
                            'resources' => [
                                'base_memory' => null,
                                'memory_ratio' => null,
                                'profile_size' => '4',
                                'minimum' => [
                                    'cpu' => 0.1,
                                    'memory' => 64,
                                    'cpu_type' => 'shared',
                                    'disk' => 128,
                                    'profile_size' => '0.1',
                                ],
                                'default' => [
                                    'cpu' => 0.5,
                                    'memory' => 224,
                                    'cpu_type' => 'shared',
                                    'disk' => 512,
                                    'profile_size' => '0.5',
                                ],
                                'disk' => [
                                    'temporary' => 8192,
                                    'instance' => 8192,
                                    'storage' => 2000,
                                ],
                            ],
                            'size' => 'AUTO',
                            'disk' => 2000,
                            'access' => ['ssh' => 'contributor'],
                            'relationships' => [],
                            'additional_hosts' => [],
                            'mounts' => [
                                '/var' => ['source' => 'storage', 'source_path' => 'var'],
                                '/data' => ['source' => 'storage', 'source_path' => 'data'],
                            ],
                            'timezone' => null,
                            'variables' => [
                                'php' => ['opcache.preload' => 'config/preload.php'],
                            ],
                            'firewall' => null,
                            'container_profile' => 'HIGH_CPU',
                            'operations' => [],
                            'name' => 'app',
                            'type' => 'php:8.3:545',
                            'preflight' => ['enabled' => true, 'ignored_rules' => []],
                            'tree_id' => 'treeid1234567890abcdef',
                            'app_dir' => '/app',
                            'endpoints' => [
                                'http' => ['scheme' => 'http', 'port' => 80],
                                'php' => ['scheme' => 'http', 'port' => 80],
                            ],
                            'runtime' => [
                                'extensions' => ['apcu', 'blackfire', 'mbstring', 'pdo_sqlite', 'sodium', 'xsl'],
                            ],
                            'web' => [
                                'locations' => [
                                    '/' => [
                                        'root' => 'public',
                                        'expires' => '1h',
                                        'passthru' => '/index.php',
                                        'scripts' => true,
                                        'allow' => true,
                                        'headers' => [],
                                        'rules' => [],
                                    ],
                                ],
                                'move_to_root' => false,
                            ],
                            'hooks' => [
                                'build' => "echo 'fake build';",
                                'deploy' => "echo 'fake deploy';",
                                'post_deploy' => null,
                            ],
                            'crons' => [
                                'security-check' => [
                                    'spec' => '50 23 * * *',
                                    'commands' => ['start' => 'echo cron', 'stop' => null],
                                    'shutdown_timeout' => null,
                                    'timeout' => 86400,
                                ],
                                'clean-expired-sessions' => [
                                    'spec' => '17,47 * * * *',
                                    'commands' => ['start' => 'php-session-clean', 'stop' => null],
                                    'shutdown_timeout' => null,
                                    'timeout' => 86400,
                                ],
                            ],
                            'source' => ['root' => '/', 'operations' => []],
                            'build' => ['flavor' => 'none', 'caches' => []],
                            'dependencies' => ['php' => ['composer' => '^2']],
                            'stack' => [],
                            'is_across_submodule' => false,
                            'instance_count' => 2,
                            'config_id' => 'configid-0001',
                            'slug_id' => 'fake-slug-id-0001',
                            'supports_horizontal_scaling' => true,
                        ],
                    ],
                    'workers' => [],
                    'tasks' => '[]',
                    'container_profiles' => [
                        'BALANCED' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 352, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 640, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 1088, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 1920, 'cpu_type' => 'shared'],
                            '2' => ['cpu' => 2.0, 'memory' => 2800, 'cpu_type' => 'shared'],
                            '4' => ['cpu' => 4.0, 'memory' => 4800, 'cpu_type' => 'shared'],
                            '16.gc' => ['cpu' => 16.0, 'memory' => 65536, 'cpu_type' => 'guaranteed'],
                        ],
                        'HIGHER_MEMORY' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 864, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 1472, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 2368, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 3840, 'cpu_type' => 'shared'],
                        ],
                        'HIGH_CPU' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 128, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 224, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 384, 'cpu_type' => 'shared'],
                            '2' => ['cpu' => 2.0, 'memory' => 704, 'cpu_type' => 'shared'],
                        ],
                        'HIGH_MEMORY' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 448, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 832, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 1408, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 2432, 'cpu_type' => 'shared'],
                        ],
                    ],
                ], JSON_THROW_ON_ERROR)
            ));

        $result = $this->applicationsTask->list($projectId, $environmentId);

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('app', $result);
    }

    public function testListReturnsEmptyArrayIfNoDeployment(): void
    {
        $projectId = 'test-project';
        $environmentId = 'main';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'fake-deploy-2-0001abcd2345efgh6789ijkl0123mnop4567qrst',
                    '_links' => [
                        'self' => ['href' => 'href'],
                        '#topology' => ['href' => 'href'],
                    ],
                    'created_at' => '2025-09-10T08:30:00+00:00',
                    'updated_at' => null,
                    'fingerprint' => 'deadbeefcafebabef00d1234567890abcdef1234',
                    'cluster_name' => 'fakeproj-dev-cluster',
                    'project_info' => [
                        'title' => 'Fake Project Test',
                        'name' => 'fakeproj',
                        'entropy' => 'ABC123XYZ456FAKEENTROPY====',
                        'namespace' => 'upsun',
                        'organization' => 'ORG1234567890',
                        'capabilities' => [
                            'autoscaling' => ['enabled' => true],
                            'build_resources' => [
                                'enabled' => true,
                                'max_cpu' => 4.0,
                                'max_memory' => 10240,
                            ],
                            'custom_domains' => [
                                'enabled' => true,
                                'environments_with_domains_limit' => 5,
                            ],
                            'data_retention' => ['enabled' => true],
                            'guaranteed_resources' => [
                                'enabled' => false,
                                'instance_limit' => 32,
                            ],
                            'images' => [
                                'elasticsearch-enterprise' => ['*' => ['available' => false]],
                                'mongodb-enterprise' => ['*' => ['available' => false]],
                            ],
                            'instance_limit' => 8,
                            'integrations' => [
                                'enabled' => true,
                                'config' => [
                                    'newrelic' => ['enabled' => true],
                                    'sumologic' => ['enabled' => true],
                                    'splunk' => ['enabled' => true],
                                    'httplog' => ['enabled' => true],
                                    'syslog' => ['enabled' => true],
                                    'webhook' => ['enabled' => true],
                                    'script' => ['enabled' => true],
                                    'github' => ['enabled' => true],
                                    'gitlab' => ['enabled' => true],
                                    'bitbucket' => ['enabled' => true],
                                    'bitbucket_server' => ['enabled' => true],
                                    'health.email' => ['enabled' => true],
                                    'health.webhook' => ['enabled' => true],
                                    'health.pagerduty' => ['enabled' => true],
                                    'health.slack' => ['enabled' => true],
                                    'cdn.fastly' => ['enabled' => true],
                                    'blackfire' => ['enabled' => true, 'role' => 'admin'],
                                    'otlp' => ['enabled' => false],
                                ],
                                'allowed_integrations' => [
                                    'sumologic', 'newrelic', 'splunk', 'httplog', 'syslog', 'webhook', 'script',
                                    'github', 'gitlab', 'bitbucket', 'bitbucket_server', 'health.email',
                                    'health.webhook', 'health.pagerduty', 'health.slack', 'cdn.fastly', 'blackfire',
                                ],
                            ],
                            'logs_forwarding' => ['max_extra_payload_size' => 1048576],
                            'metrics' => ['max_range' => '30d'],
                            'runtime_operations' => ['enabled' => true],
                            'source_operations' => ['enabled' => true],
                        ],
                        'settings' => [
                            'activity_logs_max_size' => 67108864,
                            'additional_hosts' => [],
                            'allow_burst' => true,
                            'allow_manual_deployments' => true,
                            'allow_rolling_deployments' => false,
                            'app_error_page_template' => null,
                            'application_config_file' => '.upsun.app.yaml',
                            'bot_email' => 'bot@fakeproj.com',
                            'build_resources' => [
                                'cpu' => 1.0,
                                'memory' => 2048,
                            ],
                            'centralized_permissions' => true,
                            'certificate_renewal_activity' => true,
                            'certificate_style' => 'ecdsa',
                            'certifier_url' => 'https://ssh.api.platform.sh',
                            'concurrency_limits' => [
                                'internal' => 1,
                                'integration' => 4,
                                'backup' => 2,
                                'cron' => 5,
                                'cron:production' => 1,
                                'default' => 2,
                            ],
                            'continuous_profiling' => [
                                'supported_runtimes' => [
                                    'python', 'golang', 'java', 'ruby', 'php', 'rust', 'nodejs'
                                ],
                            ],
                            'cron_maximum_jitter' => 20,
                            'cron_minimum_interval' => 5,
                            'cron_non_production_expiry_interval' => 30,
                            'cron_production_expiry_interval' => 30,
                            'crons_in_git' => true,
                            'custom_error_template' => null,
                            'data_retention' => [
                                'production' => [
                                    'max_backups' => 4,
                                    'default_config' => [
                                        'manual_count' => 2,
                                        'schedule' => [['interval' => '1d', 'count' => 2]],
                                    ],
                                ],
                                'development' => [
                                    'max_backups' => 2,
                                    'default_config' => ['manual_count' => 2, 'schedule' => []],
                                ],
                            ],
                            'development_application_size' => 'S',
                            'development_domain_template' => null,
                            'development_service_size' => 'S',
                            'disable_agent_error_reporter' => false,
                            'enable_admin_agent' => false,
                            'enable_cache_grace_period' => true,
                            'enable_certificate_provisioning' => true,
                            'enable_codesource_integration_push' => true,
                            'enable_disk_health_monitoring' => true,
                            'enable_github_app_token_exchange' => false,
                            'enable_guaranteed_resources' => false,
                            'enable_incremental_backups' => true,
                            'enable_paused_environments' => true,
                            'enable_routes_tracing' => true,
                            'enable_state_api_deployments' => true,
                            'enable_unified_configuration' => true,
                            'enable_zero_downtime_deployments' => false,
                            'enforce_mfa' => false,
                            'environment_name_strategy' => 'name-and-hash',
                            'flexible_build_cache' => false,
                            'git_server' => ['push_size_hard_limit' => 100],
                            'glue_server_max_request_size' => 10,
                            'has_sleepy_crons' => true,
                            'image_deployment_validation' => true,
                            'initialize' => [],
                            'local_disk_size' => 8192,
                            'max_allowed_redirects_paths' => 50000,
                            'max_allowed_routes' => 50000,
                            'outbound_restrictions_default_policy' => 'allow',
                            'persistent_endpoints_ssh' => true,
                            'persistent_endpoints_ssl_certificates' => true,
                            'product_code' => 'fake',
                            'product_name' => 'FakeProduct',
                            'project_config_dir' => '.fakeproj',
                            'requires_domain_ownership' => false,
                            'router_gen2' => false,
                            'router_resources' => [
                                'baseline_cpu' => 0.05,
                                'baseline_memory' => 128,
                                'max_cpu' => 1.0,
                                'max_memory' => 1024,
                            ],
                            'self_upgrade' => true,
                            'sizing_api_enabled' => true,
                            'strict_configuration' => true,
                            'support_generic_images' => true,
                            'systemd' => false,
                            'temporary_disk_size' => 8192,
                            'ui_uri_template' => 'https://console.fake.com/{organization}/{project}',
                            'use_drupal_defaults' => false,
                            'use_legacy_subdomains' => false,
                            'variables_prefix' => 'FAKE_',
                        ],
                    ],
                    'environment_info' => [
                        'name' => 'dev',
                        'status' => 'active',
                        'is_main' => false,
                        'is_production' => false,
                        'constraints' => [
                            'cluster_type' => 'environment',
                            'deployment_type' => 'development',
                        ],
                        'reference' => 'refs/heads/dev',
                        'machine_name' => 'dev-abc123',
                        'environment_type' => 'development',
                        'links' => [
                            '#ui' => ['href' => 'https://console.fake.com/ORG1234567890/fakeproj/dev'],
                        ],
                    ],
                    'deployment_target' => 'local',
                    'vpn' => null,
                    'http_access' => [
                        'is_enabled' => true,
                        'addresses' => [],
                        'basic_auth' => [],
                    ],
                    'enable_smtp' => false,
                    'restrict_robots' => false,
                    'variables' => [],
                    'access' => [
                        ['entity_id' => 'user-123', 'role' => 'admin'],
                        ['entity_id' => 'user-456', 'role' => 'contributor'],
                    ],
                    'subscription' => [
                        'license_uri' => 'https://accounts.platform.sh/api/v1/licenses/FAKE123',
                        'storage' => 512,
                        'included_users' => 2,
                        'subscription_management_uri' => 'https://console.fake.com/fakeorg/-/billing/plan/FAKE123',
                        'restricted' => false,
                        'suspended' => false,
                        'user_licenses' => 2,
                        'resource_validation_url' => 'href',
                    ],
                    'services' => [],
                    'routes' => [
                        'https://dev-fakeproj.eu-5.platformsh.site/' => [
                            'primary' => true,
                            'id' => 'route4',
                            'production_url' => 'https://dev-fakeproj.eu-5.platformsh.site/',
                            'attributes' => [],
                            'type' => 'upstream',
                            'tls' => [
                                'strict_transport_security' => [
                                    'enabled' => true,
                                    'include_subdomains' => true,
                                    'preload' => false,
                                ],
                                'min_version' => 'TLSv1.2',
                                'client_authentication' => null,
                                'client_certificate_authorities' => [],
                            ],
                            'original_url' => 'https://{all}/',
                            'http_access' => [
                                'is_enabled' => true, 'addresses' => [], 'basic_auth' => []
                            ],
                            'restrict_robots' => false,
                            'cache' => [
                                'enabled' => true,
                                'default_ttl' => 3600,
                                'cookies' => ['SESSIONID'],
                                'headers' => ['Accept', 'Accept-Language'],
                            ],
                            'ssi' => ['enabled' => false],
                            'upstream' => 'app:http',
                            'redirects' => ['expires' => '-1s', 'paths' => []],
                            'sticky' => ['enabled' => false],
                        ],
                        'http://dev-fakeproj.eu-5.platformsh.site/' => [
                            'primary' => false,
                            'id' => 'route5',
                            'production_url' => 'http://dev-fakeproj.eu-5.platformsh.site/',
                            'attributes' => [],
                            'type' => 'redirect',
                            'tls' => [
                                'strict_transport_security' => [
                                    'enabled' => null, 'include_subdomains' => null, 'preload' => null
                                ],
                                'min_version' => null,
                                'client_authentication' => null,
                                'client_certificate_authorities' => [],
                            ],
                            'original_url' => 'http://{all}/',
                            'http_access' => ['is_enabled' => true, 'addresses' => [], 'basic_auth' => []],
                            'restrict_robots' => false,
                            'to' => 'https://dev-fakeproj.eu-5.platformsh.site/',
                            'redirects' => ['expires' => '-1s', 'paths' => []],
                        ],
                    ],
                    'webapps' => [],
                    'workers' => [],
                    'tasks' => '[]',
                    'container_profiles' => [
                        'BALANCED' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 352, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 640, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 1088, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 1920, 'cpu_type' => 'shared'],
                            '2' => ['cpu' => 2.0, 'memory' => 2800, 'cpu_type' => 'shared'],
                            '4' => ['cpu' => 4.0, 'memory' => 4800, 'cpu_type' => 'shared'],
                            '16.gc' => ['cpu' => 16.0, 'memory' => 65536, 'cpu_type' => 'guaranteed'],
                        ],
                        'HIGHER_MEMORY' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 864, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 1472, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 2368, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 3840, 'cpu_type' => 'shared'],
                        ],
                        'HIGH_CPU' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 128, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 224, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 384, 'cpu_type' => 'shared'],
                            '2' => ['cpu' => 2.0, 'memory' => 704, 'cpu_type' => 'shared'],
                        ],
                        'HIGH_MEMORY' => [
                            '0.1' => ['cpu' => 0.1, 'memory' => 448, 'cpu_type' => 'shared'],
                            '0.25' => ['cpu' => 0.25, 'memory' => 832, 'cpu_type' => 'shared'],
                            '0.5' => ['cpu' => 0.5, 'memory' => 1408, 'cpu_type' => 'shared'],
                            '1' => ['cpu' => 1.0, 'memory' => 2432, 'cpu_type' => 'shared'],
                        ],
                    ],
                ], JSON_THROW_ON_ERROR)
            ));

        $result = $this->applicationsTask->list($projectId, $environmentId);

        $this->assertSame([], $result);
    }
}
