<?php
declare(strict_types=1);

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/functions.php';

$startTime = microtime(true);

$input = readRows(__DIR__ . '/input.txt');

echo 'Part 1: ' . checksum($input) . PHP_EOL;
echo 'Part 2: ' . findEqualCharactersInMostSimilarWords($input) . PHP_EOL;

printExecutionInfo($startTime);
