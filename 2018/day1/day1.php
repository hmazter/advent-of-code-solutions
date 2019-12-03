<?php
declare(strict_types=1);

require_once __DIR__ . '/../../common.php';
require_once __DIR__ . '/functions.php';

$startTime = microtime(true);

$input = file_get_contents(__DIR__ . '/input.txt');

echo "part 1: " . countTotal($input) . PHP_EOL;
echo "part 2: " . firstFrequencyTwice($input) . PHP_EOL;

printExecutionInfo($startTime);
