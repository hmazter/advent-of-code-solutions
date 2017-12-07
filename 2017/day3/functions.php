<?php
declare(strict_types=1);

/**
 * Part 1
 *
 * @param int $input
 * @return int
 */
function distanceFromCenter(int $input): int
{
    $squareSize = squareSize($input);
    $centerX = $centerY = squareCenter($squareSize);
    $result = createSquareWithIncrementalNumber($squareSize, $input);

    //drawSquare($result['square']);

    $diffX = abs($result['x'] - $centerX);
    $diffY = abs($result['y'] - $centerY);

    write("diff X $diffX\n");
    write("diff Y $diffY\n");

    return $diffX + $diffY;
}

function nextNumberAfterInput($input): int
{
    $squareSize = squareSize($input);
    return createSquareWithNeighborSum($squareSize, $input);
}

/**
 * get the needed size of the square
 * @param int $numberToInclude
 * @return int
 */
function squareSize(int $numberToInclude): int
{
    return (int)ceil(sqrt($numberToInclude));
}

function squareCenter(int $size): int
{
    return (int)floor($size / 2);
}

function createSquareWithIncrementalNumber(int $size, int $numberToReach): array
{
    $square = [];
    $x = $y = squareSize($size);

    $numberToAdd = 1;
    $stepsLeft = 0;
    $up = $right = 1;
    $down = $left = 2;
    $directions = ['right', 'up', 'left', 'down'];
    $currentDirectionIndex = 0;

    write("Adding $numberToAdd to position, $x,$y\n");
    $square[$y][$x] = $numberToAdd;

    while (true) {
        $currentDirection = $directions[$currentDirectionIndex % 4];
        $currentDirectionIndex++;
        $diffX = $diffY = 0;

        switch ($currentDirection) {
            case 'right':
                write('right' . PHP_EOL);
                $stepsLeft = $right;
                $right += 2;
                $diffX = 1;
                break;

            case 'left':
                write('left' . PHP_EOL);
                $stepsLeft = $left;
                $left += 2;
                $diffX = -1;
                break;

            case 'up':
                write('up' . PHP_EOL);
                $stepsLeft = $up;
                $up += 2;
                $diffY = 1;
                break;

            case 'down':
                write('down' . PHP_EOL);
                $stepsLeft = $down;
                $down += 2;
                $diffY = -1;
                break;
        }

        for ($i = 0; $i < $stepsLeft; $i++) {
            write('---------------------' . PHP_EOL);
            $numberToAdd++;
            if ($numberToAdd > $numberToReach) {
                break 2;
            }

            $y += $diffY;
            $x += $diffX;
            write("Adding $numberToAdd to position, $x,$y\n");

            $square[$y][$x] = $numberToAdd;
        }

        write(PHP_EOL);
        write(PHP_EOL);
    }

    return [
        'square' => $square,
        'x' => $x,
        'y' => $y,
        'nextNumber' => $numberToAdd,
    ];
}

function createSquareWithNeighborSum(int $size, int $numberToReach): int
{
    $square = [];
    $x = $y = squareSize($size);

    $numberToAdd = 1;
    $stepsLeft = 0;
    $up = $right = 1;
    $down = $left = 2;
    $directions = ['right', 'up', 'left', 'down'];
    $currentDirectionIndex = 0;

    write("Adding $numberToAdd to position, $x,$y\n");
    $square[$y][$x] = $numberToAdd;

    while (true) {
        $currentDirection = $directions[$currentDirectionIndex % 4];
        $currentDirectionIndex++;
        $diffX = $diffY = 0;

        switch ($currentDirection) {
            case 'right':
                write('right' . PHP_EOL);
                $stepsLeft = $right;
                $right += 2;
                $diffX = 1;
                break;

            case 'left':
                write('left' . PHP_EOL);
                $stepsLeft = $left;
                $left += 2;
                $diffX = -1;
                break;

            case 'up':
                write('up' . PHP_EOL);
                $stepsLeft = $up;
                $up += 2;
                $diffY = 1;
                break;

            case 'down':
                write('down' . PHP_EOL);
                $stepsLeft = $down;
                $down += 2;
                $diffY = -1;
                break;
        }

        for ($i = 0; $i < $stepsLeft; $i++) {
            write('---------------------' . PHP_EOL);
            $y += $diffY;
            $x += $diffX;
            $numberToAdd = 0;

            $numberToAdd += $square[$y - 1][$x] ?? 0;
            $numberToAdd += $square[$y - 1][$x + 1] ?? 0;
            $numberToAdd += $square[$y - 1][$x - 1] ?? 0;
            $numberToAdd += $square[$y][$x + 1] ?? 0;
            $numberToAdd += $square[$y][$x - 1] ?? 0;
            $numberToAdd += $square[$y + 1][$x] ?? 0;
            $numberToAdd += $square[$y + 1][$x - 1] ?? 0;
            $numberToAdd += $square[$y + 1][$x + 1] ?? 0;

            if ($numberToAdd > $numberToReach) {
                //drawSquare($square);
                return $numberToAdd;
            }
            write("Adding $numberToAdd to position, $x,$y\n");

            $square[$y][$x] = $numberToAdd;
        }

        write(PHP_EOL);
        write(PHP_EOL);
    }

    return 0;
}

function drawSquare($square)
{
    ksort($square);
    foreach (array_reverse($square) as $row) {
        ksort($row);
        foreach ($row as $item) {
            echo $item . ' ';
        }
        echo PHP_EOL;
    }
}

function write($text)
{
    // enable to get all debug output
    $debug = false;
    if ($debug) {
        echo $text;
    }
}
