<?php
declare(strict_types=1);

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/functions.php';

$startTime = microtime(true);

$input = readRows(__DIR__ . '/input.txt');
sort($input);

echo 'Part 1: ' . solvePart1($input) . PHP_EOL;
echo 'Part 2: ' . solvePart2($input) . PHP_EOL;

printExecutionInfo($startTime);
