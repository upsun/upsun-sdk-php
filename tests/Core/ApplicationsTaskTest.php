<?php

namespace Upsun\Tests\Core;

use Nyholm\Psr7\Response;
use Upsun\Api\DeploymentApi;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\UpsunClient;
use Psr\Http\Client\ClientInterface;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Nyholm\Psr7\Factory\Psr17Factory;

class ApplicationsTaskTest extends BaseTestCase
{
    private ApplicationsTask $applicationsTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $deploymentApi = new DeploymentApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->applicationsTask = new class (
            $upsunClient,
            $deploymentApi
        ) extends ApplicationsTask {
        };
    }

    public function testListReturnsWebappsArray(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        "id" => "deploymentId",
                        "cluster_name" => "clusterName",
                        "project_info" => [
                            "title" => "Test project",
                            "name" => "azertyuiop",
                            'capabilities' => new \stdClass(),
                            'settings' => new \stdClass()

                        ],
                        "environment_info" => [
                            "name" => "main",
                            "status" => "active",
                            "is_main" => true,
                            "is_production" => true,
                            "reference" => 'reference',
                            'machine_name' => 'machine name',
                            'environment_type' => 'production',
                            "constraints" => [
                                "cluster_type" => "environment",
                                "deployment_type" => "production"
                            ],
                            "links" => []
                        ],
                        "deployment_target" => "local",
                        "http_access" => [
                            "is_enabled" => true,
                            "addresses" => [],
                            "basic_auth" => new \stdClass(),
                        ],
                        "enable_smtp" => true,
                        "restrict_robots" => true,
                        "variables" => [],
                        "access" => [["entity_id" => "entityId", "role" => "admin"]],
                        "subscription" => [
                            "license_uri" => "licence-uri",
                            "storage" => 1024,
                            "included_users" => 1,
                            "restricted" => false,
                            "suspended" => false,
                            "user_licenses" => 1,
                            'subscription_management_uri' => 'subscription_management_uri'
                        ],
                        "services" => new \stdClass(),
                        "routes" => new \stdClass(),
                        "webapps" => [
                            "app" => [
                                "name" => "app",
                                "type" => "php:8.3:545",
                                "disk" => 512,
                                "size" => "AUTO",
                                "preflight" => [
                                    "enabled" => true,
                                    "ignored_rules" => []
                                ],
                                "tree_id" => "treeId",
                                "app_dir" => "/app",
                                "runtime" => [
                                    "extensions" => ["apcu", "blackfire"]
                                ],
                                "web" => [
                                    "locations" => [
                                        "/" => [
                                            "root" => "public",
                                            "expires" => "1h",
                                            "passthru" => "/index.php",
                                            "scripts" => true,
                                            "allow" => true,
                                            "headers" => [],
                                            "rules" => []
                                        ]
                                    ],
                                    "move_to_root" => false
                                ],
                                "hooks" => [
                                    "build" => "build hook",
                                    "deploy" => "set -x -e\nsymfony-deploy",
                                    "post_deploy" => null
                                ],
                                "crons" => [],
                                "source" => [
                                    "root" => "/",
                                    "operations" => []
                                ],
                                "build" => [
                                    "flavor" => "none",
                                    "caches" => []
                                ],
                                "dependencies" => [
                                    "php" => [
                                        "composer" => "^2"
                                    ]
                                ],
                                "stack" => [],
                                "is_across_submodule" => false,
                                "instance_count" => 2,
                                "config_id" => "slug",
                                "slug_id" => "slug"
                            ]
                        ],
                        "workers" => new \stdClass(),
                        "container_profiles" => new \stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'vjfwze4eacnle';
        $envId = 'main';

        $result = $this->applicationsTask->list($projectId, $envId);

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('app', $result);
        $this->assertEquals('app', $result['app']->getName());
    }


    public function testListReturnsEmptyArrayIfNoDeployment(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $projectId = 'proj-1';
        $envId = 'env-1';

        $result = $this->applicationsTask->list($projectId, $envId);
        $this->assertSame([], $result);
    }

    public function testGetReturnsWebApplicationWhenAvailable(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        "id" => "deploymentId",
                        "cluster_name" => "clusterName",
                        "project_info" => [
                            "title" => "Test project",
                            "name" => "azertyuiop",
                            'capabilities' => new \stdClass(),
                            'settings' => new \stdClass()
                        ],
                        "environment_info" => [
                            "name" => "main",
                            "status" => "active",
                            "is_main" => true,
                            "is_production" => true,
                            "reference" => 'reference',
                            'machine_name' => 'machine name',
                            'environment_type' => 'production',
                            "constraints" => [
                                "cluster_type" => "environment",
                                "deployment_type" => "production"
                            ],
                            "links" => []
                        ],
                        "deployment_target" => "local",
                        "http_access" => [
                            "is_enabled" => true,
                            "addresses" => [],
                            "basic_auth" => new \stdClass(),
                        ],
                        "enable_smtp" => true,
                        "restrict_robots" => true,
                        "variables" => [],
                        "access" => [["entity_id" => "entityId", "role" => "admin"]],
                        "subscription" => [
                            "license_uri" => "licence-uri",
                            "storage" => 1024,
                            "included_users" => 1,
                            "restricted" => false,
                            "suspended" => false,
                            "user_licenses" => 1,
                            'subscription_management_uri' => 'subscription_management_uri'
                        ],
                        "services" => new \stdClass(),
                        "routes" => new \stdClass(),
                        "webapps" => [
                            "app" => [
                                "name" => "app",
                                "type" => "php:8.3:545",
                                "disk" => 512,
                                "size" => "AUTO",
                                "preflight" => [
                                    "enabled" => true,
                                    "ignored_rules" => []
                                ],
                                "tree_id" => "treeId",
                                "app_dir" => "/app",
                                "runtime" => [
                                    "extensions" => ["apcu", "blackfire"]
                                ],
                                "web" => [
                                    "locations" => [
                                        "/" => [
                                            "root" => "public",
                                            "expires" => "1h",
                                            "passthru" => "/index.php",
                                            "scripts" => true,
                                            "allow" => true,
                                            "headers" => [],
                                            "rules" => []
                                        ]
                                    ],
                                    "move_to_root" => false
                                ],
                                "hooks" => [
                                    "build" => "build hook",
                                    "deploy" => "set -x -e\nsymfony-deploy",
                                    "post_deploy" => null
                                ],
                                "crons" => [],
                                "source" => [
                                    "root" => "/",
                                    "operations" => []
                                ],
                                "build" => [
                                    "flavor" => "none",
                                    "caches" => []
                                ],
                                "dependencies" => [
                                    "php" => [
                                        "composer" => "^2"
                                    ]
                                ],
                                "stack" => [],
                                "is_across_submodule" => false,
                                "instance_count" => 2,
                                "config_id" => "slug",
                                "slug_id" => "slug"
                            ]
                        ],
                        "workers" => new \stdClass(),
                        "container_profiles" => new \stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'azertyuiop';
        $envId = 'main';

        $result = $this->applicationsTask->get($projectId, $envId, 'app');

        $this->assertNotNull($result);
        $this->assertEquals('app', $result->getName());
    }

    public function testGetReturnsNullWhenAppNotFound(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        "id" => "deploymentId",
                        "cluster_name" => "clusterName",
                        "project_info" => [
                            "title" => "Test project",
                            "name" => "azertyuiop",
                            'capabilities' => new \stdClass(),
                            'settings' => new \stdClass()
                        ],
                        "environment_info" => [
                            "name" => "main",
                            "status" => "active",
                            "is_main" => true,
                            "is_production" => true,
                            "reference" => 'reference',
                            'machine_name' => 'machine name',
                            'environment_type' => 'production',
                            "constraints" => [
                                "cluster_type" => "environment",
                                "deployment_type" => "production"
                            ],
                            "links" => []
                        ],
                        "deployment_target" => "local",
                        "http_access" => [
                            "is_enabled" => true,
                            "addresses" => [],
                            "basic_auth" => new \stdClass(),
                        ],
                        "enable_smtp" => true,
                        "restrict_robots" => true,
                        "variables" => [],
                        "access" => [["entity_id" => "entityId", "role" => "admin"]],
                        "subscription" => [
                            "license_uri" => "licence-uri",
                            "storage" => 1024,
                            "included_users" => 1,
                            "restricted" => false,
                            "suspended" => false,
                            "user_licenses" => 1,
                            'subscription_management_uri' => 'subscription_management_uri'
                        ],
                        "services" => new \stdClass(),
                        "routes" => new \stdClass(),
                        "webapps" => [
                            "anotherApp" => [
                                "name" => "app",
                                "type" => "php:8.3:545",
                                "disk" => 512,
                                "size" => "AUTO",
                                "preflight" => [
                                    "enabled" => true,
                                    "ignored_rules" => []
                                ],
                                "tree_id" => "treeId",
                                "app_dir" => "/app",
                                "runtime" => [
                                    "extensions" => ["apcu", "blackfire"]
                                ],
                                "web" => [
                                    "locations" => [
                                        "/" => [
                                            "root" => "public",
                                            "expires" => "1h",
                                            "passthru" => "/index.php",
                                            "scripts" => true,
                                            "allow" => true,
                                            "headers" => [],
                                            "rules" => []
                                        ]
                                    ],
                                    "move_to_root" => false
                                ],
                                "hooks" => [
                                    "build" => "build hook",
                                    "deploy" => "set -x -e\nsymfony-deploy",
                                    "post_deploy" => null
                                ],
                                "crons" => [],
                                "source" => [
                                    "root" => "/",
                                    "operations" => []
                                ],
                                "build" => [
                                    "flavor" => "none",
                                    "caches" => []
                                ],
                                "dependencies" => [
                                    "php" => [
                                        "composer" => "^2"
                                    ]
                                ],
                                "stack" => [],
                                "is_across_submodule" => false,
                                "instance_count" => 2,
                                "config_id" => "slug",
                                "slug_id" => "slug"
                            ]
                        ],
                        "workers" => new \stdClass(),
                        "container_profiles" => new \stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'azertyuiop';
        $envId = 'main';
        $app = 'app';

        $result = $this->applicationsTask->get($projectId, $envId, $app);

        $this->assertNull($result);
    }
}
