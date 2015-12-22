<?php

$target = 36000000;
$presents = 0;
$house = 1;
while (true) {
    $presents = array_sum(getDivisors($house)) * 10;

    if ($presents >= $target) {
        break;
    }

    $house++;
}


echo "House $house got " .
    number_format($presents, 0, '.', ' ') .
    " presents which matches the target (" .
    number_format($target, 0, '.', ' ') . ")\n";

function getDivisors($number)
{
    $divisors = [];
    $sqrt = sqrt($number);

    for ($i = 1; $i <= $sqrt; $i++) {
        if ($number % $i == 0) {
            $divisors[] = $i;
            $divisors[] = $number / $i;
        }
    }

    return array_unique($divisors);
}
