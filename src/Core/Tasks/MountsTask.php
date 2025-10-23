<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

/**
 * MountTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class MountsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
    ) {
        parent::__construct($client);
    }
}
