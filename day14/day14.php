<?php
include_once dirname(__FILE__) . '/Reindeer.php';

$totalTime = 2503;
$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$reindeers = [];

foreach ($lines as $line) {
    preg_match('/(\w*) can fly (\d*) km\/s for (\d*) seconds, but then must rest for (\d*) seconds./', $line, $match);
    $reindeers[$match[1]] = new Reindeer($match[1], $match[2], $match[3], $match[4]);
}

$leadDistance = 0;
for ($i = 0; $i < $totalTime; $i++) {
    $leader = [];

    /** @var Reindeer $reindeer */
    foreach ($reindeers as $reindeer) {
        // calculate each reindeer's movement
        $distance = $reindeer->tick($i);

        /*
         * Part 2
         */
        if ($distance > $leadDistance) {
            // new leader, replace previous leader(s)
            $leadDistance = $distance;
            $leader = [$reindeer];
        }else if ($distance == $leadDistance) {
            // equal distance as the current leader
            $leader[] = $reindeer;
        }
    }

    // add points to current leader(s)
    foreach ($leader as $reindeer) {
        $reindeer->addPoint();
    }
}

echo "distance result (part 1)".PHP_EOL;
foreach ($reindeers as $reindeer) {
    echo $reindeer->getResult().PHP_EOL;
}

echo PHP_EOL;

echo "points result (part 2)".PHP_EOL;
foreach ($reindeers as $reindeer) {
    echo $reindeer->getPointsResult().PHP_EOL;
}