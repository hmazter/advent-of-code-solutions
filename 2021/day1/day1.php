<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(readRows(__DIR__ . '/input.txt'));

$startTime = microtime(true);

echo 'Part 1: ' . count_number_of_depth_increases($input) . PHP_EOL;
echo 'Part 2: ' . count_number_of_depth_increases_sliding_window($input) . PHP_EOL;

printExecutionInfo($startTime);
