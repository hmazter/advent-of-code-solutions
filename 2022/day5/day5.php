<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

[$stacks_input, $input] = parse_input(file_get_contents(__DIR__ . '/modified_input'));

$startTime = microtime(true);

echo 'Part 1: ' . part1($stacks_input, $input) . PHP_EOL;
echo 'Part 2: ' . part2($stacks_input, $input) . PHP_EOL;

printExecutionInfo($startTime);
