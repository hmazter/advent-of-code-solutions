<?php
declare(strict_types=1);

function part1(array $input): int
{
    $score = 0;

    foreach ($input as $round) {
        $score += play_round_part1($round);
    }

    return $score;
}

function part2(array $input): int
{
    $score = 0;

    foreach ($input as $round) {
        $score += play_round_part2($round);
    }

    return $score;
}

function play_round_part1(string $input): int
{
    $values = [
        'A' => Shape::Rock,
        'B' => Shape::Paper,
        'C' => Shape::Scissors,

        'X' => Shape::Rock,
        'Y' => Shape::Paper,
        'Z' => Shape::Scissors,
    ];

    $opponent = $values[explode(' ', $input)[0]];
    $you = $values[explode(' ', $input)[1]];

    // Draw
    if ($opponent === $you) {
        return 3 + $you->value;
    }

    // win
    if (($opponent === Shape::Rock && $you === Shape::Paper)
        || ($opponent === Shape::Paper && $you === Shape::Scissors)
        || ($opponent === Shape::Scissors && $you === Shape::Rock)) {
        return 6 + $you->value;
    }

    // lose
    if (($opponent === Shape::Rock && $you === Shape::Scissors)
        || ($opponent === Shape::Paper && $you === Shape::Rock)
        || ($opponent === Shape::Scissors && $you === Shape::Paper)) {
        return 0 + $you->value;
    }

    throw new UnexpectedValueException('unknown combination');
}


function play_round_part2(string $input): int
{
    $shapes = [
        'A' => Shape::Rock,
        'B' => Shape::Paper,
        'C' => Shape::Scissors,
    ];

    [$opponent, $outcome] = explode(' ', $input);
    $opponent = $shapes[$opponent];

    if ($outcome === 'Y') {
        // draw
        return $opponent->value + 3;
    }

    if ($outcome === 'X') {
        // lose
        if ($opponent === Shape::Rock) {
            return Shape::Scissors->value + 0;
        }
        if ($opponent === Shape::Paper) {
            return Shape::Rock->value + 0;
        }
        if ($opponent === Shape::Scissors) {
            return Shape::Paper->value + 0;
        }
    }

    if ($outcome === 'Z') {
        // Win
        if ($opponent === Shape::Rock) {
            return Shape::Paper->value + 6;
        }
        if ($opponent === Shape::Paper) {
            return Shape::Scissors->value + 6;
        }
        if ($opponent === Shape::Scissors) {
            return Shape::Rock->value + 6;
        }
    }

    throw new UnexpectedValueException('unknown combination');
}

enum Shape: int
{
    case Rock = 1;
    case Paper = 2;
    case Scissors = 3;
}