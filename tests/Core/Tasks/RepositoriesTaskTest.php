<?php

namespace Upsun\Tests\Core\Tasks;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\DiffApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\RepositoriesTask;
use Upsun\Model\Blob;
use Upsun\Model\Commit;
use Upsun\Model\Ref;
use Upsun\Model\SystemInformation;
use Upsun\Model\Tree;
use Upsun\UpsunClient;

class RepositoriesTaskTest extends BaseTestCase
{
    private RepositoriesTask $repositoriesTask;

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

        $this->repositoriesTask = new class (
            $upsunClient,
            new RepositoryApi(...$apiClassParams),
            new SystemInformationApi(...$apiClassParams),
            new DiffApi(...$apiClassParams)
        ) extends RepositoriesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetGitBlob(): void
    {
        $projectId = 'test-project-id';
        $blobId = 'abc123def456';
        $expectedData = [
            'id' => $blobId,
            'sha' => $blobId,
            'size' => 1024,
            'encoding' => 'utf-8',
            'content' => 'file content here'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitBlob($projectId, $blobId);

        $this->assertInstanceOf(Blob::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetGitBlobWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitBlob($projectId, 'abc123');
    }

    /**
     * @dataProvider invalidBlobIdProvider
     */
    public function testGetGitBlobWithInvalidBlobId(string $blobId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitBlob('test-project-id', $blobId);
    }

    public function testGetGitBlobNotFound(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Blob not found'])
            ));

        $this->repositoriesTask->getGitBlob('test-project-id', 'nonexistent-blob');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetGitCommit(): void
    {
        $projectId = 'test-project-id';
        $commitId = 'commit123abc456def';
        $expectedData = [
            'id' => $commitId,
            'sha' => $commitId,
            'message' => 'Initial commit',
            'author' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'date' => '2024-01-01T10:00:00+00:00'
            ],
            'committer' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'date' => '2024-01-01T10:00:00+00:00'
            ],
            'tree' => 'tree123abc',
            'parents' => []
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitCommit($projectId, $commitId);

        $this->assertInstanceOf(Commit::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetGitCommitWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitCommit($projectId, 'commit123');
    }

    /**
     * @dataProvider invalidCommitIdProvider
     */
    public function testGetGitCommitWithInvalidCommitId(string $commitId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitCommit('test-project-id', $commitId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetGitRef(): void
    {
        $projectId = 'test-project-id';
        $refId = 'heads/main';
        $expectedData = [
            'id' => $refId,
            'ref' => 'refs/' . $refId,
            'sha' => 'commit123abc456def',
            'object' => [
                'type' => 'commit',
                'sha' => 'commit123abc456def'
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitRef($projectId, $refId);

        $this->assertInstanceOf(Ref::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider gitRefTypesProvider
     * @throws ClientExceptionInterface
     */
    public function testGetGitRefWithDifferentTypes(string $refType, string $refName): void
    {
        $projectId = 'test-project-id';
        $refId = $refType . '/' . $refName;
        $expectedData = [
            'id' => $refId,
            'ref' => 'refs/' . $refId,
            'sha' => 'abc123',
            'object' => ['type' => 'commit', 'sha' => 'abc123']
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitRef($projectId, $refId);

        $this->assertInstanceOf(Ref::class, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetGitRefWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitRef($projectId, 'heads/main');
    }

    /**
     * @dataProvider invalidRefIdProvider
     */
    public function testGetGitRefWithInvalidRefId(string $refId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitRef('test-project-id', $refId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListGitRefs(): void
    {
        $projectId = 'test-project-id';
        $expectedData = [
            [
                'id' => 'heads/main',
                'ref' => 'refs/heads/main',
                'sha' => 'abc123',
                'object' => ['type' => 'commit', 'sha' => 'abc123']
            ],
            [
                'id' => 'heads/develop',
                'ref' => 'refs/heads/develop',
                'sha' => 'def456',
                'object' => ['type' => 'commit', 'sha' => 'def456']
            ],
            [
                'id' => 'tags/v1.0.0',
                'ref' => 'refs/tags/v1.0.0',
                'sha' => 'ghi789',
                'object' => ['type' => 'tag', 'sha' => 'ghi789']
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->listGitRefs($projectId);

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertContainsOnlyInstancesOf(Ref::class, $result);
        $this->assertObjectMatchesArray($result, $expectedData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListGitRefsReturnsEmptyArray(): void
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

        $result = $this->repositoriesTask->listGitRefs($projectId);

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testListGitRefsWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->listGitRefs($projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListGitDiffs(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $result = $this->repositoriesTask->listGitDiffs('test-project-id', 'main', 'develop');

        $this->assertIsArray($result);
        $this->assertSame([], $result);
    }

    public function testListGitDiffsWithInvalidBaseId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->listGitDiffs('test-project-id', '', 'develop');
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetGitTree(): void
    {
        $projectId = 'test-project-id';
        $treeId = 'tree123abc456def';
        $expectedData = [
            'id' => $treeId,
            'sha' => $treeId,
            'tree' => [
                [
                    'path' => 'src',
                    'mode' => '040000',
                    'type' => 'tree',
                    'sha' => 'subtree123'
                ],
                [
                    'path' => 'README.md',
                    'mode' => '100644',
                    'type' => 'blob',
                    'sha' => 'blob123'
                ]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitTree($projectId, $treeId);

        $this->assertInstanceOf(Tree::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetGitTreeWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitTree($projectId, 'tree123');
    }

    /**
     * @dataProvider invalidTreeIdProvider
     */
    public function testGetGitTreeWithInvalidTreeId(string $treeId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitTree('test-project-id', $treeId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetGitInfo(): void
    {
        $projectId = 'test-project-id';
        $expectedData = [
            'version' => '2.34.1',
            'image' => 'upsun/git:latest',
            'startedAt' => '2024-01-01T00:00:00+00:00',
            'git_version' => '2.34.1',
            'repository_size' => 1048576,
            'last_commit' => [
                'sha' => 'abc123',
                'message' => 'Latest commit'
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->repositoriesTask->getGitInfo($projectId);

        $this->assertInstanceOf(SystemInformation::class, $result);
        $this->assertObjectProperties($result, $expectedData);
    }

    /**
     * @dataProvider invalidProjectIdProvider
     */
    public function testGetGitInfoWithInvalidProjectId(string $projectId): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repositoriesTask->getGitInfo($projectId);
    }

    public static function invalidProjectIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidBlobIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidCommitIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidRefIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function invalidTreeIdProvider(): array
    {
        return [
            'empty string' => [''],
            'only spaces' => ['   '],
        ];
    }

    public static function gitRefTypesProvider(): array
    {
        return [
            'main branch' => ['heads', 'main'],
            'develop branch' => ['heads', 'develop'],
            'feature branch' => ['heads', 'feature/new-feature'],
            'version tag' => ['tags', 'v1.0.0'],
            'release tag' => ['tags', 'release-2024-01'],
        ];
    }
}
