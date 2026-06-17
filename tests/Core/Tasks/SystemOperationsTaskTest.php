<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\SystemInformationApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\SystemOperationsTask;
use Upsun\Core\Tasks\TaskBase;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class SystemOperationsTaskTest extends BaseTestCase
{
    private SystemOperationsTask $systemOperationsTask;

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

        $this->systemOperationsTask = new class (
            $upsunClient,
            new SystemInformationApi(...$apiClassParams)
        ) extends SystemOperationsTask {
        };
    }

    public function testSystemOperationsTaskCanBeInstantiated(): void
    {
        $this->assertInstanceOf(SystemOperationsTask::class, $this->systemOperationsTask);
    }

    public function testSystemOperationsTaskExtendsTaskBase(): void
    {
        $this->assertInstanceOf(TaskBase::class, $this->systemOperationsTask);
    }

    public function testRestartGitServerMethodExists(): void
    {
        $reflection = new \ReflectionClass($this->systemOperationsTask);
        $this->assertTrue($reflection->hasMethod('restartGitServer'));

        $method = $reflection->getMethod('restartGitServer');
        $this->assertTrue($method->isPublic());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRestartGitServerSuccess(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                202,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 202,
                ])
            ));

        $result = $this->systemOperationsTask->restartGitServer(projectId: 'project123');

        $this->assertEquals(new AcceptedResponse('accepted', 202), $result);
    }

    public function testRestartGitServerWithInvalidProjectId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->systemOperationsTask->restartGitServer(projectId: '');
    }
}
