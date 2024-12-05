<?php /** @noinspection OpAssignShortSyntaxInspection */
declare(strict_types=1);

function parse_input($filename): array
{
    return array_map('str_split', readRows($filename));
}

function part1(array $input): int
{
    $xmas_times = 0;

    $is = static function (int $x, int $y, string $char) use ($input) {
        return ($input[$y][$x] ?? null) === $char;
    };

    foreach ($input as $y => $row) {
        foreach ($row as $x => $value) {
            if ($value !== 'X') {
                continue;
            }

            $xmas_times = $xmas_times
                // Horisontal forward
                + (int)($is($x + 1, $y, 'M') && $is($x + 2, $y, 'A') && $is($x + 3, $y, 'S'))
                // horisontal backwards
                + (int)($is($x - 1, $y, 'M') && $is($x - 2, $y, 'A') && $is($x - 3, $y, 'S'))
                // vertical down
                + (int)($is($x, $y + 1, 'M') && $is($x, $y + 2, 'A') && $is($x, $y + 3, 'S'))
                // vertical up
                + (int)($is($x, $y - 1, 'M') && $is($x, $y - 2, 'A') && $is($x, $y - 3, 'S'))
                // diagonal - up right
                + (int)($is($x + 1, $y + 1, 'M') && $is($x + 2, $y + 2, 'A') && $is($x + 3, $y + 3, 'S'))
                // diagonal - down left
                + (int)($is($x - 1, $y - 1, 'M') && $is($x - 2, $y - 2, 'A') && $is($x - 3, $y - 3, 'S'))
                // diagonal - down right
                + (int)($is($x + 1, $y - 1, 'M') && $is($x + 2, $y - 2, 'A') && $is($x + 3, $y - 3, 'S'))
                // diagonal - up left
                + (int)($is($x - 1, $y + 1, 'M') && $is($x - 2, $y + 2, 'A') && $is($x - 3, $y + 3, 'S'));
        }
    }

    return $xmas_times;
}

function part2(array $input): int
{
    $xmas_times = 0;

    $is = static function (int $x, int $y, string $char) use ($input) {
        return ($input[$y][$x] ?? null) === $char;
    };

    foreach ($input as $y => $row) {
        foreach ($row as $x => $value) {
            if ($value !== 'A') {
                continue;
            }

            $xmas_times = $xmas_times
                + (int)($is($x - 1, $y - 1, 'M') && $is($x + 1, $y + 1, 'S')
                     && $is($x - 1, $y + 1, 'M') && $is($x + 1, $y - 1, 'S'))

                + (int)($is($x + 1, $y + 1, 'M') && $is($x - 1, $y - 1, 'S')
                     && $is($x + 1, $y - 1, 'M') && $is($x - 1, $y + 1, 'S'))

                + (int)($is($x - 1, $y - 1, 'M') && $is($x + 1, $y + 1, 'S')
                     && $is($x + 1, $y - 1, 'M') && $is($x - 1, $y + 1, 'S'))

                + (int)($is($x + 1, $y + 1, 'M') && $is($x - 1, $y - 1, 'S')
                     && $is($x - 1, $y + 1, 'M') && $is($x + 1, $y - 1, 'S'));
        }
    }

    return $xmas_times;
}