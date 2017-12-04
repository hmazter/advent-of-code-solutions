<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);

$paperProperty = [
    'children' => 3,
    'cats' => '> 7',
    'samoyeds' => 2,
    'pomeranians' => '< 3',
    'akitas' => 0,
    'vizslas' => 0,
    'goldfish' => '< 5',
    'trees' => '> 3',
    'cars' => 2,
    'perfumes' => 1,
];

$sues = [];
foreach ($lines as $line) {
    preg_match(
        '/Sue (\d+): (.*)/',
        $line,
        $match
    );

    $sue = $match[1];
    $properties = explode(', ', $match[2]);
    foreach ($properties as $property) {
        list($property, $amount) = explode(': ', $property);
        $sues[$sue][$property] = $amount;
    }
}

foreach ($sues as $id => $sue) {
    $intersect = array_intersect_assoc_range($paperProperty, $sue);
    if (count($intersect) === count($sue)) {
        echo "sue number $id\n";
        break;
    }
}

function array_intersect_assoc_range($fullArray, $subset)
{
    $intersect = [];
    foreach ($subset as $property => $amount) {
        $paperAmount = $fullArray[$property];

        $comparison = '==';
        if (strpos($paperAmount, ' ') !== false) {
            list($comparison, $paperAmount) = explode(' ', $paperAmount);
        }

        if ($comparison == '<' && $amount < $paperAmount) {
            $intersect[$property] = $amount;
        } elseif ($comparison == '>' && $amount > $paperAmount) {
            $intersect[$property] = $amount;
        } elseif ($comparison == '==' && $amount == $paperAmount) {
            $intersect[$property] = $amount;
        }
    }
    return $intersect;
}
