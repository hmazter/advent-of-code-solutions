<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$program = toIntArray(explode(',', readFileContent(__DIR__ . '/input.txt')));

$startTime = microtime(true);

echo 'Part 1: ' .execute($program, 1) . PHP_EOL;
echo 'Part 2: ' .execute($program, 5) . PHP_EOL;

printExecutionInfo($startTime);
