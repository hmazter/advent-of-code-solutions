<?php
declare(strict_types=1);

function part1(array $lines): int
{
    return array_sum(array_map('count_card_score', $lines));
}

function part2(array $lines): int
{
    $cards = array_map('parse_card', $lines);

    foreach ($cards as $index => &$card) {
        $matching = count(array_intersect($card['winning'], $card['having']));
        // add copies of the following "$matching" number of cards
        // with the number of cards I have of this ($card['count'])
        for ($i = $index + 1; $i <= $index + $matching; $i++) {
            $cards[$i]['count'] += $card['count'];
        }
    }

    return array_sum(
        array_column($cards, 'count')
    );
}

function count_card_score(string $line): int
{
    $card = parse_card($line);
    $matches = count(array_intersect($card['winning'], $card['having']));

    return match ($matches) {
        0 => 0, // no matches => no score
        1 => 1, // 1 match => 1 point
        default => 2 ** ($matches - 1), // 2 or more matches => 2^(matches-1) points (double for each match except the first match)
    };
}

#[\JetBrains\PhpStorm\ArrayShape(['card' => 'int', 'count' => 'int', 'winning' => 'array', 'having' => 'array'])]
function parse_card(string $line): array
{
    preg_match('/Card\s+(\d+):\s+([\d ]+)\|([\d ]+)/', $line, $matches);

    return [
        'card' => (int)$matches[1],
        'count' => 1,
        'winning' => get_ints_from_string($matches[2]),
        'having' => get_ints_from_string($matches[3]),
    ];
}

function get_ints_from_string(string $string): array
{
    preg_match_all('/\d+/', $string, $matches);

    return array_map('intval', $matches[0]);
}