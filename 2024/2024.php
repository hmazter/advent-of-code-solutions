<?php

foreach (range(1, 25) as $day) {
    $filename = __DIR__ . "/day{$day}/day{$day}.php";
    if (file_exists($filename)) {
        echo "\n=====================\n";
        echo "Day $day\n";
        system(PHP_BINARY . ' ' . $filename);
    }
}