<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

//$salt = 'abc';
$salt = 'ihaygndm';

echo 'Index for 64th key (part 1): ' . solve($salt, false) . PHP_EOL;
echo 'Index for 64th key (part 2): ' . solve($salt, true) . PHP_EOL;
