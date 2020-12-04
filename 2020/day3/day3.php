<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input.txt');
$map = parse_input($input);

$startTime = microtime(true);

echo 'Part 1: ' . count_trees($map, 1, 3) . PHP_EOL;
echo 'Part 2: ' . sum_paths($map) . PHP_EOL;

printExecutionInfo($startTime);
