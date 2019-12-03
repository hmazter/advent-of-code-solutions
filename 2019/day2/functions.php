<?php
declare(strict_types=1);

function set_noun_and_verb(array $program, int $noun, int $verb): array
{
    $program[1] = $noun;
    $program[2] = $verb;

    return $program;
}

function execute(array $program): int
{
    for ($i = 0; $i < count($program); $i += 4) {
        $opcode = $program[$i];
        if ($opcode === 99) {
            break;
        }

        $position1 = $program[$i + 1];
        $position2 = $program[$i + 2];
        $resultPosition = $program[$i + 3];

        if ($opcode === 1) {
            $program[$resultPosition] = $program[$position1] + $program[$position2];
        } elseif ($opcode === 2) {
            $program[$resultPosition] = $program[$position1] * $program[$position2];
        } else {
            throw new RuntimeException("Unknown opcode: $opcode");
        }
    }

    return $program[0];
}

function execute_step2(array $program): int
{
    for ($i = 0; $i < 100; $i++) {
        for ($j = 0; $j < 100; $j++) {
            $result = execute(set_noun_and_verb($program, $i, $j));
            if ($result === 19690720) {
                return 100 * $i + $j;
            }
        }
    }

    throw new \RuntimeException('no result found');
}