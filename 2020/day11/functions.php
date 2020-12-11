<?php
declare(strict_types=1);

function day11(array $input, int $crowd_limit, bool $check_visible): int
{
    $map = array_map(fn ($row) => str_split($row), $input);

    $rowCount = count($map);
    $columnCount = count($map[0]);

    while (true) {
        $change = false;
        $newMap = $map;

        for ($r = 0; $r < $rowCount; $r++) {
            for ($c = 0; $c < $columnCount; $c++) {
                if ($map[$r][$c] === '.') {
                    // if this is a floor tile we dont need to calculate, move on to the next sopt directly
                    continue;
                }

                // count occupied adjacent seats
                $adjacent = 0;
                foreach ([-1, 0, 1] as $rd) {
                    foreach ([-1, 0, 1] as $cd) {
                        if ($rd === 0 && $cd === 0) {
                            // don't count the current seat
                            continue;
                        }
                        $rr = $r + $rd;
                        $cc = $c + $cd;

                        // part 2
                        while ($check_visible && 0 <= $rr && $rr < $rowCount && 0 <= $cc && $cc < $columnCount && $map[$rr][$cc] === '.') {
                            // while we are at a floor tile, continue one step further in the direction we are checking
                            $rr += $rd;
                            $cc += $cd;
                        }

                        if (0 <= $rr && $rr < $rowCount && 0 <= $cc && $cc < $columnCount && $map[$rr][$cc] === '#') {
                            $adjacent++;
                        }
                    }
                }

                if ($map[$r][$c] === 'L' && $adjacent === 0) {
                    //If a seat is empty (L) and there are no occupied seats adjacent to it, the seat becomes occupied.
                    $newMap[$r][$c] = '#';
                    $change = true;
                } elseif ($map[$r][$c] === '#' && $adjacent >= $crowd_limit) {
                    //If a seat is occupied (#) and four/five or more seats adjacent to it are also occupied, the seat becomes empty.
                    $newMap[$r][$c] = 'L';
                    $change = true;
                }
            }
        }
        $map = $newMap;

        if ($change === false) {
            return strlen(
                str_replace(['.', 'L'], '',
                    implode('',
                        array_map(fn ($row) => implode('', $row), $map)
                    )
                )
            );
        }
    }
}