<?php
declare(strict_types=1);

function count_valid_passwords_part_1($rows): int
{
    return count(
        array_filter(
            array_map('is_valid_password_part_1', $rows)
        )
    );
}

function count_valid_passwords_part_2($rows): int
{
    return count(
        array_filter(
            array_map('is_valid_password_part_2', $rows)
        )
    );
}

function is_valid_password_part_1(string $row): bool
{
    [, $min, $max, $char, $password] = parse_row($row);

    $count = strlen(preg_replace("/[^$char]/", '', $password));
    return $min <= $count && $count <= $max;
}

function is_valid_password_part_2(string $row): bool
{
    [, $pos1, $pos2, $char, $password] = parse_row($row);

    return ($password[$pos1 - 1] === $char XOR $password[$pos2 - 1] === $char);
}

function parse_row(string $row): array
{
    preg_match('/(\d+)-(\d+) (\D+): (\D*)/', $row, $output);
    return $output;
}