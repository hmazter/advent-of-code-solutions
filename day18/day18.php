<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$steps = 100;

$currentGrid = [];
foreach ($lines as $line) {
    $line = str_replace('#', 1, $line);
    $line = str_replace('.', 0, $line);
    $chars = str_split($line);
    $currentGrid[] = $chars;
}

// Step 2. Force all 4 corners ON
$size = count($currentGrid[0]);
$currentGrid[0][0] = 1;
$currentGrid[0][$size - 1] = 1;
$currentGrid[$size - 1][0] = 1;
$currentGrid[$size - 1][$size - 1] = 1;

echo "initial state" . PHP_EOL;
printGrid($currentGrid);

while ($steps > 0) {
    $steps--;

    $nextGrid = $currentGrid;
    for ($i = 0; $i < count($currentGrid); $i++) {
        for ($j = 0; $j < count($currentGrid[$i]); $j++) {
            $nextGrid[$i][$j] = determineNextState($i, $j);
        }
    }
    $currentGrid = $nextGrid;
}

$totalOn = 0;
for ($i = 0; $i < count($currentGrid); $i++) {
    $totalOn += array_sum($currentGrid[$i]);
}

echo "Total lights on: " . $totalOn . PHP_EOL;


function determineNextState($i, $j)
{
    // Step 2. If checkin corners, always return ON
    global $size;
    if (($i == 0 || $i == $size - 1) && ($j == 0 || $j == $size - 1)) {
        return 1;
    }

    $currentState = getCurrentState($i, $j);

    $sum = 0;
    $sum += getCurrentState($i - 1, $j - 1);
    $sum += getCurrentState($i - 1, $j);
    $sum += getCurrentState($i - 1, $j + 1);
    $sum += getCurrentState($i, $j + 1);
    $sum += getCurrentState($i, $j - 1);
    $sum += getCurrentState($i + 1, $j - 1);
    $sum += getCurrentState($i + 1, $j);
    $sum += getCurrentState($i + 1, $j + 1);

    // is ON and has 2 or 3 ON neighbors
    if ($currentState == 1 && ($sum == 2 || $sum == 3)) {
        return 1;
    }

    // is OFF and has 3 ON neighbors
    if ($currentState == 0 && $sum == 3) {
        return 1;
    }

    return 0;
}

function getCurrentState($i, $j)
{
    global $currentGrid;
    if (isset($currentGrid[$i][$j])) {
        return $currentGrid[$i][$j];
    }

    // All out of bounds is considered OFF
    return 0;
}

/**
 * Extra!
 * Just for pretty output of grid
 *
 * @param $grid
 */
function printGrid($grid)
{
    for ($i = 0; $i < count($grid); $i++) {
        for ($j = 0; $j < count($grid[$i]); $j++) {
            if ($grid[$i][$j] == 0) {
                echo '.';
            } else {
                echo '#';
            }
        }
        echo PHP_EOL;
    }
}
