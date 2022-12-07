<?php
declare(strict_types=1);

function part1(array $stacks_input, array $input2): string
{
    $stacks = build_stacks($stacks_input);

    foreach ($input2 as $row) {
        [$count, $from, $to] = parse_instruction_row($row);

        for ($i = 0; $i < $count; $i++) {
            $container = $stacks[$from]->pop();
            $stacks[$to]->push($container);
        }
    }

    $string = '';
    foreach ($stacks as $stack) {
        $string .= $stack->pop();
    }

    return $string;
}

function part2(array $stacks_input, array $input2): string
{
    $stacks = build_stacks($stacks_input);

    foreach ($input2 as $row) {
        [$count, $from, $to] = parse_instruction_row($row);

        $containers = new SplStack();
        for ($i = 0; $i < $count; $i++) {
            $containers->push($stacks[$from]->pop());
        }
        foreach ($containers as $container) {
            $stacks[$to]->push($container);
        }
    }

    $string = '';
    foreach ($stacks as $stack) {
        $string .= $stack->pop();
    }

    return $string;
}

/**
 * @param array<int, int[]> $input
 * @return array<int, splStack>
 */
function build_stacks(array $input): array
{
    $stacks = [];

    foreach ($input as $num => $items) {
        $stacks[$num] = new SplStack();
        foreach ($items as $item) {
            $stacks[$num]->push($item);
        }
    }

    return $stacks;
}

/**
 * @param string $row
 * @return int[]
 */
function parse_instruction_row(string $row): array
{
    preg_match('/move (\d+) from (\d+) to (\d+)/', $row, $match);

    return [
        (int)$match[1],
        (int)$match[2],
        (int)$match[3],
    ];
}

/**
 * @return array{0: array<int, string[]>, 1: string[]}
 */
function parse_input(string $input): array
{
    [$stack_input, $instructions] = explode("\n\n", $input);

    $stack_input = collect(explode("\n", $stack_input))
        ->mapWithKeys(function ($row) {

            return [$row[0] => str_split(substr($row, 3))];
        })
        ->all();

    return [
        $stack_input,
        explode("\n", $instructions),
    ];
}