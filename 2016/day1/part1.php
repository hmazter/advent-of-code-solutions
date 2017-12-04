<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
$input = file_get_contents($file);
$steps = explode(', ', $input);

// example 1 => 5
//$steps = ['R2', 'L3'];
// example 2 => 2
//$steps = ['R2', 'R2', 'R2'];
// example 3 => 12
//$steps = ['R5', 'L5', 'R5', 'R3'];

$movement = [
    ['x' => 0, 'y' => 1],   // N
    ['x' => 1, 'y' => 0],   // E
    ['x' => 0, 'y' => -1],   // S
    ['x' => -1, 'y' => 0],   // W
];
$directionChange = [
    'R' => function ($x) { return ($x + 1) % 4; },
    'L' => function ($x) { return ($x + 4 - 1) % 4; },
];

$currentDirection = 0; // N
$pos = ['x' => 0,  'y' => 0];

foreach ($steps as $step) {
    $turnDirection = $step[0];
    $length = substr($step, 1);

    $currentDirection = $directionChange[$turnDirection]($currentDirection);
    $pos['x'] += $movement[$currentDirection]['x'] * $length;
    $pos['y'] += $movement[$currentDirection]['y'] * $length;
}

echo 'total distance: ' . abs($pos['x'] + $pos['y']) .PHP_EOL;

