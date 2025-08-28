<?php

namespace Upsun\Core\Tasks;

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
}
