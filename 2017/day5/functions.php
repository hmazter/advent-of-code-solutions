<?php
declare(strict_types=1);

/**
 * @param array|int[] $instructions
 * @param bool $part2
 * @return int
 */
function solveDay5(array $instructions, bool $part2): int
{
    $jumps = 0;
    $position = 0;
    $instructionCount = count($instructions);

    // while the position is in the instruction space
    while ($position >= 0 && $position < $instructionCount) {
        // read the instruction
        $instruction = $instructions[$position];

        if ($part2 && $instruction >= 3) {
            // decrement the instruction by one
            $instructions[$position]--;
        } else {
            // increment the instruction by one
            $instructions[$position]++;
        }

        // get the new position by "jumping" with the instruction
        $position = $position + $instruction;

        // increase jump counter
        $jumps++;
    }

    return $jumps;
}
