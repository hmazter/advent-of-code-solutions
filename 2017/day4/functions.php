<?php
declare(strict_types=1);

function isValidPassPhrasePart1(array $words)
{
    for ($i = 0; $i < count($words); $i++) {
        for ($j = $i + 1; $j < count($words); $j++) {
            if ($words[$i] === $words[$j]) {
                return false;
            }
        }
    }

    return true;
}