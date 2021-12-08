<?php
declare(strict_types=1);

use JetBrains\PhpStorm\ArrayShape;

function solve_part1(array $input): int
{
    $count = 0;
    foreach ($input as $row) {
        ['output' => $output] = parse_input_row($row);
        foreach ($output as $item) {
            if (in_array(strlen($item), [2, 3, 4, 7])) {
                $count++;
            }
        }
    }

    return $count;
}

function solve_part2(array $input): int
{
    $sum = 0;

    foreach ($input as $row) {
        ['patterns' => $patterns, 'output' => $output] = parse_input_row($row);
        $lookup = create_lookup_table($patterns);
        $number = '';
        foreach ($output as $item) {
            $number .= get_number_from_pattern($lookup, $item);
        }

        $sum += (int)$number;
    }

    return $sum;
}

#[ArrayShape(['1' => 'string', '4' => 'string', '4-1' => 'string'])]
function create_lookup_table(array $patterns): array
{
    $lookup = [];

    foreach ($patterns as $i => $pattern) {
        if (strlen($pattern) === 2) {
            $lookup[1] = $pattern;
            unset($patterns[$i]);
        } elseif (strlen($pattern) === 4) {
            $lookup[4] = $pattern;
            unset($patterns[$i]);
        }
    }

    $lookup['4-1'] = implode('', array_diff(
        str_split($lookup[4]),
        str_split($lookup[1]),
    ));

    return $lookup;
}

function get_number_from_pattern(array $lookup, string $pattern): int
{
    // the ones that can be identified by unique length
    if (strlen($pattern) === 7) return 8;
    if (strlen($pattern) === 4) return 4;
    if (strlen($pattern) === 3) return 7;
    if (strlen($pattern) === 2) return 1;

    // len 6 => 9, 6 or 0
    if (strlen($pattern) === 6) {
        if (contains($pattern, $lookup[4])) return 9;
        if (!contains($pattern, $lookup[1])) return 6;

        return 0;
    }

    // len 5 => 3, 5 or 2
    if (strlen($pattern) === 5) {
        if (contains($pattern, $lookup[1])) return 3;
        if (contains($pattern, $lookup['4-1'])) return 5;
        return 2;
    }

    throw new RuntimeException("Did not find a number for: $pattern");
}

function contains(string $haystack, string $needle): bool
{
    foreach (str_split($needle) as $char) {
        if (!str_contains($haystack, $char)) {
            return false;
        }
    }

    return true;
}

#[ArrayShape(['patterns' => 'string[]', 'output' => 'string[]'])]
function parse_input_row(string $row): array
{
    [$patterns, $output] = explode('|', $row);

    return [
        'patterns' => explode(' ', trim($patterns)),
        'output' => explode(' ', trim($output)),
    ];
}