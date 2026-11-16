<?php

namespace Upsun\Tests\Core\Tasks;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\SshApi;
use Upsun\Core\Tasks\SshTask;
use Upsun\Core\TokenProvider;
use Upsun\Model\ListUserSshKeys200Response;
use Upsun\Model\SshKey;
use Upsun\UpsunClient;

class SshTaskTest extends BaseTestCase
{
    private const USER_ID = 'user-123';
    private const KEY_ID = 'key-456';
    private const KEY_VALUE = 'ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIAbCd user@host';

    private SshTask $sshTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    private ?RequestInterface $sentRequest = null;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

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
            $this->createMock(UpsunClient::class),
            new SshApi(...$apiClassParams)
        ) extends SshTask {
        };
    }

    private function respondWith(int $status, ?array $body = null): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($status, $body): Response {
                $this->sentRequest = $request;

                return new Response(
                    $status,
                    $body === null ? [] : ['Content-Type' => 'application/json'],
                    $body === null ? '' : json_encode($body)
                );
            });
    }

    private function sshKeyData(?string $label = 'Laptop'): array
    {
        return [
            'id' => self::KEY_ID,
            'sha256' => 'SHA256:abcd1234',
            'value' => self::KEY_VALUE,
            'label' => $label,
            'active' => true,
            'user_id' => self::USER_ID,
            'created_at' => '2026-01-01T10:00:00+00:00',
            'updated_at' => '2026-01-01T10:00:00+00:00',
        ];
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testAddPostsTheKeyToTheUser(): void
    {
        $this->respondWith(201, $this->sshKeyData());

        $result = $this->sshTask->add(self::USER_ID, self::KEY_VALUE, 'Laptop');

        $this->assertSame('POST', $this->sentRequest->getMethod());
        $this->assertSame('/users/user-123/ssh-keys', $this->sentRequest->getUri()->getPath());
        $this->assertSame(
            ['value' => self::KEY_VALUE, 'label' => 'Laptop'],
            json_decode((string) $this->sentRequest->getBody(), true)
        );
        $this->assertInstanceOf(SshKey::class, $result);
        $this->assertSame(self::KEY_ID, $result->getId());
        $this->assertSame('Laptop', $result->getLabel());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testAddWithoutLabelSendsOnlyTheValue(): void
    {
        $this->respondWith(201, $this->sshKeyData(null));

        $this->sshTask->add(self::USER_ID, self::KEY_VALUE);

        $body = json_decode((string) $this->sentRequest->getBody(), true);
        $this->assertSame(self::KEY_VALUE, $body['value']);
        $this->assertNull($body['label'] ?? null);
    }

    public function testAddWithEmptyValueIsRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('SSH key value is required');

        $this->sshTask->add(self::USER_ID, '');
    }

    /**
     * @dataProvider invalidIdProvider
     */
    public function testAddWithInvalidUserIdIsRejected(string $userId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->add($userId, self::KEY_VALUE);
    }

    public function testAddDuplicateKeyThrowsApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->respondWith(409, ['message' => 'SSH key already exists']);

        $this->sshTask->add(self::USER_ID, self::KEY_VALUE);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetReadsTheKeyOfTheUser(): void
    {
        $this->respondWith(200, $this->sshKeyData());

        $result = $this->sshTask->get(self::USER_ID, self::KEY_ID);

        $this->assertSame('GET', $this->sentRequest->getMethod());
        $this->assertSame('/users/user-123/ssh-keys/key-456', $this->sentRequest->getUri()->getPath());
        $this->assertSame(self::KEY_VALUE, $result->getValue());
        $this->assertSame('SHA256:abcd1234', $result->getSha256());
    }

    /**
     * @dataProvider invalidIdProvider
     */
    public function testGetWithInvalidKeyIdIsRejected(string $keyId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->get(self::USER_ID, $keyId);
    }

    /**
     * @dataProvider invalidIdProvider
     */
    public function testGetWithInvalidUserIdIsRejected(string $userId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->get($userId, self::KEY_ID);
    }

    public function testGetUnknownKeyThrowsApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->respondWith(404, ['message' => 'SSH key not found']);

        $this->sshTask->get(self::USER_ID, 'unknown');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListReadsOnePageOfKeys(): void
    {
        $this->respondWith(200, ['items' => [$this->sshKeyData()], 'count' => 1]);

        $result = $this->sshTask->list(self::USER_ID, pageSize: 10, sort: '-created_at');

        $this->assertSame('GET', $this->sentRequest->getMethod());
        $this->assertSame('/users/user-123/ssh-keys', $this->sentRequest->getUri()->getPath());
        parse_str($this->sentRequest->getUri()->getQuery(), $query);
        $this->assertSame('10', $query['page']['size']);
        $this->assertSame('-created_at', $query['sort']);
        $this->assertInstanceOf(ListUserSshKeys200Response::class, $result);
        $this->assertSame(1, $result->getCount());
        $this->assertContainsOnlyInstancesOf(SshKey::class, $result->getItems());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListSendsTheCreatedAtFilter(): void
    {
        $this->respondWith(200, ['items' => [], 'count' => 0]);

        $this->sshTask->list(self::USER_ID, filterCreatedAt: ['eq' => '2026-01-01T00:00:00+00:00']);

        parse_str($this->sentRequest->getUri()->getQuery(), $query);
        $this->assertSame('2026-01-01T00:00:00+00:00', $query['filter']['created_at']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListSendsTheUpdatedAtFilter(): void
    {
        $this->respondWith(200, ['items' => [], 'count' => 0]);

        $this->sshTask->list(self::USER_ID, filterUpdatedAt: ['eq' => '2026-02-01T00:00:00+00:00']);

        parse_str($this->sentRequest->getUri()->getQuery(), $query);
        $this->assertSame(['updated_at' => '2026-02-01T00:00:00+00:00'], $query['filter']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListWithoutFiltersSendsNoQuery(): void
    {
        $this->respondWith(200, ['items' => [], 'count' => 0]);

        $this->sshTask->list(self::USER_ID);

        $this->assertSame('', $this->sentRequest->getUri()->getQuery());
    }

    /**
     * The generated SshApi sends only the `eq` operator, so any other key must fail before the request.
     *
     * @dataProvider unsupportedDateFilterProvider
     */
    public function testListWithUnsupportedDateFilterOperatorIsRejected(string $argument, array $filter): void
    {
        $this->httpClient->expects($this->never())->method('sendRequest');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($argument . ' supports only the "eq" operator');

        $this->sshTask->list(self::USER_ID, ...[$argument => $filter]);
    }

    public static function unsupportedDateFilterProvider(): array
    {
        return [
            'created_at gte' => ['filterCreatedAt', ['gte' => '2026-01-01T00:00:00+00:00']],
            'created_at between' => ['filterCreatedAt', ['between' => '2026-01-01,2026-02-01']],
            'updated_at lt' => ['filterUpdatedAt', ['lt' => '2026-01-01T00:00:00+00:00']],
            'updated_at eq with gt' => ['filterUpdatedAt', ['eq' => '2026-01-01T00:00:00+00:00', 'gt' => 'x']],
            'unknown key' => ['filterCreatedAt', ['from' => '2026-01-01T00:00:00+00:00']],
        ];
    }

    /**
     * @dataProvider invalidIdProvider
     */
    public function testListWithInvalidUserIdIsRejected(string $userId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->list($userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteRemovesTheKeyOfTheUser(): void
    {
        $this->respondWith(204);

        $this->sshTask->delete(self::USER_ID, self::KEY_ID);

        $this->assertSame('DELETE', $this->sentRequest->getMethod());
        $this->assertSame('/users/user-123/ssh-keys/key-456', $this->sentRequest->getUri()->getPath());
    }

    /**
     * @dataProvider invalidIdProvider
     */
    public function testDeleteWithInvalidKeyIdIsRejected(string $keyId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sshTask->delete(self::USER_ID, $keyId);
    }

    public function testDeleteWithoutRecentAuthenticationThrowsApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->respondWith(403, ['message' => 'Forbidden']);

        $this->sshTask->delete(self::USER_ID, self::KEY_ID);
    }

    public static function invalidIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }
}
