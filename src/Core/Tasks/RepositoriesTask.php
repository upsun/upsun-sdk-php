<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DiffApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Model\Blob;
use Upsun\Model\Commit;
use Upsun\Model\Ref;
use Upsun\Model\SystemInformation;
use Upsun\Model\Tree;
use Upsun\UpsunClient;

/**
 * RepositoriesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class RepositoriesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly RepositoryApi $repositoryApi,
        private readonly SystemInformationApi $systemInformationApi,
        private readonly DiffApi $diffApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Get a Git blob by its ID in the specified project. This method retrieves the details of a Git blob, including
     * its content, encoding, and any relevant metadata. The blob ID should be a valid identifier for a Git blob within
     * the project's repository.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitBlob(string $projectId, string $repositoryBlobId): Blob
    {
        parent::checkProjectId($projectId);
        parent::checkRepositoryBlobId($repositoryBlobId);

        return $this->repositoryApi->getProjectsGitBlobs(
            projectId: $projectId,
            repositoryBlobId: $repositoryBlobId
        );
    }

    /**
     * Get a Git commit by its ID in the specified project. This method retrieves the details of a Git commit, including
     * its message, author, committer, timestamp, and any relevant metadata. The commit ID should be a valid identifier
     * for a Git commit within the project's repository.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        parent::checkProjectId($projectId);
        parent::checkRepositoryCommitId($repositoryCommitId);

        return $this->repositoryApi->getProjectsGitCommits(
            projectId: $projectId,
            repositoryCommitId: $repositoryCommitId
        );
    }

    /**
     * Get a Git reference (e.g., branch or tag) by its ID in the specified project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        parent::checkProjectId($projectId);
        parent::checkRepositoryRefId($repositoryRefId);

        return $this->repositoryApi->getProjectsGitRefs(
            projectId: $projectId,
            repositoryRefId: $repositoryRefId
        );
    }

    /**
     * List all Git references (e.g., branches and tags) in the specified project. This method retrieves a list of all
     * Git references that exist within the project's repository, including details such as the reference name, type
     * (branch or tag), and the commit it points to. The returned list includes the details of each Git reference that
     * belongs to the project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return Ref[]
     */
    public function listGitRefs(string $projectId): array
    {
        parent::checkProjectId($projectId);

        return $this->repositoryApi->listProjectsGitRefs(projectId: $projectId);
    }

    /**
     * Get a Git tree by its ID in the specified project. This method retrieves the details of a Git tree, including its
     * entries (files and subdirectories), their types, and any relevant metadata. The tree ID should be a valid
     * identifier for a Git tree within the project's repository.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        parent::checkProjectId($projectId);
        parent::checkRepositoryTreeId($repositoryTreeId);

        return $this->repositoryApi->getProjectsGitTrees(
            projectId: $projectId,
            repositoryTreeId: $repositoryTreeId
        );
    }

    /**
     * Get GIT related system information for a project. This method retrieves details about the Git system associated
     * with the specified project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        parent::checkProjectId($projectId);

        return $this->systemInformationApi->getProjectsSystem(projectId: $projectId);
    }

    /**
     * List Git diffs between two references
     * This method retrieves the differences between two Git references (branches, tags, or commits),
     * showing what changed between them.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, diffBaseId, or diffTargetId is invalid
     * @return array
     */
    public function listGitDiffs(
        string $projectId,
        string $diffBaseId,
        string $diffTargetId
    ): array {
        $this->checkProjectId($projectId);
        if (empty($diffBaseId)) {
            throw new InvalidArgumentException('Diff base ID cannot be empty');
        }
        if (empty($diffTargetId)) {
            throw new InvalidArgumentException('Diff target ID cannot be empty');
        }

        return $this->diffApi->listProjectsGitDiffs(
            projectId: $projectId,
            diffBaseId: $diffBaseId,
            diffTargetId: $diffTargetId
        );
    }
}
