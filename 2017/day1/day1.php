<?php
declare(strict_types=1);

require_once '../common.php';

$input = readFileContent(__DIR__ . '/input.txt');

echo "part1: " . solve($input) . PHP_EOL;
echo "part1: " . solvePart2($input) . PHP_EOL;

function solve($input)
{
    $sum = 0;
    $strlen = strlen($input);
    for ($i = 0; $i < $strlen; $i++) {
        $current = $input[$i];
        $next = $input[($i + 1) % $strlen];
        if ($current === $next) {
            $sum += $current;
        }
    }

    return $sum;
}

function solvePart2($input)
{
    $sum = 0;
    $strlen = strlen($input);
    for ($i = 0; $i < $strlen; $i++) {
        $current = $input[$i];
        $next = $input[($i + ($strlen / 2)) % $strlen];
        if ($current === $next) {
            $sum += $current;
        }
    }

    return $sum;
}
