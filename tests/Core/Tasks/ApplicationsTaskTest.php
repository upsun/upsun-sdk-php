<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\DeploymentApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\UpsunClient;

class ApplicationsTaskTest extends BaseTestCase
{
    private ApplicationsTask $applicationsTask;

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

        $this->applicationsTask = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams)
        ) extends ApplicationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
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
                            'capabilities' => new stdClass(),
                            'settings' => new stdClass()

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
                            "basic_auth" => new stdClass(),
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
                        "services" => new stdClass(),
                        "routes" => new stdClass(),
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
                        "workers" => new stdClass(),
                        "container_profiles" => new stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'vjfwze4eacnle';
        $envId = 'main';

        $result = $this->applicationsTask->list(projectId: $projectId, environmentId: $envId);

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('app', $result);
        $this->assertEquals('app', $result['app']->getName());
    }


    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->applicationsTask->list(projectId: $projectId, environmentId: $envId);
        $this->assertSame([], $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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
                            'capabilities' => new stdClass(),
                            'settings' => new stdClass()
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
                            "basic_auth" => new stdClass(),
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
                        "services" => new stdClass(),
                        "routes" => new stdClass(),
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
                        "workers" => new stdClass(),
                        "container_profiles" => new stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'azertyuiop';
        $envId = 'main';

        $result = $this->applicationsTask->get(projectId: $projectId, environmentId: $envId, applicationId: 'app');

        $this->assertNotNull($result);
        $this->assertEquals('app', $result->getName());
    }

    /**
     * @throws ClientExceptionInterface
     */
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
                            'capabilities' => new stdClass(),
                            'settings' => new stdClass()
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
                            "basic_auth" => new stdClass(),
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
                        "services" => new stdClass(),
                        "routes" => new stdClass(),
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
                        "workers" => new stdClass(),
                        "container_profiles" => new stdClass(),
                        "created_at" => "2025-09-11T12:31:16+00:00",
                    ]
                ])
            ));

        $projectId = 'azertyuiop';
        $envId = 'main';
        $app = 'app';

        $result = $this->applicationsTask->get(projectId: $projectId, environmentId: $envId, applicationId: $app);

        $this->assertNull($result);
    }
}
