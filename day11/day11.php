<?php

//$password = 'vzbxkghb';   // part 1 input
$password = 'vzbxxyzz';     // part 1 solution => input part 2

$threeLetterIncrease = generateThreeLetterIncrease();
$allowedAlphabeth = [
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'k', 'm',
    'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x' ,'y', 'z',
];

while (true) {
    $password = join('', increaseLetters(str_split($password)));

    if (isValid($password)) {
        break;
    }
}

echo "password: $password\n";


function generateThreeLetterIncrease()
{
    $alphabeth = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x' ,'y', 'z',
    ];

    $result = [];
    for ($i = 0; $i < count($alphabeth) - 2; $i++) {
        $result[$alphabeth[$i] . $alphabeth[$i + 1] . $alphabeth[$i + 2]] = true;
    }
    return $result;
}

function increaseLetters($passwordArray)
{
    global $allowedAlphabeth;

    $char = array_pop($passwordArray);
    $index = array_search($char, $allowedAlphabeth) + 1;

    if ($index >= count($allowedAlphabeth)) {
        $index = 0;
        $passwordArray = increaseLetters($passwordArray);
    }
    $passwordArray[] = $allowedAlphabeth[$index];

    return $passwordArray;

}

function isValid($password)
{
    if (!containsThreeLetterIncrease($password)) {
        return false;
    }

    if (!containsTwoPairs($password)) {
        return false;
    }

    return true;
}

function containsThreeLetterIncrease($password)
{
    global $threeLetterIncrease;
    for ($i = 0; $i < strlen($password) - 2; $i++) {
        $substr = substr($password, $i, 3);
        if (isset($threeLetterIncrease[$substr])) {
            return true;
        }
    }

    return false;
}

function containsTwoPairs($password)
{
    preg_match_all('/(\w)\1{1,}/', $password, $match);
    if (count($match[0]) >= 2 && $match[0][0] != $match[0][1]) {
        return true;
    }

    return false;
}
