<?php
declare(strict_types = 1);

$input = 'ugkcyxxp';
//$input = 'abc'; // example

$index = 0;
$password = '';

for ($i = 0; $i < 8; $i++) {
    while (true) {
        $hash = md5($input . $index);
        $index++;

        if (strpos($hash, '00000') === 0) {
            $password .= $hash[5];

            break;
        }
    }
}

echo 'password: ' . $password . PHP_EOL;
