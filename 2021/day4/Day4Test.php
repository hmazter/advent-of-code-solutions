<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../../common.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    public function test_parse_input()
    {
        $input = readFileContent(__DIR__ . '/example');

        [$numbers, $boards] = parse_input($input);

        self::assertEquals(
            [7, 4, 9, 5, 11, 17, 23, 2, 0, 14, 21, 24, 10, 16, 13, 6, 15, 25, 12, 22, 18, 20, 8, 19, 3, 26, 1],
            $numbers,
        );

        self::assertCount(3, $boards);
    }

    public function test_bingo_horizontal()
    {
        $board = new Board('1 2' . PHP_EOL . '3 4');

        $board->markNumber(3);
        self::assertFalse($board->hasBingo());

        $board->markNumber(4);
        self::assertTrue($board->hasBingo());
    }

    public function test_bingo_vertical()
    {
        $board = new Board('1 2' . PHP_EOL . '3 4');

        $board->markNumber(1);
        self::assertFalse($board->hasBingo());

        $board->markNumber(3);
        self::assertTrue($board->hasBingo());
    }

    public function test_get_unmarked_sum()
    {
        $board = new Board('1 2' . PHP_EOL . '3 4');

        $board->markNumber(1);
        self::assertEquals(9, $board->getUnmarkedSum());
    }

    public function test_solve_part1()
    {
        $input = readFileContent(__DIR__ . '/example');

        self::assertEquals(
            4512,
            solve_part1($input)
        );
    }

    public function test_solve_part2()
    {
        $input = readFileContent(__DIR__ . '/example');

        self::assertEquals(
            1924,
            solve_part2($input)
        );
    }
}
