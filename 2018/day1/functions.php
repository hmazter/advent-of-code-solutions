<?php
declare(strict_types=1);


function countTotal(string $changes)
{
    $changes = replaceNewlineAndComma($changes);
    return eval('return ' . $changes . ';');
}

function replaceNewlineAndComma(string $changes)
{
    return str_replace([',', ' ', "\n"], '', $changes);
}

function firstFrequencyTwice(string $input): int
{
    $input = explode("\n", $input);

    $frequencies = [0 => true];
    $frequency = 0;
    $i = 0;
    while (true) {
        $item = $input[$i % count($input)];
        $frequency += $item;

        if (isset($frequencies[$frequency])) {
            return $frequency;
        }
        $frequencies[$frequency] = true;
        $i++;
    }
}
