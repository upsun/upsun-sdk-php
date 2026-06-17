<?php

namespace Upsun\Tests\Core\Tasks;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\TaskApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\TaskBase;
use Upsun\Core\Tasks\TaskContainersTask;
use Upsun\Model\AcceptedResponse;
use Upsun\UpsunClient;

class TaskContainersTaskTest extends BaseTestCase
{
    private TaskContainersTask $taskContainersTask;

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

        $this->taskContainersTask = new class (
            $upsunClient,
            new TaskApi(...$apiClassParams)
        ) extends TaskContainersTask {
        };
    }

    public function testTaskContainersTaskCanBeInstantiated(): void
    {
        $this->assertInstanceOf(TaskContainersTask::class, $this->taskContainersTask);
    }

    public function testTaskContainersTaskExtendsTaskBase(): void
    {
        $this->assertInstanceOf(TaskBase::class, $this->taskContainersTask);
    }

    public function testGetMethodExists(): void
    {
        $reflection = new \ReflectionClass($this->taskContainersTask);
        $this->assertTrue($reflection->hasMethod('get'));

        $method = $reflection->getMethod('get');
        $this->assertTrue($method->isPublic());
    }

    public function testListMethodExists(): void
    {
        $reflection = new \ReflectionClass($this->taskContainersTask);
        $this->assertTrue($reflection->hasMethod('list'));

        $method = $reflection->getMethod('list');
        $this->assertTrue($method->isPublic());
    }

    public function testRunMethodExists(): void
    {
        $reflection = new \ReflectionClass($this->taskContainersTask);
        $this->assertTrue($reflection->hasMethod('run'));

        $method = $reflection->getMethod('run');
        $this->assertTrue($method->isPublic());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRunSuccess(): void
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

        $result = $this->taskContainersTask->run(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: 'task789'
        );

        $this->assertEquals(new AcceptedResponse('accepted', 202), $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetSuccess(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], '{}'));

        try {
            $this->taskContainersTask->get(
                projectId: 'project123',
                environmentId: 'env456',
                taskId: 'task789'
            );
        } catch (ApiException) {
        }
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListSuccess(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], '[]'));

        $result = $this->taskContainersTask->list(
            projectId: 'project123',
            environmentId: 'env456'
        );

        $this->assertIsArray($result);
    }

    public function testGetMethodWithInvalidProjectId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->taskContainersTask->get(
            projectId: '',
            environmentId: 'env456',
            taskId: 'task789'
        );
    }

    public function testGetMethodWithInvalidTaskId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->taskContainersTask->get(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: ''
        );
    }

    public function testRunMethodWithInvalidTaskId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->taskContainersTask->run(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: ''
        );
    }

    public function testRunMethodWithInvalidProjectId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->taskContainersTask->run(
            projectId: '',
            environmentId: 'env456',
            taskId: 'task789'
        );
    }

    /**
     * A flat NAME => value map must be wrapped under the `env` group.
     *
     * @throws ClientExceptionInterface
     */
    public function testRunWrapsFlatVariablesUnderEnvGroup(): void
    {
        $capturedBody = null;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function ($request) use (&$capturedBody) {
                $capturedBody = json_decode((string)$request->getBody(), true);
                return new Response(
                    202,
                    ['Content-Type' => 'application/json'],
                    json_encode(['status' => 'accepted', 'code' => 202])
                );
            });

        $this->taskContainersTask->run(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: 'task789',
            variables: ['FOO' => 'bar', 'BAZ' => 'qux']
        );

        $this->assertSame(
            ['env' => ['FOO' => 'bar', 'BAZ' => 'qux']],
            $capturedBody['variables']
        );
    }

    /**
     * Already-grouped variables must be passed through untouched.
     *
     * @throws ClientExceptionInterface
     */
    public function testRunKeepsAlreadyGroupedVariables(): void
    {
        $capturedBody = null;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function ($request) use (&$capturedBody) {
                $capturedBody = json_decode((string)$request->getBody(), true);
                return new Response(
                    202,
                    ['Content-Type' => 'application/json'],
                    json_encode(['status' => 'accepted', 'code' => 202])
                );
            });

        $grouped = ['env' => ['FOO' => 'bar'], 'build' => ['BAZ' => 'qux']];

        $this->taskContainersTask->run(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: 'task789',
            variables: $grouped
        );

        $this->assertSame($grouped, $capturedBody['variables']);
    }

    /**
     * A map with at least one non-array value is treated as flat and wrapped.
     *
     * @throws ClientExceptionInterface
     */
    public function testRunWrapsMixedVariablesUnderEnvGroup(): void
    {
        $capturedBody = null;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function ($request) use (&$capturedBody) {
                $capturedBody = json_decode((string)$request->getBody(), true);
                return new Response(
                    202,
                    ['Content-Type' => 'application/json'],
                    json_encode(['status' => 'accepted', 'code' => 202])
                );
            });

        $mixed = ['env' => ['FOO' => 'bar'], 'FLAT' => 'value'];

        $this->taskContainersTask->run(
            projectId: 'project123',
            environmentId: 'env456',
            taskId: 'task789',
            variables: $mixed
        );

        $this->assertSame(['env' => $mixed], $capturedBody['variables']);
    }
}
