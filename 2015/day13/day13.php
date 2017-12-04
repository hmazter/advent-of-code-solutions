<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$pattern = '/(.*) would (.*) (\d+).* (.*)\./';
$happiness = [];
$persons = [];

foreach ($lines as $line) {
    preg_match($pattern, $line, $match);
    list(, $a, $sign, $points, $b) = $match;

    if ($sign == 'lose') {
        $points = $points * -1;
    }

    $persons[$a] = true;
    $happiness[$a][$b] = (int)$points;

    // part 2
    $happiness[$a]['me'] = 0;
    $happiness['me'][$a] = 0;
}

// part 2
$persons['me'] = true;

$permutations = [];
pc_permute(array_keys($persons));

$bestScore = 0;
foreach ($permutations as $permutation) {
    $current = 0;
    for ($i = 0; $i < count($permutation); $i++) {
        $size = count($permutation);
        $next = ($i + 1) % $size;

        $current += (int)$happiness[$permutation[$i]][$permutation[$next]];
        $current += (int)$happiness[$permutation[$next]][$permutation[$i]];
    }

    if ($current > $bestScore) {
        $bestScore = $current;
    }
}

echo "best happiness: $bestScore\n";


/**
 * Get all permutation of an array
 *
 * http://docstore.mik.ua/orelly/webprog/pcook/ch04_26.htm
 * @param array $items
 * @param array $perms
 */
function pc_permute($items, $perms = array())
{
    global $permutations;
    if (empty($items)) {
        $permutations[] = $perms;
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            pc_permute($newitems, $newperms);
        }
    }
}
