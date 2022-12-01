<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    /** @test */
    public function can_solve_part_1()
    {
        $part1 = part1(__DIR__ . '/example.txt');

        self::assertEquals(24000, $part1);
    }

    /** @test */
    public function can_solve_part_2()
    {
        $part2 = part2(__DIR__ . '/example.txt');

        self::assertEquals(45000, $part2);
    }
}
