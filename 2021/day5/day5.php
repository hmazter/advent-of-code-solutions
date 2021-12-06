<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input');

$startTime = microtime(true);

echo 'Part 1: ' . solve($input, false) . PHP_EOL;
echo 'Part 2: ' . solve($input, true) . PHP_EOL;

printExecutionInfo($startTime);
