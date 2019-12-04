<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$rows = readRows(__DIR__ .'/input.txt');
$path1 = explode(',', $rows[0]);
$path2 = explode(',', $rows[1]);

$startTime = microtime(true);

$result = solve($path1, $path2);
echo 'Part 1: ' . $result['manhattan'] . PHP_EOL;
echo 'Part 2: ' . $result['wire'] . PHP_EOL;

printExecutionInfo($startTime);
