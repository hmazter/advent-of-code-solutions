<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    public function test_parse_row()
    {
        self::assertEquals([0, 9, 5, 9], parse_row('0,9 -> 5,9'));
    }

    public function test_solve_part1()
    {
        $input = readRows(__DIR__ . '/example');
        self::assertEquals(5, solve($input, false));
    }

    public function test_solve_part2()
    {
        $input = readRows(__DIR__ . '/example');
        self::assertEquals(12, solve($input, true));
    }
}
