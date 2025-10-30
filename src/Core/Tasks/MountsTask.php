<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

/**
 * MountTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
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
