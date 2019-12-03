<?php
declare(strict_types=1);

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(explode(',', readFileContent(__DIR__ . '/input.txt')));

$startTime = microtime(true);

echo 'Part 1: ' . execute(set_noun_and_verb($input, 12, 2)) . PHP_EOL;
echo 'Part 2: ' . execute_step2($input) . PHP_EOL;

printExecutionInfo($startTime);
