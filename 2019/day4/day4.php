<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$start = 347312;
$end = 805915;

$startTime = microtime(true);

echo 'Part 1: ' . count_valid_passwords($start, $end, false) . PHP_EOL;
echo 'Part 2: ' . count_valid_passwords($start, $end, true) . PHP_EOL;

printExecutionInfo($startTime);
