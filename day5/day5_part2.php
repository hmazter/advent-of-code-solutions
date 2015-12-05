<?php

$file = __DIR__ . '/input.txt';
$lines = file($file);

$wordCount = 0;
foreach ($lines as $word) {
    $duplicateString = false;
    for ($i = 0; $i < strlen($word) - 1; $i++) {
        $pair = substr($word, $i, 2);
        preg_match_all("/$pair/", $word, $matches);
        // at least 2 matches of the pair
        if (count($matches[0]) > 1) {
            $duplicateString = true;
            break;
        }
    }

    $repeatWithOneSpace = false;
    for ($i = 0; $i < strlen($word) - 2; $i++) {
        $firstChar = substr($word, $i, 1);
        $thirdChar = substr($word, $i + 2, 1);
        if ($firstChar == $thirdChar) {
            $repeatWithOneSpace = true;
            break;
        }
    }

    if ($duplicateString && $repeatWithOneSpace) {
        $wordCount++;
    }
}

echo "$wordCount\n";
