<?php
declare(strict_types=1);

function calculate_cost_for_prize(array $button_a, array $button_b, array $prize): int
{
    $lowest_cost = PHP_INT_MAX;

    for ($a = 0; $a <= 100; $a++) {
        for ($b = 0; $b <= 100; $b++) {
            $position_x = $button_a[0] * $a + $button_b[0] * $b;
            $position_y = $button_a[1] * $a + $button_b[1] * $b;
            $cost = $a * 3 + $b * 1;

            if ($cost < $lowest_cost && $position_x === $prize[0] && $position_y === $prize[1]) {
                $lowest_cost = $cost;
            }
        }
    }

    return $lowest_cost === PHP_INT_MAX ? 0 : $lowest_cost;
}

function part1(array $rows): int
{
    $sum = 0;

    foreach (array_chunk($rows, 3) as $chunk) {
        preg_match('/Button A: X\+(\d+), Y\+(\d+) Button B: X\+(\d+), Y\+(\d+) Prize: X=(\d+), Y=(\d+)/', implode(' ', $chunk), $matches);
        $button_a = [(int)$matches[1], (int)$matches[2]];
        $button_b = [(int)$matches[3], (int)$matches[4]];
        $prize = [(int)$matches[5], (int)$matches[6]];

        $cost = calculate_cost_for_prize($button_a, $button_b, $prize);

        dump("A: $matches[1],$matches[2] B: $matches[3],$matches[4] Prize:$matches[5],$matches[6] = $cost");

        $sum += $cost;
    }

    return $sum;
}