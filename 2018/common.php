<?php
declare(strict_types=1);

/**
 * Read a file and return each row as an array, skipping empty lines and trimming new lines
 *
 * @param string $filename
 * @return array|bool
 */
function readRows(string $filename): array
{
    return file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

/**
 * Read a file and return the while content as a string
 *
 * @param string $filename
 * @return string
 */
function readFileContent(string $filename): string
{
    return trim(file_get_contents($filename));
}

/**
 * Cast each element in an array to int
 *
 * @param array|int[] $array
 * @return array
 */
function toIntArray(array $array): array
{
    return array_map(function (string $value): int {
        return (int)$value;
    }, $array);
}
