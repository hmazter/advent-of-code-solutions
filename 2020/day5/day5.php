<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

echo 'Part 1: ' . find_max_seat_id($input) . PHP_EOL;
echo 'Part 2: ' . find_empty_seat($input) . PHP_EOL;

printExecutionInfo($startTime);
