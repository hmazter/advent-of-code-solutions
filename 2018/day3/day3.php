<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$startTime = microtime(true);

$input = readRows('input.txt'); $width = 1000; $height = 1000; $print = false;
//$input = readRows('example.txt'); $width = 8; $height = 8; $print = true;

list($collisionCount, $completeClaim) = solve_day3($input, $width, $height, $print);

echo 'Part 1: ' . $collisionCount . PHP_EOL;
echo 'Part 2: ' . $completeClaim .  PHP_EOL;

printExecutionInfo($startTime);
