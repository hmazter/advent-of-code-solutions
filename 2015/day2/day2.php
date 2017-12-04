<?php

$file = __DIR__ . '/input.txt';
$lines = file($file);

$paper = 0;
$ribbon = 0;

foreach ($lines as $line) {
    list($l, $w, $h) = explode('x', trim($line));
    $box = (2 * $l * $w) + (2 * $w * $h) + (2 * $h * $l);
    $sides = [$l, $w, $h];
    sort($sides);
    $extra = $sides[0] * $sides[1];
    $paper += $box + $extra;

    $wrap = (2 * $sides[0]) + (2 * $sides[1]);
    $bow = $l * $w * $h;
    $ribbon += $wrap + $bow;
}

echo "Paper: $paper\n";
echo "Ribbon: $ribbon\n";