<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\TaskApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Task;
use Upsun\Model\TaskTriggerInput;
use Upsun\UpsunClient;

/**
 * TaskContainersTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class TaskContainersTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly TaskApi $taskApi
    ) {
        parent::__construct($client);
    }

    /**
     * Get a specific task by ID in an environment
     * This method retrieves information about a specific asynchronous task that has been run in an environment.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or taskId is invalid
     */
    public function get(
        string $projectId,
        string $environmentId,
        string $taskId
    ): Task {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if (empty($taskId)) {
            throw new InvalidArgumentException('Task ID cannot be empty');
        }

        return $this->taskApi->getProjectsEnvironmentsTasks(
            projectId: $projectId,
            environmentId: $environmentId,
            taskId: $taskId
        );
    }

    /**
     * List all tasks in an environment
     * This method retrieves a list of all asynchronous tasks that have been run in an environment,
     * allowing you to review the history of tasks and their statuses.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     * @return Task[]
     */
    public function list(
        string $projectId,
        string $environmentId
    ): array {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->taskApi->listProjectsEnvironmentsTasks(
            projectId: $projectId,
            environmentId: $environmentId
        );
    }

    /**
     * Run a task in an environment
     * This method executes an asynchronous task in the specified environment. Tasks are long-running operations
     * that can be executed in the background and tracked via the get() method.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or taskId is invalid
     */
    public function run(
        string $projectId,
        string $environmentId,
        string $taskId
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        $this->checkTaskId($taskId);

        return $this->taskApi->runTask(
            projectId: $projectId,
            environmentId: $environmentId,
            taskId: $taskId,
            taskTriggerInput: new TaskTriggerInput()
        );
    }
}
