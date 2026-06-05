<?php

namespace Upsun\Tests\Core\Tasks;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\SshKeysApi;
use Upsun\Core\Tasks\SshTask;
use Upsun\Core\TokenProvider;
use Upsun\Model\SshKey;
use Upsun\UpsunClient;

class SshTaskTest extends BaseTestCase
{
    private SshTask $sshTask;

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

        $this->sshTask = new class (
            $upsunClient,
            new SshKeysApi(...$apiClassParams)
        ) extends SshTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testAddSshKey(): void
    {
        $userId = 'user-123';
        $sshKeyValue = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host';
        $title = 'My SSH Key';
        $expectedData = [
            'id' => 1,
            'title' => $title,
            'value' => $sshKeyValue,
            'fingerprint' => 'SHA256:abcd1234...',
            'created_at' => '2024-01-01T10:00:00+00:00'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->sshTask->add($sshKeyValue, $userId, $title);

        $this->assertInstanceOf(SshKey::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testAddSshKeyWithoutTitle(): void
    {
        $userId = 'user-123';
        $sshKeyValue = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host';
        $expectedData = [
            'id' => 1,
            'value' => $sshKeyValue,
            'fingerprint' => 'SHA256:abcd1234...',
            'created_at' => '2024-01-01T10:00:00+00:00'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->sshTask->add($sshKeyValue, $userId);

        $this->assertInstanceOf(SshKey::class, $result);
    }

    public function testAddSshKeyWithEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('SSH key value is required');

        $this->sshTask->add('', 'user-123');
    }

    /**
     * @dataProvider invalidUserIdProvider
     */
    public function testAddSshKeyWithInvalidUserId(string $userId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sshKeyValue = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host';
        $this->sshTask->add($sshKeyValue, $userId);
    }

    public function testAddSshKeyDuplicate(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                409,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'SSH key already exists'])
            ));

        $sshKeyValue = 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host';
        $this->sshTask->add($sshKeyValue, 'user-123');
    }

    /**
     * @dataProvider sshKeyTypesProvider
     * @throws ClientExceptionInterface
     */
    public function testAddDifferentSshKeyTypes(string $keyType, string $keyValue): void
    {
        $userId = 'user-123';
        $expectedData = [
            'id' => 1,
            'value' => $keyValue,
            'fingerprint' => 'SHA256:abcd1234...',
            'created_at' => '2024-01-01T10:00:00+00:00'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->sshTask->add($keyValue, $userId, $keyType);

        $this->assertInstanceOf(SshKey::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetSshKey(): void
    {
        $keyId = 123;
        $expectedData = [
            'id' => $keyId,
            'title' => 'My SSH Key',
            'value' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host',
            'fingerprint' => 'SHA256:abcd1234...',
            'created_at' => '2024-01-01T10:00:00+00:00'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->sshTask->get($keyId);

        $this->assertInstanceOf(SshKey::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider invalidKeyIdProvider
     */
    public function testGetSshKeyWithInvalidKeyId(int $keyId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->get($keyId);
    }

    public function testGetSshKeyNotFound(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'SSH key not found'])
            ));

        $this->sshTask->get(99999);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteSshKey(): void
    {
        $keyId = 123;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                [],
                ''
            ));

        $this->sshTask->delete($keyId);

        // Assert no exception was thrown
        $this->assertTrue(true);
    }

    /**
     * @dataProvider invalidKeyIdProvider
     */
    public function testDeleteSshKeyWithInvalidKeyId(int $keyId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->delete($keyId);
    }

    public function testDeleteSshKeyNotFound(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'SSH key not found'])
            ));

        $this->sshTask->delete(99999);
    }

    public function testDeleteSshKeyForbidden(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Forbidden'])
            ));

        $this->sshTask->delete(123);
    }

    public static function invalidUserIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidKeyIdProvider(): array
    {
        return [
            'zero' => [0],
            'negative' => [-1],
        ];
    }

    public static function sshKeyTypesProvider(): array
    {
        return [
            'RSA' => [
                'RSA Key',
                'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC... user@host'
            ],
            'ED25519' => [
                'ED25519 Key',
                'ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIAbCd... user@host'
            ],
            'ECDSA' => [
                'ECDSA Key',
                'ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlz... user@host'
            ],
        ];
    }
}
