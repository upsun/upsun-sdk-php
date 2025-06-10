<?php

namespace Tests\Upsun\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\apisgen\EnvironmentBackupsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\Backup;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\BackupTask;
use Upsun\UpsunClient;
use OpenAPI\Client\ApiException;

class BackupTaskTest extends TestCase
{
    private UpsunClient $clientMock;
    private EnvironmentBackupsApi $backupApiMock;
    private BackupTask $backupTask;

    protected function setUp(): void
    {
        $this->clientMock = new class() extends UpsunClient {
            public Client $apiClient;
            public Configuration $apiConfig;
            public function __construct() {}
        };

        $this->clientMock->apiClient = $this->createMock(Client::class);
        $this->clientMock->apiConfig = $this->createMock(Configuration::class);

        $this->backupApiMock = $this->createMock(EnvironmentBackupsApi::class);

        // BackupTask avec injection du mock
        $this->backupTask = new class($this->clientMock) extends BackupTask {
            private ?EnvironmentBackupsApi $mockApi = null;

            public function refreshToken(): void {}

            public function setMockApi(EnvironmentBackupsApi $mock): void
            {
                $this->mockApi = $mock;
            }

            public function getApi(): EnvironmentBackupsApi
            {
                return $this->mockApi ?? parent::getApi();
            }
        };

        $this->backupTask->setMockApi($this->backupApiMock);
    }

    public function testListBackupsSuccess(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';

        $backup1 = new Backup();
        $backup2 = new Backup();

        $this->backupApiMock
            ->expects($this->once())
            ->method('listProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId)
            ->willReturn([$backup1, $backup2]);

        $result = $this->backupTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Backup::class, $result);
    }

    public function testListBackupsEmpty(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';

        $this->backupApiMock
            ->expects($this->once())
            ->method('listProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId)
            ->willReturn([]);

        $result = $this->backupTask->list($projectId, $environmentId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testListBackupsApiException(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';

        $this->backupApiMock
            ->expects($this->once())
            ->method('listProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId)
            ->willThrowException(new ApiException("Erreur", 500));

        $this->expectException(ApiException::class);

        $this->backupTask->list($projectId, $environmentId);
    }

    public function testGetBackupSuccess(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';
        $backupId = 'backup-1';

        $backup = new Backup();

        $this->backupApiMock
            ->expects($this->once())
            ->method('getProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId, $backupId)
            ->willReturn($backup);

        $result = $this->backupTask->get($projectId, $environmentId, $backupId);

        $this->assertInstanceOf(Backup::class, $result);
        $this->assertSame($backup, $result);
    }

    public function testGetBackupNotFound(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';
        $backupId = 'backup-inexistant';

        $this->backupApiMock
            ->expects($this->once())
            ->method('getProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId, $backupId)
            ->willReturn(null);

        $result = $this->backupTask->get($projectId, $environmentId, $backupId);

        $this->assertNull($result);
    }

    public function testGetBackupApiException(): void
    {
        $projectId = 'project-123';
        $environmentId = 'env-abc';
        $backupId = 'backup-err';

        $this->backupApiMock
            ->expects($this->once())
            ->method('getProjectsEnvironmentsBackups')
            ->with($projectId, $environmentId, $backupId)
            ->willThrowException(new ApiException("Erreur API", 500));

        $this->expectException(ApiException::class);

        $this->backupTask->get($projectId, $environmentId, $backupId);
    }
}
