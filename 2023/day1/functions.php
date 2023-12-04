<?php
declare(strict_types=1);

use Illuminate\Support\Arr;

function part1(array $input): int
{
    return array_sum(array_map('get_calibration_value', $input));
}

function part2(array $input): int
{
    return array_sum(array_map('get_calibration_value_spelled_out', $input));
}

function get_calibration_value(string $line): int
{
    return get_calibration_value_spelled_out($line, false);
}

function get_calibration_value_spelled_out(string $line, bool $include_spelled_out = true): int
{
    if ($include_spelled_out) {
        $digits = implode('|', [1, 2, 3, 4, 5, 6, 7, 8, 9, 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']);
    } else {
        $digits = implode('|', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    $map = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];
    preg_match_all("/(?=($digits))/", $line, $matches);

    $digits = $matches[1];
    $first_digit = $digits[0];
    $second_digit = Arr::last($digits);

    $first_digit = $map[$first_digit] ?? $first_digit;
    $second_digit = $map[$second_digit] ?? $second_digit;

    return (int)"{$first_digit}{$second_digit}";
}
