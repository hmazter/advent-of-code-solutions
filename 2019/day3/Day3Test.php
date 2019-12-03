<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    /**
     * @dataProvider part1_provider
     */
    public function test_part1($expected, $path1, $path2)
    {
        self::assertEquals($expected, solve($path1, $path2)['manhattan']);
    }

    public function part1_provider()
    {
        yield [
            159,
            ['R75', 'D30', 'R83', 'U83', 'L12', 'D49', 'R71', 'U7', 'L72'],
            ['U62', 'R66', 'U55', 'R34', 'D71', 'R55', 'D58', 'R83']
        ];
    }

    /**
     * @dataProvider part2_provider
     */
    public function test_part2($expected, $path1, $path2)
    {
        self::assertEquals($expected, solve($path1, $path2)['wire']);
    }

    public function part2_provider()
    {
        yield [
            610,
            ['R75', 'D30', 'R83', 'U83', 'L12', 'D49', 'R71', 'U7', 'L72'],
            ['U62', 'R66', 'U55', 'R34', 'D71', 'R55', 'D58', 'R83']
        ];
    }
}
