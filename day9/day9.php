<?php
declare(strict_types = 1);
require_once __DIR__ . '/functions.php';

$compressed = trim(file_get_contents('input.txt'));

echo 'decompressed length part 1 : ' . decompress($compressed, false) . PHP_EOL;
echo 'decompressed length part 2 : ' . decompress($compressed, true) . PHP_EOL;
