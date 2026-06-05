<?php

namespace Upsun\Tests\Core\Tasks;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Core\Tasks\IntegrationsTask;
use Upsun\Core\TokenProvider;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\GitHubIntegrationCreateInput;
use Upsun\Model\GitHubIntegrationPatch;
use Upsun\UpsunClient;

class IntegrationsTaskTest extends BaseTestCase
{
    private IntegrationsTask $integrationsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            new class implements TokenProvider
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

        $this->integrationsTask = new class (
            $upsunClient,
            new ThirdPartyIntegrationsApi(...$apiClassParams)
        ) extends IntegrationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateIntegration(): void
    {
        $projectId = 'test-project-id';
        $expectedData = [
            'status' => 'success',
            'code' => 202,
            'result' => 'success',
            '_links' => ['self' => ['href' => '/api/projects/' . $projectId . '/integrations/1']]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                202,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $integrationInput = new GitHubIntegrationCreateInput(
            type: 'github',
            token: 'ghp_test_token',
            repository: 'owner/repo'
        );

        $result = $this->integrationsTask->createIntegration($projectId, $integrationInput);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testCreateIntegrationWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $integrationInput = new GitHubIntegrationCreateInput(
            type: 'github',
            token: 'test-token',
            repository: 'owner/repo'
        );

        $this->integrationsTask->createIntegration($projectId, $integrationInput);
    }

    public function testCreateIntegrationWithEmptyType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Integration type cannot be empty');

        $integrationInput = new GitHubIntegrationCreateInput(
            type: '',
            token: 'token',
            repository: 'repo'
        );

        $this->integrationsTask->createIntegration('test-project-id', $integrationInput);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteIntegration(): void
    {
        $projectId = 'test-project-id';
        $integrationId = 'integration-123';
        $expectedData = [
            'status' => 'success',
            'code' => 202,
            'result' => 'success',
            '_links' => ['self' => ['href' => '/api/projects/' . $projectId . '/integrations/' . $integrationId]]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                202,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->integrationsTask->deleteIntegration($projectId, $integrationId);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testDeleteIntegrationWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->integrationsTask->deleteIntegration($projectId, 'integration-123');
    }

    public function testDeleteIntegrationWithEmptyIntegrationId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Integration ID cannot be empty');

        $this->integrationsTask->deleteIntegration('test-project-id', '');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListIntegrations(): void
    {
        $projectId = 'test-project-id';
        $expectedData = [];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->integrationsTask->listIntegrations($projectId);

        $this->assertIsArray($result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListIntegrationsReturnsEmptyArray(): void
    {
        $projectId = 'test-project-id';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $result = $this->integrationsTask->listIntegrations($projectId);

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testListIntegrationsWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->integrationsTask->listIntegrations($projectId);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetIntegrationWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->integrationsTask->getIntegration($projectId, 'integration-123');
    }

    /**
     * @dataProvider invalidIntegrationIdProvider
     */
    public function testGetIntegrationWithInvalidIntegrationId(string $integrationId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->integrationsTask->getIntegration('test-project-id', $integrationId);
    }

    public function testGetIntegrationNotFound(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Integration not found'])
            ));

        $this->integrationsTask->getIntegration('test-project-id', 'nonexistent-id');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateIntegration(): void
    {
        $projectId = 'test-project-id';
        $integrationId = 'integration-123';
        $expectedData = [
            'status' => 'success',
            'code' => 202,
            'result' => 'success',
            '_links' => ['self' => ['href' => '/api/projects/' . $projectId . '/integrations/' . $integrationId]]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                202,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $integrationPatch = new GitHubIntegrationPatch(
            type: 'github',
            token: 'updated-token',
            repository: 'owner/updated-repo'
        );

        $result = $this->integrationsTask->updateIntegration($projectId, $integrationId, $integrationPatch);

        $this->assertInstanceOf(AcceptedResponse::class, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testUpdateIntegrationWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $integrationPatch = new GitHubIntegrationPatch(
            type: 'github',
            token: 'token',
            repository: 'repo'
        );

        $this->integrationsTask->updateIntegration($projectId, 'integration-123', $integrationPatch);
    }

    /**
     * @dataProvider invalidIntegrationIdProvider
     */
    public function testUpdateIntegrationWithInvalidIntegrationId(string $integrationId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $integrationPatch = new GitHubIntegrationPatch(
            type: 'github',
            token: 'token',
            repository: 'repo'
        );

        $this->integrationsTask->updateIntegration('test-project-id', $integrationId, $integrationPatch);
    }

    public function testUpdateIntegrationWithEmptyType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Integration type cannot be empty');

        $integrationPatch = new GitHubIntegrationPatch(
            type: '',
            token: 'token',
            repository: 'repo'
        );

        $this->integrationsTask->updateIntegration('test-project-id', 'integration-123', $integrationPatch);
    }

    public static function invalidProjectIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidIntegrationIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function integrationTypesProvider(): array
    {
        return [
            'github' => [
                'github',
                ['id' => 'integration-github', 'type' => 'github', 'repository' => 'owner/repo']
            ],
            'gitlab' => [
                'gitlab',
                ['id' => 'integration-gitlab', 'type' => 'gitlab', 'repository' => 'owner/repo']
            ],
            'bitbucket' => [
                'bitbucket',
                ['id' => 'integration-bitbucket', 'type' => 'bitbucket', 'repository' => 'owner/repo']
            ],
            'webhook' => [
                'webhook',
                ['id' => 'integration-webhook', 'type' => 'webhook', 'url' => 'https://example.com/webhook']
            ],
            'health.email' => [
                'health.email',
                ['id' => 'integration-health.email', 'type' => 'health.email', 'recipients' => ['test@example.com']]
            ],
            'health.slack' => [
                'health.slack',
                ['id' => 'integration-health.slack', 'type' => 'health.slack', 'channel' => '#alerts']
            ],
        ];
    }
}
