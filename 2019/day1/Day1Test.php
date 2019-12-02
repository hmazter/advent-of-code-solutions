<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    /**
     * @test
     * @dataProvider mass_provider
     */
    public function test_calculate_fuel_requirements_part1($mass, $fuel)
    {
        self::assertEquals($fuel, calculate_module_fuel_requirements($mass));
    }

    public function mass_provider() {
        yield [12, 2];
        yield [14, 2];
        yield [1969, 654];
        yield [100756, 33583];
    }

    /**
     * @test
     * @dataProvider mass_provider2
     */
    public function test_calculate_fuel_requirements_part2($mass, $fuel)
    {
        self::assertEquals($fuel, calculate_module_fuel_requirements_including_fuel($mass));
    }

    public function mass_provider2() {
        yield [14, 2];
        yield [1969, 966];
        yield [100756, 50346];
    }

    /** @test */
    public function test_calculate_total_fuel_requirements_part1()
    {
        $input = [12, 14];
        self::assertEquals(4, calculate_total_fuel_requirements($input, false));
    }

    /** @test */
    public function test_calculate_total_fuel_requirements_part2()
    {
        $input = [12, 1969];
        self::assertEquals(968, calculate_total_fuel_requirements($input, true));
    }
}
