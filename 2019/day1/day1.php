<?php
declare(strict_types=1);

require_once __DIR__ . '/../../common.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(readRows(__DIR__ . '/input.txt'));

$startTime = microtime(true);

echo 'Part 1: ' . calculate_total_fuel_requirements($input, false) . PHP_EOL;
echo 'Part 2: ' . calculate_total_fuel_requirements($input, true) . PHP_EOL;

printExecutionInfo($startTime);
