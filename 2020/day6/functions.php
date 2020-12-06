<?php
declare(strict_types=1);

/**
 * Get the "chunks" from an array, each chunk is separated by a empty line/item
 *
 * Example:
 * """
 * abc <-- chunk 1
 *     <-- empty line
 * a   <-|
 * b     |- chunk 2
 * c   <-|
 * """
 *
 * Will return:
 * [
 *   ['abc']
 *   ['a','b','c']
 * ]
 */
function get_chunks(string $input): array
{
    return array_map(fn ($chunk) => explode("\n", $chunk), explode("\n\n", $input));
}

function sum_unique_in_chunks(string $input): int
{
    $chunks = get_chunks($input);

    $count = 0;
    foreach ($chunks as $chunk) {
        $count += count(
            array_unique(
                str_split(
                    implode('', $chunk)
                )
            )
        );
    }

    return $count;
}

function sum_intersection_in_chunks(string $input): int
{
    $chunks = get_chunks($input);

    $count = 0;
    foreach ($chunks as $chunk) {
        if (count($chunk) === 1) {
            $count += strlen($chunk[0]);
        } else {
            $count += count(array_intersect(...array_map('str_split', $chunk)));
        }
    }

    return $count;

}