<?php
declare(strict_types=1);

require_once '../common.php';
require_once './functions.php';

$rows = readRows('input.txt');
$part1 = 0;

foreach ($rows as $row) {
    $words = explode(' ', $row);
    $part1 += isValidPassPhrasePart1($words) ? 1 : 0;
}

echo "part1: $part1\n";
