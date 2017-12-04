<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once './day1.php';

class Day1Test extends TestCase
{
    /**
     * @test
     * @dataProvider solveDataProvider
     * @param string $input
     * @param int $sum
     */
    public function solve(string $input, int $sum)
    {
        self::assertEquals($sum, solve($input));
    }

    public function solveDataProvider()
    {
        return [
            ['1122', 3],
            ['1111', 4],
            ['1234', 0],
            ['91212129', 9],
        ];
    }

    /**
     * @test
     * @dataProvider solvePart2DataProvider
     * @param string $input
     * @param int $sum
     */
    public function solvePart2(string $input, int $sum)
    {
        self::assertEquals($sum, solvePart2($input));
    }

    public function solvePart2DataProvider()
    {
        return [
            ['1212', 6],
            ['1221', 0],
            ['123425', 4],
            ['123123', 12],
            ['12131415', 4],
        ];
    }
}