<?php

namespace Upsun\Core\Tasks;

use DateTime;
use DateTimeInterface;
use Psr\Http\Client\ClientExceptionInterface;
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
     *
     * @throws ClientExceptionInterface
     */
    protected function extractSubscriptionId(string $projectLicenceUri): string
    {
        $path = parse_url($projectLicenceUri, PHP_URL_PATH);
        return basename($path);
    }
}
