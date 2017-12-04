<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$totalAmount = 150;

$permutations = pc_array_power_set($lines);

echo "Number of permutations: " . count($permutations) . PHP_EOL;

$count = 0;

$smallestAmountContainers = null;
$smallestCount = 0;
foreach ($permutations as $permutation) {
    if (array_sum($permutation) == $totalAmount) {
        $count++;

        // part 2
        if (count($permutation) < $smallestAmountContainers || $smallestAmountContainers == null) {
            $smallestCount = 1;
            $smallestAmountContainers = count($permutation);
        } elseif (count($permutation) == $smallestAmountContainers) {
            $smallestCount++;
        }
    }
}

echo "combinations of containers that fits $totalAmount litres (part 1): $count\n";
echo "combinations of containers of minimum numbers that fits $totalAmount litres (part 2): $smallestCount\n";

/**
 * http://docstore.mik.ua/orelly/webprog/pcook/ch04_25.htm
 *
 * @param array $elements
 * @return array
 */
function pc_array_power_set($elements)
{
    // initialize by adding the empty set
    $results = array(array());

    foreach ($elements as $element) {
        foreach ($results as $combination) {
            $results[] = array_merge(array($element), $combination);
        }
    }

    return $results;
}
