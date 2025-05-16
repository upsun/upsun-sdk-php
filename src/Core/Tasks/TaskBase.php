<?php

namespace Upsun\Core\Tasks;

use GuzzleHttp\Client;

abstract class TaskBase
{
    public function __construct(public readonly Client $client) { }
}