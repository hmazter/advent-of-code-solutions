<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(readRows(__DIR__ . '/input.txt'));

$startTime = microtime(true);

echo 'Part 1: ' . find_invalid_number($input, 25) . PHP_EOL;
echo 'Part 2: ' . find_sum_of_min_and_max_in_a_contiguous_set($input, 25) . PHP_EOL;

printExecutionInfo($startTime);
