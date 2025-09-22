<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\ApiException;
use Upsun\Api\DomainManagementApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\AcceptedResponse;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\DomainTask;
use Upsun\UpsunClient;

class DomainTaskTest extends BaseTestCase
{
    private DomainTask $domainTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $domainApi = new DomainManagementApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->domainTask = new class (
            $upsunClient,
            $domainApi
        ) extends DomainTask {
        };
    }

    public function testCreateWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $input = ['name' => 'name'];

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

        $result = $this->domainTask->create($projectId, $input);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testCreateWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';
        $input = ['name' => 'name'];

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

        $result = $this->domainTask->create($projectId, $input, $envId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testDeleteWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-abc';

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

        $result = $this->domainTask->delete($projectId, $domainId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testDeleteWithEnvironment(): void
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
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $result = $this->domainTask->delete($projectId, $domainId, $envId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testGetWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-abc';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'type' => 'project',
                    'name' => 'Production Environment',
                    'attributes' => [
                        'region' => 'us-east-1',
                        'tier' => 'premium',
                        'version' => '1.2.3',
                    ],
                    'createdAt' => '2025-09-15T12:00:00Z',
                    'updatedAt' => '2025-09-15T12:30:00Z',
                    'project' => 'project_123',
                    'registeredName' => 'prod_env_001',
                    'isDefault' => true,
                    'replacementFor' => 'staging_env_001',
                ])
            ));

        $result = $this->domainTask->get($projectId, $domainId);
        $this->assertEquals("Production Environment", $result->getName());
        $this->assertEquals("project", $result->getType());
    }

    public function testGetWithEnvironment(): void
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
                    'type' => 'environment',
                    'name' => 'Environment Domain',
                    'attributes' => [
                        'region' => 'us-east-1',
                        'tier' => 'premium',
                        'version' => '1.2.3',
                    ],
                    'createdAt' => '2025-09-15T12:00:00Z',
                    'updatedAt' => '2025-09-15T12:30:00Z',
                    'project' => 'project_123',
                    'registeredName' => 'prod_env_001',
                    'isDefault' => true,
                    'replacementFor' => 'staging_env_001',
                ])
            ));

        $result = $this->domainTask->get($projectId, $domainId, $envId);
        $this->assertEquals("Environment Domain", $result->getName());
        $this->assertEquals("environment", $result->getType());
    }

    public function testListWithoutEnvironment(): void
    {
        $projectId = 'proj-1';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'project',
                        'name' => 'Production Domain',
                        'attributes' => [
                            'region' => 'us-east-1',
                            'tier' => 'premium',
                            'version' => '1.2.3',
                        ],
                        'createdAt' => '2025-09-15T12:00:00Z',
                        'updatedAt' => '2025-09-15T12:30:00Z',
                        'project' => 'project_123',
                        'registeredName' => 'prod_env_001',
                        'isDefault' => true,
                        'replacementFor' => 'staging_env_001',
                    ],
                    [
                        'type' => 'project',
                        'name' => 'Production Domain',
                        'attributes' => [
                            'region' => 'us-east-1',
                            'tier' => 'premium',
                            'version' => '1.2.3',
                        ],
                        'createdAt' => '2025-09-15T12:00:00Z',
                        'updatedAt' => '2025-09-15T12:30:00Z',
                        'project' => 'project_123',
                        'registeredName' => 'prod_env_001',
                        'isDefault' => true,
                        'replacementFor' => 'staging_env_001',
                    ]
                ])
            ));

        $result = $this->domainTask->list($projectId);
        $this->assertEquals("Production Domain", $result[0]->getName());
        $this->assertEquals("Production Domain", $result[1]->getName());
        $this->assertEquals("project", $result[0]->getType());
        $this->assertEquals("project", $result[1]->getType());
    }

    public function testListWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-id';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'type' => 'environment',
                        'name' => 'Environment Domain',
                        'attributes' => [
                            'region' => 'us-east-1',
                            'tier' => 'premium',
                            'version' => '1.2.3',
                        ],
                        'createdAt' => '2025-09-15T12:00:00Z',
                        'updatedAt' => '2025-09-15T12:30:00Z',
                        'project' => 'project_123',
                        'registeredName' => 'prod_env_001',
                        'isDefault' => true,
                        'replacementFor' => 'staging_env_001',
                    ],
                    [
                        'type' => 'environment',
                        'name' => 'Environment Domain',
                        'attributes' => [
                            'region' => 'us-east-1',
                            'tier' => 'premium',
                            'version' => '1.2.3',
                        ],
                        'createdAt' => '2025-09-15T12:00:00Z',
                        'updatedAt' => '2025-09-15T12:30:00Z',
                        'project' => 'project_123',
                        'registeredName' => 'prod_env_001',
                        'isDefault' => true,
                        'replacementFor' => 'staging_env_001',
                    ]
                ])
            ));

        $result = $this->domainTask->list($projectId, $envId);
        $this->assertEquals("Environment Domain", $result[0]->getName());
        $this->assertEquals("Environment Domain", $result[1]->getName());
        $this->assertEquals("environment", $result[0]->getType());
        $this->assertEquals("environment", $result[1]->getType());
    }

    public function testUpdateWithoutEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-1';

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

        $result = $this->domainTask->update($projectId, $domainId, ['attributes' => [], "isDefault" => true]);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testUpdateWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $domainId = 'domain-1';
        $envId = 'env-id';

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

        $result = $this->domainTask->update($projectId, $domainId, ['attributes' => [], "isDefault" => true], $envId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    public function testCreateThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $projectId = 'proj-1';
        $input = ['name' => 'name'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'KO',
                    'code' => 404
                ])
            ));

        $result = $this->domainTask->create($projectId, $input);
    }
}
