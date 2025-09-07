<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

/**
 * MetricsTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class MetricsTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
    ) {
        parent::__construct($this->client);
    }
}
