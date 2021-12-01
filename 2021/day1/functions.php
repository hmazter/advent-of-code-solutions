<?php
declare(strict_types=1);


function count_number_of_depth_increases(array $items): int
{
    $increases = 0;
    for ($i = 1; $i < count($items); $i++) {
        if ($items[$i] > $items[$i - 1]) {
            $increases++;
        }
    }
    return $increases;
}

function count_number_of_depth_increases_sliding_window(array $items): int
{
    $increases = 0;
    for ($i = 3; $i < count($items); $i++) {
        $current = $items[$i] + $items[$i - 1] + $items[$i - 2];
        $previous = $items[$i - 1] + $items[$i - 2] + $items[$i - 3];
        if ($current > $previous) {
            $increases++;
        }
    }
    return $increases;
}