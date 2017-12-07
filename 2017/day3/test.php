<?php
declare(strict_types=1);

require_once './functions.php';

class Day3Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider squareSizeProvider
     * @param int $expected
     * @param int $input
     */
    public function squareSize(int $expected, int $input)
    {
        self::assertEquals($expected, squareSize($input));
    }

    public function squareSizeProvider()
    {
        return [
            [3, 9],
            [3, 6],
            [5, 24],
            [5, 25],
        ];
    }

    /**
     * @test
     */
    public function createSquare()
    {
        $expected = [
            [7,8,9],
            [6,1,2],
            [5,4,3],
        ];

        self::assertEquals($expected, createSquareWithIncrementalNumber(3, 9));
    }
}
