<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

// Load polymorphic models
foreach (glob(dirname(__DIR__) . '/src/Model/*.php') as $modelFile) {
    if (basename($modelFile) === 'Object.php') {
        continue; // "Object" is a reserved word in PHP 7.2+, so we skip it
    }
    require_once $modelFile;
}
