<?php
declare(strict_types=1);

function solve(array $path1, array $path2): array
{
    $w1 = get_wire_path_points($path1);
    $w2 = get_wire_path_points($path2);

    $intersect = array_intersect(array_keys($w1), array_keys($w2));

    $manhattan_distance = min(array_map(function ($position) {
        [$x, $y] = explode(',', $position);
        return abs($x) + abs($y);
    }, $intersect));

    $wire_distance = min(array_map(function ($position) use($w1, $w2) {
        return $w1[$position] + $w2[$position];
    }, $intersect));

    return ['wire' => $wire_distance, 'manhattan' => $manhattan_distance];
}


function get_wire_path_points(array $path): array
{
    $movementX = ['L' => -1, 'R' => 1, 'U' => 0, 'D' => 0];
    $movementY = ['L' => 0, 'R' => 0, 'U' => 1, 'D' => -1];

    $x = 0;
    $y = 0;
    $steps = 0;

    $points = [];
    foreach ($path as $item) {
        $direction = $item[0];
        $count = substr($item, 1);

        for ($i = 0; $i < $count; $i++) {
            $steps++;
            $y += $movementY[$direction];
            $x += $movementX[$direction];

            if (!isset($points["$x,$y"])) {
                $points["$x,$y"] = $steps;
            }
        }
    }

    return $points;
}