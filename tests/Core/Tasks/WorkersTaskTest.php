<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\Model\WorkersValue;
use Upsun\UpsunClient;

class WorkersTaskTest extends BaseTestCase
{
    private WorkersTask $workersTask;

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

        $this->workersTask = new class (
            $upsunClient,
            new DeploymentApi(...$apiClassParams),
        ) extends WorkersTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListWorkersSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $deploymentsFake = [
            [
                "id" => "deploymentId",
                "cluster_name" => "clusterName",
                "project_info" => [
                    "title" => "Test project",
                    "name" => "azertyuiop",
                    "capabilities" => new stdClass(),
                    "settings" => new stdClass(),
                    "namespace" => null,
                    "organization" => null,
                ],
                "environment_info" => [
                    "name" => "main",
                    "status" => "active",
                    "is_main" => true,
                    "is_production" => true,
                    "reference" => "reference",
                    "machine_name" => "machine name",
                    "environment_type" => "production",
                    "constraints" => [
                        "cluster_type" => "environment",
                        "deployment_type" => "production",
                    ],
                    "links" => new stdClass(),
                ],
                "deployment_target" => "local",
                "http_access" => [
                    "is_enabled" => true,
                    "addresses" => [],
                    "basic_auth" => [],
                ],
                "enable_smtp" => true,
                "restrict_robots" => true,
                "variables" => [],
                "access" => [
                    ["entity_id" => "entityId", "role" => "admin"]
                ],
                "subscription" => [
                    "license_uri" => "licence-uri",
                    "storage" => 1024,
                    "included_users" => 1,
                    "restricted" => false,
                    "suspended" => false,
                    "user_licenses" => 1,
                    "subscription_management_uri" => "subscription_management_uri",
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
                            "ignored_rules" => [],
                        ],
                        "tree_id" => "treeId",
                        "app_dir" => "/app",
                        "runtime" => [
                            "extensions" => ["apcu", "blackfire"],
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
                                    "rules" => [],
                                ]
                            ],
                            "move_to_root" => false,
                        ],
                        "hooks" => [
                            "build" => "build hook",
                            "deploy" => "set -x -e\nsymfony-deploy",
                            "post_deploy" => null,
                        ],
                        "crons" => [],
                        "source" => [
                            "root" => "/",
                            "operations" => [],
                        ],
                        "build" => [
                            "flavor" => "none",
                            "caches" => [],
                        ],
                        "dependencies" => [
                            "php" => ["composer" => "^2"],
                        ],
                        "stack" => [],
                        "is_across_submodule" => false,
                        "instance_count" => 2,
                        "config_id" => "slug",
                        "slug_id" => "slug",
                    ]
                ],
                "workers" => [
                    [
                        "size" => "medium",
                        "access" => [],
                        "relationships" => [],
                        "additionalHosts" => [],
                        "mounts" => [],
                        "variables" => [],
                        "operations" => [],
                        "name" => "worker1",
                        "type" => "php-worker",
                        "preflight" => [
                            "enabled" => true,
                            "ignoredRules" => []
                        ],
                        "treeId" => "treeId1",
                        "appDir" => "/app",
                        "runtime" => new stdClass(),
                        "worker" => [
                            "commands" => [
                                "start" => "start-command",
                                "preStart" => "prestart-command"
                            ],
                            "disk" => 256
                        ],
                        "app" => "app1",
                        "slugId" => "slug1",
                        "resources" => [
                            "baseMemory" => 512,
                            "memoryRatio" => 1,
                            "profileSize" => "medium",
                            "minimum" => [
                                "cpu" => 1.0,
                                "memory" => 512,
                                "disk" => 256,
                                "profileSize" => "medium",
                                "cpuType" => "x86_64"
                            ],
                            "default" => [
                                "cpu" => 2.0,
                                "memory" => 1024,
                                "disk" => 512,
                                "profileSize" => "large",
                                "cpuType" => "x86_64"
                            ],
                            "disk" => [
                                "temporary" => 128,
                                "instance" => 512,
                                "storage" => 1024
                            ]
                        ],
                        "disk" => 512,
                        "timezone" => "UTC",
                        "firewall" => [
                            "outbound" => []
                        ],
                        "containerProfile" => null,
                        "endpoints" => new stdClass(),
                        "stack" => [],
                        "instanceCount" => 2
                    ]
                ],
                "container_profiles" => new stdClass(),
                "created_at" => "2025-09-11T12:31:16+00:00",
                "updated_at" => null,
                "fingerprint" => null,
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($deploymentsFake)
            ));

        $result = $this->workersTask->list(projectId: $projectId, environmentId: $environmentId);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(WorkersValue::class, $result);
        $this->assertObjectMatchesArray($result, $deploymentsFake[0]['workers']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListWorkersError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404
                ])
            ));

        $this->expectException(ApiException::class);

        $this->workersTask->list(projectId: $projectId, environmentId: $environmentId);
    }
}
