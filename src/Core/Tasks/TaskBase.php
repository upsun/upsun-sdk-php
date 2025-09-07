<?php

namespace Upsun\Core\Tasks;

use DateTimeInterface;
use Upsun\UpsunClient;

/**
 * TaskBase class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
abstract class TaskBase
{
    public function __construct(
        public UpsunClient $client,
    ) {
    }

    protected function normalizeFilter(array|string|int|\DateTime|null $value): array
    {
        if ($value === null) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        if ($value instanceof \DateTime) {
            return ['eq' => $value->format(DateTimeInterface::ATOM)];
        }

        // string or int
        return ['eq' => (string) $value];
    }
}
