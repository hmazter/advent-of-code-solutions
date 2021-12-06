<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = toIntArray(
    explode(',', readFileContent(__DIR__ . '/input'))
);

$startTime = microtime(true);

echo 'Part 1: ' . count_lanternfish($input, 80) . PHP_EOL;
echo 'Part 2: ' . count_lanternfish($input, 256) . PHP_EOL;

printExecutionInfo($startTime);
