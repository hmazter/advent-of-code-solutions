<?php
declare(strict_types=1);

function countCharactersInString(string $string)
{
    return array_count_values(str_split($string));
}

function hasCharacterOccurExactlyTwice(string $string)
{
    return in_array(2, countCharactersInString($string));
}

function hasCharacterOccurExactlyThreeTimes(string $string)
{
    return in_array(3, countCharactersInString($string));
}

function checksum(array $rows): int
{
    $two = 0;
    $three = 0;
    foreach ($rows as $row) {
        if (hasCharacterOccurExactlyTwice($row)) {
            $two++;
        }
        if (hasCharacterOccurExactlyThreeTimes($row)) {
            $three++;
        }
    }

    return $two * $three;
}

function findTwoMostSimilarStringsInAArray(array $words)
{
    $mostSimilarWords = [];
    $shortestDistance = PHP_INT_MAX;

    $numWords = count($words);

    for ($i = 0; $i < $numWords; $i++) {
        $word1 = $words[$i];
        for ($j = $i + 1; $j < $numWords; $j++) {
            $word2 = $words[$j];

            $distance = levenshtein($word1, $word2);
            if ($distance < $shortestDistance) {
                $mostSimilarWords = [$word1, $word2];
                $shortestDistance = $distance;
            }
        }
    }

    return $mostSimilarWords;
}

function findEqualCharactersInTwoWords(string $word1, string $word2)
{
    $wordLength = strlen($word1);

    $result = '';
    for ($i = 0; $i < $wordLength; $i++) {
        if ($word1[$i] === $word2[$i]) {
            $result .= $word1[$i];
        }
    }

    return $result;
}

function findEqualCharactersInMostSimilarWords(array $input): string
{
    list($word1, $word2) = findTwoMostSimilarStringsInAArray($input);
    return findEqualCharactersInTwoWords($word1, $word2);
}