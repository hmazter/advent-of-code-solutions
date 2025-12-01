<?php
declare(strict_types=1);

function part1(int $start_position, array $input): int
{
    $position = $start_position;
    $zero_count = 0;

    foreach ($input as $value) {
        $position = calculate_rotation($position, $value);
        if ($position === 0) {
            $zero_count++;
        }
    }

    return $zero_count;
}

function part2(int $start_position, array $rows): int
{
    $position = $start_position;
    $zero_count = 0;

    foreach ($rows as $row) {
        preg_match('/([LR])(\d*)/', $row, $matches);
        $direction = $matches[1];
        for ($i = 0; $i < abs((int) $matches[2]); $i++) {
            // move one tick Left (-1) or Right (+1)
            $position += $direction === 'L' ? -1 : 1;

            // wrap around from 0 to 99 and vice verse
            if ($position < 0) {
                $position = 99;
            } elseif ($position > 99) {
                $position = 0;
            }

            // Did this tick land on 0?
            if ($position === 0) {
                $zero_count++;
            }
        }
    }

    return $zero_count;
}


function parse_row(string $input): int
{
    preg_match('/([LR])(\d*)/', $input, $matches);
    if ($matches[1] === 'R') {
        return (int) $matches[2];
    }

    return (int) $matches[2] * -1;
}

function calculate_rotation(int $position, string $input): int
{
    $tmp = $position + parse_row($input);
    if ($tmp < 0) {
        $tmp += 100;
    }
    return ($tmp) % 100;
}