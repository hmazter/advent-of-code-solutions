<?php
declare(strict_types=1);
ini_set("memory_limit", '-1');

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$moons = [
    new Moon(13, -13, -2),
    new Moon(16, 2, -15),
    new Moon(7, -18, -12),
    new Moon(-3, -8, -8),
];

$startTime = microtime(true);

echo 'Part 1: ' . solve_part1($moons, 1000) . PHP_EOL;
echo 'Part 2: ' . solve_part2($moons) . PHP_EOL;

printExecutionInfo($startTime);
