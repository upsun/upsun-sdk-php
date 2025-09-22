<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\ApiException;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Model\AcceptedResponse;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Model\Backup;
use Upsun\UpsunClient;

class BackupTaskTest extends BaseTestCase
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

        $result = $this->backupTask->backup($projectId, $envId, true);

        $acceptedResponse = new AcceptedResponse('accepted', 200);
        $this->assertEquals($acceptedResponse, $result);
    }

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

        $result = $this->backupTask->delete($projectId, $envId, $backupId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

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
        $backup = $this->backupTask->get('prj', 'env', 'bkp');
        $this->assertEquals("backup-1", $backup->getId());
    }

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

        $result = $this->backupTask->list('prj', 'env');

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Backup::class, $result);
        $this->assertEquals("backup-1", $result[0]->getId());
        $this->assertEquals("backup-2", $result[1]->getId());
    }

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

        $result = $this->backupTask->restore(
            'prj',
            'env',
            'bkp',
            ['restoreCode' => true, 'restoreResources' => true]
        );

        $this->assertEquals($acceptedResponse, $result);
    }

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

        $this->backupTask->restore(
            'prj-does-not-exist',
            'env',
            'bkp',
            ['restoreCode' => true, 'restoreResources' => true]
        );
    }
}
