<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(readRows(__DIR__ . '/input.txt'));

$startTime = microtime(true);

echo 'Part 1: ' . part1($input) . PHP_EOL;
echo 'Part 2: ' . 'NOT SOLVED' . PHP_EOL;

printExecutionInfo($startTime);
