<?php
declare(strict_types=1);

use JetBrains\PhpStorm\ArrayShape;

#[ArrayShape(['depth' => 'int', 'horizontal' => 'int'])]
function calculate_final_position(array $commands): array
{
    $horizontal = 0;
    $depth = 0;

    foreach ($commands as $command) {
        [$direction, $step] = parse_command($command);

        if ($direction === 'down') {
            $depth += (int)$step;
        }
        if ($direction === 'up') {
            $depth -= (int)$step;
        }
        if ($direction === 'forward') {
            $horizontal += (int)$step;
        }
    }

    return [
        'depth' => $depth,
        'horizontal' => $horizontal,
    ];
}

#[ArrayShape(['depth' => 'int', 'horizontal' => 'int'])]
function calculate_final_position_with_aim(array $commands): array
{
    $horizontal = 0;
    $depth = 0;
    $aim = 0;

    foreach ($commands as $command) {
        [$direction, $step] = parse_command($command);

        if ($direction === 'down') {
            $aim += (int)$step;
        }
        if ($direction === 'up') {
            $aim -= (int)$step;
        }
        if ($direction === 'forward') {
            $horizontal += (int)$step;
            $depth += $aim * (int)$step;
        }
    }

    return [
        'depth' => $depth,
        'horizontal' => $horizontal,
    ];
}

function solve_part1(array $input): int
{
    ['depth' => $depth, 'horizontal' => $horizontal] = calculate_final_position($input);

    return $depth * $horizontal;
}

function solve_part2(array $input): int
{
    ['depth' => $depth, 'horizontal' => $horizontal] = calculate_final_position_with_aim($input);

    return $depth * $horizontal;
}

function parse_command(string $command): array
{
    preg_match('/(\S+) (\d+)/', $command, $match);
    return [$match[1], $match[2]];
}