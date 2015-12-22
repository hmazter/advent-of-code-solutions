<?php

$target = 36000000;
//$target = 10000;
$presents = 0;
$house = 1;
while (true) {
    $divisors = getDivisors($house);

    foreach ($divisors as $key => $divisor) {
        if ($divisor * 50 < $house) {
            unset($divisors[$key]);
//            echo "elf $divisor has delivered to more then 50 houses\n";
        }
    }

    $presents = array_sum($divisors) * 11;

//    echo "House $house got $presents presents.\n";

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
