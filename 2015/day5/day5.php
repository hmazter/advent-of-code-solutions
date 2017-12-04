<?php

$file = __DIR__ . '/input.txt';
$lines = file($file);

$vowels = ['a', 'e', 'i', 'o', 'u'];
$disallowedChars = ['ab', 'cd', 'pq', 'xy'];
$wordCount = 0;

foreach ($lines as $word) {
    // count vowels
    $vowelCount = 0;
    $chars = str_split($word);
    foreach ($chars as $char) {
        if (in_array($char, $vowels)) {
            $vowelCount++;
        }
    }

    // contains a disallowed string
    $disallowed = false;
    foreach ($disallowedChars as $disallowedChar) {
        if (strpos($word, $disallowedChar) !== false) {
            $disallowed = true;
            break;
        }
    }

    // contains 2 repeating chars
    $repeating = (preg_match('/(\w)\1{1,}/', $word)) > 0;

    if ($vowelCount >= 3 && !$disallowed && $repeating) {
        $wordCount++;
    }
}

echo "$wordCount\n";
