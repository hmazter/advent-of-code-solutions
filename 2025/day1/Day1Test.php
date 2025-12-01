<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    #[Test]
    #[TestWith(['R12', 12])]
    #[TestWith(['L10', -10])]
    public function parse_row_returns_int(string $input, int $expected)
    {
        self::assertSame($expected, parse_row($input));
    }

    #[Test]
    #[TestWith([11, 'R8', 19])]
    #[TestWith([19, 'L19', 0])]
    #[TestWith([5, 'L10', 95])]
    #[TestWith([99, 'R1', 0])]
    #[TestWith([0, 'L1', 99])]
    public function test_calculate_rotation(int $position, string $input, int $expected)
    {
        self::assertSame($expected, calculate_rotation($position, $input));
    }

    public function test_part1()
    {
        self::assertSame(3, part1(50, [
            'L68',
            'L30',
            'R48',
            'L5',
            'R60',
            'L55',
            'L1',
            'L99',
            'R14',
            'L82',
        ]));
    }

    public function test_part2()
    {
        self::assertSame(6, part2(50, [
            'L68',
            'L30',
            'R48',
            'L5',
            'R60',
            'L55',
            'L1',
            'L99',
            'R14',
            'L82',
        ]));
    }
}
