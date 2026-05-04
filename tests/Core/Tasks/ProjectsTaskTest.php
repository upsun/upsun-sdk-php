<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\ApiTokensApi;
use Upsun\Api\AutoscalingApi;
use Upsun\Api\CertManagementApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\DefaultApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\DomainManagementApi;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MfaApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\RegionsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\RoutingApi;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Api\SourceOperationsApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SupportApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Core\Tasks\CertificatesTask;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\IntegrationsTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountsTask;
use Upsun\Core\Tasks\OperationsTask;
use Upsun\Core\Tasks\OrganizationsTask;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\Core\Tasks\RepositoriesTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Core\Tasks\SupportTicketsTask;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Core\Tasks\UsersInvitationsTask;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Certificate;
use Upsun\Model\Domain;
use Upsun\Model\Environment;
use Upsun\Model\ListProjectTeamAccess200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\Project;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectStatus;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Subscription;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\UserProjectAccess;
use Upsun\UpsunClient;

class ProjectsTaskTest extends BaseTestCase
{
    protected ProjectsTask $projectsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->projectsTask = new class (
            $upsunClient,
            new ProjectApi(...$apiClassParams),
            new OrganizationProjectsApi(...$apiClassParams),
            new ProjectSettingsApi(...$apiClassParams),
            new SubscriptionsApi(...$apiClassParams),
        ) extends ProjectsTask {
        };

        $upsunClient->invitations = new class (
            $upsunClient,
            new OrganizationInvitationsApi(...$apiClassParams),
            new ProjectInvitationsApi(...$apiClassParams),
        ) extends UsersInvitationsTask {
        };

        $upsunClient->variables = new class (
            $upsunClient,
            new ProjectVariablesApi(...$apiClassParams),
            new EnvironmentVariablesApi(...$apiClassParams),
        ) extends VariablesTask {
        };

        $upsunClient->activities = new class (
            $upsunClient,
            new ProjectActivityApi(...$apiClassParams),
            new EnvironmentActivityApi(...$apiClassParams)
        ) extends ActivitiesTask {
        };

        $upsunClient->applications = new class (
            $upsunClient,
        ) extends ApplicationsTask {
        };

        $upsunClient->backups = new class (
            $upsunClient,
            new EnvironmentBackupsApi(...$apiClassParams)
        ) extends BackupsTask {
        };

        $upsunClient->certificates = new class (
            $upsunClient,
            new CertManagementApi(...$apiClassParams)
        ) extends CertificatesTask {
        };

        $upsunClient->domains = new class (
            $upsunClient,
            new DomainManagementApi(...$apiClassParams)
        ) extends DomainsTask {
        };

        $upsunClient->environments = new class (
            $upsunClient,
            new EnvironmentApi(...$apiClassParams),
            new EnvironmentTypeApi(...$apiClassParams),
            new DeploymentApi(...$apiClassParams)
        ) extends EnvironmentsTask {
        };

        $upsunClient->integrations = new class (
            $upsunClient,
            new ThirdPartyIntegrationsApi(...$apiClassParams)
        ) extends IntegrationsTask {
        };

        $upsunClient->metrics = new class (
            $upsunClient
        ) extends MetricsTask {
        };

        $upsunClient->mounts = new class (
            $upsunClient
        ) extends MountsTask {
        };

        $upsunClient->operations = new class (
            $upsunClient,
            new RuntimeOperationsApi(...$apiClassParams)
        ) extends OperationsTask {
        };

        $upsunClient->organizations = new class (
            $upsunClient,
            new OrganizationsApi(...$apiClassParams),
            new OrganizationProjectsApi(...$apiClassParams),
            new OrganizationMembersApi(...$apiClassParams),
            new SubscriptionsApi(...$apiClassParams),
            new InvoicesApi(...$apiClassParams),
            new MfaApi(...$apiClassParams),
            new OrdersApi(...$apiClassParams),
            new ProfilesApi(...$apiClassParams),
            new RecordsApi(...$apiClassParams),
            new VouchersApi(...$apiClassParams),
            new AddOnsApi(...$apiClassParams)
        ) extends OrganizationsTask {
        };

        $upsunClient->projects = $this->projectsTask;

        $upsunClient->regions = new class (
            $upsunClient,
            new RegionsApi(...$apiClassParams)
        ) extends RegionsTask {
        };

        $upsunClient->repositories = new class (
            $upsunClient,
            new RepositoryApi(...$apiClassParams),
            new SystemInformationApi(...$apiClassParams)
        ) extends RepositoriesTask {
        };

        $upsunClient->resources = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams),
            new AutoscalingApi(...$apiClassParams),
        ) extends ResourcesTask {
        };

        $upsunClient->routes = new class (
            $upsunClient,
            new RoutingApi(...$apiClassParams)
        ) extends RoutesTask {
        };

        $upsunClient->sourceOperations = new class (
            $upsunClient,
            new SourceOperationsApi(...$apiClassParams)
        ) extends SourceOperationsTask {
        };

        $upsunClient->teams = new class (
            $upsunClient,
            new TeamsApi(...$apiClassParams),
            new TeamAccessApi(...$apiClassParams)
        ) extends TeamsTask {
        };

        $upsunClient->supportTickets = new class (
            $upsunClient,
            new DefaultApi(...$apiClassParams),
            new SupportApi(...$apiClassParams)
        ) extends SupportTicketsTask {
        };

        $upsunClient->users = new class (
            $upsunClient,
            new UsersApi(...$apiClassParams),
            new UserProfilesApi(...$apiClassParams),
            new UserAccessApi(...$apiClassParams),
            new ApiTokensApi(...$apiClassParams),
            new ConnectionsApi(...$apiClassParams),
            new GrantsApi(...$apiClassParams),
            new MfaApi(...$apiClassParams),
            new PhoneNumberApi(...$apiClassParams)
        ) extends UsersTask {
        };

        $upsunClient->workers = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams)
        ) extends WorkersTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGet()
    {
        $prjId = 'test-project';

        $projectFake = $this->getFakeProject($prjId);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($projectFake)
            ));

        $result = $this->projectsTask->get(projectId: $prjId);
        $this->assertInstanceOf(Project::class, $result);
        $this->assertObjectProperties($result, $projectFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDelete()
    {
        $projectId = 'test-project';

        $fakeOrganizationProject = [
            'id' => $projectId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Test Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:test/project.git',
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
            'namespace' => 'namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'project.upsun.dev',
        ];

        $this->httpClient
            ->expects($this->atMost(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeOrganizationProject)
                ),
                new Response(
                    204,
                    ['Content-Type' => 'application/json'],
                    json_encode([
                        'status' => ProjectStatus::SUSPENDED,
                        'code' => 204
                    ])
                )
            );
        $this->projectsTask->delete(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetCapabilities()
    {
        $projectId = 'test-project';

        $fakeCapabilities = [
            'tasks' => [
                'enabled' => true,
            ],
            'metrics' => [
                'maxRange' => '30d',
            ],
            'logsForwarding' => [
                'maxExtraPayloadSize' => 1024,
            ],
            'images' => [
                ['name' => 'php:8.2', 'size' => '200MB'],
                ['name' => 'node:18', 'size' => '150MB'],
            ],
            'instanceLimit' => 10,
            'buildResources' => [
                'enabled' => true,
                'maxCpu' => 4.0,
                'maxMemory' => 8192,
            ],
            'dataRetention' => [
                'enabled' => true,
            ],
            'autoscaling' => [
                'enabled' => true,
            ],
            'guaranteedResources' => [
                'enabled' => true,
                'instanceLimit' => '2',
            ],
            'customDomains' => [
                'enabled' => true,
                'environmentsWithDomainsLimit' => 5,
            ],
            'sourceOperations' => [
                'enabled' => true,
            ],
            'runtimeOperations' => [
                'enabled' => false,
            ],
            'outboundFirewall' => [
                'enabled' => true,
            ],
            'integrations' => [
                'enabled' => true,
                'config' => [
                    'provider' => 'github',
                    'webhookSecret' => 'secret123',
                ],
                'allowedIntegrations' => [
                    'github',
                    'gitlab',
                    'bitbucket',
                ],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCapabilities)
            ));

        $result = $this->projectsTask->getCapabilities(projectId: $projectId);
        $this->assertInstanceOf(ProjectCapabilities::class, $result);
        $this->assertObjectProperties($result, $fakeCapabilities);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCanCreate()
    {
        $organizationId = 'org_1';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $result = $this->projectsTask->canCreate($organizationId);
        $this->assertNotNull($result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdate()
    {
        $projectId = 'test-project';
        $projectFake = $this->getFakeProject($projectId);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($projectFake)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode([])
                )
            );

        $result = $this->projectsTask->update(
            projectId: $projectId,
            title: 'My Project',
            timezone: 'UTC',
        );

        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testInfoWithUpdate()
    {
        $projectId = 'test-project';
        $projectFake = $this->getFakeProject($projectId);

        $this->httpClient
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($projectFake)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode([])
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($projectFake)
                )
            );

        $result = $this->projectsTask->info(
            projectId: $projectId,
            title: 'My Project',
            timezone: 'UTC',
        );

        $this->assertInstanceOf(Project::class, $result);
        $this->assertObjectProperties($result, $projectFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelInvite()
    {
        $projectId = 'test-project';
        $invitationId = 'invite-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No Content',
                    'code' => 204,
                    'message' => 'Invite Cancelled successfully',
                    'data' => [
                        'operation_id' => 'restore-123-abc',
                        'estimated_duration' => '5-10 minutes'
                    ]
                ])
            ));

        $this->projectsTask->cancelInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateInvite()
    {
        $projectId = 'test-project';

        $invitation = [
            'finishedAt' => '2025-09-24T10:15:00Z',
            'id' => 'inv_123456789',
            'state' => 'pending',
            'projectId' => $projectId,
            'role' => 'developer',
            'email' => 'invite@example.com',
            'owner' => [
                'id' => 'owner_111',
                'displayName' => 'Jane Doe',
            ],
            'createdAt' => '2025-09-20T08:00:00Z',
            'updatedAt' => '2025-09-22T15:30:00Z',
            'environments' => [
                [
                    'id' => 'env_001',
                    'name' => 'development',
                ],
                [
                    'id' => 'env_002',
                    'name' => 'production',
                ],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($invitation)
            ));

        $result = $this->projectsTask->createInvite(
            projectId: $projectId,
            email: 'invite@example.com',
            role: 'developer',
            permissions: ['read', 'write', 'deploy'],
            environments: [
                [
                    'id' => 'env_123',
                    'name' => 'staging',
                ],
                [
                    'id' => 'env_456',
                    'name' => 'production',
                ],
            ],
            force: true,
        );
        $this->assertInstanceOf(ProjectInvitation::class, $result);
        $this->assertObjectProperties($result, $invitation);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjectInvites()
    {
        $projectId = 'test-project';
        $filterState = ['active'];
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';

        $list = [
            [
                'finishedAt' => '2025-09-24T10:15:00Z',
                'id' => 'inv_123456789',
                'state' => 'pending',
                'projectId' => $projectId,
                'role' => 'developer',
                'email' => 'invite@example.com',
                'owner' => [
                    'id' => 'owner_111',
                    'displayName' => 'Jane Doe',
                ],
                'createdAt' => '2025-09-20T08:00:00Z',
                'updatedAt' => '2025-09-22T15:30:00Z',
                'environments' => [
                    [
                        'id' => 'env_001',
                        'name' => 'development',
                    ],
                    [
                        'id' => 'env_002',
                        'name' => 'production',
                    ],
                ],
            ],
            [
                'finishedAt' => '2025-09-24T10:15:00Z',
                'id' => 'inv_987654321',
                'state' => 'pending',
                'projectId' => $projectId,
                'role' => 'developer',
                'email' => 'invite2@example.com',
                'owner' => [
                    'id' => 'owner_111',
                    'displayName' => 'Jane Doe',
                ],
                'createdAt' => '2025-09-20T08:00:00Z',
                'updatedAt' => '2025-09-22T15:30:00Z',
                'environments' => [
                    [
                        'id' => 'env_003',
                        'name' => 'staging',
                    ],
                    [
                        'id' => 'env_002',
                        'name' => 'production',
                    ],
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->projectsTask->listInvites(
            projectId: $projectId,
            filterState: $filterState,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetSettings()
    {
        $projectId = 'test-project';

        $fakeConfig = [
            'initialize' => [],
            'product_name' => 'My Product',
            'product_code' => 'PRD123',
            'ui_uri_template' => '/{project}/dashboard',
            'variables_prefix' => 'VAR_',
            'bot_email' => 'bot@example.com',
            'application_config_file' => 'app.config.json',
            'project_config_dir' => '/etc/project/config',
            'use_drupal_defaults' => true,
            'use_legacy_subdomains' => true,
            'development_service_size' => '2XL',
            'development_application_size' => '2XL',
            'enable_certificate_provisioning' => true,
            'certificate_style' => 'ecdsa',
            'certificate_renewal_activity' => true,
            'development_domain_template' => '{project}.dev.example.com',
            'enable_state_api_deployments' => true,
            'temporary_disk_size' => 1024,
            'local_disk_size' => 2048,
            'cron_minimum_interval' => 60,
            'cron_maximum_jitter' => 10,
            'cron_production_expiry_interval' => 3600,
            'cron_non_production_expiry_interval' => 1800,
            'concurrency_limits' => [
                'property1' => 5,
                'property2' => 10,
            ],
            'flexible_build_cache' => true,
            'strict_configuration' => true,
            'has_sleepy_crons' => false,
            'crons_in_git' => true,
            'custom_error_template' => 'errors/custom.html',
            'app_error_page_template' => 'errors/app.html',
            'environment_name_strategy' => 'hash',
            'data_retention' => [
                'property1' => [
                    'max_backups' => 10,
                    'default_config' => [
                        'manual_count' => 2,
                        'schedule' => [
                            [
                                'interval' => 'daily',
                                'count' => 7,
                            ],
                        ],
                    ],
                ],
                'property2' => [
                    'max_backups' => 5,
                    'default_config' => [
                        'manual_count' => 1,
                        'schedule' => [
                            [
                                'interval' => 'weekly',
                                'count' => 4,
                            ],
                        ],
                    ],
                ],
            ],
            'enable_codesource_integration_push' => true,
            'enforce_mfa' => true,
            'systemd' => true,
            'router_gen2' => true,
            'build_resources' => [
                'cpu' => 0.5,
                'memory' => 1024,
            ],
            'outbound_restrictions_default_policy' => 'allow',
            'self_upgrade' => true,
            'selfUpgradeLatestMajor' => false,
            'additional_hosts' => [
                'property1' => 'extra1.example.com',
                'property2' => 'extra2.example.com',
            ],
            'max_allowed_routes' => 50,
            'max_allowed_redirects_paths' => 20,
            'enable_incremental_backups' => true,
            'sizing_api_enabled' => true,
            'enable_cache_grace_period' => true,
            'enable_zero_downtime_deployments' => true,
            'enable_admin_agent' => true,
            'certifier_url' => 'https://certs.example.com',
            'centralized_permissions' => true,
            'glue_server_max_request_size' => 1048576,
            'persistent_endpoints_ssh' => true,
            'persistent_endpoints_ssl_certificates' => true,
            'enable_disk_health_monitoring' => true,
            'enable_paused_environments' => true,
            'enable_unified_configuration' => true,
            'enable_explicit_empty_routes' => true,
            'enable_routes_tracing' => false,
            'image_deployment_validation' => true,
            'support_generic_images' => true,
            'enable_github_app_token_exchange' => true,
            'continuous_profiling' => [
                'supported_runtimes' => ['php', 'nodejs'],
            ],
            'disable_agent_error_reporter' => false,
            'requires_domain_ownership' => true,
            'enable_guaranteed_resources' => true,
            'git_server' => [
                'push_size_hard_limit' => 52428800,
            ],
            'activity_logs_max_size' => 100000,
            'allow_manual_deployments' => true,
            'allow_rolling_deployments' => true,
            'allow_activity_reschedule' => true,
            'allow_burst' => true,
            'router_resources' => [
                'baseline_cpu' => 0.2,
                'baseline_memory' => 512,
                'max_cpu' => 1.0,
                'max_memory' => 4096,
            ],
            'allow_scaling_to_zero' => true,
            'save_applications_vendors' => true,
            'locations_script_default' => true,
            'support_oci_images' => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeConfig)
            ));

        $result = $this->projectsTask->getSettings(projectId: $projectId);
        $this->assertInstanceOf(ProjectSettings::class, $result);
        $this->assertObjectProperties($result, $fakeConfig);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateSettings()
    {
        $projectId = 'test-project';

        $data = [
            'dataRetention' => [
                'property1' => [
                    'max_backups' => 7,
                    'default_config' => [
                        'manual_count' => 2,
                        'schedule' => [
                            [
                                'interval' => 'daily',
                                'count' => 7,
                            ],
                            [
                                'interval' => 'weekly',
                                'count' => 4,
                            ],
                        ],
                    ],
                ],
            ],
            'initialize' => [
                'step' => 'prepare',
                'status' => 'pending',
            ],
            'cpu' => 0.5,
            'memory' => 1024,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));


        $result = $this->projectsTask->updateSettings(
            projectId: $projectId,
            initialize: $data['initialize'],
            dataRetention: $data['dataRetention'],
            cpu: $data['cpu'],
            memory: $data['memory']
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateVariable()
    {

        $projectId = 'test-project';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->createVariable(
            projectId: $projectId,
            name: 'env:API_KEY',
            value: '123456789abcdef',
            attributes: [
                'description' => 'API key for third-party service',
                'scope' => 'project',
            ],
            isJson: false,
            isSensitive: true,
            visibleBuild: true,
            visibleRuntime: false,
            applicationScope: ['app1', 'app2'],
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->deleteVariable(projectId: $projectId, variableId: $variableId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';

        $variable = [
            'id' => 'var_123456',
            'created_at' => '2019-08-24T14:15:22Z',
            'updated_at' => '2019-08-24T14:15:22Z',
            'name' => 'API_KEY',
            'attributes' => [
                'property1' => 'some-metadata',
                'property2' => 'another-metadata',
            ],
            'value' => '123456789abcdef',
            'is_json' => true,
            'is_sensitive' => true,
            'visible_build' => true,
            'visible_runtime' => true,
            'application_scope' => [
                'backend',
                'frontend',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($variable)
            ));

        $result = $this->projectsTask->getVariable(projectId: $projectId, variableId: $variableId);
        $this->assertInstanceOf(ProjectVariable::class, $result);
        $this->assertObjectProperties($result, $variable);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListVariables()
    {
        $projectId = 'test-project';

        $list = [
            [
                'id' => 'var_123456',
                'created_at' => '2019-08-24T14:15:22Z',
                'updated_at' => '2019-08-24T14:15:22Z',
                'name' => 'env:API_KEY',
                'attributes' => [
                    'property1' => 'some-metadata',
                    'property2' => 'another-metadata',
                ],
                'value' => '123456789abcdef',
                'is_json' => true,
                'is_sensitive' => true,
                'visible_build' => true,
                'visible_runtime' => true,
                'application_scope' => [
                    'environment'
                ],
            ],
            [
                'id' => 'var_654321',
                'created_at' => '2019-08-24T14:15:22Z',
                'updated_at' => '2019-08-24T14:15:22Z',
                'name' => 'env:TOKEN',
                'attributes' => [
                    'property1' => 'some-metadata',
                    'property2' => 'another-metadata',
                ],
                'value' => '123456789abcdef',
                'is_json' => true,
                'is_sensitive' => true,
                'visible_build' => true,
                'visible_runtime' => true,
                'application_scope' => [
                    'project'
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->projectsTask->listVariables(projectId: $projectId);
        $this->assertContainsOnlyInstancesOf(ProjectVariable::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->updateVariable(
            projectId: $projectId,
            variableId: $variableId,
            name: 'API_KEY_UPDATED',
            value: 'abcdef123456789',
            attributes: [
                'property1' => 'updated-metadata',
                'property2' => 'additional-info',
            ],
            isJson: true,
            isSensitive: true,
            visibleBuild: false,
            visibleRuntime: true,
            applicationScope: ['app1', 'app2'],
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetActivity()
    {
        $projectId = 'test-project';
        $activityId = 'activity-123';
        $fakeActivity = [
            'type' => 'deployment',
            'parameters' => (object)[
                'branch' => 'main',
                'version' => '1.0.0',
            ],
            'project' => 'proj_123456',
            'state' => 'running',
            'completionPercent' => 45,
            'timings' => [
                'queuedAt' => '2025-09-24T10:00:00Z',
                'startedAt' => '2025-09-24T10:05:00Z',
                'expectedCompletion' => '2025-09-24T10:30:00Z',
            ],
            'log' => 'Deployment started successfully.',
            'payload' => (object)[
                'commit' => 'abc123def',
                'author' => 'Jane Doe',
            ],
            'id' => 'act_987654',
            'createdAt' => '2025-09-24T10:00:00Z',
            'updatedAt' => '2025-09-24T10:15:00Z',
            'result' => null,
            'startedAt' => '2025-09-24T10:05:00Z',
            'completedAt' => null,
            'cancelledAt' => null,
            'description' => 'Deployment of the main branch',
            'text' => 'Deployment in progress...',
            'expiresAt' => '2025-09-25T10:00:00Z',
            'integration' => 'CI/CD Pipeline',
            'environments' => [
                ['id' => 'env_001', 'name' => 'staging'],
                ['id' => 'env_002', 'name' => 'production'],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeActivity)
            ));

        $result = $this->projectsTask->getActivity(projectId: $projectId, activityId: $activityId);
        $this->assertInstanceOf(Activity::class, $result);
        $this->assertObjectProperties($result, $fakeActivity);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testListActivities()
    {
        $projectId = 'test-project';
        $list = [
            [
                'type' => 'deployment',
                'parameters' => (object)[
                    'branch' => 'main',
                    'version' => '1.0.0',
                ],
                'project' => 'proj_123456',
                'state' => 'running',
                'completionPercent' => 45,
                'timings' => [
                    'queuedAt' => '2025-09-24T10:00:00Z',
                    'startedAt' => '2025-09-24T10:05:00Z',
                    'expectedCompletion' => '2025-09-24T10:30:00Z',
                ],
                'log' => 'Deployment started successfully.',
                'payload' => (object)[
                    'commit' => 'abc123def',
                    'author' => 'Jane Doe',
                ],
                'id' => 'act_987654',
                'createdAt' => '2025-09-24T10:00:00Z',
                'updatedAt' => '2025-09-24T10:15:00Z',
                'result' => null,
                'startedAt' => '2025-09-24T10:05:00Z',
                'completedAt' => null,
                'cancelledAt' => null,
                'description' => 'Deployment of the main branch',
                'text' => 'Deployment in progress...',
                'expiresAt' => '2025-09-25T10:00:00Z',
                'integration' => 'CI/CD Pipeline',
                'environments' => [
                    ['id' => 'env_001', 'name' => 'staging'],
                    ['id' => 'env_002', 'name' => 'production'],
                ],
            ],
            [
                'type' => 'deployment',
                'parameters' => (object)[
                    'branch' => 'main',
                    'version' => '1.0.0',
                ],
                'project' => 'proj_123456',
                'state' => 'completed',
                'completionPercent' => 45,
                'timings' => [
                    'queuedAt' => '2025-09-24T10:00:00Z',
                    'startedAt' => '2025-09-24T10:05:00Z',
                    'expectedCompletion' => '2025-09-24T10:30:00Z',
                ],
                'log' => 'Deployment finished successfully.',
                'payload' => (object)[
                    'commit' => 'abc123def',
                    'author' => 'Jane Doe',
                ],
                'id' => 'act_123456789',
                'createdAt' => '2025-09-24T10:00:00Z',
                'updatedAt' => '2025-09-24T10:15:00Z',
                'result' => null,
                'startedAt' => '2025-09-24T10:05:00Z',
                'completedAt' => null,
                'cancelledAt' => null,
                'description' => 'Deployment of the main branch',
                'text' => 'Finished...',
                'expiresAt' => '2025-09-25T10:00:00Z',
                'integration' => 'CI/CD Pipeline',
                'environments' => [
                    ['id' => 'env_001', 'name' => 'staging'],
                    ['id' => 'env_002', 'name' => 'production'],
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->projectsTask->listActivities(projectId: $projectId);

        $this->assertContainsOnlyInstancesOf(Activity::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelActivity()
    {
        $projectId = 'test-project';
        $activityId = 'activity-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $response = $this->projectsTask->cancelActivity(projectId: $projectId, activityId: $activityId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->deleteDomain(projectId: $projectId, domainId: $domainId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testGetDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domain = [
            'type' => 'prodstorage',
            'name' => 'Environment Domain',
            'attributes' => [
                'region' => 'us-east-1',
                'tier' => 'premium',
                'version' => '1.2.3',
            ],
            'createdAt' => '2025-09-15T12:00:00Z',
            'updatedAt' => '2025-09-15T12:30:00Z',
            'project' => 'project_123',
            'registeredName' => 'prod_env_001',
            'isDefault' => true,
            'replacementFor' => 'staging_env_001',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($domain)
            ));

        $result = $this->projectsTask->getDomain(projectId: $projectId, domainId: $domainId);
        $this->assertInstanceOf(Domain::class, $result);
        $this->assertObjectProperties($result, $domain);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListDomains()
    {
        $projectId = 'test-project';
        $list = [
            [
                'type' => 'prodstorage',
                'name' => 'Environment Domain',
                'attributes' => [
                    'region' => 'us-east-1',
                    'tier' => 'premium',
                    'version' => '1.2.3',
                ],
                'createdAt' => '2025-09-15T12:00:00Z',
                'updatedAt' => '2025-09-15T12:30:00Z',
                'project' => 'project_123',
                'registeredName' => 'prod_env_001',
                'isDefault' => true,
                'replacementFor' => 'staging_env_001',
            ],
            [
                'type' => 'prodstorage',
                'name' => 'Environment Domain',
                'attributes' => [
                    'region' => 'us-east-1',
                    'tier' => 'premium',
                    'version' => '1.2.3',
                ],
                'createdAt' => '2025-09-15T12:00:00Z',
                'updatedAt' => '2025-09-15T12:30:00Z',
                'project' => 'project_123',
                'registeredName' => 'prod_env_001',
                'isDefault' => true,
                'replacementFor' => 'staging_env_001',
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->projectsTask->listDomains(projectId: $projectId);
        $this->assertContainsOnlyInstancesOf(Domain::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->deleteCertificate(projectId: $projectId, certificateId: $certId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $fakeCertificate = [
            'id' => 'cert1',
            'certificate' => '-----BEGIN CERTIFICATE-----
FAKE-CERTIFICATE-DATA
-----END CERTIFICATE-----',
            'chain' => [
                '-----BEGIN CERTIFICATE-----
FAKE-CHAIN-CERT-DATA
-----END CERTIFICATE-----',
            ],
            'isProvisioned' => true,
            'isInvalid' => false,
            'isRoot' => false,
            'domains' => [
                'example.com',
                'www.example.com',
            ],
            'authType' => [
                'dns-01',
            ],
            'issuer' => [
                [
                    'oid' => '2.5.4.3', // CN
                    'value' => 'Fake Root CA',
                    'alias' => 'CN',
                ],
                [
                    'oid' => '2.5.4.10', // O
                    'value' => 'Fake Authority',
                    'alias' => 'O',
                ],
                [
                    'oid' => '2.5.4.6', // C
                    'value' => 'FR',
                    'alias' => 'C',
                ],
            ],
            'expiresAt' => '2026-09-24T10:15:00Z',
            'createdAt' => '2025-09-24T09:00:00Z',
            'updatedAt' => '2025-09-24T09:30:00Z',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCertificate)
            ));

        $result = $this->projectsTask->getCertificate(projectId: $projectId, certificateId: $certId);
        $this->assertInstanceOf(Certificate::class, $result);
        $this->assertObjectProperties($result, $fakeCertificate);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListCertificates()
    {
        $projectId = 'test-project';

        $list = [
            [
                'id' => 'cert1',
                'certificate' => '-----BEGIN CERTIFICATE-----
FAKE-CERTIFICATE-DATA
-----END CERTIFICATE-----',
                'chain' => [
                    '-----BEGIN CERTIFICATE-----
FAKE-CHAIN-CERT-DATA
-----END CERTIFICATE-----',
                ],
                'isProvisioned' => true,
                'isInvalid' => false,
                'isRoot' => false,
                'domains' => [
                    'example.com',
                    'www.example.com',
                ],
                'authType' => [
                    'dns-01',
                ],
                'issuer' => [
                    [
                        'oid' => '2.5.4.3', // CN
                        'value' => 'Fake Root CA',
                        'alias' => 'CN',
                    ],
                    [
                        'oid' => '2.5.4.10', // O
                        'value' => 'Fake Authority',
                        'alias' => 'O',
                    ],
                    [
                        'oid' => '2.5.4.6', // C
                        'value' => 'FR',
                        'alias' => 'C',
                    ],
                ],
                'expiresAt' => '2026-09-24T10:15:00Z',
                'createdAt' => '2025-09-24T09:00:00Z',
                'updatedAt' => '2025-09-24T09:30:00Z',
            ],
            [
                'id' => 'cert2',
                'certificate' => '-----BEGIN CERTIFICATE-----
FAKE-CERTIFICATE-DATA2
-----END CERTIFICATE-----',
                'chain' => [
                    '-----BEGIN CERTIFICATE-----
FAKE-CHAIN-CERT-DATA2
-----END CERTIFICATE-----',
                ],
                'isProvisioned' => true,
                'isInvalid' => false,
                'isRoot' => false,
                'domains' => [
                    'example2.com',
                    'www.example2.com',
                ],
                'authType' => [
                    'dns-02',
                ],
                'issuer' => [
                    [
                        'oid' => '2.5.4.6', // CN
                        'value' => 'Fake Root CA',
                        'alias' => 'CN',
                    ],
                    [
                        'oid' => '2.5.4.6', // O
                        'value' => 'Fake Authority',
                        'alias' => 'O',
                    ],
                    [
                        'oid' => '2.5.4.6', // C
                        'value' => 'FR',
                        'alias' => 'C',
                    ],
                ],
                'expiresAt' => '2026-09-24T10:15:00Z',
                'createdAt' => '2025-09-24T09:00:00Z',
                'updatedAt' => '2025-09-24T09:30:00Z',
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->projectsTask->listCertificates(projectId: $projectId);
        $this->assertContainsOnlyInstancesOf(Certificate::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateCertificate()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $certData = [
            'chain' => [
                '-----BEGIN CERTIFICATE-----' . PHP_EOL .
                'FAKE-CHAIN-CERT-DATA' . PHP_EOL .
                '-----END CERTIFICATE-----',
            ],
            'isInvalid' => false,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->projectsTask->updateCertificate(
            projectId: $projectId,
            certificateId: $certId,
            chain: $certData['chain'],
            isInvalid: $certData['isInvalid']
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testGetTeamProjectAccessByProject()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';
        $fakeTeamProjectAccess = [
            'teamId' => 'team-123',
            'organizationId' => 'org-456',
            'projectId' => 'proj-789',
            'projectTitle' => 'Awesome Project',
            'grantedAt' => '2025-09-24T10:00:00Z',
            'updatedAt' => '2025-09-24T12:30:00Z',
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/teams/team-123/projects/proj-789',
                ],
                'update' => [
                    'href' => 'https://api.example.com/teams/team-123/projects/proj-789/update',
                ],
                'delete' => [
                    'href' => 'https://api.example.com/teams/team-123/projects/proj-789/delete',
                ],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeTeamProjectAccess)
            ));

        $result = $this->projectsTask->getTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
        $this->assertInstanceOf(TeamProjectAccess::class, $result);
        $this->assertObjectProperties($result, $fakeTeamProjectAccess);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testGrantProjectTeamAccess()
    {
        $projectId = 'test-project';
        $fakeTeamProjectAccessList = [
            ['teamId' => 'team-123'],
            ['teamId' => 'team-456'],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No content',
                    'code' => 204
                ])
            ));

        $this->projectsTask->grantTeamProjectAccessToProject(
            projectId: $projectId,
            access: $fakeTeamProjectAccessList
        );
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testGrantTeamProjectAccessToTeam()
    {
        $teamId = 'team-123';

        $fakeProjectTeamAccessList = [
            ['projectId' => 'proj-123'],
            ['projectId' => 'proj-456'],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No content',
                    'code' => 204
                ])
            ));

        $this->projectsTask->grantTeamProjectAccessToTeam(teamId: $teamId, access: $fakeProjectTeamAccessList);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListTeamProjectAccessByProject()
    {
        $projectId = 'test-project';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';

        $fakeListTeamProjectAccess = [
            'items' => [
                [
                    'teamId' => 'team-123',
                    'organizationId' => 'org-456',
                    'projectId' => 'proj-789',
                    'projectTitle' => 'Awesome Project',
                    'grantedAt' => '2025-09-24T10:00:00Z',
                    'updatedAt' => '2025-09-24T12:30:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self'],
                        'update' => ['href' => 'https://api.example.com/update'],
                        'delete' => ['href' => 'https://api.example.com/delete'],
                    ],
                ],
                [
                    'teamId' => 'team-234',
                    'organizationId' => 'org-567',
                    'projectId' => 'proj-890',
                    'projectTitle' => 'Another Project',
                    'grantedAt' => '2025-09-20T09:00:00Z',
                    'updatedAt' => '2025-09-21T14:15:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self2'],
                        'update' => ['href' => 'https://api.example.com/update2'],
                        'delete' => ['href' => 'https://api.example.com/delete2'],
                    ],
                ],
            ],
            'links' => [
                'first' => ['href' => 'https://api.example.com/page=1'],
                'next' => ['href' => 'https://api.example.com/page=2'],
                'last' => ['href' => 'https://api.example.com/page=10'],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeListTeamProjectAccess)
            ));

        $result = $this->projectsTask->listTeamProjectAccessByProject(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertObjectMatchesArray($result->getItems(), $fakeListTeamProjectAccess['items']);
        $this->assertObjectProperties($result->getLinks(), $fakeListTeamProjectAccess['links']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListTeamProjectAccessByTeam()
    {
        $teamId = 'team-123';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';

        $fakeListTeamProjectAccess = [
            'items' => [
                [
                    'teamId' => 'team-123',
                    'organizationId' => 'org-456',
                    'projectId' => 'proj-789',
                    'projectTitle' => 'Awesome Project',
                    'grantedAt' => '2025-09-24T10:00:00Z',
                    'updatedAt' => '2025-09-24T12:30:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self'],
                        'update' => ['href' => 'https://api.example.com/update'],
                        'delete' => ['href' => 'https://api.example.com/delete'],
                    ],
                ],
                [
                    'teamId' => 'team-234',
                    'organizationId' => 'org-567',
                    'projectId' => 'proj-890',
                    'projectTitle' => 'Another Project',
                    'grantedAt' => '2025-09-20T09:00:00Z',
                    'updatedAt' => '2025-09-21T14:15:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self2'],
                        'update' => ['href' => 'https://api.example.com/update2'],
                        'delete' => ['href' => 'https://api.example.com/delete2'],
                    ],
                ],
            ],
            'links' => [
                'first' => ['href' => 'https://api.example.com/page=1'],
                'next' => ['href' => 'https://api.example.com/page=2'],
                'last' => ['href' => 'https://api.example.com/page=10'],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeListTeamProjectAccess)
            ));

        $result = $this->projectsTask->listTeamProjectAccessByTeam(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertObjectMatchesArray($result->getItems(), $fakeListTeamProjectAccess['items']);
        $this->assertObjectProperties($result->getLinks(), $fakeListTeamProjectAccess['links']);
    }



    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetUserProjectAccessByProject()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

        $fakeProjectUserAccess = [
            'userId' => 'user-123',
            'organizationId' => 'org-456',
            'projectId' => 'proj-789',
            'projectTitle' => 'Awesome Project',
            'permissions' => ['read', 'write', 'admin'],
            'grantedAt' => '2025-09-24T10:00:00Z',
            'updatedAt' => '2025-09-24T12:30:00Z',
            'links' => [
                'self' => ['href' => 'https://api.example.com/self'],
                'update' => ['href' => 'https://api.example.com/update'],
                'delete' => ['href' => 'https://api.example.com/delete'],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeProjectUserAccess)
            ));

        $result = $this->projectsTask->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $fakeProjectUserAccess);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantUserProjectAccessByProject()
    {
        $projectId = 'test-project';

        $data = [
            [
                'userId' => 'string',
                'permissions' => ['admin'],
                'autoAddMember' => true,
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No content',
                    'code' => 204
                ])
            ));

        $this->projectsTask->grantUserProjectAccessByProject(projectId: $projectId, permissions: $data);
    }



    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateUserProjectAccessByProject()
    {
        $projectId = 'test-project';
        $userId = 'user-123';
        $fakePermissions = [
            'permissions' => ['admin'],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No content',
                    'code' => 204
                ])
            ));

        $this->projectsTask->updateUserProjectAccessByProject(
            projectId: $projectId,
            userId: $userId,
            permissions: $fakePermissions
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListUserProjectAccessByProject()
    {
        $projectId = 'test-project';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';

        $fakeUserProjectAccessList = [
            'items' => [
                [
                    'userId' => 'user-123',
                    'organizationId' => 'org-456',
                    'projectId' => 'proj-789',
                    'projectTitle' => 'Awesome Project',
                    'permissions' => ['read', 'write', 'admin'],
                    'grantedAt' => '2025-09-24T10:00:00Z',
                    'updatedAt' => '2025-09-24T12:30:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self'],
                        'update' => ['href' => 'https://api.example.com/update'],
                        'delete' => ['href' => 'https://api.example.com/delete'],
                    ],
                ],
                [
                    'userId' => 'user-234',
                    'organizationId' => 'org-567',
                    'projectId' => 'proj-890',
                    'projectTitle' => 'Another Project',
                    'permissions' => ['read'],
                    'grantedAt' => '2025-09-20T09:00:00Z',
                    'updatedAt' => '2025-09-21T14:15:00Z',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/self2'],
                        'update' => ['href' => 'https://api.example.com/update2'],
                        'delete' => ['href' => 'https://api.example.com/delete2'],
                    ],
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeUserProjectAccessList)
            ));

        $result = $this->projectsTask->listUserProjectAccessByProject(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(UserProjectAccess::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $fakeUserProjectAccessList['items']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreate()
    {
        $orgId = 'org-123';

        $subscription = [
            "status" => "active",
            "createdAt" => "2024-10-01T10:00:00Z",
            "updatedAt" => "2025-09-17T12:00:00Z",
            "owner" => "owner_fake_789",
            "ownerInfo" => [
                "type" => "user",
                "username" => "jdoe",
                "displayName" => "John Doe",
            ],
            "vendor" => "upsun",
            "plan" => "upsun/flexible",
            "environments" => 3,
            "storage" => 10240,
            "userLicenses" => 10,
            "projectId" => "proj_fake_456",
            "projectEndpoint" => "https://api.upsun.com/projects/proj_fake_456",
            "projectTitle" => "My Project",
            "projectRegion" => 'fr-3.platform.sh',
            "projectRegionLabel" => "US East",
            "projectUi" => "https://console.upsun.com/org_fake_123/proj_fake_456",
            "projectOptions" => [
                "defaults" => null,
                "enforced" => null,
                "regions" => ["us.platform.sh"],
                "plans" => ["upsun/flexible"],
                "billing" => [
                    "cycle" => "monthly",
                    "currency" => "USD",
                ],
            ],
            "agencySite" => false,
            "invoiced" => true,
            "hipaa" => false,
            "isTrialPlan" => false,
            "services" => ["mysql", "redis"],
            "green" => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($subscription)
            ));
        $result = $this->projectsTask->create(
            organizationId: $orgId,
            projectRegion: 'fr-3.platform.sh',
            title: 'My Project',
            defaultBranch: 'main',
            plan: "upsun/flexible",
            optionsUrl: 'https://example.com/options',
            environments: 3,
            storage: 5000,
        );
        $this->assertInstanceOf(Subscription::class, $result);
        $this->assertObjectProperties($result, $subscription);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListEnvironments()
    {
        $projectId = 'test-project';

        $list = [
            [
                'id' => 'env1',
                '_links' => [],
                '_embedded' => [],
                'created_at' => '2025-09-08T13:29:56.333140+00:00',
                'updated_at' => '2025-09-15T16:17:15.300725+00:00',
                'name' => 'main',
                'machine_name' => 'main-bvxea6i',
                'title' => 'Main',
                'attributes' => [],
                'type' => 'production',
                'parent' => null,
                'default_domain' => null,
                'has_domains' => false,
                'clone_parent_on_create' => true,
                'deployment_target' => 'local',
                'is_pr' => false,
                'has_remote' => false,
                'status' => 'active',
                'http_access' => [
                    'is_enabled' => true,
                    'addresses' => [],
                    'basic_auth' => []
                ],
                'enable_smtp' => true,
                'supports_rolling_deployments' => false,
                'restrict_robots' => true,
                'edge_hostname' => 'main-bvxea6i-azertyuiop.eu-5.platformsh.site',
                'deployment_state' => [
                    'last_state_update_successful' => true,
                    'last_deployment_successful' => true,
                    'last_deployment_at' => '2025-09-15T16:17:15.300344+00:00',
                    'last_autoscale_up_at' => null,
                    'last_autoscale_down_at' => null,
                    'crons' => ['enabled' => true, 'status' => 'running']
                ],
                'sizing' => [
                    'services' => [],
                    'webapps' => [
                        'app' => [
                            'resources' => ['profile_size' => '0.5'],
                            'instance_count' => 1,
                            'disk' => 2001
                        ]
                    ],
                    'workers' => []
                ],
                'resources_overrides' => [],
                'max_instance_count' => null,
                'last_active_at' => '2025-09-15T16:13:18.034357+00:00',
                'last_backup_at' => '2025-09-15T04:09:39.480120+00:00',
                'project' => 'azertyuiop',
                'is_main' => true,
                'is_dirty' => false,
                'has_staged_activities' => false,
                'can_rolling_deploy' => false,
                'has_code' => true,
                'head_commit' => 'azertyuiop',
                'merge_info' => ['commits_ahead' => 0, 'commits_behind' => 0, 'parent_ref' => null],
                'has_deployment' => true,
                'supports_restrict_robots' => true
            ],
            [
                'id' => 'env1',
                '_links' => [],
                '_embedded' => [],
                'created_at' => '2025-09-08T13:29:56.333140+00:00',
                'updated_at' => '2025-09-15T16:17:15.300725+00:00',
                'name' => 'staging',
                'machine_name' => 'main-bvxea6i',
                'title' => 'Staging',
                'attributes' => [],
                'type' => 'staging',
                'parent' => null,
                'default_domain' => null,
                'has_domains' => false,
                'clone_parent_on_create' => true,
                'deployment_target' => 'local',
                'is_pr' => false,
                'has_remote' => false,
                'status' => 'active',
                'http_access' => [
                    'is_enabled' => true,
                    'addresses' => [],
                    'basic_auth' => []
                ],
                'enable_smtp' => true,
                'supports_rolling_deployments' => false,
                'restrict_robots' => true,
                'edge_hostname' => 'main-bvxea6i-azertyuiop.eu-5.platformsh.site',
                'deployment_state' => [
                    'last_state_update_successful' => true,
                    'last_deployment_successful' => true,
                    'last_deployment_at' => '2025-09-15T16:17:15.300344+00:00',
                    'last_autoscale_up_at' => null,
                    'last_autoscale_down_at' => null,
                    'crons' => ['enabled' => true, 'status' => 'running']
                ],
                'sizing' => [
                    'services' => [],
                    'webapps' => [
                        'app' => [
                            'resources' => ['profile_size' => '0.5'],
                            'instance_count' => 1,
                            'disk' => 2001
                        ]
                    ],
                    'workers' => []
                ],
                'resources_overrides' => [],
                'max_instance_count' => null,
                'last_active_at' => '2025-09-15T16:13:18.034357+00:00',
                'last_backup_at' => '2025-09-15T04:09:39.480120+00:00',
                'project' => 'azertyuiop',
                'is_main' => true,
                'is_dirty' => false,
                'has_staged_activities' => false,
                'can_rolling_deploy' => false,
                'has_code' => true,
                'head_commit' => 'azertyuiop',
                'merge_info' => ['commits_ahead' => 0, 'commits_behind' => 0, 'parent_ref' => null],
                'has_deployment' => true,
                'supports_restrict_robots' => true
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));
        $result = $this->projectsTask->listEnvironments(projectId: $projectId);
        $this->assertContainsOnlyInstancesOf(Environment::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteWithError()
    {
        $projectId = 'test-project-with-no-right';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->projectsTask->delete(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->get(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCapabilitiesWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getCapabilities(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->update(projectId: $projectId, title: 'Update Project');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelInviteWithError()
    {
        $projectId = '-1';
        $invitationId = 'invite-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->cancelInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateInviteWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->createInvite(projectId: $projectId, email: 'test@test.fr');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetSettingsWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getSettings(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateSettingsWithError()
    {
        $projectId = 'test-project';
        $data = [
            'dataRetention' => [
                'property1' => [
                    'max_backups' => 7,
                    'default_config' => [
                        'manual_count' => 2,
                        'schedule' => [
                            [
                                'interval' => 'daily',
                                'count' => 7,
                            ],
                            [
                                'interval' => 'weekly',
                                'count' => 4,
                            ],
                        ],
                    ],
                ],
            ],
            'initialize' => [
                'step' => 'prepare',
                'status' => 'pending',
            ],
            'cpu' => 0.5,
            'memory' => 1024,
        ];
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->updateSettings(
            projectId: $projectId,
            initialize: $data['initialize'],
            dataRetention: $data['dataRetention'],
            cpu: $data['cpu'],
            memory: $data['memory']
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->deleteDomain(projectId: $projectId, domainId: $domainId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getDomain(projectId: $projectId, domainId: $domainId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListDomainsWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listDomains(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->deleteCertificate(projectId: $projectId, certificateId: $certId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getCertificate(projectId: $projectId, certificateId: $certId);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testListCertificatesWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listCertificates(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateCertificateWithError()
    {
        $projectId = 'test-project';
        $certId = 'cert-123';
        $certData = [
            'chain' => [
                '-----BEGIN CERTIFICATE-----' . PHP_EOL .
                'FAKE-CHAIN-CERT-DATA' . PHP_EOL .
                '-----END CERTIFICATE-----',
            ],
            'isInvalid' => false,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->updateCertificate(
            projectId: $projectId,
            certificateId: $certId,
            chain: $certData['chain'],
            isInvalid: $certData['isInvalid'],
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetTeamProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetTeamProjectAccessByTeamWithError()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantTeamProjectAccessToProjectWithError()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->grantTeamProjectAccessToProject(
            projectId: $projectId,
            access: $request
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantTeamProjectAccessToTeamWithError()
    {
        $teamId = 'team-123';
        $request = [['role' => 'admin']];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->grantTeamProjectAccessToTeam(teamId: $teamId, access: $request);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListTeamProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listTeamProjectAccessByProject(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListTeamProjectAccessByTeamWithError()
    {
        $teamId = 'team-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listTeamProjectAccessByTeam(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetUserProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantUserProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';
        $request = [['role' => 'admin']];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->grantUserProjectAccessByProject(projectId: $projectId, permissions: $request);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateUserProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';
        $userId = 'user-123';
        $request = ['role' => 'admin'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->updateUserProjectAccessByProject(projectId: $projectId, userId: $userId, permissions: $request);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListUserProjectAccessByProjectWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listUserProjectAccessByProject(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateWithError()
    {
        $orgId = 'org-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->create(
            organizationId: $orgId,
            projectRegion: 'fr-3.platform.sh',
            title: 'My Project',
            defaultBranch: 'main',
            plan: "upsun/flexible",
            optionsUrl: 'https://example.com/options',
            environments: 3,
            storage: 5000,
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListEnvironmentsWithError()
    {
        $projectId = 'test-project';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);
        $this->projectsTask->listEnvironments(projectId: $projectId);
    }
}
