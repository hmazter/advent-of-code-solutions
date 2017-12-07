<?php
declare(strict_types=1);

require_once './functions.php';

$input = 347991;

$distance = distanceFromCenter($input);
$nextNumber = nextNumberAfterInput($input);

echo "part1 $distance\n";
echo "part2 $nextNumber\n";
