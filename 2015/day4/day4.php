<?php

// the desired length of zeroes
$length = 6; // 5
$target = str_repeat('0', $length);

// the input string
$input = 'iwrupvqb';

// iterator
$number = 1;

// compare first 'length' characters of md5 hash to target
while (substr(md5($input.$number), 0, $length) !== $target) {
    // increase the number to test
    $number++;
}

echo "hash: ".md5($input.$number)."\n";
echo "number: $number\n";