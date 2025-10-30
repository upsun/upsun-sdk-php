<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

/**
 * MetricsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class MetricsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
    ) {
        parent::__construct($client);
    }
}
