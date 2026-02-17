<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DomainManagementApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class DomainsTaskTest extends BaseTestCase
{
    private DomainsTask $domainsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
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

        $this->domainsTask = new class (
            $upsunClient,
            new DomainManagementApi(...$apiClassParams),
        ) extends DomainsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateWithoutEnvironment(): void
    {
        $projectId = 'proj-1';

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

        $result = $this->domainsTask->create(
            projectId: $projectId,
            name: 'example.com',
            attributes: [
                'ssl' => 'enabled',
                'region' => 'eu',
            ],
            isDefault: true,
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-1';

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

        $result = $this->domainsTask->create(
            projectId: $projectId,
            name: 'example.com',
            attributes: [
                'ssl' => 'enabled',
                'region' => 'eu',
            ],
            isDefault: true,
            environmentId: $envId
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->delete(projectId: $projectId, domainId: $domainId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->delete(projectId: $projectId, domainId: $domainId, environmentId: $envId);
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->get(projectId: $projectId, domainId: $domainId);
        $this->assertEquals("Production Environment", $result->getName());
        $this->assertEquals("project", $result->getType());
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->get(projectId: $projectId, domainId: $domainId, environmentId: $envId);
        $this->assertEquals("Environment Domain", $result->getName());
        $this->assertEquals("environment", $result->getType());
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->list(projectId: $projectId);
        $this->assertEquals("Production Domain", $result[0]->getName());
        $this->assertEquals("Production Domain", $result[1]->getName());
        $this->assertEquals("project", $result[0]->getType());
        $this->assertEquals("project", $result[1]->getType());
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListWithEnvironment(): void
    {
        $projectId = 'proj-1';
        $envId = 'env-id';
        $data = [
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
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->domainsTask->list(projectId: $projectId, environmentId: $envId);
        $this->assertIsArray($result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProject(): void
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

        $result = $this->domainsTask->update(
            projectId: $projectId,
            domainId: $domainId,
            attributes: [],
            isDefault: true
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->domainsTask->update(
            projectId: $projectId,
            domainId: $domainId,
            attributes: [],
            isDefault: true,
            environmentId: $envId
        );
        $this->assertEquals(new AcceptedResponse('accepted', 200), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $this->domainsTask->create(projectId: $projectId, name: 'name');
    }
}
