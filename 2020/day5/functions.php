<?php
declare(strict_types=1);

function find_max_seat_id(array $input)
{
    return max(array_map('pass_to_binary', $input));
}

function find_empty_seat(array $input): int
{
    $occupied_seat_ids = array_map('pass_to_binary', $input);
    $min = min($occupied_seat_ids);
    $max = max($occupied_seat_ids);
    $all_seat_id = range($min, $max);

    return head(array_diff($all_seat_id, $occupied_seat_ids));
}

function pass_to_binary(string $pass): int
{
    $pass = str_replace(['F', 'L', 'B', 'R'], ['0', '0', '1', '1'], $pass);
    return bindec($pass);
}

/*
 *  Below methods is not used any more, was part of my first attempt to find the seat id based on calculations
 */

function get_seat_id(string $pass): int
{
    return get_row($pass) * 8 + get_column($pass);
}

function get_row(string $pass): int
{
    $chars = str_split($pass);
    $chars = array_slice($chars, 0, 7);
    $lower = 0;
    $upper = 127;
    foreach ($chars as $char) {
        if ($char === 'F') {
            $upper -= (($upper - $lower + 1) / 2);
        }
        if ($char === 'B') {
            $lower += (($upper - $lower + 1) / 2);
        }
    }

    if ($lower !== $upper) {
        throw new RuntimeException('not equal');
    }

    return $lower;
}

function get_column(string $pass): int
{
    $chars = str_split($pass);
    $chars = array_slice($chars, 7, 3);
    $lower = 0;
    $upper = 7;
    foreach ($chars as $char) {
        if ($char === 'L') {
            $upper -= (($upper - $lower + 1) / 2);
        }
        if ($char === 'R') {
            $lower += (($upper - $lower + 1) / 2);
        }
    }

    if ($lower !== $upper) {
        throw new RuntimeException('not equal');
    }

    return $lower;
}