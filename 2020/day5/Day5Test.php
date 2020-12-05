<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    public function test_get_row()
    {
        self::assertEquals(44, get_row('FBFBBFFRLR'));

        self::assertEquals(70, get_row('BFFFBBFRRR'));
        self::assertEquals(14, get_row('FFFBBBFRRR'));
        self::assertEquals(102, get_row('BBFFBBFRLL'));
    }

    public function test_get_column()
    {
        self::assertEquals(5, get_column('FBFBBFFRLR'));

        self::assertEquals(7, get_column('BFFFBBFRRR'));
        self::assertEquals(7, get_column('FFFBBBFRRR'));
        self::assertEquals(4, get_column('BBFFBBFRLL'));
    }

    public function test_get_seat_id()
    {
        self::assertEquals(357, get_seat_id('FBFBBFFRLR'));

        self::assertEquals(567, get_seat_id('BFFFBBFRRR'));
        self::assertEquals(119, get_seat_id('FFFBBBFRRR'));
        self::assertEquals(820, get_seat_id('BBFFBBFRLL'));
    }

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
