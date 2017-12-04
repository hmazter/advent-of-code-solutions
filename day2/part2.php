<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
$rows = file($file);

// example => 5DB3
//$rows = [
//    'ULL',
//    'RRDDD',
//    'LURDL',
//    'UUUUD',
//];

$keypad = [
    [0, 0, 1, 0, 0],
    [0, 2, 3, 4, 0],
    [5, 6, 7, 8, 9],
    [0, 'A', 'B', 'C', 0],
    [0, 0, 'D', 0, 0],
];

$validPos = [
    [false, false, true, false, false],
    [false, true, true, true, false],
    [true, true, true, true, true],
    [false, true, true, true, false],
    [false, false, true, false, false],
];

function movement($direction, $pos)
{
    switch ($direction) {
        case 'U':
            $newPos = ['row' => $pos['row'] - 1, 'col' => $pos['col']];
            break;
        case 'D':
            $newPos = ['row' => $pos['row'] + 1, 'col' => $pos['col']];
            break;
        case 'R':
            $newPos = ['row' => $pos['row'], 'col' => $pos['col'] + 1];
            break;
        case 'L':
            $newPos = ['row' => $pos['row'], 'col' => $pos['col'] - 1];
            break;
        default:
            throw new \RuntimeException('Invalid movement direction');
    }
    return isValidPosOnKeypad($newPos) ? $newPos : $pos;
}

function isValidPosOnKeypad($pos)
{
    global $validPos;

    // outside array
    if ($pos['row'] < 0 || $pos['row'] > 4) {
        return false;
    }
    if ($pos['col'] < 0 || $pos['col'] > 4) {
        return false;
    }

    // valid pos in array
    return $validPos[$pos['row']][$pos['col']];
}

$currentPos = ['row' => 2, 'col' => 0];
$code = [];

foreach ($rows as $row) {
    $steps = str_split(trim($row));
    foreach ($steps as $step) {
        $currentPos = movement($step, $currentPos);
    }
    $code[] = $keypad[$currentPos['row']][$currentPos['col']];
}

echo sprintf('Code: %s' . PHP_EOL, implode('', $code));
