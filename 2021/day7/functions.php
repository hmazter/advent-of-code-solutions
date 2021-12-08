<?php
declare(strict_types=1);

function solve_part1(array $input): int
{
    $min_fuel = PHP_INT_MAX;

    $min_position = min($input);
    $max_position = max($input);
    foreach (range($min_position, $max_position) as $target_position) {
        $fuel = calculate_fuel_constant($input, $target_position);
        if ($fuel < $min_fuel) {
            $min_fuel = $fuel;
        }
    }

    return $min_fuel;
}

function solve_part2(array $input): int
{
    $min_fuel = PHP_INT_MAX;

    $min_position = min($input);
    $max_position = max($input);
    foreach (range($min_position, $max_position) as $target_position) {
        $fuel = calculate_fuel_increasing($input, $target_position);
        if ($fuel < $min_fuel) {
            $min_fuel = $fuel;
        }
    }

    return $min_fuel;
}

function calculate_fuel_constant(array $positions, int $target_position): int
{
    $fuel = 0;

    foreach ($positions as $position) {
        $fuel += abs($target_position - $position);
    }

    return $fuel;
}

function calculate_fuel_increasing(array $positions, int $target_position): int
{
    $fuel = 0;

    foreach ($positions as $position) {
        // https://www.easycalculation.com/formulas/sum-of-series.html
        $steps = abs($target_position - $position);
        $fuel += ($steps * ($steps + 1) / 2);
    }

    return $fuel;
}