<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    public function test_part1()
    {
        $rows = readRows(__DIR__ . '/example');

        self::assertEquals(11, part1($rows));
    }

    public function test_part2()
    {
        $rows = readRows(__DIR__ . '/example');

        self::assertEquals(31, part2($rows));
    }
}
