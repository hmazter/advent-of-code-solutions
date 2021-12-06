<?php
declare(strict_types=1);

function count_lanternfish(array $input, int $days): int
{
    $ages = array_fill(0, 9, 0);
    foreach ($input as $age) {
        $ages[$age]++;
    }

    for ($day = 0; $day < $days; $day++) {
        $count_to_reset = $ages[0];
        $new = array_shift($ages);
        $ages[] = $new;
        $ages[6] += $count_to_reset;
    }

    return array_sum($ages);
}