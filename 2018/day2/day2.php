<?php
declare(strict_types=1);

require_once '../common.php';
require_once './day2_functions.php';

$input = readRows('input.txt');

echo 'Part 1: ' . checksum($input) . PHP_EOL;
echo 'Part 2: ' . findEqualCharactersInMostSimilarWords($input) . PHP_EOL;
