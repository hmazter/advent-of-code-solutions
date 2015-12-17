<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$totalAmount = 150;

$permutations = powerSet($lines);

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
 * http://stackoverflow.com/a/6092999
 *
 * @param array $in
 * @param int $minLength
 * @return array
 */
function powerSet($in, $minLength = 1)
{
    $count = count($in);
    $members = pow(2, $count);
    $return = array();
    for ($i = 0; $i < $members; $i++) {
        $b = sprintf("%0" . $count . "b", $i);
        $out = array();
        for ($j = 0; $j < $count; $j++) {
            if ($b{$j} == '1') {
                $out[] = $in[$j];
            }
        }
        if (count($out) >= $minLength) {
            $return[] = $out;
        }
    }
    return $return;
}
