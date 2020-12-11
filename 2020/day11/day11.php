<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

echo 'Part 1: ' . day11($input, crowd_limit: 4, check_visible: false) . PHP_EOL;
echo 'Part 2: ' . day11($input, crowd_limit: 5, check_visible: true) . PHP_EOL;

printExecutionInfo($startTime);
