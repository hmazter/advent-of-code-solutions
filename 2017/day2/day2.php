<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$rows = readRows('input.txt');
$part1 = 0;
$part2 = 0;
foreach ($rows as $row) {
    $input = explode("\t", $row);
    $part1 += rowDiff($input);
    $part2 += rowEvenlyDivisible($input);
}

echo "part1: $part1\n";
echo "part1: $part2\n";