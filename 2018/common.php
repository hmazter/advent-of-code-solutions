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

/**
 * @param float $startTime
 */
function printExecutionInfo(float $startTime): void
{
    $memory = formatBytes(memory_get_usage());
    $peak = formatBytes(memory_get_peak_usage());
    $duration = microtime(true) - $startTime;
    $duration = number_format($duration, 4);

    echo PHP_EOL;
    echo "Using $memory memory, peaked at $peak and took $duration seconds to execute" . PHP_EOL;
}

/**
 * @see https://stackoverflow.com/a/2510459/779652
 * @param $bytes
 * @param int $precision
 * @return string
 */
function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}