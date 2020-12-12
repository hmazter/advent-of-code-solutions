<?php
declare(strict_types=1);

function day12_part1(array $input): int
{
    $position = ['x' => 0, 'y' => 0];
    $direction = ['x' => 1, 'y' => 0];

    foreach ($input as $instruction) {
        $instruction = parse_instruction($instruction);

        if ($instruction[0] === 'R' || $instruction[0] === 'L') {
            // Rotate the ship
            $direction = rotate($direction, $instruction[0], $instruction[1]);
        } elseif (in_array($instruction[0], ['N', 'S', 'E', 'W'])) {
            // Move the ship in a direction, without changing the ships direction
            $move_direction = match ($instruction[0]) {
                'N' => ['x' => 0, 'y' => 1],
                'S' => ['x' => 0, 'y' => -1],
                'E' => ['x' => 1, 'y' => 0],
                'W' => ['x' => -1, 'y' => 0],
            };

            $position['x'] += $move_direction['x'] * $instruction[1];
            $position['y'] += $move_direction['y'] * $instruction[1];
        } else {
            // Moving Forward in the ships direction
            $position['x'] += $direction['x'] * $instruction[1];
            $position['y'] += $direction['y'] * $instruction[1];
        }
    }

    return abs($position['x']) + abs($position['y']);
}

function day12_part2(array $input): int
{
    $ship = ['x' => 0, 'y' => 0];
    $waypoint = ['x' => 10, 'y' => 1];

    foreach ($input as $instruction) {
        $instruction = parse_instruction($instruction);

        if ($instruction[0] === 'R' || $instruction[0] === 'L') {
            // Rotate the waypoint around the ship
            $waypoint = rotate($waypoint, $instruction[0], $instruction[1]);
        } elseif (in_array($instruction[0], ['N', 'S'])) {
            // Move waypoint North/South
            $waypoint['y'] = match ($instruction[0]) {
                'N' => $waypoint['y'] + $instruction[1],
                'S' => $waypoint['y'] - $instruction[1],
            };
        } elseif (in_array($instruction[0], ['E', 'W'])) {
            // Move waypoint East/West
            $waypoint['x'] = match ($instruction[0]) {
                'E' => $waypoint['x'] + $instruction[1],
                'W' => $waypoint['x'] - $instruction[1],
            };
        } else {
            // Moving forward
            $ship['x'] += $waypoint['x'] * $instruction[1];
            $ship['y'] += $waypoint['y'] * $instruction[1];
        }
    }

    return abs($ship['x']) + abs($ship['y']);
}

function rotate(array $current, string $direction, int $degrees)
{
    if ($degrees === 180) {
        return [
            'x' => $current['x'] * -1,
            'y' => $current['y'] * -1,
        ];
    }

    if (($direction === 'R' && $degrees === 90) || ($direction === 'L' && $degrees === 270)) {
        return [
            'x' => $current['y'],
            'y' => $current['x'] * -1,
        ];
    }

    if (($direction === 'R' && $degrees === 270) || ($direction === 'L' && $degrees === 90)) {
        return [
            'x' => $current['y'] * -1,
            'y' => $current['x'],
        ];
    }

    throw new InvalidArgumentException('Invalid rotate arguments');
}

function parse_instruction(string $instruction): array
{
    preg_match('/(\D)(\d*)/', $instruction, $match);

    return [$match[1], (int) $match[2]];
}