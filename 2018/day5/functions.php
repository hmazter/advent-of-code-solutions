<?php
declare(strict_types=1);

require_once __DIR__ . '/../common.php';

function reactPolymers(string $polymer): string
{
    $i = 0;
    while (true) {
        // if the string is empty => abort
        if (strlen($polymer) === 0) {
            break;
        }

        // if we have reached the end of the string => abort
        if ($i + 1 === strlen($polymer)) {
            break;
        }

        // calculate the ascii diff between current and next letter
        $diff = abs(ord($polymer[$i]) - ord($polymer[$i + 1]));

        // its 32 ascii chars between a lowercase and a uppercase letter
        if ($diff === 32) {
            // remove those 2 chars from the string
            $polymer[$i] = ' ';
            $polymer[$i + 1] = ' ';
            $polymer = str_replace(' ', '', $polymer);

            // reset $i
            $i = 0;
        } else {
            // otherwise step one step forward
            $i++;
        }
    }

    return $polymer;
}

function removeAndReact($polymer): int
{
    $shortest = null;

    foreach (range('a', 'z') as $char) {
        $p = str_replace([$char, strtoupper($char)], '', $polymer);
        $length = strlen(reactPolymers($p));
        if ($shortest === null || $length < $shortest) {
            $shortest = $length;
        }
    }

    return $shortest;
}