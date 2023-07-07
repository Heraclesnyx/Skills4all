<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');


/***
 * Les règles appliquées par le cs sont:
 *  @Symfony les normes
 *  @PHP 8.1 avec des règles risquées
 * 
 */
$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PHP80Migration:risky' => true,
        'concat_space' => ['spacing' => 'one'],
        'psr_autoloading' => false,
        'array_syntax' => ['syntax' => 'short'],
        'class_definition' => ['multi_line_extends_each_single_line' => true],
        'no_useless_else' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => true],
        'echo_tag_syntax' => true,
        'list_syntax' => ['syntax' => 'short'],
        'linebreak_after_opening_tag' => true,
        'void_return' => false,
        'phpdoc_summary' => false,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
    ])
    ->setCacheFile(__DIR__ . '/.php_cs.cache')
    ->setFinder($finder);

return $config;