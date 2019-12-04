<?php
declare(strict_types=1);

function count_valid_passwords(int $start, int $end, bool $check_triple_digits): int
{
    $count = 0;
    for ($password = $start; $password <= $end; $password++) {
        if (is_valid_password($password, $check_triple_digits)) {
            $count++;
        }
    }
    return $count;
}

function is_valid_password(int $number, bool $check_triple_digits): bool
{
    if ($check_triple_digits) {
        return has_double_digits_but_not_in_larger_group($number) && never_decreases($number);
    }

    return has_double_digits($number) && never_decreases($number);
}

function has_double_digits(int $number): bool
{
    // using backreference:
    // \1+ matches the same text as most recently matched by the 1st capturing group
    return preg_match('/(.)\1+/', (string)$number) > 0;
}

function has_double_digits_but_not_in_larger_group(int $number): bool
{
    $string = (string)$number;

    preg_match_all('/(.)\1+/', $string, $matches);
    foreach ($matches[0] as $match) {
        if (strlen($match) === 2) {
            return true;
        }
    }

    return false;
}

function never_decreases(int $number): bool
{
    $string = (string)$number;

    for ($i = 0; $i < strlen($string) - 1; $i++) {
        if ($string[$i] > $string[$i + 1]) {
            return false;
        }
    }

    return true;
}