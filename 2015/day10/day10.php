<?php

$input = '1113222113';
$loopTimes = 50;

for ($i = 0; $i < $loopTimes; $i++) {
    $chars = str_split($input);
    $output = [];
    $index = 0;
    $previous = null;

    foreach ($chars as $char) {
        if ($char != $previous) {
            $index++;
            $output[$index] = ['char' => $char, 'count' => 0];
        }

        $previous = $char;
        $output[$index]['count']++;
    }

    $input = '';
    foreach ($output as $char) {
        $input .= "{$char['count']}{$char['char']}";
    }
}

echo "string length: " . strlen($input) . PHP_EOL;
