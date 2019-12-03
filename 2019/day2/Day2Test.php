<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    /**
     * @dataProvider execute_provider
     */
    public function test_execute(int $expected, array $program)
    {
        self::assertEquals($expected, execute($program));
    }

    public function execute_provider()
    {
        yield [3500, [1,9,10,3,2,3,11,0,99,30,40,50]];
        yield [2, [1,0,0,0,99]];
        yield [2, [2,3,0,3,99]];
        yield [2, [2,4,4,5,99,0]];
        yield [30, [1,1,1,4,99,5,6,0,99]];
    }
}
