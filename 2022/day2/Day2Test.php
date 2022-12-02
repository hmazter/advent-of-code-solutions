<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    /** @test */
    public function play_round_case_win()
    {
        self::assertEquals(8, play_round_part1('A Y'));
    }

    /** @test */
    public function play_round_case_lose()
    {
        self::assertEquals(1, play_round_part1('B X'));
    }

    /** @test */
    public function play_round_case_draw()
    {
        self::assertEquals(6, play_round_part1('C Z'));
    }

    public function test_part_1()
    {
        $input = [
            'A Y',
            'B X',
            'C Z',
        ];

        self::assertEquals(15, part1($input));
    }


    /** @test */
    public function part2_draw()
    {
        self::assertEquals(4, play_round_part2('A Y'));
    }

    /** @test */
    public function part2_lose()
    {
        self::assertEquals(1, play_round_part2('B X'));
    }

    /** @test */
    public function part2_win()
    {
        self::assertEquals(7, play_round_part2('C Z'));
    }


    public function test_part_2()
    {
        $input = [
            'A Y',
            'B X',
            'C Z',
        ];

        self::assertEquals(12, part2($input));
    }
}
