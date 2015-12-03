<?php

$file = __DIR__ . '/input.txt';
$chars = str_split(file_get_contents($file));

var_dump($chars);

$x = 0;
$y = 0;
$positions = [
    "$x:$y" => 1
];

foreach ($chars as $char) {
    switch ($char) {
        case '^':
            $y++;
            break;
        case 'v':
            $y--;
            break;
        case '>':
            $x++;
            break;
        case '<':
            $x--;
            break;
    }

    $positions["$x:$y"] = 1;
}

echo "Houses: " . count($positions) . "\n";