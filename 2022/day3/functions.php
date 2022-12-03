<?php
declare(strict_types=1);

use Illuminate\Support\Collection;

function part1(array $input): int
{
    return collect($input)
        ->map(get_priority_for_rucksack(...))
        ->sum();
}

function part2(array $input): int
{
    return collect($input)
        ->chunk(3)
        ->map(fn (Collection $group) => get_priority_for_group($group->all()))
        ->sum();
}

function get_priority_for_rucksack(string $input): int
{
    $rucksack = str_split($input);
    $length = count($rucksack);

    $compartment1 = array_slice($rucksack, 0, $length / 2);
    $compartment2 = array_slice($rucksack, $length / 2, $length / 2);

    $item = head(array_intersect($compartment1, $compartment2));

    return get_priority_for_item($item);
}

function get_priority_for_group(array $group): int
{
    if (count($group) !== 3) {
        throw new InvalidArgumentException('There are not 3 rucksacks in group!');
    }

    $rucksacks = array_map(str_split(...), $group);

    $item = head(array_intersect(...$rucksacks));

    return get_priority_for_item($item);
}

function get_priority_for_item(string $item): int
{
    if (ord($item) >= 97 && ord($item) <= 122) {
        // lowercase
        return ord($item) - 96;
    }

    // uppercase
    return ord($item) - 38;
}