<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

$rules = parse_rules($input);

echo 'Part 1: ' . count_bags_that_eventually_can_contain_shiny_gold($rules) . PHP_EOL;
echo 'Part 2: ' . count_bags_inside_shiny_gold_bag($rules) . PHP_EOL;

printExecutionInfo($startTime);
