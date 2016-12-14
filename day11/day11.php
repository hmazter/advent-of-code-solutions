<?php
declare(strict_types = 1);
require_once __DIR__ . '/functions.php';

$rows = file(__DIR__ . '/input_part2.txt');
$state = parseInput($rows);
$path = bfsPath($state);

echo 'Start state:'.PHP_EOL;
printState($path[1]);

echo '----------------------------'.PHP_EOL;
echo 'End state:'.PHP_EOL;
printState($path[count($path) - 1]);

echo 'number of steps: ' . (count($path) - 1) . PHP_EOL;
