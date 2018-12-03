<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{

    public function testParseInputRow()
    {
        $claim = parseInputRow('#4 @ 293,741: 24x29');

        self::assertEquals(4, $claim->id);
        self::assertEquals(293, $claim->left);
        self::assertEquals(741, $claim->top);
        self::assertEquals(24, $claim->width);
        self::assertEquals(29, $claim->height);
    }

    public function testCountUniqueOverlaps()
    {
        $input = [
            '#1 @ 1,3: 4x4',
            '#2 @ 3,1: 4x4',
            '#3 @ 5,5: 2x2',
        ];

        $solve_day3 = solve_day3($input, 8, 8, false);
        self::assertEquals(4, $solve_day3[0]);
        self::assertEquals(3, $solve_day3[1]);
    }
}
