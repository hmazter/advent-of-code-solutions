<?php
declare(strict_types=1);

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
    preg_match('/^[a-z]*(\d)/', $line, $matches);
    $first_digit = $matches[1];

    preg_match('/.*(\d)[a-z]*$/', $line, $matches);
    $second_digit = $matches[1];

    return (int)"{$first_digit}{$second_digit}";
}

function get_calibration_value_spelled_out(string $line): int
{
    $first_digit = null;
    $first_index = PHP_INT_MAX;
    $second_digit = null;
    $last_index = -1;

    $digits = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    $map = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9];
    foreach ($digits as $digit) {
        $new_first_index = strpos($line, (string)$digit);
        $new_last_index = strrpos($line, (string)$digit);

        if ($new_first_index !== false && $new_first_index < $first_index) {
            $first_digit = $map[$digit] ?? $digit;
            $first_index = $new_first_index;
        }
        if ($new_last_index !== false && $new_last_index > $last_index) {
            $second_digit = $map[$digit] ?? $digit;
            $last_index = $new_last_index;
        }
    }

    return (int)"{$first_digit}{$second_digit}";
}
