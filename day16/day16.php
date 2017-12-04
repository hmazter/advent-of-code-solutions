<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

//$diskSize = 272; // part 1
$diskSize = 35651584; // part 2
$initialData = '01111010110010011';

$data = getData($initialData, $diskSize);
$checksum = calculateChecksum($data);

echo 'Checksum: ' . $checksum . PHP_EOL;
