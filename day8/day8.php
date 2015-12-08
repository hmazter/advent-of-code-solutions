<?php

$lines = file(dirname(__FILE__) . '/input.txt');

$part1sum = 0;
$part2sum = 0;

foreach ($lines as $line) {
    $line = trim($line);
    $codeLength = strlen($line);

    $unescaped = substr($line, 1, strlen($line)-2);
    $unescaped = stripcslashes($unescaped);
    $unescapedLength = strlen($unescaped);

    $escaped = addslashes($line);
    $escapedLength = strlen($escaped) + 2;

    $part1sum+= ($codeLength - $unescapedLength);
    $part2sum+= ($escapedLength - $codeLength);
}

echo "Part 1: $part1sum\n";
echo "Part 2: $part2sum\n";