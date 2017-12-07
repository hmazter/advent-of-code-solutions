<?php
declare(strict_types=1);

require_once './functions.php';

class Day6Test extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     * @dataProvider redistributeLargestProvider
     * @param $expected
     * @param $memory
     */
    public function redistributeLargest($expected, $memory)
    {
        redistributeLargest($memory);

        self::assertEquals($expected, $memory);
    }

    public function redistributeLargestProvider()
    {
        return [
            [[2, 4, 1, 2], [0, 2, 7, 0]],
            [[3, 1, 2, 3], [2, 4, 1, 2]],
            [[0, 2, 3, 4], [3, 1, 2, 3]],
            [[1, 3, 4, 1], [0, 2, 3, 4]],
            [[2, 4, 1, 2], [1, 3, 4, 1]],
        ];
    }

    /**
     * @test
     */
    public function reallocateMemory()
    {
        $memory = [0, 2, 7, 0];
        $result = reallocateMemory($memory);
        self::assertEquals(5, $result['total']);
        self::assertEquals(4, $result['loop']);
    }
}