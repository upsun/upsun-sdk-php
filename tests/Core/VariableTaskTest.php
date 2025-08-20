<?php

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\VariableTask;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\ProjectVariable;
use Upsun\Model\EnvironmentVariable;
use Upsun\ApiException;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class VariableTaskTest extends TestCase
{
    private VariableTask $variableTask;
    private $projectVariablesApi;
    private $environmentVariablesApi;
    private $client;

    protected function setUp(): void
    {
        $this->client = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->projectVariablesApi = $this->createMock(ProjectVariablesApi::class);
        $this->environmentVariablesApi = $this->createMock(EnvironmentVariablesApi::class);

        $this->variableTask = new class(
            $this->client,
            $this->projectVariablesApi,
            $this->environmentVariablesApi
        ) extends VariableTask {
            public function refreshToken(): void
            {
            }
        };
        
    }

    public function testCreateProjectVariableSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);
        $this->projectVariablesApi->method('createProjectsVariables')->willReturn($response);

        $result = $this->variableTask->createProjectVariable('pid', ['name' => 'FOO', 'value' => 'bar']);
        $this->assertSame($response, $result);
    }

    public function testCreateProjectVariableFailure(): void
    {
        $this->projectVariablesApi->method('createProjectsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->createProjectVariable('pid', ['name' => 'FOO', 'value' => 'bar']);
    }

    public function testDeleteProjectVariableSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);
        $this->projectVariablesApi->method('deleteProjectsVariables')->willReturn($response);

        $result = $this->variableTask->deleteProjectVariable('pid', 'vid');
        $this->assertSame($response, $result);
    }

    public function testDeleteProjectVariableFailure(): void
    {
        $this->projectVariablesApi->method('deleteProjectsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->deleteProjectVariable('pid', 'vid');
    }

    public function testGetProjectVariableSuccess(): void
    {
        $variable = $this->createMock(ProjectVariable::class);
        $this->projectVariablesApi->method('getProjectsVariables')->willReturn($variable);

        $result = $this->variableTask->getProjectVariable('pid', 'vid');
        $this->assertSame($variable, $result);
    }

    public function testGetProjectVariableFailure(): void
    {
        $this->projectVariablesApi->method('getProjectsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->getProjectVariable('pid', 'vid');
    }

    public function testListProjectVariablesSuccess(): void
    {
        $this->projectVariablesApi->method('listProjectsVariables')->willReturn([]);
        $result = $this->variableTask->listProjectVariables('pid');
        $this->assertIsArray($result);
    }

    public function testListProjectVariablesFailure(): void
    {
        $this->projectVariablesApi->method('listProjectsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->listProjectVariables('pid');
    }

    public function testUpdateProjectVariableSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);
        $this->projectVariablesApi->method('updateProjectsVariables')->willReturn($response);

        $result = $this->variableTask->updateProjectVariable('pid', 'vid', ['value' => 'baz']);
        $this->assertSame($response, $result);
    }

    public function testUpdateProjectVariableFailure(): void
    {
        $this->projectVariablesApi->method('updateProjectsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->updateProjectVariable('pid', 'vid', ['value' => 'baz']);
    }

    public function testCreateEnvironmentVariableFailure(): void
    {
        $this->environmentVariablesApi->method('deleteProjectsEnvironmentsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->createEnvironmentVariable('pid', 'eid', ['name' => 'FOO', 'value' => 'bar']);
    }

    public function testDeleteEnvironmentVariableSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);
        $this->environmentVariablesApi->method('deleteProjectsEnvironmentsVariables')->willReturn($response);

        $result = $this->variableTask->deleteEnvironmentVariable('pid', 'eid', 'vid');
        $this->assertSame($response, $result);
    }

    public function testDeleteEnvironmentVariableFailure(): void
    {
        $this->environmentVariablesApi->method('deleteProjectsEnvironmentsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->deleteEnvironmentVariable('pid', 'eid', 'vid');
    }

    public function testGetEnvironmentVariableSuccess(): void
    {
        $variable = $this->createMock(EnvironmentVariable::class);
        $this->environmentVariablesApi->method('getProjectsEnvironmentsVariables')->willReturn($variable);

        $result = $this->variableTask->getEnvironmentVariable('pid', 'eid', 'vid');
        $this->assertSame($variable, $result);
    }

    public function testGetEnvironmentVariableFailure(): void
    {
        $this->environmentVariablesApi->method('getProjectsEnvironmentsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->getEnvironmentVariable('pid', 'eid', 'vid');
    }

    public function testListEnvironmentVariablesSuccess(): void
    {
        $this->environmentVariablesApi->method('listProjectsEnvironmentsVariables')->willReturn([]);
        $result = $this->variableTask->listEnvironmentVariables('pid', 'eid');
        $this->assertIsArray($result);
    }

    public function testListEnvironmentVariablesFailure(): void
    {
        $this->environmentVariablesApi->method('listProjectsEnvironmentsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->listEnvironmentVariables('pid', 'eid');
    }

    public function testUpdateEnvironmentVariableSuccess(): void
    {
        $response = $this->createMock(AcceptedResponse::class);
        $this->environmentVariablesApi->method('updateProjectsEnvironmentsVariables')->willReturn($response);

        $result = $this->variableTask->updateEnvironmentVariable('pid', 'eid', 'vid', ['value' => 'baz']);
        $this->assertSame($response, $result);
    }

    public function testUpdateEnvironmentVariableFailure(): void
    {
        $this->environmentVariablesApi->method('updateProjectsEnvironmentsVariables')->willThrowException($this->createMock(ApiException::class));
        $this->expectException(ApiException::class);
        $this->variableTask->updateEnvironmentVariable('pid', 'eid', 'vid', ['value' => 'baz']);
    }
}
