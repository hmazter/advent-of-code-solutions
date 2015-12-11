<?php

$password = 'vzbxkghb';   // part 1 input
//$password = 'vzbxxyzz';     // part 1 solution => input part 2

$threeLetterIncrease = generateThreeLetterIncrease();

while (!isValid(++$password)) { }

echo "password: $password\n";


/**
 * Generates an array of all tree letter increases; abc, bcd, ...
 * Could be replace with a static array of these
 *
 * @return array
 */
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

/**
 * Check if a password is valid
 *
 * @param string $password
 * @return bool
 */
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

/**
 * Check if a password contains the required tree letter increase, eg: 'abc', 'bcd' ...
 *
 * @param string $password
 * @return bool
 */
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

/**
 * Checks if a password contains two pars, eg: 'aa' and 'bb', or 'cc' ...
 *
 * @param $password
 * @return bool
 */
function containsTwoPairs($password)
{
    preg_match_all('/(\w)\1{1,}/', $password, $match);
    if (count($match[0]) >= 2 && $match[0][0] != $match[0][1]) {
        return true;
    }

    return false;
}
