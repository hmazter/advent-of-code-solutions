<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readFileContent('input.txt');

$startTime = microtime(true);

echo 'Part 1: ' . sum_unique_in_chunks($input) . PHP_EOL;
echo 'Part 2: ' . sum_intersection_in_chunks($input) . PHP_EOL;

printExecutionInfo($startTime);
