<?php
require_once(dirname(__FILE__) . '/Grid.php');
require_once(dirname(__FILE__) . '/Light.php');

$lines = file(dirname(__FILE__) . '/input.txt');
/*$lines = [
    'turn on 0,0 through 2,2'
];*/

$pattern = '/(\D*)(\s*)(\d+),(\d+)(\D*)(\d+),(\d+)/';

$grid = new Grid(1000);

foreach ($lines as $line) {
    preg_match($pattern, $line, $match);
    $action = trim($match[1]);
    $lowerX = trim($match[3]);
    $lowerY = trim($match[4]);
    $topX = trim($match[6]);
    $topY = trim($match[7]);

    switch ($action) {
        case 'turn on':
            $grid->turnOn($lowerX, $lowerY, $topX, $topY);
            break;

        case 'turn off':
            $grid->turnOff($lowerX, $lowerY, $topX, $topY);
            break;

        case 'toggle':
            $grid->toggle($lowerX, $lowerY, $topX, $topY);

    }
}

echo 'Lights on: ' . $grid->count() . "\n";