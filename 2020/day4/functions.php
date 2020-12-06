<?php
declare(strict_types=1);

function get_passports(string $input): array
{
    // Split each passport "chunk"
    return collect(explode("\n\n", $input))
        // replace newline separator in passport chunks with the common space separator
        ->map(fn($passport) => str_replace("\n", ' ', $passport))
        ->map(function ($passport) {
            // split passport chunk into each field
            return collect(explode(' ', $passport))
                // map the passport fields as a key-value array
                ->mapWithKeys(function ($item) {
                    [$key, $value] = explode(':', $item);
                    return [$key => $value];
                })
                ->all();
        })
        ->all();
}

function is_valid_passport(array $passport, bool $validate): bool
{
    $hasRequired = isset(
        $passport['byr'],
        $passport['iyr'],
        $passport['eyr'],
        $passport['hgt'],
        $passport['hcl'],
        $passport['ecl'],
        $passport['pid'],
    );

    if (! $validate) {
        return $hasRequired;
    }

    return $hasRequired
        && is_valid_byr($passport['byr'])
        && is_valid_iyr($passport['iyr'])
        && is_valid_eyr($passport['eyr'])
        && is_valid_hgt($passport['hgt'])
        && is_valid_hcl($passport['hcl'])
        && is_valid_ecl($passport['ecl'])
        && is_valid_pid($passport['pid']);
}

function is_valid_byr($value): bool
{
    return $value >= 1920 && $value <= 2002;
}

function is_valid_iyr($value): bool
{
    return $value >= 2010 && $value <= 2020;
}

function is_valid_eyr($value): bool
{
    return $value >= 2020 && $value <= 2030;
}

function is_valid_hcl($value): bool
{
    return preg_match('/#[0-9a-f]{6}/', $value) > 0;
}

function is_valid_ecl($value): bool
{
    return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
}

function is_valid_pid($value): bool
{
    return is_numeric($value) && strlen($value) === 9;
}

function is_valid_hgt($value): bool
{
    if (str_ends_with($value, 'in')) {
        return (int) $value >= 59 && (int) $value <= 76;
    }
    if (str_ends_with($value, 'cm')) {
        return (int) $value >= 150 && (int) $value <= 193;
    }
    return false;
}

function count_valid_passports(array $passports, bool $validate): int
{
    return count(
        array_filter(
            array_map(fn ($passport) => is_valid_passport($passport, $validate), $passports)
        )
    );
}