<?php
declare(strict_types=1);

function part1(array $input): int
{
    $diff = get_difference_distribution($input);
    return $diff[1] * $diff[3];
}

function get_difference_distribution(array $input): array
{
    $differences = [];
    asort($input);

    array_unshift($input, 0); //add the start joltage of 0
    for ($i = 1; $i < count($input); $i++) {
        $differences[] = $input[$i] - $input[$i - 1];
    }

    $distribution = array_count_values($differences);
    $distribution[3]++; // add the diff of 3 to the adapter joltage
    return $distribution;
}