<?php

namespace Tests\Unit\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\DeploymentApi;
use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ApplicationTask;
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
    private BackupTask $backupTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $environmentBackupApi = new EnvironmentBackupsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->backupTask = new class (
            $upsunClient,
            $environmentBackupApi
        ) extends BackupTask {
        };
    }

    public function testBackupCallsApiWithCorrectParameters()
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
        $safe = true;

        $result = $this->backupTask->backup($projectId, $envId, $safe);
        $this->assertSame(new AcceptedResponse('accepted', 200), $result);
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
