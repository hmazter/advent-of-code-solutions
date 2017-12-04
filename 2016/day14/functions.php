<?php
declare(strict_types = 1);

function solve(string $salt, bool $isPart2)
{
    $keys = [];
    $hashes = [];

    // populate hash array
    fillHashes($hashes, $salt, 0, 1000, $isPart2);

    $i = 0;
    while (count($keys) < 64) {
        if (isset($hashes[$i + 1000]) === false) {
            // append to hash array if index +1000 does not exists
            fillHashes($hashes, $salt, $i + 1000, 1, $isPart2);
        }

        $hash = $hashes[$i];
        $hashTriplet = hasTriplet($hash);
        if ($hashTriplet !== false) {
            // this hash ha a triplet, check the upcoming 1000 hashes if a matching "five" is found
            for ($j = $i + 1; $j < $i + 1000; $j++) {
                if (hasFive($hashes[$j], $hashTriplet)) {
                    $keys[] = $i;
                    break;
                }
            }
        }

        $i++;
    }

    return $keys[63];
}

/**
 * @param string $hash
 * @return string|bool
 */
function hasTriplet(string $hash)
{
    if (preg_match('/(.)\1{2}/', $hash, $match) > 0) {
        return $match[1];
    }
    return false;
}

function hasFive(string $hash, string $char)
{
    return preg_match('/' . $char . '{5}/', $hash) > 0;
}

function fillHashes(&$hashes, string $salt, int $from, int $count, bool $useStretching = false)
{
    for ($i = $from; $i < $from + $count; $i++) {
        $hashes[$i] = $useStretching ? hashTimes($salt . $i, 2016) : md5($salt . $i);
    }
}

function hashTimes(string $text, int $times)
{
    $hash = md5($text);
    for ($i = 0; $i < $times; $i++) {
        $hash = md5($hash);
    }
    return $hash;
}
