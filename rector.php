<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/vendor',
    ])
    ->withImportNames(
        importNames: true,
        importDocBlockNames: false,
        importShortClasses: false,
        removeUnusedImports: false
    )
    ->withRules([
        // Une règle bidon juste pour activer le traitement
        // Elle ne fera rien si vous n'avez pas de promoted properties
        RemoveUnusedPromotedPropertyRector::class,
    ]);
