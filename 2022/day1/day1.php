<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$startTime = microtime(true);

echo 'Part 1: ' . part1(__DIR__ . '/input.txt') . PHP_EOL;
echo 'Part 2: ' . part2(__DIR__ . '/input.txt') . PHP_EOL;

printExecutionInfo($startTime);
