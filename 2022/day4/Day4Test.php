<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{

    private array $input = [
        '2-4,6-8',
        '2-3,4-5',
        '5-7,7-9',
        '2-8,3-7',
        '6-6,4-6',
        '2-6,4-8',
    ];

    public function test_part1()
    {
        self::assertEquals(2, part1($this->input));
    }

    public function test_part2()
    {
        self::assertEquals(4, part2($this->input));
    }

    /** @test */
    public function is_fully_contained_false()
    {
        self::assertFalse(is_fully_contained('2-4,6-8'));
    }

    /** @test */
    public function is_fully_contained_true_first()
    {
        self::assertTrue(is_fully_contained('6-6,4-6'));
    }

    /** @test */
    public function is_fully_contained_true_second()
    {
        self::assertTrue(is_fully_contained('2-8,3-7'));
    }

    /** @test */
    public function is_overlapping_false()
    {
        self::assertFalse(is_overlapping('2-4,6-8'));
    }

    /** @test */
    public function is_overlapping_true1()
    {
        self::assertTrue(is_overlapping('5-7,7-9'));
    }

    /** @test */
    public function is_overlapping_true2()
    {
        self::assertTrue(is_overlapping('2-8,3-7'));
    }

    /** @test */
    public function is_overlapping_true3()
    {
        self::assertTrue(is_overlapping('6-6,4-6'));
    }
}
