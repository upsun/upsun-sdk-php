<?php

namespace Upsun\Core;

use GuzzleHttp\Client;

abstract class TaskBase
{
    public function __construct(public readonly Client $client) { }
}