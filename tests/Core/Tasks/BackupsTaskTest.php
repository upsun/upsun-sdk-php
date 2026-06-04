<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Backup;
use Upsun\UpsunClient;

class BackupsTaskTest extends BaseTestCase
{
    private BackupsTask $backupsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            new class implements \Upsun\Core\TokenProvider
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

        $this->backupsTask = new class (
            $upsunClient,
            new EnvironmentBackupsApi(...$apiClassParams),
        ) extends BackupsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testBackup()
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

        $result = $this->backupsTask->create(projectId: $projectId, environmentId: $envId, isSafe: true);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDelete()
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

        $result = $this->backupsTask->delete(projectId: $projectId, environmentId: $envId, backupId: $backupId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGet()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "id" => "backup-1",
                    "attributes" => [],
                    "status" => "CREATED",
                    "commitId" => "commit-id-1",
                    "environment" => "main",
                    "safe" => false,
                    "restorable" => true,
                    "automated" => true,
                    "createdAt" => "2025-09-12T04:09:50.688719+00:00",
                    "updatedAt" => "2025-09-12T04:09:50.688719+00:00",
                    "expiresAt" => "2025-09-15T14:08:39.728284+00:00",
                    "index" => 4,
                    "sizeOfVolumes" => 2001,
                    "sizeUsed" => 24,
                    "deployment" => "deployment-id"
                ])
            ));
        $backup = $this->backupsTask->get(projectId: 'prj', environmentId: 'env', backupId: 'bkp');
        $this->assertEquals("backup-1", $backup->getId());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testList()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        "id" => "backup-1",
                        "attributes" => [],
                        "status" => "CREATED",
                        "commitId" => "commit-id-1",
                        "environment" => "main",
                        "safe" => false,
                        "restorable" => true,
                        "automated" => true,
                        "createdAt" => "2025-09-12T04:09:50.688719+00:00",
                        "updatedAt" => "2025-09-12T04:09:50.688719+00:00",
                        "expiresAt" => "2025-09-15T14:08:39.728284+00:00",
                        "index" => 4,
                        "sizeOfVolumes" => 2001,
                        "sizeUsed" => 24,
                        "deployment" => "deployment-id"
                    ],
                    [
                        "id" => "backup-2",
                        "attributes" => [],
                        "status" => "CREATED",
                        "commitId" => "commit-id-2",
                        "environment" => "main",
                        "safe" => false,
                        "restorable" => true,
                        "automated" => true,
                        "createdAt" => "2025-09-12T04:09:50.688719+00:00",
                        "updatedAt" => "2025-09-12T04:09:50.688719+00:00",
                        "expiresAt" => "2025-09-15T14:08:39.728284+00:00",
                        "index" => 4,
                        "sizeOfVolumes" => 2001,
                        "sizeUsed" => 24,
                        "deployment" => "deployment-id"
                    ]
                ])
            ));

        $result = $this->backupsTask->list(projectId: 'prj', environmentId: 'env');

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Backup::class, $result);
        $this->assertEquals("backup-1", $result[0]->getId());
        $this->assertEquals("backup-2", $result[1]->getId());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRestoreCallsApi()
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

        $result = $this->backupsTask->restore(
            projectId: 'prj',
            environmentId: 'env',
            backupId: 'bkp',
            restoreCode: true,
            restoreResources: true
        );

        $this->assertEquals($acceptedResponse, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRestoreThrowsApiException()
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'Forbidden',
                    'code' => 403
                ])
            ));

        $this->backupsTask->restore(
            projectId: 'prj-does-not-exist',
            environmentId: 'env',
            backupId: 'bkp',
            restoreCode: true,
            restoreResources: true
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListBackupsReturnsEmptyArray(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, []));

        $result = $this->backupsTask->list(projectId: 'prj', environmentId: 'env');

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    /**
     * @dataProvider backupStatusProvider
     * @throws ClientExceptionInterface
     */
    public function testGetBackupWithDifferentStatuses(string $status): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, [
                "id" => "backup-1",
                "attributes" => [],
                "status" => $status,
                "commitId" => "commit-id-1",
                "environment" => "main",
                "safe" => false,
                "restorable" => $status === "CREATED",
                "automated" => true,
                "createdAt" => "2025-09-12T04:09:50.688719+00:00",
                "updatedAt" => "2025-09-12T04:09:50.688719+00:00",
                "expiresAt" => "2025-09-15T14:08:39.728284+00:00",
                "index" => 4,
                "sizeOfVolumes" => 2001,
                "sizeUsed" => 24,
                "deployment" => "deployment-id"
            ]));

        $backup = $this->backupsTask->get(projectId: 'prj', environmentId: 'env', backupId: 'bkp');

        $this->assertEquals($status, $backup->getStatus());
    }

    /**
     * @dataProvider backupTypeProvider
     * @throws ClientExceptionInterface
     */
    public function testBackupWithDifferentTypes(bool $isSafe, bool $automated): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, [
                'status' => 'accepted',
                'code' => 200
            ]));

        $result = $this->backupsTask->create(
            projectId: 'proj-1',
            environmentId: 'env-1',
            isSafe: $isSafe
        );

        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListBackupsWithIncludeAutomated(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createJsonResponse(200, [
                [
                    "id" => "backup-auto-1",
                    "attributes" => [],
                    "commit_id" => "abc123",
                    "environment" => "env",
                    "automated" => true,
                    "safe" => false,
                    "restorable" => true,
                    "status" => "CREATED",
                ],
                [
                    "id" => "backup-manual-1",
                    "attributes" => [],
                    "commit_id" => "def456",
                    "environment" => "env",
                    "automated" => false,
                    "safe" => true,
                    "restorable" => true,
                    "status" => "CREATED",
                ]
            ]));

        $result = $this->backupsTask->list(
            projectId: 'prj',
            environmentId: 'env'
        );

        $this->assertCount(2, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRestoreWithDifferentOptions(): void
    {
        $testCases = [
            ['restoreCode' => true, 'restoreResources' => false],
            ['restoreCode' => false, 'restoreResources' => true],
            ['restoreCode' => true, 'restoreResources' => true],
        ];

        foreach ($testCases as $options) {
            $this->httpClient
                ->method('sendRequest')
                ->willReturn($this->createJsonResponse(200, [
                    'status' => 'accepted',
                    'code' => 200
                ]));

            $result = $this->backupsTask->restore(
                projectId: 'prj',
                environmentId: 'env',
                backupId: 'bkp',
                restoreCode: $options['restoreCode'],
                restoreResources: $options['restoreResources']
            );

            $this->assertInstanceOf(AcceptedResponse::class, $result);
        }
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteBackupNotFound(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn($this->createErrorResponse(404, 'Backup not found'));

        $this->backupsTask->delete(
            projectId: 'prj',
            environmentId: 'env',
            backupId: 'nonexistent'
        );
    }

    public static function backupStatusProvider(): array
    {
        return [
            'created' => ['CREATED'],
            'pending' => ['PENDING'],
            'failed' => ['FAILED'],
        ];
    }

    public static function backupTypeProvider(): array
    {
        return [
            'safe manual' => [true, false],
            'unsafe manual' => [false, false],
            'safe automated' => [true, true],
            'unsafe automated' => [false, true],
        ];
    }
}
