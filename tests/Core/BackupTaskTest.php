<?php

namespace Tests\Unit\Core\Tasks;

use PHPUnit\Framework\TestCase;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentBackupsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Backup;
use Upsun\Core\Tasks\BackupTask;
use OpenAPI\Client\Model\EnvironmentBackupInput;
use OpenAPI\Client\Model\EnvironmentRestoreInput;

class BackupTaskTest extends TestCase
{
    private EnvironmentBackupsApi $apiMock;
    private BackupTask $task;

    protected function setUp(): void
    {
        $this->apiMock = $this->createMock(EnvironmentBackupsApi::class);

        $this->task = new class($this->apiMock) extends BackupTask {
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
            ->willThrowException(new ApiException());

        $this->task->backup('prj', 'env', []);
    }
}
