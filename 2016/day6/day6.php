<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
//$file = __DIR__ . '/example.txt';
$rows = file($file);

$chars = [];
$part1message = '';
$part2message = '';

// add all character to an array for that message position
foreach ($rows as $row) {
    $row = trim($row);
    $length = strlen($row);
    for ($i = 0; $i < $length; $i++) {
        $chars[$i][] = $row[$i];
    }
}

foreach ($chars as $char) {
    // get character frequency
    $charFreq = array_count_values($char);

    // sort desc to get the most common char
    arsort($charFreq);
    $part1message .= array_keys($charFreq)[0];

    // sort asc to get the least common char
    asort($charFreq);
    $part2message .= array_keys($charFreq)[0];
}

echo 'Part1: ' . $part1message . PHP_EOL;
echo 'Part2: ' . $part2message . PHP_EOL;

