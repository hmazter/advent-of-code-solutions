<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$input = readRows('./input.txt');

solveDay8($input, $endMax, $runningMax);

echo "part1: $endMax\n";
echo "part2: $runningMax\n";
