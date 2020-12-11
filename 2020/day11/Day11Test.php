<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day11Test extends TestCase
{
    public function test_part1()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $occupiedSeats = day11($input, crowd_limit: 4, check_visible: false);
        self::assertEquals(37, $occupiedSeats);
    }

    public function test_part2()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $occupiedSeats = day11($input, crowd_limit: 5, check_visible: true);
        self::assertEquals(26, $occupiedSeats);
    }
}
