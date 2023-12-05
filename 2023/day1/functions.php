<?php
declare(strict_types=1);

use Illuminate\Support\Arr;

function part1(array $input): int
{
    return collect($input)
        ->map(fn ($line) => get_calibration_value($line, include_spelled_out: false))
        ->sum();
}

function part2(array $input): int
{
    return collect($input)
        ->map(fn ($line) => get_calibration_value($line, include_spelled_out: true))
        ->sum();
}

function get_calibration_value(string $line, bool $include_spelled_out): int
{
    $map = [
        1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9,
        'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9
    ];

    $digits = implode('|', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    if ($include_spelled_out) {
        $digits .= '|' . implode('|', ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']);
    }
    preg_match_all("/(?=($digits))/", $line, $matches);

    $digits = $matches[1];
    $first_digit = $map[$digits[0]];
    $second_digit = $map[Arr::last($digits)];

    return (int)"{$first_digit}{$second_digit}";
}
