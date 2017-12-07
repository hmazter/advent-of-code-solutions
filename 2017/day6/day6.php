<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$input = toIntArray(explode("\t", readFileContent('./input.txt')));

$cycles = reallocateMemory($input);

echo "part1: {$cycles['total']}\n";
echo "part2: {$cycles['loop']}\n";
