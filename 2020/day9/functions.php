<?php
declare(strict_types=1);

function find_invalid_number(array $input, int $preamble_length): int
{
    $size = count($input);
    for ($i = $preamble_length; $i < $size; $i++) {
        $preamble = array_slice($input, $i - $preamble_length, $preamble_length);
        $number = $input[$i];
        if (is_valid($number, $preamble) === false) {
            return $number;
        }
    }

    throw new RuntimeException('Did not find any invalid number');
}

function find_sum_of_min_and_max_in_a_contiguous_set(array $input, int $preamble_length): int
{
    $invalid_number = find_invalid_number($input, $preamble_length);
    $size = count($input);

    foreach ($input as $i => $value) {
        $set = [$value];
        for ($j = $i + 1; $j < $size; $j++) {
            $set[] = $input[$j];

            $sum = array_sum($set);
            if ($sum > $invalid_number) {
                // the sum has exceeded the invalid number, move on to the next set
                break;
            }
            if ($sum === $invalid_number) {
                // we have found a sum that matches the invalid number,
                // return the sum of min and max of the set
                return min($set) + max($set);
            }
        }
    }

    throw new RuntimeException('Did not find any contiguous set that sums to the invalid number');
}

function is_valid(int $number, array $preamble): bool
{
    foreach ($preamble as $i => $iValue) {
        foreach ($preamble as $j => $jValue) {
            if ($i !== $j && ($iValue + $jValue === $number)) {
                return true;
            }
        }
    }

    return false;
}