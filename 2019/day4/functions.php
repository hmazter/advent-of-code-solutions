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
        return never_decreases($number) && has_double_digits_but_not_in_larger_group($number);
    }

    return has_double_digits($number) && never_decreases($number);
}

function has_double_digits(int $number): bool
{
    return preg_match('/11|22|33|44|55|66|77|88|99|00/', (string)$number) > 0;
}

function has_double_digits_but_not_in_larger_group(int $number): bool
{
    $string = (string)$number;

    for ($i = 0; $i < strlen($string) - 1; $i++) {
        $next_is_same = $string[$i] === $string[$i + 1];
        // next next is out of bounds or different
        $next_next_is_different = $i === strlen($string) - 2 || $string[$i] !== $string[$i + 2];
        // previous is out of bounds or different
        $previous_is_different = $i === 0 || $string[$i] !== $string[$i - 1];

        if ($next_is_same && $next_next_is_different && $previous_is_different) {
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