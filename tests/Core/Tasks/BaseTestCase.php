<?php

namespace Upsun\Tests\Core\Tasks;

use DateTime;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Core\OAuthProvider;

abstract class BaseTestCase extends TestCase
{
    /**
     * Assert that an object's properties match expected values.
     * Supports nested objects, arrays, and DateTime conversion.
     *
     * @throws Exception
     */
    protected function assertObjectProperties(mixed $actual, mixed $expected, string $prefix = ''): void
    {
        // Case objet
        if (is_object($actual) && is_iterable($expected)) {
            foreach ($expected as $key => $value) {
                $getter = 'get' . ucfirst($key);
                if (!method_exists($actual, $getter)) {
                    continue;
                }

                $propValue = $actual->$getter();
                $this->assertObjectProperties($propValue, $value, sprintf('%s%s.', $prefix, $key));
            }

            return;
        }

        // Case array
        if (is_array($actual) && is_iterable($expected)) {
            foreach ($actual as $idx => $item) {
                $expectedItem = $expected[$idx] ?? $expected;
                $this->assertObjectProperties($item, $expectedItem, $prefix . sprintf('[%s].', $idx));
            }

            return;
        }

        // Case DateTime
        if ($actual instanceof DateTime) {
            if (!($expected instanceof DateTime)) {
                $expected = new DateTime($expected);
            }

            $this->assertEquals(
                $expected->getTimestamp(),
                $actual->getTimestamp(),
                'Failed asserting equality at ' . $prefix
            );
            return;
        }

        $this->assertEquals(
            $expected,
            $actual,
            'Failed asserting equality at ' . $prefix
        );
    }

    /**
     * Compare list of objects (ex: Activity[]) with expected array.
     *
     * @throws Exception
     */
    protected function assertObjectMatchesArray(array $actual, array $expected, string $prefix = ''): void
    {
        $this->assertCount(
            count($expected),
            $actual,
            'Array size mismatch at ' . $prefix
        );

        // Case objet
        foreach ($actual as $index => $object) {
            $this->assertObjectProperties(
                $object,
                $expected[$index],
                $prefix . sprintf('[%s].', $index)
            );
        }
    }

    /**
     * Create standard API class parameters for testing.
     * Returns array: [OAuthProvider, ClientInterface, Psr17Factory, ApiConfiguration]
     *
     * @param ClientInterface|null $httpClient Optional HTTP client mock to use
     * @return array
     */
    protected function createApiClassParams(?ClientInterface $httpClient = null): array
    {
        if ($httpClient === null) {
            $httpClient = $this->createMock(ClientInterface::class);
        }

        return [
            $this->createMock(OAuthProvider::class),
            $httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];
    }

    /**
     * Create a standard HTTP response mock.
     *
     * @param int $statusCode HTTP status code (default: 200)
     * @param array $data Response body data (will be JSON encoded)
     * @param array $headers Response headers (default: ['Content-Type' => 'application/json'])
     * @return Response
     */
    protected function createJsonResponse(
        int $statusCode = 200,
        array $data = [],
        array $headers = ['Content-Type' => 'application/json']
    ): Response {
        return new Response(
            $statusCode,
            $headers,
            json_encode($data)
        );
    }

    /**
     * Create a standard error response mock.
     *
     * @param int $statusCode HTTP error status code (default: 404)
     * @param string $message Error message (default: 'Not found')
     * @return Response
     */
    protected function createErrorResponse(int $statusCode = 404, string $message = 'Not found'): Response
    {
        return new Response(
            $statusCode,
            ['Content-Type' => 'application/json'],
            json_encode(['message' => $message])
        );
    }

    /**
     * Assert that an ApiException was thrown with a specific HTTP status code.
     *
     * @param int $expectedStatusCode Expected HTTP status code
     * @param callable $callback Code to execute that should throw the exception
     */
    protected function assertApiExceptionWithCode(int $expectedStatusCode, callable $callback): void
    {
        try {
            $callback();
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException $e) {
            $this->assertEquals(
                $expectedStatusCode,
                $e->getCode(),
                sprintf('Expected ApiException with code %d, got %d', $expectedStatusCode, $e->getCode())
            );
        }
    }

    /**
     * Generate a random project ID for testing.
     *
     * @param string $prefix Optional prefix (default: 'test-project')
     * @return string
     */
    protected function generateProjectId(string $prefix = 'test-project'): string
    {
        return $prefix . '-' . bin2hex(random_bytes(8));
    }

    /**
     * Generate a random environment ID for testing.
     *
     * @param string $prefix Optional prefix (default: 'test-env')
     * @return string
     */
    protected function generateEnvironmentId(string $prefix = 'test-env'): string
    {
        return $prefix . '-' . bin2hex(random_bytes(4));
    }

    /**
     * Generate a random organization ID for testing.
     *
     * @param string $prefix Optional prefix (default: 'test-org')
     * @return string
     */
    protected function generateOrganizationId(string $prefix = 'test-org'): string
    {
        return $prefix . '-' . bin2hex(random_bytes(8));
    }

    /**
     * Create a mock HTTP client that returns a specific response.
     *
     * @param Response $response Response to return
     * @param int $expectedCalls Number of times the client should be called (default: 1)
     * @return ClientInterface&MockObject
     */
    protected function createMockHttpClient(Response $response, int $expectedCalls = 1): ClientInterface
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->exactly($expectedCalls))
            ->method('sendRequest')
            ->willReturn($response);

        return $httpClient;
    }

    /**
     * Create a mock HTTP client that throws an ApiException with specified status code.
     *
     * @param int $statusCode HTTP error status code
     * @param string $message Error message
     * @return ClientInterface&MockObject
     */
    protected function createMockHttpClientWithError(int $statusCode, string $message = 'Error'): ClientInterface
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->method('sendRequest')
            ->willReturn($this->createErrorResponse($statusCode, $message));

        return $httpClient;
    }

    protected function getFakeDeployment(?array $webapps = null, ?array $services = null, ?array $workers = null): array
    {
        $webapps = $webapps ?? [
            'app' => [
                'resources' => [
                    'base_memory' => null,
                    'memory_ratio' => null,
                    'profile_size' => '1',
                    'minimum' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared', 'disk' => 128, 'profile_size' => '0.1'],
                    'default' => ['cpu' => 0.5, 'memory' => 224, 'cpu_type' => 'shared', 'disk' => 512, 'profile_size' => '0.5'],
                    'disk' => ['temporary' => 8192, 'instance' => 8192, 'storage' => 1024],
                ],
                'size' => 'AUTO',
                'disk' => 1024,
                'access' => ['ssh' => 'contributor'],
                'relationships' => [
                    'database' => ['service' => 'mysql', 'endpoint' => 'mysql'],
                    'cache' => ['service' => 'redis', 'endpoint' => 'redis'],
                ],
                'additional_hosts' => [],
                'mounts' => [
                    '/var/cache' => ['source' => 'local', 'source_path' => 'var/cache'],
                    '/var/share' => ['source' => 'storage', 'source_path' => 'var/share'],
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
                'type' => 'php:8.3',
                'preflight' => [
                    'enabled' => true,
                    'ignored_rules' => [],
                ],
                'tree_id' => 'tree-fake-001',
                'app_dir' => '/app',
                'endpoints' => [
                    'http' => ['scheme' => 'http', 'port' => 80],
                    'php' => ['scheme' => 'http', 'port' => 80],
                ],
                'runtime' => ['extensions' => ['ctype', 'iconv']],
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
                    'build' => 'set -e',
                    'deploy' => 'set -e',
                    'post_deploy' => null,
                ],
                'crons' => [
                    'security-check' => [
                        'spec' => '50 23 * * *',
                        'commands' => ['start' => 'if [ "$PLATFORM_ENVIRONMENT_TYPE" = "production" ]; then croncape echo "fake-security-check"; fi', 'stop' => null],
                        'shutdown_timeout' => null,
                        'timeout' => 86400,
                    ],
                    'clean-expired-sessions' => [
                        'spec' => '17,47 * * * *',
                        'commands' => ['start' => 'croncape php-session-clean', 'stop' => null],
                        'shutdown_timeout' => null,
                        'timeout' => 86400,
                    ],
                ],
                'source' => ['root' => '/', 'operations' => []],
                'build' => ['flavor' => 'none', 'caches' => []],
                'dependencies' => [],
                'stack' => ['runtimes' => [], 'packages' => []],
                'is_across_submodule' => false,
                'instance_count' => 2,
                'config_id' => 'cfg-fake-001',
                'slug_id' => 'slug-fake-001',
                'supports_horizontal_scaling' => true,
            ],
            'backend' => [
                'resources' => [
                    'base_memory' => null,
                    'memory_ratio' => null,
                    'profile_size' => '1',
                    'minimum' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared', 'disk' => 128, 'profile_size' => '0.1'],
                    'default' => ['cpu' => 0.5, 'memory' => 224, 'cpu_type' => 'shared', 'disk' => 512, 'profile_size' => '0.5'],
                    'disk' => ['temporary' => 8192, 'instance' => 8192, 'storage' => 1024],
                ],
                'size' => 'AUTO',
                'disk' => 1024,
                'access' => ['ssh' => 'contributor'],
                'relationships' => [
                    'database' => ['service' => 'mysql', 'endpoint' => 'mysql'],
                    'cache' => ['service' => 'redis', 'endpoint' => 'redis'],
                ],
                'additional_hosts' => [],
                'mounts' => [
                    '/var/cache' => ['source' => 'local', 'source_path' => 'var/cache'],
                    '/var/share' => ['source' => 'storage', 'source_path' => 'var/share'],
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
                'type' => 'php:8.3',
                'preflight' => [
                    'enabled' => true,
                    'ignored_rules' => [],
                ],
                'tree_id' => 'tree-fake-001',
                'app_dir' => '/app',
                'endpoints' => [
                    'http' => ['scheme' => 'http', 'port' => 80],
                    'php' => ['scheme' => 'http', 'port' => 80],
                ],
                'runtime' => ['extensions' => ['ctype', 'iconv']],
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
                    'build' => 'set -e',
                    'deploy' => 'set -e',
                    'post_deploy' => null,
                ],
                'crons' => [
                    'security-check' => [
                        'spec' => '50 23 * * *',
                        'commands' => ['start' => 'if [ "$PLATFORM_ENVIRONMENT_TYPE" = "production" ]; then croncape echo "fake-security-check"; fi', 'stop' => null],
                        'shutdown_timeout' => null,
                        'timeout' => 86400,
                    ],
                    'clean-expired-sessions' => [
                        'spec' => '17,47 * * * *',
                        'commands' => ['start' => 'croncape php-session-clean', 'stop' => null],
                        'shutdown_timeout' => null,
                        'timeout' => 86400,
                    ],
                ],
                'source' => ['root' => '/', 'operations' => []],
                'build' => ['flavor' => 'none', 'caches' => []],
                'dependencies' => [],
                'stack' => ['runtimes' => [], 'packages' => []],
                'is_across_submodule' => false,
                'instance_count' => 2,
                'config_id' => 'cfg-fake-001',
                'slug_id' => 'slug-fake-001',
                'supports_horizontal_scaling' => true,
            ],
        ];

        $services = $services ?? [
            'mysql' => [
                'type' => 'mariadb:11.8:37',
                'size' => 'AUTO',
                'disk' => 2048,
                'access' => [],
                'configuration' => [
                    'schemas' => ['main'],
                    'endpoints' => [
                        'mysql' => [
                            'default_schema' => 'main',
                            'privileges' => ['main' => 'admin'],
                        ],
                    ],
                    'backwards_compatibility_mode' => true,
                ],
                'relationships' => [],
                'firewall' => null,
                'resources' => [
                    'base_memory' => null,
                    'memory_ratio' => null,
                    'profile_size' => '1',
                    'minimum' => ['cpu' => 0.1, 'memory' => 448, 'cpu_type' => 'shared', 'disk' => 256, 'profile_size' => '0.1'],
                    'default' => ['cpu' => 0.5, 'memory' => 1408, 'cpu_type' => 'shared', 'disk' => 512, 'profile_size' => '0.5'],
                    'disk' => ['temporary' => 8192, 'instance' => 8192, 'storage' => 2048],
                ],
                'container_profile' => 'HIGH_MEMORY',
                'endpoints' => [
                    'mysql' => [
                        'scheme' => 'mysql',
                        'port' => 3306,
                        'default' => true,
                        'path' => 'main',
                        'username' => '',
                        'password' => '',
                        'query' => ['is_master' => true],
                    ],
                    'mysql-all' => [
                        'scheme' => 'mysql',
                        'port' => 3306,
                        'default' => false,
                        'path' => 'main',
                        'username' => '',
                        'password' => '',
                        'query' => ['is_master' => true],
                    ],
                    'mysql-replica' => [
                        'scheme' => 'mysql',
                        'port' => 3306,
                        'default' => false,
                        'path' => 'main',
                        'username' => '',
                        'password' => '',
                        'query' => ['is_master' => false],
                    ],
                ],
                'instance_count' => 1,
                'supports_horizontal_scaling' => false,
            ],
            'redis' => [
                'type' => 'redis:6.2:401',
                'size' => 'AUTO',
                'disk' => null,
                'access' => [],
                'configuration' => [],
                'relationships' => [],
                'firewall' => null,
                'resources' => [
                    'base_memory' => null,
                    'memory_ratio' => null,
                    'profile_size' => '0.5',
                    'minimum' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared', 'disk' => null, 'profile_size' => '0.1'],
                    'default' => ['cpu' => 0.5, 'memory' => 1088, 'cpu_type' => 'shared', 'disk' => null, 'profile_size' => '0.5'],
                    'disk' => ['temporary' => 8192, 'instance' => 8192, 'storage' => null],
                ],
                'container_profile' => 'BALANCED',
                'endpoints' => [
                    'redis' => ['scheme' => 'redis', 'port' => 6379, 'default' => true],
                    'redis-replica' => ['scheme' => 'redis', 'port' => 6379],
                ],
                'instance_count' => 1,
                'supports_horizontal_scaling' => false,
            ],
        ];

        $workers = $workers ?? [
            'app--app-worker' => [
                'resources' => [
                    'base_memory' => null,
                    'memory_ratio' => null,
                    'profile_size' => '1',
                    'minimum' => ['cpu' => 0.1, 'memory' => 64, 'cpu_type' => 'shared', 'disk' => null, 'profile_size' => '0.1'],
                    'default' => ['cpu' => 0.5, 'memory' => 224, 'cpu_type' => 'shared', 'disk' => null, 'profile_size' => '0.5'],
                    'disk' => ['temporary' => 8192, 'instance' => 8192, 'storage' => null],
                ],
                'size' => 'AUTO',
                'disk' => null,
                'access' => ['ssh' => 'contributor'],
                'relationships' => [
                    'database' => ['service' => 'mysql', 'endpoint' => 'mysql'],
                    'cache' => ['service' => 'redis', 'endpoint' => 'redis'],
                ],
                'additional_hosts' => [],
                'mounts' => [
                    '/var/cache' => ['source' => 'local', 'source_path' => 'var/cache'],
                    '/var/share' => ['source' => 'storage', 'source_path' => 'var/share'],
                    '/data' => ['source' => 'storage', 'source_path' => 'data'],
                ],
                'timezone' => null,
                'variables' => [
                    'php' => ['opcache.preload' => 'config/preload.php'],
                ],
                'firewall' => null,
                'container_profile' => 'HIGH_CPU',
                'operations' => [],
                'name' => 'app--app-worker',
                'type' => 'php:8.3',
                'preflight' => [
                    'enabled' => true,
                    'ignored_rules' => [],
                ],
                'tree_id' => 'tree-fake-001',
                'app_dir' => '/app',
                'endpoints' => [],
                'runtime' => ['extensions' => ['ctype', 'iconv']],
                'worker' => ['commands' => ['start' => 'php bin/worker.php']],
                'app' => 'app',
                'stack' => ['runtimes' => [], 'packages' => []],
                'instance_count' => 2,
                'slug_id' => 'slug-worker-fake-001',
                'supports_horizontal_scaling' => true,
            ],
        ];

        return [
            'id' => 'current',
            '_links' => [
                'self' => ['href' => 'https://api.fake.local/deployments/current'],
                '#sboms' => ['href' => '/api/fake/deployments/current/sboms'],
                '#topology' => ['href' => 'https://api.fake.local/deployments/current/topology'],
                '#operations' => ['href' => '/api/fake/deployments/current/operations'],
                '#edit' => ['href' => '/api/fake/deployments/next'],
            ],
            'created_at' => '2026-03-06T10:00:00+00:00',
            'updated_at' => null,
            'fingerprint' => sha1('fake-fingerprint'),
            'cluster_name' => 'fake-cluster-main',
            'project_info' => [
                'title' => 'Fake Project',
                'name' => 'fake-project',
                'entropy' => 'FAKE_ENTROPY',
                'namespace' => 'upsun',
                'organization' => 'ORG_FAKE_001',
                'capabilities' => [
                    'autoscaling' => ['enabled' => true],
                    'build_resources' => ['enabled' => true, 'max_cpu' => 4.0, 'max_memory' => 10240],
                    'custom_domains' => ['enabled' => true, 'environments_with_domains_limit' => 5],
                    'data_retention' => ['enabled' => true],
                    'guaranteed_resources' => ['enabled' => false, 'instance_limit' => 32],
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
                            'otlplog' => ['enabled' => false],
                        ],
                        'allowed_integrations' => [
                            'sumologic', 'newrelic', 'splunk', 'httplog', 'syslog',
                            'webhook', 'script', 'github', 'gitlab', 'bitbucket',
                            'bitbucket_server', 'health.email', 'health.webhook',
                            'health.pagerduty', 'health.slack', 'cdn.fastly', 'blackfire',
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
                    'allow_activity_reschedule' => false,
                    'allow_burst' => false,
                    'allow_manual_deployments' => true,
                    'allow_rolling_deployments' => true,
                    'allow_scaling_to_zero' => false,
                    'app_error_page_template' => null,
                    'application_config_file' => '.upsun.app.yaml',
                    'bot_email' => 'bot@fake.local',
                    'build_resources' => ['cpu' => 1.0, 'memory' => 2048],
                    'centralized_permissions' => true,
                    'certificate_renewal_activity' => true,
                    'certificate_style' => 'ecdsa',
                    'certifier_url' => 'https://ssh.api.fake.local',
                    'concurrency_limits' => [
                        'internal' => 1,
                        'integration' => 4,
                        'backup' => 2,
                        'cron' => 5,
                        'cron:production' => 1,
                        'default' => 2,
                        'cleanup' => 3,
                    ],
                    'continuous_profiling' => [
                        'supported_runtimes' => ['ruby', 'python', 'php', 'nodejs', 'rust', 'java', 'golang'],
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
                    'maintenance_window' => null,
                    'max_allowed_redirects_paths' => 50000,
                    'max_allowed_routes' => 50000,
                    'outbound_restrictions_default_policy' => 'allow',
                    'persistent_endpoints_ssh' => true,
                    'persistent_endpoints_ssl_certificates' => true,
                    'product_code' => 'upsun',
                    'product_name' => 'Upsun',
                    'project_config_dir' => '.upsun',
                    'requires_domain_ownership' => false,
                    'router_gen2' => false,
                    'router_resources' => [
                        'baseline_cpu' => 0.05,
                        'baseline_memory' => 128,
                        'max_cpu' => 1.0,
                        'max_memory' => 1024,
                    ],
                    'save_applications_vendors' => false,
                    'self_upgrade' => true,
                    'self_upgrade_latest_major' => false,
                    'sizing_api_enabled' => true,
                    'strict_configuration' => true,
                    'support_generic_images' => true,
                    'systemd' => false,
                    'temporary_disk_size' => 8192,
                    'ui_uri_template' => 'https://console.fake.local/{organization}/{project}',
                    'use_drupal_defaults' => false,
                    'use_legacy_subdomains' => false,
                    'variables_prefix' => 'PLATFORM_',
                ],
            ],
            'environment_info' => [
                'name' => 'main',
                'status' => 'active',
                'is_main' => true,
                'is_production' => true,
                'constraints' => [
                    'cluster_type' => 'environment',
                    'deployment_type' => 'production',
                ],
                'reference' => 'refs/heads/main',
                'machine_name' => 'main-fake',
                'environment_type' => 'production',
                'links' => [
                    '#ui' => ['href' => 'https://console.fake.local/ORG_FAKE_001/fake-project/main'],
                ],
            ],
            'deployment_target' => 'local',
            'vpn' => null,
            'http_access' => ['is_enabled' => true, 'addresses' => [], 'basic_auth' => []],
            'enable_smtp' => true,
            'restrict_robots' => true,
            'variables' => [],
            'access' => [
                ['entity_id' => 'fake-entity-uuid-0001', 'role' => 'admin'],
            ],
            'subscription' => [
                'license_uri' => 'https://accounts.fake/licenses/FAKE-123',
                'storage' => 1024,
                'included_users' => 1,
                'subscription_management_uri' => 'https://console.fake.local/billing/FAKE-123',
                'restricted' => false,
                'suspended' => false,
                'user_licenses' => 1,
                'resource_validation_url' => 'https://api.fake.local/validate',
            ],
            'services' => $services,
            'routes' => [
                'https://main-fake-fake-project.fake.local/' => [
                    'primary' => true,
                    'id' => null,
                    'production_url' => 'https://main-fake-fake-project.fake.local/',
                    'attributes' => [],
                    'type' => 'upstream',
                    'tls' => [
                        'strict_transport_security' => ['enabled' => null, 'include_subdomains' => null, 'preload' => null],
                        'min_version' => null,
                        'client_authentication' => null,
                        'client_certificate_authorities' => [],
                    ],
                    'original_url' => 'https://{all}/',
                    'http_access' => ['is_enabled' => true, 'addresses' => [], 'basic_auth' => []],
                    'restrict_robots' => true,
                    'cache' => [
                        'enabled' => true,
                        'default_ttl' => 0,
                        'cookies' => ['*'],
                        'headers' => ['Accept', 'Accept-Language'],
                    ],
                    'ssi' => ['enabled' => false],
                    'upstream' => 'app:http',
                    'redirects' => ['expires' => '-1s', 'paths' => []],
                    'sticky' => ['enabled' => false],
                ],
                'http://main-fake-fake-project.fake.local/' => [
                    'primary' => false,
                    'id' => null,
                    'production_url' => 'http://main-fake-fake-project.fake.local/',
                    'attributes' => [],
                    'type' => 'redirect',
                    'tls' => [
                        'strict_transport_security' => ['enabled' => null, 'include_subdomains' => null, 'preload' => null],
                        'min_version' => null,
                        'client_authentication' => null,
                        'client_certificate_authorities' => [],
                    ],
                    'original_url' => 'http://{all}/',
                    'http_access' => ['is_enabled' => true, 'addresses' => [], 'basic_auth' => []],
                    'restrict_robots' => true,
                    'to' => 'https://main-fake-fake-project.fake.local/',
                    'redirects' => ['expires' => '-1s', 'paths' => []],
                ],
            ],
            'webapps' => $webapps,
            'workers' => $workers,
            'container_profiles' => 'HIGH_CPU',
        ];
    }

    protected function getFakeProject(string $projectId): array
    {
        return [
            'id' => $projectId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Student Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:student/project.git',
                'clientSshKey' => 'ssh-rsa AAAAB3Nza...fake',
            ],
            'subscription' => [
                'licenseUri' => 'https://upsun.com/licenses/123',
                'storage' => 10240,
                'includedUsers' => 5,
                'subscriptionManagementUri' => 'https://upsun.com/manage/123',
                'restricted' => false,
                'suspended' => false,
                'userLicenses' => 10,
                'id' => 'sub_123456',
                'plan' => 'pro',
                'environments' => 3,
                'resources' => [
                    'containerProfiles' => true,
                    'production' => [
                        'legacyDevelopment' => false,
                        'maxCpu' => 2.0,
                        'maxMemory' => 4096,
                        'maxEnvironments' => 5,
                    ],
                    'development' => [
                        'legacyDevelopment' => true,
                        'maxCpu' => 1.0,
                        'maxMemory' => 2048,
                        'maxEnvironments' => 10,
                    ],
                ],
                'resourceValidationUrl' => 'https://upsun.com/resources/validate',
                'imageTypes' => [
                    'only' => ['php:8.2', 'node:18'],
                    'exclude' => ['java:11'],
                ],
            ],
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-01T12:00:00Z',
            'namespace' => 'student-namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'student-project.upsun.dev',
        ];
    }
}
