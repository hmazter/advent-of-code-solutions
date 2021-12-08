<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day7Test extends TestCase
{
    private array $input = [16, 1, 2, 0, 4, 2, 7, 1, 2, 14];

    /** @dataProvider calculate_fuel_constant_provider */
    public function test_calculate_fuel_constant($target_position, $fuel)
    {
        self::assertEquals($fuel, calculate_fuel_constant($this->input, $target_position));
    }

    public function calculate_fuel_constant_provider()
    {
        return [
            [2, 37],
            [1, 41],
            [10, 71],
        ];
    }

    /** @dataProvider calculate_fuel_increasing_provider */
    public function test_calculate_fuel_increasing($target_position, $fuel)
    {
        self::assertEquals($fuel, calculate_fuel_increasing($this->input, $target_position));
    }

    public function calculate_fuel_increasing_provider()
    {
        return [
            [5, 168],
            [2, 206],
        ];
    }

    public function test_solve_part1()
    {
        self::assertEquals(37, solve_part1($this->input));
    }

    public function test_solve_part2()
    {
        self::assertEquals(168, solve_part2($this->input));
    }
}
