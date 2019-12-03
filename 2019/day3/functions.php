<?php
declare(strict_types=1);

function solve(array $path1, array $path2): array
{
    $w1 = get_wire_path_points($path1);
    $w2 = get_wire_path_points($path2);

    $manhattan_distance = PHP_INT_MAX;
    $wire_distance = PHP_INT_MAX;
    foreach ($w1 as $position => $steps) {
        if (isset($w2[$position])) {
            // wire distance
            $dist = $steps + $w2[$position];
            if ($dist < $wire_distance) {
                $wire_distance = $dist;
            }

            //manhattan distance
            [$x, $y] = explode(',', $position);
            $dist = abs($x) + abs($y);
            if ($dist < $manhattan_distance) {
                $manhattan_distance = $dist;
            }
        }
    }

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