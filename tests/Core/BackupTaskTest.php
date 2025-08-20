<?php

namespace Tests\Unit\Core\Tasks;

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\ApiException;
use Upsun\API\EnvironmentBackupsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Backup;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Model\EnvironmentBackupInput;
use Upsun\Model\EnvironmentRestoreInput;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class BackupTaskTest extends TestCase
{
    private EnvironmentBackupsApi $apiMock;
    private BackupTask $task;

    private UpsunClient $clientMock;

    protected function setUp(): void
    {
        $this->apiMock = $this->createMock(EnvironmentBackupsApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->task = new class($this->clientMock, $this->apiMock) extends BackupTask {
            public function refreshToken(): void {}
        };
    }

    public function testBackupCallsApiWithCorrectParameters()
    {
        $projectId = 'prj';
        $envId = 'env';
        $inputArray = ['foo' => 'bar'];

        $expectedResponse = $this->createMock(AcceptedResponse::class);

        $this->apiMock->expects($this->once())
            ->method('backupEnvironment')
            ->with(
                $this->equalTo($projectId),
                $this->equalTo($envId),
                $this->isInstanceOf(EnvironmentBackupInput::class)
            )
            ->willReturn($expectedResponse);

        $result = $this->task->backup($projectId, $envId, $inputArray);

        $this->assertSame($expectedResponse, $result);
    }

    public function testDeleteCallsApi()
    {
        $this->apiMock->expects($this->once())
            ->method('deleteProjectsEnvironmentsBackups')
            ->willReturn($this->createMock(AcceptedResponse::class));

        $this->task->delete('prj', 'env', 'bkp');
        $this->assertTrue(true); // Just to avoid risky test
    }

    public function testGetCallsApi()
    {
        $this->apiMock->expects($this->once())
            ->method('getProjectsEnvironmentsBackups')
            ->willReturn($this->createMock(Backup::class));

        $this->task->get('prj', 'env', 'bkp');
        $this->assertTrue(true);
    }

    public function testListCallsApi()
    {
        $this->apiMock->expects($this->once())
            ->method('listProjectsEnvironmentsBackups')
            ->willReturn([]);

        $result = $this->task->list('prj', 'env');

        $this->assertIsArray($result);
    }

    public function testRestoreCallsApi()
    {
        $this->apiMock->expects($this->once())
            ->method('restoreBackup')
            ->with(
                'prj',
                'env',
                'bkp',
                $this->isInstanceOf(EnvironmentRestoreInput::class)
            )
            ->willReturn($this->createMock(AcceptedResponse::class));

        $this->task->restore('prj', 'env', 'bkp', ['foo' => 'bar']);
        $this->assertTrue(true);
    }

    public function testBackupThrowsApiException()
    {
        $this->expectException(ApiException::class);

        $this->apiMock->method('backupEnvironment')
            ->willThrowException($this->createMock(ApiException::class));

        $this->task->backup('prj', 'env', []);
    }
}
