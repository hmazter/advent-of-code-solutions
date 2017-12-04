<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
$rows = file($file);

// example => 1985
//$rows = [
//    'ULL',
//    'RRDDD',
//    'LURDL',
//    'UUUUD',
//];

$keypad = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];

function movement($direction, $pos)
{
    switch ($direction) {
        case 'U':
            return ['row' => max($pos['row'] - 1, 0), 'col' => $pos['col']];
        case 'D':
            return ['row' => min($pos['row'] + 1, 2), 'col' => $pos['col']];
        case 'R':
            return ['row' => $pos['row'], 'col' => min($pos['col'] + 1, 2)];
        case 'L':
            return ['row' => $pos['row'], 'col' => max($pos['col'] - 1, 0)];
    }
}

$currentPos = ['row' => 1, 'col' => 1];
$code = [];

foreach ($rows as $row) {
    $steps = str_split(trim($row));
    foreach ($steps as $step) {
        $currentPos = movement($step, $currentPos);
    }
    $code[] = $keypad[$currentPos['row']][$currentPos['col']];
}


echo sprintf('Code: %s' . PHP_EOL, implode('', $code));
