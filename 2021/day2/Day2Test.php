<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    private array $input = [
        'forward 5',
        'down 5',
        'forward 8',
        'up 3',
        'down 8',
        'forward 2',
    ];

    public function test_calculate_final_position()
    {
        $position = calculate_final_position($this->input);

        self::assertEquals(10, $position['depth']);
        self::assertEquals(15, $position['horizontal']);
    }

    public function test_calculate_final_position_with_aim()
    {
        $position = calculate_final_position_with_aim($this->input);

        self::assertEquals(60, $position['depth']);
        self::assertEquals(15, $position['horizontal']);
    }

    public function test_solve_part1()
    {
        self::assertEquals(150, solve_part1($this->input));
    }

    public function test_solve_part2()
    {
        self::assertEquals(900, solve_part2($this->input));
    }
}
