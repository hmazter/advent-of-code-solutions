<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$input = file('input.txt', FILE_IGNORE_NEW_LINES);
$passports = get_passports($input);

$startTime = microtime(true);

echo 'Part 1: ' . count_valid_passports($passports, false) . PHP_EOL;
echo 'Part 2: ' . count_valid_passports($passports, true) . PHP_EOL;

printExecutionInfo($startTime);
