<?php
declare(strict_types=1);

require_once 'functions.php';

$input = file_get_contents('input.txt');

echo "part 1: " . countTotal($input) . PHP_EOL;
echo "part 2: " . firstFrequencyTwice($input) . PHP_EOL;
