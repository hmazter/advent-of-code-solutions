<?php
declare(strict_types = 1);

// answer 1849
$file = __DIR__ . '/input.txt';

$rows = file($file);
$validTriangles = 0;
$allValues = [];
$colIndex = 0;

while ($colIndex < 3) {
    foreach ($rows as $rowindex => $row) {
        $values = array_map('trim', str_split($row, 5));
        $allValues[] = $values[$colIndex];
    }
    $colIndex++;
}

$triangles = array_chunk($allValues, 3);
foreach ($triangles as $triangle) {
    sort($triangle);
    if (($triangle[0] + $triangle[1]) > $triangle[2]) {
        $validTriangles++;
    }
}


echo sprintf('number of valid triangles %d' . PHP_EOL, $validTriangles);
