<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    public function test_pass_to_binary()
    {
        self::assertEquals(357, pass_to_binary('FBFBBFFRLR'));

        self::assertEquals(567, pass_to_binary('BFFFBBFRRR'));
        self::assertEquals(119, pass_to_binary('FFFBBBFRRR'));
        self::assertEquals(820, pass_to_binary('BBFFBBFRLL'));
    }

    public function test_get_max_seat_id()
    {
        self::assertEquals(820, find_max_seat_id([
            'FBFBBFFRLR',
            'BFFFBBFRRR',
            'FFFBBBFRRR',
            'BBFFBBFRLL'
        ]));
    }
}
