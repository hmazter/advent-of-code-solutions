<?php

$file = __DIR__ . '/input.txt';
$input = file_get_contents($file);
$input = str_split($input);

$floor = 0;
$basementChar = null;
$index = 0;
foreach ($input as $char) {
    $index++;
    if ($char == '(') {
        $floor++;
    } else {
        if ($char == ')') {
            $floor--;
        }
    }

    if ($floor < 0 && $basementChar == null) {
        $basementChar = $index;
    }
}

echo 'End floor: ' . $floor . "\n";
echo "Basement on $basementChar\n";