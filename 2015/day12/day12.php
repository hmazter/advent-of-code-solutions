<?php

$json = file_get_contents(dirname(__FILE__) . '/input.txt');

// part 2
// $json = cleanRed($json);

$data = json_decode($json, true);

$sum = 0;
array_walk_recursive($data, function ($value) {
    global $sum;
    $sum += intval($value);
});

echo "sum: $sum\n";

/**
 * Delete all 'json objects' from data that contains red on current level
 *
 * @param string $data
 * @return int
 */
function cleanRed($data)
{
    $stack = [];
    $chars = str_split($data);

    for ($i = 0; $i < count($chars); $i++) {
        $char = $chars[$i];
        if ($char == '{') {
            array_push($stack, $i);
        }

        if ($char == '}') {
            $end = $i;
            $start = array_pop($stack);

            $substring = substr(join('', $chars), $start, $end - $start + 1);
            if (strpos($substring, ':"red"') !== false) {
                for ($i = $start + 1; $i < $end; $i++) {
                    // replace all char belonging to red objects with space
                    $chars[$i] = ' ';
                }
            }
        }
    }

    return join('', $chars);
}