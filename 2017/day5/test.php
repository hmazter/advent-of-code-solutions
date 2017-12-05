<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

class Day5Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function solve_part1()
    {
        self::assertEquals(5, solveDay5([0, 3, 0, 1, -3], false));
    }
    /**
     * @test
     */
    public function solve_part2()
    {
        self::assertEquals(10, solveDay5([0, 3, 0, 1, -3], true));
    }
}
