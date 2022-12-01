<?php
declare(strict_types=1);

function part1(string $filename): int
{
    $elves = getElfCalories($filename);

    return max($elves);
}

function part2(string $filename): int
{
    $elves = getElfCalories($filename);

    arsort($elves);

    $top = array_slice($elves, 0, 3);

    return array_sum($top);
}

function getElfCalories(string $filename): array
{
    $content = file_get_contents($filename);

    $elves = explode("\n\n", $content);

    return array_map(function ($elf) {
        return array_sum(
            explode("\n", $elf)
        );
    }, $elves);
}