<?php
declare(strict_types=1);


function parse_input(array $input): array
{
    return collect($input)
        ->map(function ($row) {
            return str_split($row);
        })
        ->all();
}

function count_trees($map, $down, $right): int
{
    $row_count = count($map);
    $x = 0;
    $tree_count = 0;
    for ($i = $down; $i < $row_count; $i += $down) {
        $x = ($x + $right) % count($map[$i]);
        if ($map[$i][$x] === '#') {
            $tree_count++;
        }
    }

    return $tree_count;
}

function sum_paths($map): int
{
    return count_trees($map, 1, 1)
        * count_trees($map, 1, 3)
        * count_trees($map, 1, 5)
        * count_trees($map, 1, 7)
        * count_trees($map, 2, 1);
}