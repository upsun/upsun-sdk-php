<?php

namespace Upsun\Core\Tasks;

//use GuzzleHttp\Client;
use Upsun\UpsunClient;

abstract class TaskBase
{
    public function __construct(public readonly UpsunClient $client) { }
}