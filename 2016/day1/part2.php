<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
$input = file_get_contents($file);
$steps = explode(', ', $input);

// example => 4
//$steps = ['R8', 'R4', 'R4', 'R8'];

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
$path = ['0,0'];

foreach ($steps as $step) {
    $turnDirection = $step[0];
    $length = substr($step, 1);

    $currentDirection = $directionChange[$turnDirection]($currentDirection);
    foreach (range(1, $length) as $i) {
        $pos['x'] += $movement[$currentDirection]['x'];
        $pos['y'] += $movement[$currentDirection]['y'];

        $key = $pos['x'] . ',' . $pos['y'];
        if (in_array($key, $path, true)) {
            echo sprintf("distance to first crossing (%s): %d\n", $key, abs($pos['x']) + abs($pos['y']));
            exit;
        }
        $path[] = $key;
    }
}
