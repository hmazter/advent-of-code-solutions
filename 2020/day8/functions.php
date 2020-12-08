<?php /** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

function run_instructions(array $instructions, bool $throwForInfiniteLoop = false): int
{
    $accumulator = 0;
    $pointer = 0;
    $positions = [];

    while (true) {
        // return condition for part 1, throw for part 2 to identify infinite loops
        if (isset($positions[$pointer])) {
            // we have been at this position before => return!
            if ($throwForInfiniteLoop) {
                throw new InfiniteLoopException($pointer, $accumulator);
            }
            return $accumulator;
        }

        // return condition for part 2
        if ($pointer === count($instructions)) {
            // we have reached the end of the instructions => return!
            return $accumulator;
        }

        // record pointer position
        $positions[$pointer] = true;
        $instruction = parse_instruction($instructions[$pointer]);

        switch ($instruction[0]) {
            case 'nop':
                $pointer++;
                break;
            case 'jmp':
                $pointer += $instruction[1];
                break;
            case 'acc':
                $accumulator += $instruction[1];
                $pointer++;
                break;
        }
    }
}

function modify_to_exit_and_run_instructions(array $instructions): int
{
    foreach ($instructions as $index => $instruction) {
        if (str_contains($instruction, 'acc')) {
            // acc should not be modified
            continue;
        }

        $modified_instructions = $instructions;
        if (str_contains($instruction, 'nop')) {
            $modified_instructions[$index] = str_replace('nop', 'jmp', $instruction);
        } else {
            $modified_instructions[$index] = str_replace('jmp', 'nop', $instruction);
        }

        try {
            return run_instructions($modified_instructions, true);
        } catch (InfiniteLoopException $exception) {
            // this modification resulted in a infinite loop, move on the next instruction
            continue;
        }
    }

    throw new RuntimeException('No modification solved the problem');
}

function parse_instruction(string $instruction): array
{
    preg_match('/(\S+) ([-+]\d+)/', $instruction, $match);
    return [$match[1], (int) $match[2]];
}

class InfiniteLoopException extends RuntimeException
{
    public function __construct(int $pointer, int $accumulator)
    {
        parent::__construct("Infinite loop in the instructions occurred. Pointer was at $pointer and the accumulator has value $accumulator");
    }
}