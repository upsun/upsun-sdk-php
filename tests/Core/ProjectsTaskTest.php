<?php

namespace Upsun\Tests\Core;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\APITokensApi;
use Upsun\Api\CertManagementApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\DefaultApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\DomainManagementApi;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MFAApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\RegionsApi;
use Upsun\Api\RoutingApi;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Api\SourceOperationsApi;
use Upsun\Api\SupportApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Api\ApiConfiguration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Blob;
use Upsun\Model\Certificate;
use Upsun\Model\Commit;
use Upsun\Model\DeploymentTarget;
use Upsun\Model\Domain;
use Upsun\Model\Environment;
use Upsun\Model\Integration;
use Upsun\Model\ListProjectTeamAccess200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\Project;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectStatus;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Ref;
use Upsun\Model\Subscription;
use Upsun\Model\SystemInformation;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\Tree;
use Upsun\Model\UserProjectAccess;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Core\Tasks\CertificatesTask;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\InvitationsTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountsTask;
use Upsun\Core\Tasks\OperationsTask;
use Upsun\Core\Tasks\OrganizationsTask;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Core\Tasks\SupportTicketsTask;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\UpsunClient;

class ProjectsTaskTest extends BaseTestCase
{
    protected ProjectsTask $projectsTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->projectsTask = new class (
            $upsunClient,
            new ProjectApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new ProjectSettingsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new DeploymentTargetApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new RepositoryApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new SystemInformationApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new ThirdPartyIntegrationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new SubscriptionsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
        ) extends ProjectsTask {
        };

        $upsunClient->invitations = new class (
            $upsunClient,
            new OrganizationInvitationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new ProjectInvitationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
        ) extends InvitationsTask {
        };

        $upsunClient->variables = new class (
            $upsunClient,
            new ProjectVariablesApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new EnvironmentVariablesApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
        ) extends VariablesTask {
        };

        $upsunClient->activities = new class (
            $upsunClient,
            new ProjectActivityApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new EnvironmentActivityApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends ActivitiesTask {
        };

        $upsunClient->applications = new class (
            $upsunClient,
            new DeploymentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends ApplicationsTask {
        };

        $upsunClient->backups = new class (
            $upsunClient,
            new EnvironmentBackupsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends BackupsTask {
        };

        $upsunClient->certificates = new class (
            $upsunClient,
            new CertManagementApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends CertificatesTask {
        };

        $upsunClient->domains = new class (
            $upsunClient,
            new DomainManagementApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends DomainsTask {
        };

        $upsunClient->environments = new class (
            $upsunClient,
            new EnvironmentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new EnvironmentTypeApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new DeploymentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends EnvironmentsTask {
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
            new RuntimeOperationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends OperationsTask {
        };

        $upsunClient->organizations = new class (
            $upsunClient,
            new OrganizationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new OrganizationProjectsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new OrganizationMembersApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new SubscriptionsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new InvoicesApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new MFAApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new OrdersApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new ProfilesApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new RecordsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new VouchersApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new AddOnsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends OrganizationsTask {
        };

        $upsunClient->projects = $this->projectsTask;

        $upsunClient->regions = new class (
            $upsunClient,
            new RegionsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends RegionsTask {
        };

        $upsunClient->resources = new class (
            $upsunClient,
            new DeploymentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends ResourcesTask {
        };

        $upsunClient->routes = new class (
            $upsunClient,
            new RoutingApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends RoutesTask {
        };

        $upsunClient->sourceOperations = new class (
            $upsunClient,
            new SourceOperationsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends SourceOperationsTask {
        };

        $upsunClient->teams = new class (
            $upsunClient,
            new TeamsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new TeamAccessApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends TeamsTask {
        };

        $upsunClient->supportTickets = new class (
            $upsunClient,
            new DefaultApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new SupportApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends SupportTicketsTask {
        };

        $upsunClient->users = new class (
            $upsunClient,
            new UsersApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new UserProfilesApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new UserAccessApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new APITokensApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new ConnectionsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new GrantsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new MFAApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new PhoneNumberApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends UsersTask {
        };

        $upsunClient->workers = new class (
            $upsunClient,
            new DeploymentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration())
        ) extends WorkersTask {
        };
    }

    public function testGet()
    {
        $prjId = 'test-project';

        $projectFake = [
            'id' => $prjId,
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

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($projectFake)
            ));

        $result = $this->projectsTask->get($prjId);
        $this->assertInstanceOf(Project::class, $result);
        $this->assertObjectProperties($result, $projectFake);
    }

    /**
     * @throws Exception
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
        $this->projectsTask->delete($projectId);
    }

    public function testGetCapabilities()
    {
        $projectId = 'test-project';

        $fakeCapabilities = [
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
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCapabilities)
            ));

        $result = $this->projectsTask->getCapabilities($projectId);
        $this->assertInstanceOf(ProjectCapabilities::class, $result);
        $this->assertObjectProperties($result, $fakeCapabilities);
    }

    public function testUpdate()
    {
        $projectId = 'test-project';

        $fakeProjectPatch = [
            'defaultBranch' => 'main',
            'defaultDomain' => 'myproject.example.com',
            'attributes' => [
                'framework' => 'symfony',
                'language' => 'php',
                'version' => '8.2',
            ],
            'title' => 'My Project',
            'description' => 'A sample project used for testing.',
            'timezone' => 'UTC',
            'region' => 'eu-central-1',
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

        $result = $this->projectsTask->update($projectId, $fakeProjectPatch);

        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

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

        $this->projectsTask->cancelInvite($projectId, $invitationId);
    }

    /**
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

        $fakeCreateProjectInviteRequest = [
            'email' => 'invite@example.com',
            'role' => 'developer',
            'permissions' => [
                'read',
                'write',
                'deploy',
            ],
            'environments' => [
                [
                    'id' => 'env_123',
                    'name' => 'staging',
                ],
                [
                    'id' => 'env_456',
                    'name' => 'production',
                ],
            ],
            'force' => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($invitation)
            ));

        $result = $this->projectsTask->createInvite($projectId, $fakeCreateProjectInviteRequest);
        $this->assertInstanceOf(ProjectInvitation::class, $result);
        $this->assertObjectProperties($result, $invitation);
    }

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

        $result = $this->projectsTask->listInvites($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

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
            'allow_burst' => true,
            'router_resources' => [
                'baseline_cpu' => 0.2,
                'baseline_memory' => 512,
                'max_cpu' => 1.0,
                'max_memory' => 4096,
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeConfig)
            ));

        $result = $this->projectsTask->getSettings($projectId);
        $this->assertInstanceOf(ProjectSettings::class, $result);
        $this->assertObjectProperties($result, $fakeConfig);
    }

    /**
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
            'initialize' => (object)[
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


        $result = $this->projectsTask->updateSettings($projectId, $data);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testCreateVariable()
    {

        $projectId = 'test-project';

        $data = [
            'name' => 'env:API_KEY',
            'value' => '123456789abcdef',
            'attributes' => [
                'description' => 'API key for third-party service',
                'scope' => 'project',
            ],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
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

        $result = $this->projectsTask->createVariable($projectId, $data);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
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

        $result = $this->projectsTask->deleteVariable($projectId, $variableId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

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

        $result = $this->projectsTask->getVariable($projectId, $variableId);
        $this->assertInstanceOf(ProjectVariable::class, $result);
        $this->assertObjectProperties($result, $variable);
    }

    /**
     * @throws Exception
     */
    public function testListVariables()
    {
        $projectId = 'test-project';
        $expectedResponse = [['name' => 'VAR1', 'value' => 'value1']];

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

        $result = $this->projectsTask->listVariables($projectId);
        $this->assertContainsOnlyInstancesOf(ProjectVariable::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testUpdateVariable()
    {
        $projectId = 'test-project';
        $variableId = 'var-123';
        $variableData = [
            'name' => 'API_KEY_UPDATED',
            'attributes' => [
                'property1' => 'updated-metadata',
                'property2' => 'additional-info',
            ],
            'value' => 'abcdef123456789',
            'isJson' => true,
            'isSensitive' => true,
            'visibleBuild' => false,
            'visibleRuntime' => true,
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

        $result = $this->projectsTask->updateVariable($projectId, $variableId, $variableData);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

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

        $result = $this->projectsTask->getActivity($projectId, $activityId);
        $this->assertInstanceOf(Activity::class, $result);
        $this->assertObjectProperties($result, $fakeActivity);
    }

    /**
     * @throws Exception
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

        $result = $this->projectsTask->listActivities($projectId);

        $this->assertContainsOnlyInstancesOf(Activity::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

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

        $this->projectsTask->cancelActivity($projectId, $activityId);
    }

    public function testCreateDeployment()
    {
        $projectId = 'test-project';

        $data = [
            'type' => 'production',
            'name' => 'Main Deployment Target',
            'hosts' => ['host1.example.com', 'host2.example.com'],
            'enforcedMounts' => (object)[
                'mount1' => '/var/www/html',
                'mount2' => '/var/log',
            ],
            'siteUrls' => (object)[
                'primary' => 'https://www.example.com',
                'secondary' => 'https://backup.example.com',
            ],
            'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
            'enterpriseEnvironmentsMapping' => (object)[
                'env1' => 'production',
                'env2' => 'staging',
            ],
            'useDedicatedGrid' => true,
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

        $this->projectsTask->createDeployment($projectId, $data);
    }

    public function testDeleteDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

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

        $this->projectsTask->deleteDeployment($projectId, $deploymentId);
    }

    /**
     * @throws Exception
     */
    public function testGetDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

        $deploymentTarget = [
            'id' => 'deploy1',
            'type' => 'production',
            'name' => 'Main Deployment Target',
            'autoMounts' => true,
            'excludedMounts' => ['cache', 'logs'],
            'enforcedMounts' => (object)[
                'mount1' => '/var/www/html',
                'mount2' => '/var/log',
            ],
            'autoCrons' => true,
            'autoNginx' => true,
            'maintenanceMode' => false,
            'guardrailsPhase' => 2,
            'docroots' => [
                [
                    'activeDocroot' => 'v1',
                    'docrootVersions' => ['v1', 'v2'],
                    'hosts' => [
                        [
                            'type' => 'primary',
                            'id' => 'host1',
                            'services' => ['nginx', 'php']
                        ],
                        [
                            'type' => 'secondary',
                            'id' => 'host2',
                            'services' => ['nginx']
                        ]
                    ]
                ],
                [
                    'activeDocroot' => 'v2',
                    'docrootVersions' => ['v1', 'v2', 'v3'],
                    'hosts' => [
                        [
                            'type' => 'primary',
                            'id' => 'host3',
                            'services' => ['php', 'mysql']
                        ]
                    ]
                ]
            ],
            'siteUrls' => (object)[
                'primary' => 'https://www.example.com',
                'secondary' => 'https://backup.example.com',
            ],
            'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
            'useDedicatedGrid' => true,
            'deployHost' => 'deploy.example.com',
            'deployPort' => 22,
            'sshHost' => 'ssh.example.com',
            'hosts' => [
                [
                    'type' => 'primary',
                    'id' => 'host1',
                    'services' => ['nginx', 'php']
                ],
                [
                    'type' => 'secondary',
                    'id' => 'host2',
                    'services' => ['nginx']
                ]
            ],
            'storageType' => 'ssd',
            'enterpriseEnvironmentsMapping' => (object)[
                'env1' => 'production',
                'env2' => 'staging',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($deploymentTarget)
            ));

        $result = $this->projectsTask->getDeployment($projectId, $deploymentId);
        $this->assertInstanceOf(DeploymentTarget::class, $result);
        $this->assertObjectProperties($result, $deploymentTarget);
    }

    public function testListDeployments()
    {
        $projectId = 'test-project';

        $list = [
            [
                'id' => 'deploy1',
                'type' => 'dedicated',
                'name' => 'Main Deployment Target',
                'autoMounts' => true,
                'excludedMounts' => ['cache', 'logs'],
                'enforcedMounts' => (object)[
                    'mount1' => '/var/www/html',
                    'mount2' => '/var/log',
                ],
                'autoCrons' => true,
                'autoNginx' => true,
                'maintenanceMode' => false,
                'guardrailsPhase' => 2,
                'docroots' => [
                    [
                        'activeDocroot' => 'v1',
                        'docrootVersions' => ['v1', 'v2'],
                        'hosts' => [
                            [
                                'type' => 'primary',
                                'id' => 'host1',
                                'services' => ['nginx', 'php']
                            ],
                            [
                                'type' => 'secondary',
                                'id' => 'host2',
                                'services' => ['nginx']
                            ]
                        ]
                    ],
                    [
                        'activeDocroot' => 'v2',
                        'docrootVersions' => ['v1', 'v2', 'v3'],
                        'hosts' => [
                            [
                                'type' => 'primary',
                                'id' => 'host3',
                                'services' => ['php', 'mysql']
                            ]
                        ]
                    ]
                ],
                'siteUrls' => (object)[
                    'primary' => 'https://www.example.com',
                    'secondary' => 'https://backup.example.com',
                ],
                'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
                'useDedicatedGrid' => true,
                'deployHost' => 'deploy.example.com',
                'deployPort' => 22,
                'sshHost' => 'ssh.example.com',
                'hosts' => [
                    [
                        'type' => 'primary',
                        'id' => 'host1',
                        'services' => ['nginx', 'php']
                    ],
                    [
                        'type' => 'secondary',
                        'id' => 'host2',
                        'services' => ['nginx']
                    ]
                ],
                'storageType' => 'ssd',
                'enterpriseEnvironmentsMapping' => (object)[
                    'env1' => 'production',
                    'env2' => 'staging',
                ],
            ],
            [
                'id' => 'deploy2',
                'type' => 'dedicated',
                'name' => 'Staging Deployment Target',
                'autoMounts' => true,
                'excludedMounts' => ['cache', 'logs'],
                'enforcedMounts' => (object)[
                    'mount1' => '/var/www/html',
                    'mount2' => '/var/log',
                ],
                'autoCrons' => true,
                'autoNginx' => true,
                'maintenanceMode' => false,
                'guardrailsPhase' => 2,
                'docroots' => [
                    [
                        'activeDocroot' => 'v1',
                        'docrootVersions' => ['v1', 'v2'],
                        'hosts' => [
                            [
                                'type' => 'primary',
                                'id' => 'host1',
                                'services' => ['nginx', 'php']
                            ],
                            [
                                'type' => 'secondary',
                                'id' => 'host2',
                                'services' => ['nginx']
                            ]
                        ]
                    ],
                    [
                        'activeDocroot' => 'v2',
                        'docrootVersions' => ['v1', 'v2', 'v3'],
                        'hosts' => [
                            [
                                'type' => 'primary',
                                'id' => 'host3',
                                'services' => ['php', 'mysql']
                            ]
                        ]
                    ]
                ],
                'siteUrls' => (object)[
                    'primary' => 'https://www.example.com',
                    'secondary' => 'https://backup.example.com',
                ],
                'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
                'useDedicatedGrid' => true,
                'deployHost' => 'deploy.example.com',
                'deployPort' => 22,
                'sshHost' => 'ssh.example.com',
                'hosts' => [
                    [
                        'type' => 'primary',
                        'id' => 'host1',
                        'services' => ['nginx', 'php']
                    ],
                    [
                        'type' => 'secondary',
                        'id' => 'host2',
                        'services' => ['nginx']
                    ]
                ],
                'storageType' => 'ssd',
                'enterpriseEnvironmentsMapping' => (object)[
                    'env1' => 'production',
                    'env2' => 'staging',
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

        $result = $this->projectsTask->listDeployments($projectId);
        $this->assertContainsOnlyInstancesOf(DeploymentTarget::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testUpdateDeployment()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $deploymentData = [
            'id' => 'deploy1',
            'type' => 'dedicated',
            'name' => 'Updated Deployment Target',
            'hosts' => [
                [
                    'type' => 'core',
                    'id' => 'host1',
                    'services' => ['nginx', 'php']
                ],
                [
                    'type' => 'secondary',
                    'id' => 'host2',
                    'services' => ['php', 'mysql']
                ]
            ],
            'enforcedMounts' => (object)[
                'mount1' => '/var/www/html',
                'mount2' => '/var/log',
            ],
            'siteUrls' => (object)[
                'primary' => 'https://www.example.com',
                'secondary' => 'https://backup.example.com'
            ],
            'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
            'enterpriseEnvironmentsMapping' => (object)[
                'env1' => 'production',
                'env2' => 'staging'
            ],
            'useDedicatedGrid' => true
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

        $this->projectsTask->updateDeployment($projectId, $deploymentId, $deploymentData);
    }

    /**
     * @throws Exception
     */
    public function testGetGitBlob()
    {
        $projectId = 'test-project';
        $blobId = 'blob-123';

        $fakeBlob = [
            'id' => 'blob1',
            'sha' => 'abc123def456',
            'size' => 1024,
            'encoding' => 'base64',
            'content' => base64_encode('This is the content of the blob')
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeBlob)
            ));

        $result = $this->projectsTask->getGitBlob($projectId, $blobId);
        $this->assertInstanceOf(Blob::class, $result);
        $this->assertObjectProperties($result, $fakeBlob);
    }

    public function testGetGitCommit()
    {
        $projectId = 'test-project';
        $commitId = 'commit-123';

        $fakeCommit = [
            'id' => 'ref1',
            'sha' => 'abc123def456',
            'author' => [
                'date' => '2025-09-24T10:15:00+00:00',
                'name' => 'Alice Author',
                'email' => 'alice@example.com'
            ],
            'committer' => [
                'date' => '2025-09-24T11:00:00+00:00',
                'name' => 'Bob Committer',
                'email' => 'bob@example.com'
            ],
            'message' => 'Initial commit',
            'tree' => 'tree123456789',
            'parents' => ['parent1sha', 'parent2sha']
        ];


        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeCommit)
            ));

        $result = $this->projectsTask->getGitCommit($projectId, $commitId);
        $this->assertInstanceOf(Commit::class, $result);
        $this->assertObjectProperties($result, $fakeCommit);
    }

    public function testGetGitRef()
    {
        $projectId = 'test-project';
        $refId = 'ref-123';
        $fakeRef = [
            'id' => 'ref1',
            'ref' => 'refs/heads/main',
            'object' => [
                'type' => 'commit',
                'sha' => 'abc123def456'
            ],
            'sha' => 'abc123def456'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeRef)
            ));

        $result = $this->projectsTask->getGitRef($projectId, $refId);
        $this->assertInstanceOf(Ref::class, $result);
        $this->assertObjectProperties($result, $fakeRef);
    }

    public function testGetGitTree()
    {
        $projectId = 'test-project';
        $treeId = 'tree-123';
        $fakeTree = [
            'id' => 'ref1',
            'sha' => 'tree123456789',
            'tree' => [
                [
                    'path' => 'src/index.php',
                    'mode' => '100644',
                    'type' => 'blob',
                    'sha' => 'blob123abc'
                ],
                [
                    'path' => 'src/Utils/',
                    'mode' => '040000',
                    'type' => 'tree',
                    'sha' => 'tree456def'
                ],
                [
                    'path' => 'README.md',
                    'mode' => '100644',
                    'type' => 'blob',
                    'sha' => 'blob789ghi'
                ]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeTree)
            ));

        $result = $this->projectsTask->getGitTree($projectId, $treeId);
        $this->assertInstanceOf(Tree::class, $result);
        $this->assertObjectProperties($result, $fakeTree);
    }

    /**
     * @throws Exception
     */
    public function testListGitRefs(): void
    {
        $projectId = 'test-project';

        $list = [
            [
                'id' => 'ref1',
                'ref' => 'refs/heads/main',
                'object' => [
                    'type' => 'commit',
                    'sha' => 'abc123def456'
                ],
                'sha' => 'abc123def456'
            ],
            [
                'id' => 'ref2',
                'ref' => 'refs/heads/staging',
                'object' => [
                    'type' => 'commit',
                    'sha' => 'abc456def789'
                ],
                'sha' => 'abc456def789'
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

        $result = $this->projectsTask->listGitRefs($projectId);
        $this->assertContainsOnlyInstancesOf(Ref::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws Exception
     */
    public function testRestartGitServer()
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

        $result = $this->projectsTask->restartGitServer($projectId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testGetGitInfo()
    {
        $projectId = 'test-project';

        $fakeSystemInformationString = [
            'version' => '1.2.3',
            'image' => 'php:8.2',
            'startedAt' => '2025-09-24T10:15:00+00:00' // format ISO 8601
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeSystemInformationString)
            ));

        $result = $this->projectsTask->getGitInfo($projectId);
        $this->assertInstanceOf(SystemInformation::class, $result);
        $this->assertObjectProperties($result, $fakeSystemInformationString);
    }

    public function testCreateIntegration()
    {
        $projectId = 'test-project';
        $fakeIntegrationCreateInput = [
            'type' => 'github',
            'repository' => 'user/repo',
            'url' => 'https://github.com/user/repo',
            'username' => 'user',
            'token' => 'ghp_exampletoken123',
            'project' => 'project123',
            'serviceId' => 'service-001',
            'recipients' => ['dev@example.com', 'ops@example.com'],
            'routingKey' => 'routing-key-001',
            'channel' => '#notifications',
            'licenseKey' => 'license-xyz-123',
            'script' => 'deploy.sh',
            'index' => 'main',
            'appCredentials' => [
                'key' => 'oauth-key-123',
                'secret' => 'oauth-secret-456'
            ],
            'addonCredentials' => [
                'addonKey' => 'addon-abc',
                'clientKey' => 'client-xyz',
                'sharedSecret' => 'shared-secret-789'
            ],
            'fromAddress' => 'noreply@example.com',
            'sharedKey' => 'shared-key-001',
            'fetchBranches' => true,
            'pruneBranches' => false,
            'environmentInitResources' => 'standard',
            'buildPullRequests' => true,
            'pullRequestsCloneParentData' => false,
            'resyncPullRequests' => true,
            'events' => ['push', 'pull_request'],
            'environments' => ['dev', 'staging'],
            'excludedEnvironments' => ['production'],
            'states' => ['active', 'inactive'],
            'result' => 'success',
            'baseUrl' => 'https://api.example.com',
            'buildDraftPullRequests' => true,
            'buildPullRequestsPostMerge' => false,
            'buildMergeRequests' => true,
            'buildWipMergeRequests' => false,
            'mergeRequestsCloneParentData' => true,
            'extra' => ['option1' => 'value1'],
            'headers' => ['X-Custom-Header' => 'value'],
            'tlsVerify' => true,
            'sourcetype' => 'github',
            'category' => 'ci',
            'host' => 'api.example.com',
            'port' => 443,
            'protocol' => 'https',
            'facility' => 1,
            'messageFormat' => 'json',
            'authToken' => 'token-abc-123',
            'authMode' => 'bearer'
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

        $result = $this->projectsTask->createIntegration($projectId, $fakeIntegrationCreateInput);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testDeleteIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';

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

        $result = $this->projectsTask->deleteIntegration($projectId, $integrationId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $fakeIntegration = [
            'type' => 'github',
            'fetchBranches' => true,
            'pruneBranches' => false,
            'environmentInitResources' => 'standard',
            'repository' => 'user/repo',
            'buildPullRequests' => true,
            'pullRequestsCloneParentData' => false,
            'resyncPullRequests' => true,
            'url' => 'https://github.com/user/repo',
            'username' => 'user',
            'project' => 'project123',
            'environmentsCredentials' => ['dev' => 'cred1', 'staging' => 'cred2'],
            'continuousProfiling' => false,
            'events' => ['push', 'pull_request'],
            'environments' => ['dev', 'staging'],
            'excludedEnvironments' => ['production'],
            'states' => ['active', 'inactive'],
            'result' => 'success',
            'serviceId' => 'service-001',
            'baseUrl' => 'https://api.example.com',
            'buildDraftPullRequests' => true,
            'buildPullRequestsPostMerge' => false,
            'tokenType' => 'bearer',
            'buildMergeRequests' => true,
            'buildWipMergeRequests' => false,
            'mergeRequestsCloneParentData' => true,
            'recipients' => ['dev@example.com', 'ops@example.com'],
            'routingKey' => 'routing-key-001',
            'channel' => '#notifications',
            'extra' => ['option1' => 'value1'],
            'headers' => ['X-Custom-Header' => 'value'],
            'tlsVerify' => true,
            'script' => 'deploy.sh',
            'index' => 'main',
            'sourcetype' => 'github',
            'category' => 'ci',
            'host' => 'api.example.com',
            'port' => 443,
            'protocol' => 'https',
            'facility' => 1,
            'messageFormat' => 'json',
            'createdAt' => '2025-09-24T10:15:00+00:00', // string ISO 8601
            'updatedAt' => '2025-09-24T10:20:00+00:00', // string ISO 8601
            'fromAddress' => 'noreply@example.com',
            'sharedKey' => 'shared-key-001',
            'appCredentials' => [
                'key' => 'oauth-key-123'
            ],
            'addonCredentials' => [
                'addonKey' => 'addon-abc',
                'clientKey' => 'client-xyz'
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeIntegration)
            ));

        $result = $this->projectsTask->getIntegration($projectId, $integrationId);
        $this->assertInstanceOf(Integration::class, $result);
        $this->assertObjectProperties($result, $fakeIntegration);
    }

    public function testListIntegrations()
    {
        $projectId = 'test-project';
        $list = [
            [
                'type' => 'github',
                'fetchBranches' => true,
                'pruneBranches' => false,
                'environmentInitResources' => 'standard',
                'repository' => 'user/repo',
                'buildPullRequests' => true,
                'pullRequestsCloneParentData' => false,
                'resyncPullRequests' => true,
                'url' => 'https://github.com/user/repo',
                'username' => 'user',
                'project' => 'project123',
                'environmentsCredentials' => ['dev' => 'cred1', 'staging' => 'cred2'],
                'continuousProfiling' => false,
                'events' => ['push', 'pull_request'],
                'environments' => ['dev', 'staging'],
                'excludedEnvironments' => ['production'],
                'states' => ['active', 'inactive'],
                'result' => 'success',
                'serviceId' => 'service-001',
                'baseUrl' => 'https://api.example.com',
                'buildDraftPullRequests' => true,
                'buildPullRequestsPostMerge' => false,
                'tokenType' => 'bearer',
                'buildMergeRequests' => true,
                'buildWipMergeRequests' => false,
                'mergeRequestsCloneParentData' => true,
                'recipients' => ['dev@example.com', 'ops@example.com'],
                'routingKey' => 'routing-key-001',
                'channel' => '#notifications',
                'extra' => ['option1' => 'value1'],
                'headers' => ['X-Custom-Header' => 'value'],
                'tlsVerify' => true,
                'script' => 'deploy.sh',
                'index' => 'main',
                'sourcetype' => 'github',
                'category' => 'ci',
                'host' => 'api.example.com',
                'port' => 443,
                'protocol' => 'https',
                'facility' => 1,
                'messageFormat' => 'json',
                'createdAt' => '2025-09-24T10:15:00+00:00', // string ISO 8601
                'updatedAt' => '2025-09-24T10:20:00+00:00', // string ISO 8601
                'fromAddress' => 'noreply@example.com',
                'sharedKey' => 'shared-key-001',
                'appCredentials' => [
                    'key' => 'oauth-key-123'
                ],
                'addonCredentials' => [
                    'addonKey' => 'addon-abc',
                    'clientKey' => 'client-xyz'
                ]
            ],
            [
                'type' => 'gitlab',
                'fetchBranches' => true,
                'pruneBranches' => false,
                'environmentInitResources' => 'standard',
                'repository' => 'user/repo',
                'buildPullRequests' => true,
                'pullRequestsCloneParentData' => false,
                'resyncPullRequests' => true,
                'url' => 'https://gitlab.com/user/repo',
                'username' => 'user',
                'project' => 'project123',
                'environmentsCredentials' => ['dev' => 'cred1', 'staging' => 'cred2'],
                'continuousProfiling' => false,
                'events' => ['push', 'pull_request'],
                'environments' => ['dev', 'staging'],
                'excludedEnvironments' => ['production'],
                'states' => ['active', 'inactive'],
                'result' => 'success',
                'serviceId' => 'service-001',
                'baseUrl' => 'https://api.example.com',
                'buildDraftPullRequests' => true,
                'buildPullRequestsPostMerge' => false,
                'tokenType' => 'bearer',
                'buildMergeRequests' => true,
                'buildWipMergeRequests' => false,
                'mergeRequestsCloneParentData' => true,
                'recipients' => ['dev@example.com', 'ops@example.com'],
                'routingKey' => 'routing-key-001',
                'channel' => '#notifications',
                'extra' => ['option1' => 'value1'],
                'headers' => ['X-Custom-Header' => 'value'],
                'tlsVerify' => true,
                'script' => 'deploy.sh',
                'index' => 'main',
                'sourcetype' => 'github',
                'category' => 'ci',
                'host' => 'api.example.com',
                'port' => 443,
                'protocol' => 'https',
                'facility' => 1,
                'messageFormat' => 'json',
                'createdAt' => '2025-09-24T10:15:00+00:00', // string ISO 8601
                'updatedAt' => '2025-09-24T10:20:00+00:00', // string ISO 8601
                'fromAddress' => 'noreply@example.com',
                'sharedKey' => 'shared-key-001',
                'appCredentials' => [
                    'key' => 'oauth-key-123'
                ],
                'addonCredentials' => [
                    'addonKey' => 'addon-abc',
                    'clientKey' => 'client-xyz'
                ]
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

        $result = $this->projectsTask->listIntegrations($projectId);
        $this->assertContainsOnlyInstancesOf(Integration::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testUpdateIntegration()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $fakeIntegrationPatch = [
            'type' => 'github',
            'repository' => 'user/repo',
            'url' => 'https://github.com/user/repo',
            'username' => 'user',
            'token' => 'ghp_exampletoken123',
            'project' => 'project123',
            'serviceId' => 'service-001',
            'recipients' => ['dev@example.com', 'ops@example.com'],
            'routingKey' => 'routing-key-001',
            'channel' => '#notifications',
            'licenseKey' => 'license-xyz-123',
            'script' => 'deploy.sh',
            'index' => 'main',
            'appCredentials' => [
                'key' => 'oauth-key-123',
                'secret' => 'oauth-secret-456'
            ],
            'addonCredentials' => [
                'addonKey' => 'addon-abc',
                'clientKey' => 'client-xyz',
                'sharedSecret' => 'shared-secret-789'
            ],
            'fromAddress' => 'noreply@example.com',
            'sharedKey' => 'shared-key-001',
            'fetchBranches' => true,
            'pruneBranches' => false,
            'environmentInitResources' => 'standard',
            'buildPullRequests' => true,
            'pullRequestsCloneParentData' => false,
            'resyncPullRequests' => true,
            'events' => ['push', 'pull_request'],
            'environments' => ['dev', 'staging'],
            'excludedEnvironments' => ['production'],
            'states' => ['active', 'inactive'],
            'result' => 'success',
            'baseUrl' => 'https://api.example.com',
            'buildDraftPullRequests' => true,
            'buildPullRequestsPostMerge' => false,
            'buildMergeRequests' => true,
            'buildWipMergeRequests' => false,
            'mergeRequestsCloneParentData' => true,
            'extra' => ['option1' => 'value1'],
            'headers' => ['X-Custom-Header' => 'value'],
            'tlsVerify' => true,
            'sourcetype' => 'github',
            'category' => 'ci',
            'host' => 'api.example.com',
            'port' => 443,
            'protocol' => 'https',
            'facility' => 1,
            'messageFormat' => 'json',
            'authToken' => 'token-abc-123',
            'authMode' => 'bearer'
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

        $result = $this->projectsTask->updateIntegration($projectId, $integrationId, $fakeIntegrationPatch);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testCreateDomain()
    {
        $projectId = 'test-project';
        $domainData = [
            'name' => 'example.com',
            'attributes' => [
                'ssl' => 'enabled',
                'region' => 'eu',
            ],
            'isDefault' => true,
            'replacementFor' => null,
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

        $result = $this->projectsTask->createDomain($projectId, $domainData);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

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

        $result = $this->projectsTask->deleteDomain($projectId, $domainId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domain = [
            'type' => 'custom',
            'name' => 'example.com',
            'attributes' => [
                'ssl' => 'enabled',
                'region' => 'eu',
            ],
            'createdAt' => '2025-09-24T10:15:00+00:00',
            'updatedAt' => '2025-09-24T10:20:00+00:00',
            'project' => 'project123',
            'registeredName' => 'example.com',
            'isDefault' => true,
            'replacementFor' => null,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($domain)
            ));

        $result = $this->projectsTask->getDomain($projectId, $domainId);
        $this->assertInstanceOf(Domain::class, $result);
        $this->assertObjectProperties($result, $domain);
    }

    public function testListDomains()
    {
        $projectId = 'test-project';
        $list = [
            [
                'type' => 'custom',
                'name' => 'example.com',
                'attributes' => [
                    'ssl' => 'enabled',
                    'region' => 'eu',
                ],
                'createdAt' => '2025-09-24T10:15:00+00:00',
                'updatedAt' => '2025-09-24T10:20:00+00:00',
                'project' => 'project123',
                'registeredName' => 'example.com',
                'isDefault' => true,
                'replacementFor' => null,
            ],
            [
                'type' => 'custom',
                'name' => 'example2.com',
                'attributes' => [
                    'ssl' => 'enabled',
                    'region' => 'fr',
                ],
                'createdAt' => '2025-09-24T10:15:00+00:00',
                'updatedAt' => '2025-09-24T10:20:00+00:00',
                'project' => 'project123',
                'registeredName' => 'example2.com',
                'isDefault' => true,
                'replacementFor' => null,
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

        $result = $this->projectsTask->listDomains($projectId);
        $this->assertContainsOnlyInstancesOf(Domain::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testUpdateDomain()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domainData = ['attributes' => [], "isDefault" => true];

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

        $result = $this->projectsTask->updateDomain($projectId, $domainId, $domainData);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testCreateCertificate()
    {
        $projectId = 'test-project';
        $fakeCertificateCreateInput = [
            'certificate' => '-----BEGIN CERTIFICATE-----
MIIDXTCCAkWgAwIBAgIJAK8kU8kXk9Z+MA0GC...
-----END CERTIFICATE-----',
            'key' => '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASC...
-----END PRIVATE KEY-----',
            'chain' => [
                '-----BEGIN CERTIFICATE-----
MIIDdTCCAl2gAwIBAgIEb/2OBDANBgkqhkiG9w0BAQUFADB1MQswCQYDVQQGEwJV
...
-----END CERTIFICATE-----',
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

        $result = $this->projectsTask->createCertificate($projectId, $fakeCertificateCreateInput);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

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

        $result = $this->projectsTask->deleteCertificate($projectId, $certId);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

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

        $result = $this->projectsTask->getCertificate($projectId, $certId);
        $this->assertInstanceOf(Certificate::class, $result);
        $this->assertObjectProperties($result, $fakeCertificate);
    }

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

        $result = $this->projectsTask->listCertificates($projectId);
        $this->assertContainsOnlyInstancesOf(Certificate::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

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

        $result = $this->projectsTask->updateCertificate($projectId, $certId, $certData);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testRunOperation()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $deploymentId = 'deploy-123';
        $operationData = [
            'service' => 'database',
            'operation' => 'backup',
            'parameters' => []
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

        $result = $this->projectsTask->runOperation($projectId, $environmentId, $deploymentId, $operationData);
        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    public function testGetProjectTeamAccess()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';

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

        $result = $this->projectsTask->getProjectTeamAccess($projectId, $teamId);
        $this->assertInstanceOf(TeamProjectAccess::class, $result);
        $this->assertObjectProperties($result, $fakeTeamProjectAccess);
    }

    /**
     * @throws Exception
     */
    public function testGetTeamProjectAccess()
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

        $result = $this->projectsTask->getTeamProjectAccess($teamId, $projectId);
        $this->assertInstanceOf(TeamProjectAccess::class, $result);
        $this->assertObjectProperties($result, $fakeTeamProjectAccess);
    }

    /**
     * @throws Exception
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

        $this->projectsTask->grantProjectTeamAccess($projectId, $fakeTeamProjectAccessList);
    }

    /**
     * @throws Exception
     */
    public function testGrantTeamProjectAccess()
    {
        $teamId = 'team-123';
        $request = [['role' => 'admin']];

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

        $this->projectsTask->grantTeamProjectAccess($teamId, $fakeProjectTeamAccessList);
    }

    public function testListProjectTeamAccess()
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

        $result = $this->projectsTask->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertObjectMatchesArray($result->getItems(), $fakeListTeamProjectAccess['items']);
        $this->assertObjectProperties($result->getLinks(), $fakeListTeamProjectAccess['links']);
    }

    public function testListTeamProjectAccess()
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

        $result = $this->projectsTask->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertObjectMatchesArray($result->getItems(), $fakeListTeamProjectAccess['items']);
        $this->assertObjectProperties($result->getLinks(), $fakeListTeamProjectAccess['links']);
    }

    public function testRemoveProjectTeamAccess()
    {
        $projectId = 'test-project';
        $teamId = 'team-123';

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

        $this->projectsTask->removeProjectTeamAccess($projectId, $teamId);
    }

    public function testRemoveTeamProjectAccess()
    {
        $teamId = 'team-123';
        $projectId = 'test-project';

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

        $this->projectsTask->removeTeamProjectAccess($teamId, $projectId);
    }

    public function testGetProjectUserAccess()
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

        $result = $this->projectsTask->getProjectUserAccess($projectId, $userId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $fakeProjectUserAccess);
    }

    public function testGrantProjectUserAccess()
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

        $this->projectsTask->grantProjectUserAccess($projectId, $data);
    }

    public function testRemoveProjectUserAccess()
    {
        $projectId = 'test-project';
        $userId = 'user-123';

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

        $this->projectsTask->removeProjectUserAccess($projectId, $userId);
    }

    public function testUpdateProjectUserAccess()
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

        $this->projectsTask->updateProjectUserAccess($projectId, $userId, $fakePermissions);
    }

    public function testListProjectUserAccess()
    {
        $projectId = 'test-project';
        $pageSize = 10;
        $pageBefore = 'before-cursor';
        $pageAfter = 'after-cursor';
        $sort = 'created_at';

        $fakeUserProjectAccessList = [
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
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeUserProjectAccessList)
            ));

        $result = $this->projectsTask->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
    }

    public function testCreate()
    {
        $orgId = 'org-123';

        $projectData = [
            'projectRegion' => 'fr-3.platform.sh',
            "plan" => "upsun/flexible",
            'projectTitle' => 'My Project',
            'optionsUrl' => 'https://example.com/options',
            'defaultBranch' => 'main',
            'environments' => 3,
            'storage' => 5000,
        ];

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
        $result = $this->projectsTask->create($orgId, $projectData);
        $this->assertInstanceOf(Subscription::class, $result);
        $this->assertObjectProperties($result, $subscription);
    }

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
                'restrict_robots' => true,
                'edge_hostname' => 'main-bvxea6i-azertyuiop.eu-5.platformsh.site',
                'deployment_state' => [
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
                'restrict_robots' => true,
                'edge_hostname' => 'main-bvxea6i-azertyuiop.eu-5.platformsh.site',
                'deployment_state' => [
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
                204,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));
        $result = $this->projectsTask->listEnvironments($projectId);
        $this->assertContainsOnlyInstancesOf(Environment::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    public function testDeleteWithError()
    {
        $orgId = 'test-org-with-no-right';
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

        $this->projectsTask->delete($orgId, $projectId);
    }

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
        $this->projectsTask->get($projectId);
    }

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
        $this->projectsTask->getCapabilities($projectId);
    }

    public function testUpdateWithError()
    {
        $projectId = 'test-project';
        $projectData = ['title' => 'Updated Project'];

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
        $this->projectsTask->update($projectId, $projectData);
    }

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
        $this->projectsTask->cancelInvite($projectId, $invitationId);
    }

    public function testCreateInviteWithError()
    {
        $projectId = 'test-project';
        $request = ['email' => 'test'];

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
        $this->projectsTask->createInvite($projectId, $request);
    }

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
        $this->projectsTask->getSettings($projectId);
    }

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
            'initialize' => (object)[
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
        $this->projectsTask->updateSettings($projectId, $data);
    }

    public function testCreateDeploymentWithError()
    {
        $projectId = 'test-project';
        $data = [
            'type' => 'production',
            'name' => 'Main Deployment Target',
            'hosts' => ['host1.example.com', 'host2.example.com'],
            'enforcedMounts' => (object)[
                'mount1' => '/var/www/html',
                'mount2' => '/var/log',
            ],
            'siteUrls' => (object)[
                'primary' => 'https://www.example.com',
                'secondary' => 'https://backup.example.com',
            ],
            'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
            'enterpriseEnvironmentsMapping' => (object)[
                'env1' => 'production',
                'env2' => 'staging',
            ],
            'useDedicatedGrid' => true,
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
        $this->projectsTask->createDeployment($projectId, $data);
    }

    public function testDeleteDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

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
        $this->projectsTask->deleteDeployment($projectId, $deploymentId);
    }

    public function testGetDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';

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
        $this->projectsTask->getDeployment($projectId, $deploymentId);
    }

    public function testListDeploymentsWithError()
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
        $this->projectsTask->listDeployments($projectId);
    }

    public function testUpdateDeploymentWithError()
    {
        $projectId = 'test-project';
        $deploymentId = 'deploy-123';
        $deploymentData = [
            'type' => 'dedicated',
            'name' => 'Updated Deployment Target',
            'hosts' => [
                [
                    'type' => 'core',
                    'id' => 'host1',
                    'services' => ['nginx', 'php']
                ],
                [
                    'type' => 'secondary',
                    'id' => 'host2',
                    'services' => ['php', 'mysql']
                ]
            ],
            'enforcedMounts' => (object)[
                'mount1' => '/var/www/html',
                'mount2' => '/var/log',
            ],
            'siteUrls' => (object)[
                'primary' => 'https://www.example.com',
                'secondary' => 'https://backup.example.com'
            ],
            'sshHosts' => ['ssh1.example.com', 'ssh2.example.com'],
            'enterpriseEnvironmentsMapping' => (object)[
                'env1' => 'production',
                'env2' => 'staging'
            ],
            'useDedicatedGrid' => true
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
        $this->projectsTask->updateDeployment($projectId, $deploymentId, $deploymentData);
    }

    public function testGetGitBlobWithError()
    {
        $projectId = 'test-project';
        $blobId = 'blob-123';

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
        $this->projectsTask->getGitBlob($projectId, $blobId);
    }

    public function testGetGitCommitWithError()
    {
        $projectId = 'test-project';
        $commitId = 'commit-123';

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
        $this->projectsTask->getGitCommit($projectId, $commitId);
    }

    public function testGetGitRefWithError()
    {
        $projectId = 'test-project';
        $refId = 'ref-123';

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
        $this->projectsTask->getGitRef($projectId, $refId);
    }

    public function testGetGitTreeWithError()
    {
        $projectId = 'test-project';
        $treeId = 'tree-123';

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
        $this->projectsTask->getGitTree($projectId, $treeId);
    }

    public function testListGitRefsWithError()
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
        $this->projectsTask->listGitRefs($projectId);
    }

    public function testRestartGitServerWithError()
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
        $this->projectsTask->restartGitServer($projectId);
    }

    public function testGetGitInfoWithError()
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
        $this->projectsTask->getGitInfo($projectId);
    }

    public function testCreateIntegrationWithError()
    {
        $projectId = 'test-project';
        $fakeIntegrationCreateInput = [
            'type' => 'github',
            'repository' => 'user/repo',
            'url' => 'https://github.com/user/repo',
            'username' => 'user',
            'token' => 'ghp_exampletoken123',
            'project' => 'project123',
            'serviceId' => 'service-001',
            'recipients' => ['dev@example.com', 'ops@example.com'],
            'routingKey' => 'routing-key-001',
            'channel' => '#notifications',
            'licenseKey' => 'license-xyz-123',
            'script' => 'deploy.sh',
            'index' => 'main',
            'appCredentials' => [
                'key' => 'oauth-key-123',
                'secret' => 'oauth-secret-456'
            ],
            'addonCredentials' => [
                'addonKey' => 'addon-abc',
                'clientKey' => 'client-xyz',
                'sharedSecret' => 'shared-secret-789'
            ],
            'fromAddress' => 'noreply@example.com',
            'sharedKey' => 'shared-key-001',
            'fetchBranches' => true,
            'pruneBranches' => false,
            'environmentInitResources' => 'standard',
            'buildPullRequests' => true,
            'pullRequestsCloneParentData' => false,
            'resyncPullRequests' => true,
            'events' => ['push', 'pull_request'],
            'environments' => ['dev', 'staging'],
            'excludedEnvironments' => ['production'],
            'states' => ['active', 'inactive'],
            'result' => 'success',
            'baseUrl' => 'https://api.example.com',
            'buildDraftPullRequests' => true,
            'buildPullRequestsPostMerge' => false,
            'buildMergeRequests' => true,
            'buildWipMergeRequests' => false,
            'mergeRequestsCloneParentData' => true,
            'extra' => ['option1' => 'value1'],
            'headers' => ['X-Custom-Header' => 'value'],
            'tlsVerify' => true,
            'sourcetype' => 'github',
            'category' => 'ci',
            'host' => 'api.example.com',
            'port' => 443,
            'protocol' => 'https',
            'facility' => 1,
            'messageFormat' => 'json',
            'authToken' => 'token-abc-123',
            'authMode' => 'bearer'
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
        $this->projectsTask->createIntegration($projectId, $fakeIntegrationCreateInput);
    }

    public function testDeleteIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';

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
        $this->projectsTask->deleteIntegration($projectId, $integrationId);
    }

    public function testGetIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';

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
        $this->projectsTask->getIntegration($projectId, $integrationId);
    }

    public function testListIntegrationsWithError()
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
        $this->projectsTask->listIntegrations($projectId);
    }

    public function testUpdateIntegrationWithError()
    {
        $projectId = 'test-project';
        $integrationId = 'integration-123';
        $fakeIntegrationPatch = [
            'type' => 'github',
            'repository' => 'user/repo',
            'url' => 'https://github.com/user/repo',
            'username' => 'user',
            'token' => 'ghp_exampletoken123',
            'project' => 'project123',
            'serviceId' => 'service-001',
            'recipients' => ['dev@example.com', 'ops@example.com'],
            'routingKey' => 'routing-key-001',
            'channel' => '#notifications',
            'licenseKey' => 'license-xyz-123',
            'script' => 'deploy.sh',
            'index' => 'main',
            'appCredentials' => [
                'key' => 'oauth-key-123',
                'secret' => 'oauth-secret-456'
            ],
            'addonCredentials' => [
                'addonKey' => 'addon-abc',
                'clientKey' => 'client-xyz',
                'sharedSecret' => 'shared-secret-789'
            ],
            'fromAddress' => 'noreply@example.com',
            'sharedKey' => 'shared-key-001',
            'fetchBranches' => true,
            'pruneBranches' => false,
            'environmentInitResources' => 'standard',
            'buildPullRequests' => true,
            'pullRequestsCloneParentData' => false,
            'resyncPullRequests' => true,
            'events' => ['push', 'pull_request'],
            'environments' => ['dev', 'staging'],
            'excludedEnvironments' => ['production'],
            'states' => ['active', 'inactive'],
            'result' => 'success',
            'baseUrl' => 'https://api.example.com',
            'buildDraftPullRequests' => true,
            'buildPullRequestsPostMerge' => false,
            'buildMergeRequests' => true,
            'buildWipMergeRequests' => false,
            'mergeRequestsCloneParentData' => true,
            'extra' => ['option1' => 'value1'],
            'headers' => ['X-Custom-Header' => 'value'],
            'tlsVerify' => true,
            'sourcetype' => 'github',
            'category' => 'ci',
            'host' => 'api.example.com',
            'port' => 443,
            'protocol' => 'https',
            'facility' => 1,
            'messageFormat' => 'json',
            'authToken' => 'token-abc-123',
            'authMode' => 'bearer'
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
        $this->projectsTask->updateIntegration($projectId, $integrationId, $fakeIntegrationPatch);
    }

    public function testCreateDomainWithError()
    {
        $projectId = '-1';
        $domainData = ['name' => 'example.com'];

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
        $this->projectsTask->createDomain($projectId, $domainData);
    }

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
        $this->projectsTask->deleteDomain($projectId, $domainId);
    }

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
        $this->projectsTask->getDomain($projectId, $domainId);
    }

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
        $this->projectsTask->listDomains($projectId);
    }

    public function testUpdateDomainWithError()
    {
        $projectId = 'test-project';
        $domainId = 'domain-123';
        $domainData = ['attributes' => [], "isDefault" => true];

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
        $this->projectsTask->updateDomain($projectId, $domainId, $domainData);
    }

    public function testCreateCertificateWithError()
    {
        $projectId = 'test-project';
        $certData = ['certificate' => 'cert-data', 'key' => 'key-data'];

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
        $this->projectsTask->createCertificate($projectId, $certData);
    }

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
        $this->projectsTask->deleteCertificate($projectId, $certId);
    }

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
        $this->projectsTask->getCertificate($projectId, $certId);
    }

    /**
     * @throws Exception
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
        $this->projectsTask->listCertificates($projectId);
    }

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
        $this->projectsTask->updateCertificate($projectId, $certId, $certData);
    }

    public function testRunOperationWithError()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $deploymentId = 'deploy-123';
        $operationData = [
            'service' => 'database',
            'operation' => 'backup',
            'parameters' => [],
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
        $this->projectsTask->runOperation($projectId, $environmentId, $deploymentId, $operationData);
    }

    public function testGetProjectTeamAccessWithError()
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
        $this->projectsTask->getProjectTeamAccess($projectId, $teamId);
    }

    public function testGetTeamProjectAccessWithError()
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
        $this->projectsTask->getTeamProjectAccess($teamId, $projectId);
    }

    public function testGrantProjectTeamAccessWithError()
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
        $this->projectsTask->grantProjectTeamAccess($projectId, $request);
    }

    public function testGrantTeamProjectAccessWithError()
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
        $this->projectsTask->grantTeamProjectAccess($teamId, $request);
    }

    public function testListProjectTeamAccessWithError()
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
        $this->projectsTask->listProjectTeamAccess($projectId);
    }

    public function testListTeamProjectAccessWithError()
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
        $this->projectsTask->listTeamProjectAccess($teamId);
    }

    public function testRemoveProjectTeamAccessWithError()
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
        $this->projectsTask->removeProjectTeamAccess($projectId, $teamId);
    }

    public function testRemoveTeamProjectAccessWithError()
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
        $this->projectsTask->removeTeamProjectAccess($teamId, $projectId);
    }

    public function testGetProjectUserAccessWithError()
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
        $this->projectsTask->getProjectUserAccess($projectId, $userId);
    }

    public function testGrantProjectUserAccessWithError()
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
        $this->projectsTask->grantProjectUserAccess($projectId, $request);
    }

    public function testRemoveProjectUserAccessWithError()
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
        $this->projectsTask->removeProjectUserAccess($projectId, $userId);
    }

    public function testUpdateProjectUserAccessWithError()
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
        $this->projectsTask->updateProjectUserAccess($projectId, $userId, $request);
    }

    public function testListProjectUserAccessWithError()
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
        $this->projectsTask->listProjectUserAccess($projectId);
    }

    public function testCreateWithError()
    {
        $orgId = 'org-123';
        $projectData = [
            'projectRegion' => 'fr-3.platform.sh',
            "plan" => "upsun/flexible",
            'projectTitle' => 'My Project',
            'optionsUrl' => 'https://example.com/options',
            'defaultBranch' => 'main',
            'environments' => 3,
            'storage' => 5000,
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
        $this->projectsTask->create($orgId, $projectData);
    }

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
        $this->projectsTask->listEnvironments($projectId);
    }
}
