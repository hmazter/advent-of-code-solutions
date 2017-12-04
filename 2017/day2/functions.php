<?php
declare(strict_types=1);

function rowDiff(array $input)
{
    return max($input) - min($input);
}

function rowEvenlyDivisible(array $input)
{
    foreach ($input as $index1 => $val1) {
        foreach ($input as $index2 => $val2) {
            if ($index1 === $index2) {
                // don't divide with itself
                continue;
            }

            if ($val1 % $val2 === 0) {
                return $val1 / $val2;
            }
        }
    }

    throw new \RuntimeException('no dividable found');
}