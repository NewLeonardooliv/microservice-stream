<?php

$myRules = [
    '@PhpCsFixer' => true,
    'no_unused_imports' => false,
    'no_mixed_echo_print' => ['use' => 'print'],
    'echo_tag_syntax' => ['format' => 'short'],
    'increment_style' => ['style' => 'post'],
    'yoda_style' => false,
];

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();

return $config->setRules($myRules)->setFinder($finder);