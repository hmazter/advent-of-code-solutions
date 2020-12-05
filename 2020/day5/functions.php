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
    return bindec(str_replace(['F', 'L', 'B', 'R'], ['0', '0', '1', '1'], $pass));
}
