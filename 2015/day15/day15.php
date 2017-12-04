<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);

$properties = [];
foreach ($lines as $line) {
    preg_match(
        '/(.*): capacity ([0-9\-]*), durability ([0-9\-]*), flavor ([0-9\-]*), texture ([0-9\-]*), calories ([0-9\-]*)/',
        $line,
        $match
    );
    $properties[] = [$match[2], $match[3], $match[4], $match[5], $match[6]];
}

$max = 0;
$score = 0;
$count = 0;

for ($i = 0; $i <= 100; $i++) {
    for ($j = 0; $j <= 100 - $i; $j++) {
        for ($k = 0; $k <= 100 - $i - $j; $k++) {
            $l = 100 - $i - $j - $k;
            $count++;

            $capacity   = $properties[0][0] * $i + $properties[1][0] * $j + $properties[2][0] * $k + $properties[3][0] * $l;
            $durability = $properties[0][1] * $i + $properties[1][1] * $j + $properties[2][1] * $k + $properties[3][1] * $l;
            $flavor     = $properties[0][2] * $i + $properties[1][2] * $j + $properties[2][2] * $k + $properties[3][2] * $l;
            $texture    = $properties[0][3] * $i + $properties[1][3] * $j + $properties[2][3] * $k + $properties[3][3] * $l;

            // part 2
            $calories   = $properties[0][4] * $i + $properties[1][4] * $j + $properties[2][4] * $k + $properties[3][4] * $l;

            if ($capacity <= 0 || $durability <= 0 || $flavor <= 0 || $texture <= 0) {
                continue;
            }

            // part 2
            if ($calories != 500) {
                continue;
            }

            $score = $capacity * $durability * $flavor * $texture;
            if ($score > $max) {
                $max = $score;
            }
        }
    }
}

echo "Max score: " . $max . PHP_EOL;
echo "iterations: " . $count . PHP_EOL;