<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // enables automatic import of FQNs (Fully Qualified Names)
    $rectorConfig->importNames();

    // optional: removes unused "use" statements
    //$rectorConfig->removeUnusedImports();

    $rectorConfig->sets([SetList::CODING_STYLE]);

    // Skip rules that remove @author tags
    $rectorConfig->skip([
        // This rule remove PHPDoc tags, including @author --> deactivated
        RemoveUselessParamTagRector::class,
        RemoveUselessVarTagRector::class,
    ]);
};
