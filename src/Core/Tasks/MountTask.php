<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

class MountTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
    )
    {
        parent::__construct($this->client);
    }
}
