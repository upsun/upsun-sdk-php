<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

/**
 * ResourcesTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class ResourcesTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
    ) {
        parent::__construct($this->client);
    }
}
