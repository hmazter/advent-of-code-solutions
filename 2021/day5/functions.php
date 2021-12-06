<?php
declare(strict_types=1);

function solve(array $input, bool $include_diagonals = false): int
{
    $grid = [];

    foreach ($input as $row) {
        [$x1, $y1, $x2, $y2] = parse_row($row);

        if ($x1 === $x2) {
            $x = $x1;
            for ($y = min($y1, $y2); $y <= max($y1, $y2); $y++) {
                $grid[$y][$x] ??= 0;
                $grid[$y][$x]++;
            }
        } elseif ($y1 === $y2) {
            $y = $y1;
            for ($x = min($x1, $x2); $x <= max($x1, $x2); $x++) {
                $grid[$y][$x] ??= 0;
                $grid[$y][$x]++;
            }
        } elseif ($include_diagonals) {
            $steps = abs($x1 - $x2);
            $x = range($x1, $x2);
            $y = range($y1, $y2);
            for ($i = 0; $i <= $steps; $i++) {
                $grid[$y[$i]][$x[$i]] ??= 0;
                $grid[$y[$i]][$x[$i]]++;
            }
        }
    }

    return count_overlapping($grid);
}

function count_overlapping(array $grid): int
{
    $overlap_count = 0;
    foreach ($grid as $row) {
        foreach ($row as $cell) {
            if ($cell > 1) {
                $overlap_count++;
            }
        }
    }

    return $overlap_count;
}

/**
 * @return int[]
 */
function parse_row(string $row): array
{
    preg_match('/(\d+),(\d+) -> (\d+),(\d+)/', $row, $match);
    array_shift($match);

    return $match;
}