<?php
declare(strict_types=1);

function product_of_two_entries_that_sum_to_2020(array $items)
{
    foreach ($items as $i) {
        foreach ($items as $j) {
            if ($i + $j === 2020) {
                return $i * $j;
            }
        }
    }

    throw new RuntimeException('No matching entries found');
}

function product_of_three_entries_that_sum_to_2020(array $items)
{
    foreach ($items as $i) {
        foreach ($items as $j) {
            foreach ($items as $k) {
                if ($i + $j + $k === 2020) {
                    return $i * $j * $k;
                }
            }
        }
    }

    throw new RuntimeException('No matching entries found');
}