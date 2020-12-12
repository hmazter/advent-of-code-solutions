<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

echo 'Part 1: ' . day12_part1($input) . PHP_EOL;
echo 'Part 2: ' . day12_part2($input) . PHP_EOL;

printExecutionInfo($startTime);
