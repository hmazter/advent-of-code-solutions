<?php
declare(strict_types=1);

const MARKER_PACKET = 4;
const MARKER_MESSAGE = 14;

function find_start_marker(string $input, int $marker_length): int
{
    $strlen = strlen($input) - $marker_length;
    for ($i = 0; $i < $strlen; $i++) {
        $substring = substr($input, $i, $marker_length);
        $unique_values_count = count(array_unique(str_split($substring)));

        if ($unique_values_count === $marker_length) {
            // $i is zero based, we are looking for the 1-based position => +1
            return $i + $marker_length;
        }
    }

    throw new InvalidArgumentException('No marker found');
}