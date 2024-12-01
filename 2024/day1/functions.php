<?php
declare(strict_types=1);

function part1(array $rows) {
    [$left_list, $right_list] = parse_left_and_right_lists($rows);

    $total_distance = 0;
    foreach ($left_list as $index => $left) {
        $total_distance += abs($left - $right_list[$index]);
    }

    return $total_distance;
}

function part2(array $rows)
{
    [$left_list, $right_list] = parse_left_and_right_lists($rows);

    $right_list_count_values = array_count_values($right_list);

    $total_distance = 0;
    foreach ($left_list as $left) {
        $total_distance += $left * ($right_list_count_values[$left] ?? 0);
    }

    return $total_distance;
}

function parse_left_and_right_lists(array $rows): array
{
    $left_list = [];
    $right_list = [];

    foreach ($rows as $row) {
        preg_match('/(\d*)\s*(\d*)/', $row, $matches);
        $left_list[] = $matches[1];
        $right_list[] = $matches[2];
    }

    sort($left_list);
    sort($right_list);

    return [$left_list, $right_list];
}