<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    public function test_part1()
    {
        $input = '11-22,95-115,998-1012,1188511880-1188511890,222220-222224,1698522-1698528,446443-446449,38593856-38593862,565653-565659,824824821-824824827,2121212118-2121212124';
        $total = part1($input);

        self::assertEquals(1227775554, $total);
    }

    public function test_part2()
    {
        $input = '11-22,95-115,998-1012,1188511880-1188511890,222220-222224,1698522-1698528,446443-446449,38593856-38593862,565653-565659,824824821-824824827,2121212118-2121212124';
        $total = part2($input);

        self::assertEquals(4174379265, $total);
    }

    // example input
    #[TestWith(['11-22', 11 + 22])]
    #[TestWith(['95-115', 99 + 111])]
    #[TestWith(['998-1012', 999 + 1010])]
    #[TestWith(['1188511880-1188511890', 1188511885])]
    #[TestWith(['222220-222224', 222222])]
    #[TestWith(['1698522-1698528', 0])]
    #[TestWith(['446443-446449', 446446])]
    #[TestWith(['38593856-38593862', 38593859])]
    #[TestWith(['565653-565659', 565656])]
    #[TestWith(['824824821-824824827', 824824824])]
    #[TestWith(['2121212118-2121212124', 2121212121])]

    // example from description
    #[TestWith(['12341234-12341234', 12341234])]
    #[TestWith(['123123123-123123123', 123123123])]
    #[TestWith(['1212121212-1212121212', 1212121212])]
    #[TestWith(['1111111-1111111', 1111111])]
    public function test_part2_small(string $input, int $expected)
    {
        $total = part2($input);

        self::assertEquals($expected, $total);
    }
}
