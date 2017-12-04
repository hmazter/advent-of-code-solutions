<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

$instructions = file(__DIR__ . '/input.txt');
$screen = createScreen(50, 6);

foreach ($instructions as $instruction) {
    if (preg_match('/rect (\d*)x(\d*)/', $instruction, $match)) {
        turnOn($screen, (int)$match[1], (int)$match[2]);
    } elseif (preg_match('/rotate column x=(\d*) by (\d*)/', $instruction, $match)) {
        rotateColumn($screen, (int)$match[1], (int)$match[2]);
    } elseif (preg_match('/rotate row y=(\d*) by (\d*)/', $instruction, $match)) {
        rotateRow($screen, (int)$match[1], (int)$match[2]);
    }
}

printScreen($screen);
echo 'number of lit pixels : ' . countLitPixels($screen) . PHP_EOL;
