<?php
declare(strict_types = 1);

$input = 'ugkcyxxp';
//$input = 'abc'; // example

$password = [];
$index = 0;

while (true) {
    $hash = md5($input . $index);
    $index++;

    if (strpos($hash, '00000') === 0 && is_numeric($hash[5]) && $hash[5] >= 0 && (int)$hash[5] <= 7) {
        $position = $hash[5];
        $char = $hash[6];

        // only add values to new positions
        if (isset($password[$position]) === false) {
            $password[$position] = $char;
        }

        if (count($password) === 8) {
            break;
        }
    }
}

ksort($password);
echo 'password: ' . implode('', $password) . PHP_EOL;
