<?php
declare(strict_types=1);

function part1(array $input): int
{
    return collect($input)
        ->filter(is_fully_contained(...))
        ->count();
}

function part2(array $input): int
{
    return collect($input)
        ->filter(is_overlapping(...))
        ->count();
}

function is_fully_contained(string $input): bool
{
    [$elf1_start, $elf1_end, $elf2_start, $elf2_end] = parse_input($input);

    $elf1_is_contained = $elf2_start <= $elf1_start && $elf1_end <= $elf2_end;
    $elf2_is_contained = $elf1_start <= $elf2_start && $elf2_end <= $elf1_end;

    return $elf1_is_contained || $elf2_is_contained;
}

function is_overlapping(string $input): bool
{
    [$elf1_start, $elf1_end, $elf2_start, $elf2_end] = parse_input($input);

    return ($elf1_start <= $elf2_end && $elf2_start <= $elf1_end);
}

/** @return int[] */
function parse_input(string $input): array
{
    preg_match('/(\d+)-(\d+),(\d+)-(\d+)/', $input, $match);
    [, $elf1_start, $elf1_end, $elf2_start, $elf2_end] = $match;

    return [(int)$elf1_start, (int)$elf1_end, (int)$elf2_start, (int)$elf2_end];
}