<?php
declare(strict_types=1);

function isValidPassPhrasePart1(array $words): bool
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

function isValidPassPhrasePart2(array $words): bool
{
    for ($i = 0; $i < count($words); $i++) {
        for ($j = $i + 1; $j < count($words); $j++) {
            if (isAnagram($words[$i], $words[$j])) {
                return false;
            }
        }
    }

    return true;
}

function isAnagram(string $word1, string $word2): bool
{
    if (strlen($word1) !== strlen($word2)) {
        return false;
    }

    for ($i = 0; $i < strlen($word1); $i++) {
        $char = $word1[$i];
        if (strpos($word2, $char) === false) {
            // char from word 1 was not found in word2
            return false;
        } else {
            $word2 = preg_replace("/$char/", '', $word2, 1);
        }
    }

    return true;
}
