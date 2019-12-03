<?php
declare(strict_types=1);

require_once __DIR__ . '/../../common.php';
require_once __DIR__ . '/functions.php';

$input = trim(file_get_contents('./input.txt'));

$startTime = microtime(true);

echo 'Part 1: ' . strlen(reactPolymers($input)) . PHP_EOL;
echo 'Part 2: ' . removeAndReact($input) . PHP_EOL;

printExecutionInfo($startTime);
