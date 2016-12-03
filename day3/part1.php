<?php
declare(strict_types = 1);

// 993
$file = __DIR__ . '/input.txt';
$rows = file($file);
$validTriangles = 0;

foreach ($rows as $row) {
    $triangle = array_map('trim', str_split($row, 5));
    $triangle = array_map('trim', $triangle);

    if (
        ($triangle[0] + $triangle[1]) > $triangle[2] &&
        ($triangle[0] + $triangle[2]) > $triangle[1] &&
        ($triangle[1] + $triangle[2]) > $triangle[0]
    ) {
        $validTriangles++;
    }
}

echo sprintf('number of valid triangles %d' . PHP_EOL, $validTriangles);
