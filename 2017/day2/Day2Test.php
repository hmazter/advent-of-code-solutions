<?php
declare(strict_types=1);

require_once './functions.php';

class Day2Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider rowDiffProvider
     * @see http://adventofcode.com/2017/day/2
     * @param $input
     * @param $diff
     */
    public function rowDiff($input, $diff)
    {
        self::assertEquals($diff, rowDiff($input));
    }

    public function rowDiffProvider()
    {
        return [
            [[5, 1, 9, 5], 8],
            [[7, 5, 3], 4],
            [[2, 4, 6, 8], 6],
        ];
    }
    /**
     * @test
     * @dataProvider rowEvenlyDivisibleProvider
     * @see http://adventofcode.com/2017/day/2
     * @param $input
     * @param $diff
     */
    public function rowEvenlyDivisible($input, $diff)
    {
        self::assertEquals($diff, rowEvenlyDivisible($input));
    }

    public function rowEvenlyDivisibleProvider()
    {
        return [
            [[5, 9, 2, 8], 4],
            [[9, 4, 7, 3], 3],
            [[3, 8, 6, 5], 2],
        ];
    }
}
