<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';
$input = readRows(__DIR__ . '/input.txt');

$startTime = microtime(true);

$galaxy = build_galaxy($input);

echo 'Part 1: ' . $galaxy->getTotalOrbitCount() . PHP_EOL;
echo 'Part 2: ' . PHP_EOL;

printExecutionInfo($startTime);
