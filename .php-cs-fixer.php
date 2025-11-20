<?php

/**
 * @generated
 * @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/HEAD/doc/config.rst
 */
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('test')
    ->exclude('tests')
;

$config = new PhpCsFixer\Config();
return $config
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'phpdoc_order' => true,
        'array_syntax' => [ 'syntax' => 'short' ],
        'strict_comparison' => true,
        'strict_param' => true,
        'no_trailing_whitespace' => false,
        'no_trailing_whitespace_in_comment' => false,
        'braces' => false,
        'single_blank_line_at_eof' => false,
        'blank_line_after_namespace' => false,
        'no_leading_import_slash' => false,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        "fully_qualified_strict_types" => false,
        'no_unused_imports' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'curly_brace_block',
                'parenthesis_brace_block',
                'square_brace_block',
                'return',
                'throw',
                'use',
                'use_trait',
                'continue',
                'break',
                'switch',
                'case',
                'default',
            ],
        ],
        'no_whitespace_in_blank_line' => true,
    ])
    ->setFinder($finder)
;
