<?php
require_once(dirname(__FILE__) . '/City.php');

$lines = file(dirname(__FILE__) . '/input.txt');

/*
 * Create cities graph
 */
$cities = [];
foreach ($lines as $line) {
    $line = trim($line);
    preg_match('/(\S*) to (\S*) = (\d*)/', $line, $match);
    $city1 = $match[1];
    $city2 = $match[2];
    $distance = $match[3];

    if (!isset($cities[$city1])) {
        $cities[$city1] = new City($city1);
    }
    if (!isset($cities[$city2])) {
        $cities[$city2] = new City($city2);
    }

    $cities[$city1]->connections[$city2] = $distance;
    $cities[$city2]->connections[$city1] = $distance;
}

$cityNames = array_keys($cities);
$allRoutes = [];
pc_permute($cityNames);

$shortest = null;
$longest = null;
foreach ($allRoutes as $route) {
    $length = 0;
    $previous = null;
    foreach ($route as $cityName) {
        if ($previous === null) {
            $previous = $cityName;
            continue;
        }

        /** @var City $city */
        $city = $cities[$cityName];
        $length += $city->connections[$previous];

        $previous = $cityName;
    }

    if ($shortest === null || $length < $shortest) {
        $shortest = $length;
    }

    if ($longest === null || $length > $longest) {
        $longest = $length;
    }
}

echo "shortest: $shortest\n";
echo "longest: $longest\n";

/**
 * Get all permutation of an array
 *
 * http://docstore.mik.ua/orelly/webprog/pcook/ch04_26.htm
 * @param array $items
 * @param array $perms
 */
function pc_permute($items, $perms = array())
{
    global $allRoutes;
    if (empty($items)) {
        $allRoutes[] = $perms;
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
