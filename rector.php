<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // active l'import automatique des FQN
    $rectorConfig->importNames();

    // optionnel : nettoie les "use" non utilisés
    $rectorConfig->removeUnusedImports();

    $rectorConfig->sets([SetList::CODING_STYLE]);
};
