<?php

$input = '1113222113';

// examples
//$input = '1';
//$input = '11';
//$input = '21';
//$input = '1211';
//$input = '111221';

$loopTimes = 50;
for ($i = 0; $i < $loopTimes; $i++) {
    $chars = str_split($input);
    $output = [];
    $index = 0;
    $previous = null;
    $count = 0;

    foreach ($chars as $char) {
        if ($previous != $char) {
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