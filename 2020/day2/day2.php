<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$rows = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

echo 'Part 1: ' . count_valid_passwords_part_1($rows) . PHP_EOL;
echo 'Part 2: ' . count_valid_passwords_part_2($rows) . PHP_EOL;

printExecutionInfo($startTime);
