<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$instructions = toIntArray(readRows('./input.txt'));

echo "part1: " . solveDay5($instructions, false) . PHP_EOL;
echo "part2: " . solveDay5($instructions, true) . PHP_EOL;
