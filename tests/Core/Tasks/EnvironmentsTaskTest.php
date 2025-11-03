<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Api\DomainManagementApi;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\RoutingApi;
use Upsun\Api\SourceOperationsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Backup;
use Upsun\Model\Deployment;
use Upsun\Model\Domain;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\Model\EnvironmentType;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Route;
use Upsun\UpsunClient;

class EnvironmentsTaskTest extends BaseTestCase
{
    private EnvironmentsTask $environmentTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);
        $upsunClient = $this->createMock(UpsunClient::class);

        $environmentApi = new EnvironmentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration());
        $environmentTypeApi = new EnvironmentTypeApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );
        $deploymentApi = new DeploymentApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration());

        // Activity Task init
        $projectActivityApi = new ProjectActivityApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $environmentActivityApi = new EnvironmentActivityApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $activitiesTask = new class (
            $upsunClient,
            $projectActivityApi,
            $environmentActivityApi
        ) extends ActivitiesTask {
        };
        $upsunClient->activities = $activitiesTask;

        // BackupTask init
        $environmentBackupApi = new EnvironmentBackupsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $backupsTask = new class (
            $upsunClient,
            $environmentBackupApi
        ) extends BackupsTask {
        };
        $upsunClient->backups = $backupsTask;

        // VariablesTask init
        $environmentVariablesApi = new EnvironmentVariablesApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $projectVariablesApi = new ProjectVariablesApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $variablesTask = new class (
            $upsunClient,
            $projectVariablesApi,
            $environmentVariablesApi
        ) extends VariablesTask {
        };
        $upsunClient->variables = $variablesTask;

        // RouteTask init
        $routingApi = new RoutingApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $routesTask = new class (
            $upsunClient,
            $routingApi
        ) extends RoutesTask {
        };
        $upsunClient->routes = $routesTask;

        // DomainTask init
        $domainManagementApi = new DomainManagementApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $domainsTask = new class (
            $upsunClient,
            $domainManagementApi
        ) extends DomainsTask {
        };
        $upsunClient->domains = $domainsTask;

        // SourceOperationTask init
        $sourceOperationApi = new SourceOperationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new ApiConfiguration()
        );

        $sourcesTask = new class (
            $upsunClient,
            $sourceOperationApi
        ) extends SourceOperationsTask {
        };
        $upsunClient->sourceOperations = $sourcesTask;

        // EnvironmentTask
        $this->environmentTask = new class (
            $upsunClient,
            $environmentApi,
            $environmentTypeApi,
            $deploymentApi
        ) extends EnvironmentsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testActivate(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $init = 'true';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->activate($projectId, $environmentId, $init);

        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBranch(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = [
            'title' => 'Feature Branch',
            'name' => 'feature-branch',
            'cloneParent' => true,
            'type' => 'staging'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->branch($projectId, $environmentId, $input);

        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGet(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'ref1',
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
                    'supportsRollingDeployments' => false,
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
                ])
            ));

        $result = $this->environmentTask->get($projectId, $environmentId);
        $this->assertEquals("azertyuiop", $result->getProject());
        $this->assertEquals("main", $result->getName());
        $this->assertEquals("production", $result->getType());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testList(): void
    {
        $projectId = 'project-123';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'ref1',
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
                        'supportsRollingDeployments' => false,
                        'head_commit' => 'azertyuiop',
                        'merge_info' => ['commits_ahead' => 0, 'commits_behind' => 0, 'parent_ref' => null],
                        'has_deployment' => true,
                        'supports_restrict_robots' => true
                    ],
                    [
                        'id' => 'ref2',
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
                        'supportsRollingDeployments' => false,
                        'head_commit' => 'azertyuiop',
                        'merge_info' => ['commits_ahead' => 0, 'commits_behind' => 0, 'parent_ref' => null],
                        'has_deployment' => true,
                        'supports_restrict_robots' => true
                    ]
                ])
            ));

        $result = $this->environmentTask->list($projectId);
        $this->assertEquals("azertyuiop", $result[0]->getProject());
        $this->assertEquals("main", $result[0]->getName());
        $this->assertEquals("production", $result[0]->getType());
        $this->assertEquals("azertyuiop", $result[1]->getProject());
        $this->assertEquals("staging", $result[1]->getName());
        $this->assertEquals("staging", $result[1]->getType());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDelete(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->delete($projectId, $environmentId);
        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $this->assertEquals($acceptedResponse, $result);
    }

    public function testUpdate(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $patch = ['title' => 'Updated Environment'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->update($projectId, $environmentId, $patch);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testMerge(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->merge($projectId, $environmentId);

        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testPause(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->pause($projectId, $environmentId);
        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testResume(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->resume($projectId, $environmentId);
        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateVersions(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->createVersions($projectId, $environmentId);
        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListVersions(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'version1',
                        'commit' => 'azertyuiop1236',
                        'locked' => false,
                        'routing' => [
                            'percentage' => 100
                        ]
                    ],
                    [
                        'id' => 'version2',
                        'commit' => 'azertyuiop1235',
                        'locked' => false,
                        'routing' => [
                            'percentage' => 100
                        ]
                    ]
                ])
            ));

        $result = $this->environmentTask->listVersions($projectId, $environmentId);
        $this->assertEquals("azertyuiop1236", $result[0]->getCommit());
        $this->assertEquals("azertyuiop1235", $result[1]->getCommit());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetVersions(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'default',
                    'commit' => 'azertyuiop1236',
                    'locked' => false,
                    'routing' => [
                        'percentage' => 100
                    ]
                ])
            ));

        $result = $this->environmentTask->getVersions($projectId, $environmentId, 'default');
        $this->assertEquals("azertyuiop1236", $result->getCommit());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListActivities(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-1',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ],
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-2',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                ])
            ));

        $response = $this->environmentTask->listActivities("proj-id", "env-id");

        $this->assertNotEmpty($response);
        $this->assertEquals("proj-id-1", $response[0]->getProject());
        $this->assertEquals("proj-id-2", $response[1]->getProject());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetActivities(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        'type' => 'build',
                        'parameters' => (object)[],
                        'project' => 'proj-id-1',
                        'state' => 'complete',
                        'completionPercent' => 100,
                        'timings' => [],
                        'log' => 'log content',
                        'payload' => (object)[],
                        'id' => '123',
                    ]
                )
            ));

        $response = $this->environmentTask->getActivities("proj-id", "env-id", 'act-1');

        $this->assertNotEmpty($response);
        $this->assertInstanceOf(Activity::class, $response);
        $this->assertEquals("proj-id-1", $response->getProject());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelActivity(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->activityCancel("proj-id", "env-id", 'act-1');

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBackup(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $projectId = 'proj-1';
        $envId = 'env-1';

        $result = $this->environmentTask->backup($projectId, $envId, true);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteBackup(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $projectId = 'proj-1';
        $envId = 'env-1';
        $backupId = 'backup-1';

        $result = $this->environmentTask->deleteBackup($projectId, $envId, $backupId);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetBackup(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-abc';
        $envId = 'env-id';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'backup_1',
                    'attributes' => ['note' => 'Daily backup'],
                    'status' => 'completed',
                    'commitId' => 'abc123def456',
                    'environment' => 'main',
                    'safe' => true,
                    'restorable' => true,
                    'automated' => true,
                    'createdAt' => '2025-09-16T08:00:00+00:00',
                    'updatedAt' => '2025-09-16T08:05:00+00:00',
                    'expiresAt' => '2025-10-16T08:00:00+00:00',
                    'index' => 1,
                    'sizeOfVolumes' => 2048,
                    'sizeUsed' => 1024,
                    'deployment' => 'deploy_1'
                ])
            ));

        $result = $this->environmentTask->getBackup($projectId, $domainId, $envId);
        $this->assertEquals("backup_1", $result->getId());
        $this->assertEquals("completed", $result->getStatus());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRestore()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));
        $acceptedResponse = new AcceptedResponse('accepted', 200);

        $result = $this->environmentTask->restoreBackup(
            'prj',
            'env',
            'bkp',
            true,
            true,
        );

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListBackups(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'bkp-123',
                        'attributes' => [
                            'note' => 'Nightly automated backup',
                            'region' => 'eu-5',
                        ],
                        'status' => 'complete',
                        'commitId' => 'c4236c417bae9c416ced736eed6353b426ae9d34',
                        'environment' => 'main',
                        'safe' => true,
                        'restorable' => true,
                        'automated' => true,
                        'createdAt' => '2025-09-14T02:00:00Z',
                        'updatedAt' => '2025-09-14T02:05:00Z',
                        'expiresAt' => '2025-10-14T02:00:00Z',
                        'index' => 1,
                        'sizeOfVolumes' => 2048,
                        'sizeUsed' => 1024,
                        'deployment' => 'deploy-123',
                    ],
                    [
                        'id' => 'bkp-456',
                        'attributes' => [
                            'note' => 'Manual backup before migration',
                            'region' => 'eu-5',
                        ],
                        'status' => 'pending',
                        'commitId' => 'a1234567890abcdef1234567890abcdef123456',
                        'environment' => 'staging',
                        'safe' => false,
                        'restorable' => false,
                        'automated' => false,
                        'createdAt' => '2025-09-15T10:00:00Z',
                        'updatedAt' => null,
                        'expiresAt' => null,
                        'index' => 2,
                        'sizeOfVolumes' => 4096,
                        'sizeUsed' => 3560,
                        'deployment' => 'deploy-456',
                    ],
                ])
            ));

        $projectId = 'proj-1';
        $envId = 'env-1';

        $result = $this->environmentTask->listBackups($projectId, $envId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Backup::class, $result);
        $this->assertEquals("bkp-123", $result[0]->getId());
        $this->assertEquals("bkp-456", $result[1]->getId());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectVariable(): void
    {
        $projectId = 'project-123';
        $input = [
            'name' => 'API_KEY',
            'value' => 'secret',
            'attributes' => [],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->createVariable($projectId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateEnvironmentVariable(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = [
            'name' => 'API_KEY',
            'value' => 'secret',
            'attributes' => [],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
            'isEnabled' => true,
            'isInheritable' => false
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->createVariable($projectId, $input, $environmentId);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateEnvironmentVariable(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $variableId = 'var-1';
        $input = [
            'name' => 'API_KEY',
            'value' => 'secret',
            'attributes' => [],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
            'isEnabled' => true,
            'isInheritable' => false
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->updateVariable($projectId, $environmentId, $variableId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetVariable(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $variableId = 'var-1';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => $variableId,
                    'name' => 'API_KEY',
                    'value' => 'secret',
                    'attributes' => [],
                    'project' => 'project-123',
                    'environment' => 'env-456',
                    'inherited' => true,
                    'isJson' => false,
                    'isSensitive' => true,
                    'visibleBuild' => true,
                    'visibleRuntime' => false,
                    'isEnabled' => true,
                    'isInheritable' => false
                ])
            ));

        $result = $this->environmentTask->getVariable($projectId, $environmentId, $variableId);

        $this->assertInstanceOf(EnvironmentVariable::class, $result);
        $this->assertEquals($projectId, $result->getProject());
        $this->assertEquals($environmentId, $result->getEnvironment());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteEnvironmentVariable(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $variableId = 'var-1';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->deleteVariable($projectId, $environmentId, $variableId);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListEnvironmentVariables(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'env:env',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#delete' => ['href' => 'href']
                        ],
                        'created_at' => '2025-09-16T07:26:58.714065+00:00',
                        'updated_at' => '2025-09-16T07:26:58.716916+00:00',
                        'name' => 'env:env',
                        'attributes' => [],
                        'value' => 'test',
                        'is_json' => false,
                        'is_sensitive' => false,
                        'visible_build' => false,
                        'visible_runtime' => true,
                        'application_scope' => [],
                        'project' => 'azertyuiop',
                        'environment' => 'main',
                        'inherited' => false,
                        'is_enabled' => true,
                        'is_inheritable' => true,
                    ],
                    [
                        'id' => 'env:env2',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#delete' => ['href' => 'href']
                        ],
                        'created_at' => '2025-09-16T07:26:58.714065+00:00',
                        'updated_at' => '2025-09-16T07:26:58.716916+00:00',
                        'name' => 'env:env2',
                        'attributes' => [],
                        'value' => 'test2',
                        'is_json' => false,
                        'is_sensitive' => false,
                        'visible_build' => false,
                        'visible_runtime' => true,
                        'application_scope' => [],
                        'project' => 'azertyuiop',
                        'environment' => 'main',
                        'inherited' => false,
                        'is_enabled' => true,
                        'is_inheritable' => true,
                    ],
                ])
            ));

        $projectId = 'proj-1';
        $envId = 'env-1';

        $result = $this->environmentTask->listEnvironmentVariables($projectId, $envId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(EnvironmentVariable::class, $result);
        $this->assertEquals("env:env", $result[0]->getName());
        $this->assertEquals("env:env2", $result[1]->getName());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectVariables(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'env:proj',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#delete' => ['href' => 'href']
                        ],
                        'created_at' => '2025-09-16T07:26:58.714065+00:00',
                        'updated_at' => '2025-09-16T07:26:58.716916+00:00',
                        'name' => 'env:proj',
                        'attributes' => [],
                        'value' => 'test',
                        'is_json' => false,
                        'is_sensitive' => false,
                        'visible_build' => false,
                        'visible_runtime' => true,
                        'application_scope' => [],
                        'project' => 'azertyuiop',
                    ],
                    [
                        'id' => 'env:proj2',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#delete' => ['href' => 'href']
                        ],
                        'created_at' => '2025-09-16T07:26:58.714065+00:00',
                        'updated_at' => '2025-09-16T07:26:58.716916+00:00',
                        'name' => 'env:proj2',
                        'attributes' => [],
                        'value' => 'test2',
                        'is_json' => false,
                        'is_sensitive' => false,
                        'visible_build' => false,
                        'visible_runtime' => true,
                        'application_scope' => [],
                        'project' => 'azertyuiop',
                    ],
                ])
            ));

        $projectId = 'proj-1';

        $result = $this->environmentTask->listProjectVariables($projectId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectVariable::class, $result);
        $this->assertEquals("env:proj", $result[0]->getName());
        $this->assertEquals("env:proj2", $result[1]->getName());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetRoute(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $routeId = 'route-1';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'type' => 'upstream',
                    'to' => 'app:http',
                    'upstream' => 'app',
                    'primary' => true,
                    'id' => 'route-123',
                    'productionUrl' => 'https://www.example.com',
                    'attributes' => [
                        'id' => 'route-123',
                        'restrictRobots' => false,
                    ],
                    'tls' => [
                        'minVersion' => 'TLSv1.2',
                        'clientAuthentication' => null,
                        'strictTransportSecurity' => [
                            'enabled' => true,
                            'includeSubdomains' => true,
                            'preload' => false,
                        ],
                        'clientCertificateAuthorities' => null,
                    ],
                    'redirects' => [
                        'paths' => [],
                        'expires' => ''
                    ],
                    'cache' => [
                        'enabled' => true,
                        'defaultTtl' => 3600,
                        'cookies' => [],
                        'headers' => [],
                    ],
                    'ssi_enabled' => true,
                ])
            ));

        $result = $this->environmentTask->getRoute($projectId, $environmentId, $routeId);

        $this->assertInstanceOf(Route::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListRoutes(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'upstream',
                        'to' => 'app:http',
                        'upstream' => 'app',
                        'primary' => true,
                        'id' => 'route-123',
                        'productionUrl' => 'https://www.example.com',
                        'attributes' => [
                            'id' => 'route-123',
                            'restrictRobots' => false,
                        ],
                        'tls' => [
                            'minVersion' => 'TLSv1.2',
                            'clientAuthentication' => null,
                            'strictTransportSecurity' => [
                                'enabled' => true,
                                'includeSubdomains' => true,
                                'preload' => false,
                            ],
                            'clientCertificateAuthorities' => null,
                        ],
                        'redirects' => [
                            'paths' => [],
                            'expires' => ''
                        ],
                        'cache' => [
                            'enabled' => true,
                            'defaultTtl' => 3600,
                            'cookies' => [],
                            'headers' => [],
                        ],
                        'ssi_enabled' => true,
                    ],
                    [
                        'type' => 'upstream',
                        'to' => 'app2:http',
                        'upstream' => 'app2',
                        'primary' => true,
                        'id' => 'route-456',
                        'productionUrl' => 'https://www.example.com',
                        'attributes' => [
                            'id' => 'route-456',
                            'restrictRobots' => false,
                        ],
                        'tls' => [
                            'minVersion' => 'TLSv1.2',
                            'clientAuthentication' => null,
                            'strictTransportSecurity' => [
                                'enabled' => true,
                                'includeSubdomains' => true,
                                'preload' => false,
                            ],
                            'clientCertificateAuthorities' => null,
                        ],
                        'redirects' => [
                            'paths' => [],
                            'expires' => ''
                        ],
                        'cache' => [
                            'enabled' => true,
                            'defaultTtl' => 3600,
                            'cookies' => [],
                            'headers' => [],
                        ],
                        'ssi_enabled' => true,
                    ]
                ])
            ));

        $result = $this->environmentTask->listRoutes($projectId, $environmentId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Route::class, $result);

        $this->assertEquals("route-123", $result[0]->getId());
        $this->assertEquals("route-456", $result[1]->getId());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateEnvironmentDomain(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = [
            'name' => 'domain-1',
            'attributes' => [
                'version' => '8.2',
                'engine' => 'php-fpm',
            ],
            'isDefault' => true,
            'replacementFor' => null,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->createDomain($projectId, $input, $environmentId);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectDomain(): void
    {
        $projectId = 'project-123';
        $input = [
            'name' => 'domain-1',
            'attributes' => [
                'version' => '8.2',
                'engine' => 'php-fpm',
            ],
            'isDefault' => true,
            'replacementFor' => null,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->createDomain($projectId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetDomain(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-123';
        $domainId = 'domain-1';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'type' => 'environment',
                    'name' => 'DEV',
                    'attributes' => [
                        'description' => 'Environnement de développement',
                        'region' => 'eu-5'
                    ],
                    'createdAt' => '2025-09-16T08:00:00+00:00',
                    'updatedAt' => '2025-09-16T09:30:00+00:00',
                    'project' => 'fake-project-123',
                    'registeredName' => 'dev-environment',
                    'isDefault' => true,
                    'replacementFor' => null,
                ])
            ));

        $result = $this->environmentTask->getDomain($projectId, $environmentId, $domainId);

        $this->assertInstanceOf(Domain::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateDomain(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-123';
        $domainId = 'domain-123';
        $input = [
            'attributes' => [
                'version' => '8.2',
                'engine' => 'php-fpm',
            ],
            'isDefault' => true
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->updateDomain($projectId, $environmentId, $domainId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListDomain(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'ref1',
                        'type' => 'environment',
                        'name' => 'DEV',
                        'attributes' => [
                            'description' => 'Development environment',
                            'region' => 'eu-5'
                        ],
                        'createdAt' => '2025-09-16T08:00:00+00:00',
                        'updatedAt' => '2025-09-16T09:30:00+00:00',
                        'project' => 'fake-project-123',
                        'registeredName' => 'dev-environment',
                        'isDefault' => true,
                        'replacementFor' => null,
                    ],
                    [
                        'id' => 'ref2',
                        'type' => 'production',
                        'name' => 'PROD',
                        'attributes' => [
                            'description' => 'Production environment',
                            'region' => 'eu-5'
                        ],
                        'createdAt' => '2025-09-16T08:00:00+00:00',
                        'updatedAt' => '2025-09-16T09:30:00+00:00',
                        'project' => 'fake-project-123',
                        'registeredName' => 'dev-environment',
                        'isDefault' => true,
                        'replacementFor' => null,
                    ]

                ])
            ));

        $result = $this->environmentTask->listDomains($projectId, $environmentId);
        $this->assertContainsOnlyInstancesOf(Domain::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetType(): void
    {
        $projectId = 'project-123';
        $environmentTypeId = 'type-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'production',
                    '_links' => [
                        'self' => ['href' => 'href'],
                        '#edit' => ['href' => 'href'],
                        '#access' => ['href' => 'href'],
                    ],
                    'attributes' => [],
                ])
            ));

        $result = $this->environmentTask->getType($projectId, $environmentTypeId);
        $this->assertInstanceOf(EnvironmentType::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListTypes(): void
    {
        $projectId = 'project-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'production',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#access' => ['href' => 'href'],
                        ],
                        'attributes' => [],
                    ],
                    [
                        'id' => 'production',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#access' => ['href' => 'href'],
                        ],
                        'attributes' => [],
                    ],
                    [
                        'id' => 'development',
                        '_links' => [
                            'self' => ['href' => 'href'],
                            '#edit' => ['href' => 'href'],
                            '#access' => ['href' => 'href'],
                        ],
                        'attributes' => [],
                    ]
                ])
            ));

        $result = $this->environmentTask->listTypes($projectId);
        $this->assertContainsOnlyInstancesOf(EnvironmentType::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetDeployment(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $deploymentId = 'deploy-789';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'fake-deploy-0001abcd2345efgh6789ijkl0123mnop4567qrst',
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
                            'id' => 'route1',
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
                            'id' => 'route2',
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
                        ],
                    ],
                    'workers' => [],
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
                ])
            ));

        $result = $this->environmentTask->getDeployment($projectId, $environmentId, $deploymentId);

        $this->assertInstanceOf(Deployment::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListDeployments(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'fake-deploy-0001abcd2345efgh6789ijkl0123mnop4567qrst',
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
                                'id' => 'route1',
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
                                'id' => 'route2',
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
                            ],
                        ],
                        'workers' => [],
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
                    ],
                    [
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
                            ],
                        ],
                        'workers' => [],
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
                    ]
                ])
            ));

        $result = $this->environmentTask->listDeployments($projectId, $environmentId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Deployment::class, $result);

        $this->assertEquals("fake-deploy-0001abcd2345efgh6789ijkl0123mnop4567qrst", $result[0]->getId());
        $this->assertEquals("fake-deploy-2-0001abcd2345efgh6789ijkl0123mnop4567qrst", $result[1]->getId());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRunSourceOperation(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $input = [
            'operation' => 'sync',
            'variables' => []
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->environmentTask->runSourceOperation($projectId, $environmentId, $input);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListSourceOperation(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'id' => 'ope1',
                        'app' => 'app1',
                        'operation' => 'build',
                        'command' => 'composer install'
                    ],
                    [
                        'id' => 'ope2',
                        'app' => 'app2',
                        'operation' => 'deploy',
                        'command' => 'symfony deploy'
                    ],
                    [
                        'id' => 'ope3',
                        'app' => 'app3',
                        'operation' => 'backup',
                        'command' => 'backup --full'
                    ],
                ])
            ));

        $result = $this->environmentTask->listSourceOperations($projectId, $environmentId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(EnvironmentSourceOperation::class, $result);

        $this->assertEquals("build", $result[0]->getOperation());
        $this->assertEquals("deploy", $result[1]->getOperation());
        $this->assertEquals("backup", $result[2]->getOperation());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testActivateThrowsApiException(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-456';
        $init = 'true';

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

        $this->environmentTask->activate($projectId, $environmentId, $init);
    }
}
