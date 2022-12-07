<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = file_get_contents(__DIR__ . '/input');

$startTime = microtime(true);

echo 'Part 1: ' . find_start_marker($input, MARKER_PACKET) . PHP_EOL;
echo 'Part 2: ' . find_start_marker($input, MARKER_MESSAGE) . PHP_EOL;

printExecutionInfo($startTime);
