<?php
declare(strict_types = 1);

/**
 * Pass a string trough dragon curve calculation
 *
 * @param string $input
 * @return string
 */
function dragonCurve(string $input): string
{
    $b = $input;
    $b = strrev($b);
    $length = strlen($b);
    for ($i = 0; $i < $length; $i++) {
        $b[$i] = $b[$i] === '1' ? '0' : '1';
    }
    return $input . '0' . $b;
}

/**
 * Get data generated by dragon curve of a specific length
 *
 * @param string $initial initial data
 * @param int $length the desired length
 * @return string
 */
function getData(string $initial, int $length): string
{
    $data = $initial;
    while (strlen($data) < $length) {
        $data = dragonCurve($data);
    }

    return substr($data, 0, $length);
}

/**
 * Calculate checksum of a data string
 *
 * @param string $data
 * @return string
 */
function calculateChecksum(string $data): string
{
    $checksum = '';
    while (strlen($checksum) % 2 === 0) {
        $checksum = '';
        $length = strlen($data);
        for ($i = 0; $i < $length - 1; $i += 2) {
            if ($data[$i] === $data[$i + 1]) {
                $checksum .= '1';
            } else {
                $checksum .= '0';
            }
        }
        $data = $checksum;
    }
    return $checksum;
}
