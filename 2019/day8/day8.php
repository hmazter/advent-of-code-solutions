<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readFileContent(__DIR__ . '/input.txt');
$startTime = microtime(true);

echo 'Part 1: ' . solve_part_1(25, 6, $input) . PHP_EOL;
echo 'Part 2: '. PHP_EOL;
solve_part_2(25, 6, $input);

printExecutionInfo($startTime);
