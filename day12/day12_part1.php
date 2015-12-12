<?php

$json = file_get_contents(dirname(__FILE__) . '/input.txt');
$data = json_decode($json, true);

$sum = 0;
array_walk_recursive($data, function ($in) {
    global $sum;
    $sum += (int)$in;
});

echo "sum: $sum\n";