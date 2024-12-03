<?php
declare(strict_types=1);

function part1(string $input): int
{
    preg_match_all('/mul\(\d+,\d+\)/', $input, $instructions);

    $sum = 0;
    foreach ($instructions[0] as $instruction) {
        $sum += solve_instruction($instruction);
    }

    return $sum;
}

function part2(string $input): int
{
    preg_match_all("/mul\(\d+,\d+\)|do\(\)|don't\(\)/", $input, $instructions);
    $mul_enabled = true;
    $sum = 0;
    foreach ($instructions[0] as $instruction) {
        if ($instruction === 'do()') {
            $mul_enabled = true;
        } elseif ($instruction === "don't()") {
            $mul_enabled = false;
        } elseif ($mul_enabled) {
            $sum += solve_instruction($instruction);
        }
    }

    return $sum;
}

function solve_instruction(string $instruction): int
{
    preg_match('/(\d*),(\d*)/', $instruction, $matches);

    return $matches[1] * $matches[2];
}