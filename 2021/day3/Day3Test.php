<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    private array $input = [
        '00100',
        '11110',
        '10110',
        '10111',
        '10101',
        '01111',
        '00111',
        '11100',
        '10000',
        '11001',
        '00010',
        '01010',
    ];

    public function test_solve_part1()
    {
        self::assertEquals(198, solve_part1($this->input));
    }

    public function test_get_oxygen_generator_rating()
    {
        self::assertEquals(23, get_oxygen_generator_rating($this->input));
    }

    public function test_get_cO2_scrubber_rating()
    {
        self::assertEquals(10, get_cO2_scrubber_rating($this->input));
    }

    public function test_solve_part2()
    {
        self::assertEquals(230, solve_part2($this->input));
    }
}
