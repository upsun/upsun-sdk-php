<?php

namespace Upsun\Tests\Core\Tasks;

use Upsun\Core\TokenProvider;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\ProjectVariable;
use Upsun\UpsunClient;

class VariablesTaskTest extends BaseTestCase
{
    private VariablesTask $variablesTask;

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

        $this->variablesTask = new class (
            $upsunClient,
            new ProjectVariablesApi(...$apiClassParams),
            new EnvironmentVariablesApi(...$apiClassParams),
        ) extends VariablesTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateProjectVariableSuccess()
    {
        $projectId = 'proj_123';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->createProjectVariable(
            projectId: $projectId,
            name: 'VAR_NAME',
            value: 'value123',
            attributes: ['attr1' => 'val1'],
            isJson: false,
            isSensitive: true,
            visibleBuild: true,
            visibleRuntime: false,
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectVariableError()
    {
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid input'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->createProjectVariable(
            projectId: $projectId,
            name: 'VAR_NAME',
            value: 'value123'
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testDeleteProjectVariableSuccess()
    {
        $projectId = 'proj_123';
        $projectVariableId = 'var_456';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->deleteProjectVariable(
            projectId: $projectId,
            variableId: $projectVariableId
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteProjectVariableError()
    {
        $projectId = 'proj_123';
        $projectVariableId = 'var_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Variable not found'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->deleteProjectVariable(projectId: $projectId, variableId: $projectVariableId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetProjectVariableSuccess()
    {
        $projectId = 'proj_123';
        $projectVariableId = 'var_456';

        $variableFake = [
            'id' => 'var1',
            'name' => 'VAR_NAME',
            'attributes' => ['attr1' => 'val1'],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'value' => 'value123',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($variableFake)
            ));

        $result = $this->variablesTask->getProjectVariable(
            projectId: $projectId,
            variableId: $projectVariableId
        );
        $this->assertInstanceOf(ProjectVariable::class, $result);
        $this->assertObjectProperties($result, $variableFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetProjectVariableError()
    {
        $projectId = 'proj_123';
        $projectVariableId = 'var_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Variable not found'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->getProjectVariable(projectId: $projectId, variableId: $projectVariableId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjectVariablesSuccess()
    {
        $projectId = 'proj_123';

        $variablesFake = [
            [
                'id' => 'var1',
                'name' => 'VAR_ONE',
                'attributes' => ['attr1' => 'val1'],
                'isJson' => false,
                'isSensitive' => true,
                'visibleBuild' => true,
                'visibleRuntime' => false,
                'createdAt' => '2025-01-01T10:00:00Z',
                'updatedAt' => '2025-09-26T12:00:00Z',
                'value' => 'value1',
            ],
            [
                'id' => 'var2',
                'name' => 'VAR_TWO',
                'attributes' => ['attr2' => 'val2'],
                'isJson' => true,
                'isSensitive' => false,
                'visibleBuild' => false,
                'visibleRuntime' => true,
                'createdAt' => '2025-02-01T08:00:00Z',
                'updatedAt' => '2025-09-20T08:00:00Z',
                'value' => '{"foo":"bar"}',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($variablesFake)
            ));

        $result = $this->variablesTask->listProjectVariables(projectId: $projectId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectVariable::class, $result);
        $this->assertObjectMatchesArray($result, $variablesFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectVariablesError()
    {
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                500,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 500,
                    'message' => 'Internal server error'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->listProjectVariables(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateProjectVariableSuccess()
    {
        $projectId = 'proj_123';
        $variableId = 'var_456';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->updateProjectVariable(
            projectId: $projectId,
            variableId: $variableId,
            name: 'VAR_UPDATED',
            value: 'new_value',
            attributes: ['attr1' => 'val1'],
            isJson: true,
            isSensitive: false,
            visibleBuild: false,
            visibleRuntime: true,
            applicationScope: ['app1', 'app2'],
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProjectVariableError()
    {
        $projectId = 'proj_123';
        $variableId = 'var_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid input'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->updateProjectVariable(
            projectId: $projectId,
            variableId: $variableId,
            name: 'VAR_UPDATED',
            value: 'new_value'
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateEnvironmentVariableSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->createEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            name: 'ENV_VAR',
            value: 'value123',
            attributes: ['attr1' => 'val1'],
            isJson: false,
            isSensitive: true,
            visibleBuild: true,
            visibleRuntime: false,
            applicationScope: ['app1', 'app2'],
            isEnabled: true,
            isInheritable: false,
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateEnvironmentVariableError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid input'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->createEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            name: 'ENV_VAR',
            value: 'value123'
        );
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testDeleteEnvironmentVariableSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->deleteEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteEnvironmentVariableError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid variable ID'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->deleteEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetEnvironmentVariableSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $variableFake = [
            'id' => 'var1',
            'name' => 'VAR_NAME',
            'attributes' => ['attr1' => 'val1'],
            'isJson' => false,
            'isSensitive' => true,
            'visibleBuild' => true,
            'visibleRuntime' => false,
            'project' => $projectId,
            'environment' => $environmentId,
            'inherited' => false,
            'isEnabled' => true,
            'isInheritable' => false,
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'value' => 'value123'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($variableFake)
            ));

        $result = $this->variablesTask->getEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
        $this->assertInstanceOf(EnvironmentVariable::class, $result);
        $this->assertObjectProperties($result, $variableFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetEnvironmentVariableError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Variable not found'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->getEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListEnvironmentVariablesSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $variablesFake = [
            [
                'id' => 'var1',
                'name' => 'VAR_1',
                'attributes' => ['attr' => 'val1'],
                'isJson' => false,
                'isSensitive' => false,
                'visibleBuild' => true,
                'visibleRuntime' => false,
                'project' => $projectId,
                'environment' => $environmentId,
                'inherited' => false,
                'isEnabled' => true,
                'isInheritable' => false,
                'createdAt' => '2025-01-01T10:00:00Z',
                'updatedAt' => '2025-09-26T12:00:00Z',
                'value' => 'value1',
            ],
            [
                'id' => 'var2',
                'name' => 'VAR_2',
                'attributes' => ['attr' => 'val2'],
                'isJson' => true,
                'isSensitive' => true,
                'visibleBuild' => false,
                'visibleRuntime' => true,
                'project' => $projectId,
                'environment' => $environmentId,
                'inherited' => true,
                'isEnabled' => false,
                'isInheritable' => true,
                'createdAt' => '2025-02-01T08:00:00Z',
                'updatedAt' => '2025-09-20T08:00:00Z',
                'value' => '{"key":"val"}',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($variablesFake)
            ));

        $result = $this->variablesTask->listEnvironmentVariables(
            projectId: $projectId,
            environmentId: $environmentId
        );
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(EnvironmentVariable::class, $result);
        $this->assertObjectMatchesArray($result, $variablesFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListEnvironmentVariablesError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                500,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 500,
                    'message' => 'Internal Server Error'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->listEnvironmentVariables(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateEnvironmentVariableSuccess()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $fakeResponse = [
            'status' => 'accepted',
            'code' => 204
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->variablesTask->updateEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId,
            name: 'VAR_NAME_UPDATED',
            value: 'newValue',
            attributes: ['attr' => 'val'],
            isJson: false,
            isSensitive: true,
            visibleBuild: true,
            visibleRuntime: false,
            applicationScope: ['app1', 'app2'],
            isEnabled: true,
            isInheritable: false,
        );
        $this->assertInstanceOf(AcceptedResponse::class, $result);
        $this->assertObjectProperties($result, $fakeResponse);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateEnvironmentVariableError()
    {
        $projectId = 'proj_123';
        $environmentId = 'env_456';
        $variableId = 'var_789';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid input'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->variablesTask->updateEnvironmentVariable(
            projectId: $projectId,
            environmentId: $environmentId,
            variableId: $variableId,
            name: 'VAR_NAME_UPDATED',
            value: 'newValue',
            attributes: [
            'origin' => 'test',
            'custom' => 'fake-attribute'
            ],
            isJson: false,
            isSensitive: true,
            visibleBuild: true,
            visibleRuntime: false,
            applicationScope: ['app1', 'app2'],
            isEnabled: true,
            isInheritable: false,
        );
    }
}
