<?php

namespace Upsun\Core\Tasks;

use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use Upsun\UpsunClient;

/**
 * TaskBase class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
abstract class TaskBase
{
    public function __construct(
        protected UpsunClient $client,
    ) {
    }

    protected static function checkUserId(string $userId): void
    {
        if (!$userId) {
            throw new InvalidArgumentException('User ID is required');
        }
    }

    protected static function checkProjectId(string $projectId): void
    {
        if (!$projectId) {
            throw new InvalidArgumentException('Project ID is required');
        }
    }

    protected static function checkOrganizationId(string $organizationId): void
    {
        if (!$organizationId) {
            throw new InvalidArgumentException('Organization ID is required');
        }
    }

    protected static function checkEnvironmentId(string $environmentId): void
    {
        if (!$environmentId) {
            throw new InvalidArgumentException('Environment ID is required');
        }
    }

    protected static function checkActivityId(string $activityId): void
    {
        if (!$activityId) {
            throw new InvalidArgumentException('Activity ID is required');
        }
    }

    protected static function checkApplicationId(string $applicationId): void
    {
        if (!$applicationId) {
            throw new InvalidArgumentException('Application ID is required');
        }
    }

    protected static function checkBackupId(string $backupId): void
    {
        if (!$backupId) {
            throw new InvalidArgumentException('Backup ID is required');
        }
    }

    protected static function checkCertificateId(string $certificateId): void
    {
        if (!$certificateId) {
            throw new InvalidArgumentException('Certificate ID is required');
        }
    }

    protected static function checkSubscriptionId(string $subscriptionId): void
    {
        if (!$subscriptionId) {
            throw new InvalidArgumentException('Subscription ID is required');
        }
    }

    protected static function checkTeamId(string $teamId): void
    {
        if (!$teamId) {
            throw new InvalidArgumentException('Team ID is required');
        }
    }

    protected static function checkDeploymentId(string $deploymentId): void
    {
        if (!$deploymentId) {
            throw new InvalidArgumentException('Deployment ID is required');
        }
    }

    protected static function checkInvoiceId(string $invoiceId): void
    {
        if (!$invoiceId) {
            throw new InvalidArgumentException('Invoice ID is required');
        }
    }

    protected static function checkOrderId(string $orderId): void
    {
        if (!$orderId) {
            throw new InvalidArgumentException('Order ID is required');
        }
    }

    protected static function checkVoucherCode(string $code): void
    {
        if (!$code) {
            throw new InvalidArgumentException('Voucher code is required');
        }
    }

    protected static function checkProjectRegion(string $region): void
    {
        if (!$region) {
            throw new InvalidArgumentException('Project region is required');
        }
    }

    protected static function checkVariableId(string $variableId): void
    {
        if (!$variableId) {
            throw new InvalidArgumentException('Variable ID is required');
        }
    }

    protected static function checkRepositoryBlobId(string $repositoryBlobId): void
    {
        if (!$repositoryBlobId) {
            throw new InvalidArgumentException('Repository Blob ID is required');
        }
    }

    protected static function checkRepositoryCommitId(string $repositoryCommitId): void
    {
        if (!$repositoryCommitId) {
            throw new InvalidArgumentException('Repository Commit ID is required');
        }
    }

    protected static function checkRepositoryRefId(string $repositoryRefId): void
    {
        if (!$repositoryRefId) {
            throw new InvalidArgumentException('Repository Ref ID is required');
        }
    }

    protected static function checkRepositoryTreeId(string $repositoryTreeId): void
    {
        if (!$repositoryTreeId) {
            throw new InvalidArgumentException('Repository Tree ID is required');
        }
    }

    protected static function checkIntegrationId(string $integrationId): void
    {
        if (!$integrationId) {
            throw new InvalidArgumentException('Integration ID is required');
        }
    }

    protected static function checkDomainId(string $domainId): void
    {
        if (!$domainId) {
            throw new InvalidArgumentException('Domain ID is required');
        }
    }

    protected static function checkApiTokenId(string $tokenId): void
    {
        if (!$tokenId) {
            throw new InvalidArgumentException('API Token ID is required');
        }
    }

    protected static function checkEmail(string $email): void
    {
        if (!$email) {
            throw new InvalidArgumentException('Email is required');
        }

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            throw new InvalidArgumentException('Invalid email format');
        }
    }

    protected static function checkInviteId(string $inviteId): void
    {
        if (!$inviteId) {
            throw new InvalidArgumentException('Invite ID is required');
        }
    }

    protected static function checkUsername(string $username): void
    {
        if (!$username) {
            throw new InvalidArgumentException('Username is required');
        }
    }

    protected static function checkSshKeyId(int $keyId): void
    {
        if (!$keyId || $keyId <= 0) {
            throw new InvalidArgumentException('Key ID must be a positive integer');
        }
    }

    protected function normalizeFilter(array|string|int|DateTime|null $value): array
    {
        if ($value === null) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        if ($value instanceof DateTime) {
            return ['eq' => $value->format(DateTimeInterface::ATOM)];
        }

        // string or int
        return ['eq' => (string) $value];
    }

    /**
     * Get SubscriptionId of a Project Licence Uri
     */
    protected function extractSubscriptionId(string $projectLicenceUri): string
    {
        $path = parse_url($projectLicenceUri, PHP_URL_PATH);
        return basename($path);
    }
}
