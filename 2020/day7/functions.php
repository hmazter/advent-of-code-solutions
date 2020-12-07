<?php
declare(strict_types=1);

function parse_rules(array $input): array
{
    $rules = [];
    foreach ($input as $item) {
        preg_match('/(\w+ \w+) bags contain ([\w ,]+)\./', $item, $match);
        if ($match[2] === 'no other bags') {
            $inner = null;
        } else {
            $inner = collect(explode(',', $match[2]))
                ->mapWithKeys(function ($bag) {
                    if (preg_match('/(\d+) (\w+ \w+)/', $bag, $match)) {
                        return [$match[2] => $match[1]];
                    }
                    return null;
                })
                ->all();
        }
        $rules[$match[1]] = $inner;
    }

    return $rules;
}

function can_contain(array $rules, string $outer, string $inner): bool
{
    if ($rules[$outer] === null) {
        return false;
    }

    if (isset($rules[$outer][$inner])) {
        return true;
    }

    $return = false;
    foreach ($rules[$outer] as $new_outer => $count) {
        $return = $return || can_contain($rules, $new_outer, $inner);
    }

    return $return;
}

function count_bags_inside(array $rules, string $bag): int
{
    if ($rules[$bag] === null) {
        return 0;
    }

    $return = 0;
    foreach ($rules[$bag] as $new_bag => $count) {
        $return += (int) $count * (count_bags_inside($rules, $new_bag) + 1);
    }

    return $return;
}

function count_bags_that_eventually_can_contain_shiny_gold(array $rules): int
{
    $outers = array_keys($rules);

    return count(
        array_filter(
            array_map(fn ($outer) => can_contain($rules, $outer, 'shiny gold'), $outers)
        )
    );
}

function count_bags_inside_shiny_gold_bag(array $rules): int
{
    return count_bags_inside($rules, 'shiny gold');
}