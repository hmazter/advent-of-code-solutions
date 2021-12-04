<?php
declare(strict_types=1);

use Illuminate\Support\Collection;

function solve_part1(array $input): int
{
    $count = count_bits($input);

    $gamma = $count
        ->map(fn($position) => array_key_first($position))
        ->join('');

    $epsilon = $count
        ->map(fn($position) => array_key_last($position))
        ->join('');

    return bindec($gamma) * bindec($epsilon);
}

function solve_part2(array $input): int
{
    return get_oxygen_generator_rating($input) * get_cO2_scrubber_rating($input);
}

function get_oxygen_generator_rating(array $input): int
{
    $len = strlen($input[0]);
    $lines = collect($input);

    for ($i = 0; $i < $len; $i++) {
        [$ones, $zeroes] = count_ones_and_zeroes($lines, $i);

        // which is most common in position $i
        $most_common = $ones >= $zeroes ? 1 : 0;

        $lines = $lines->filter(fn($line) => (int)$line[$i] === $most_common);

        if ($lines->count() === 1) {
            break;
        }
    }

    return bindec($lines->first());
}

function get_cO2_scrubber_rating(array $input): int
{
    $len = strlen($input[0]);
    $lines = collect($input);

    for ($i = 0; $i < $len; $i++) {
        [$ones, $zeroes] = count_ones_and_zeroes($lines, $i);

        // which is the least common in position $i
        $least_common = $ones < $zeroes ? 1 : 0;

        $lines = $lines->filter(fn($line) => (int)$line[$i] === $least_common);

        if ($lines->count() === 1) {
            break;
        }
    }

    return bindec($lines->first());
}

function count_ones_and_zeroes(Collection $lines, int $position): array
{
    $ones = 0;
    $zeroes = 0;

    foreach ($lines as $line) {
        if ((int)$line[$position] === 0) {
            $zeroes++;
        } else {
            $ones++;
        }
    }

    return [$ones, $zeroes];
}

function count_bits(array $input): Collection
{
    $input = array_map('str_split', $input);
    $input = transpose($input);

    return collect($input)
        ->map(fn($array) => array_count_values($array))
        ->map(function ($array) {
            arsort($array);
            return $array;
        });
}