<?php
declare(strict_types=1);

function part1(string $input): int
{
    $ranges = explode(',', $input);
    $total = 0;
    foreach ($ranges as $range) {
        foreach (range(...explode('-', $range)) as $value) {
            $len = strlen((string) $value);
            if ($len % 2 === 0) {
                [$first, $second] = str_split((string) $value, $len / 2);
                if ($first === $second) {
                    $total += $value;
                }
            }
        }
    }

    return $total;
}

function part2(string $input): int
{
    $ranges = explode(',', $input);
    $total = 0;
    foreach ($ranges as $range) {
        foreach (range(...explode('-', $range)) as $value) {
            $value_len = strlen((string) $value);
            for ($i = 1; $i < $value_len; $i++) {
                $parts = str_split((string) $value, $i);
                $part_count = count($parts);
                $is_all_parts_equal = count(array_unique($parts)) === 1;
                if ($part_count > 1 && $is_all_parts_equal) {
                    $total += $value;

                    // the same value can not be an invalid ID in multiple ways, so we can continue to next value
                    continue 2;
                }
            }
        }
    }

    return $total;
}