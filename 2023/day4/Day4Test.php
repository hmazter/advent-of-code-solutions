<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    public function test_parse_card()
    {
        $card = parse_card('Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1');

        self::assertEquals(3, $card['card']);
        self::assertEquals([1, 21, 53, 59, 44], $card['winning']);
        self::assertEquals([69, 82, 63, 72, 16, 21, 14,  1], $card['having']);
    }

    public function test_count_card_score()
    {
        self::assertEquals(8, count_card_score('Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53'));
        self::assertEquals(2, count_card_score('Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1'));
        self::assertEquals(1, count_card_score('Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83'));
        self::assertEquals(0, count_card_score('Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36'));
    }

    public function test_part1()
    {
        $input = readRows(__DIR__ . '/example');

        self::assertEquals(13, part1($input));
    }

    public function test_part2()
    {
        $input = readRows(__DIR__ . '/example');

        self::assertEquals(30, part2($input));
    }
}
