<?php
declare(strict_types=1);

function part1(array $lines): int
{
    $sum_valid_games = 0;
    foreach ($lines as $line) {
        $game = parse_game($line);
        if (is_valid_game($game)) {
            $sum_valid_games += $game['game'];
        }
    }

    return $sum_valid_games;
}

function part2(array $lines): int
{
    $sum = 0;
    foreach ($lines as $line) {
        $sum += count_power_of_cubes(parse_game($line));
    }

    return $sum;
}

function count_power_of_cubes(array $game): int
{
    return $game['red'] * $game['green'] * $game['blue'];
}

function is_valid_game(array $game): bool
{
    return $game['red'] <= 12 && $game['green'] <= 13 && $game['blue'] <= 14;
}

function parse_game(string $input): array
{
    preg_match('/Game (\d+):/', $input, $matches);
    $game = (int)$matches[1];
    $input = str_replace("Game $game: ", '', $input);

    $cubes = [
        'red' => 0,
        'green' => 0,
        'blue' => 0,
    ];

    $sets = explode('; ', $input);
    foreach ($sets as $set) {
        $cubes['red'] = max($cubes['red'], get_cube_count($set, 'red'));
        $cubes['green'] = max($cubes['green'], get_cube_count($set, 'green'));
        $cubes['blue'] = max($cubes['blue'], get_cube_count($set, 'blue'));
    }

    return [
        'game' => $game,
        ...$cubes,
    ];
}

function get_cube_count(string $input, string $color): int
{
    preg_match('/(\d+) ' . $color . '/', $input, $matches);
    return (int)($matches[1] ?? 0);
}