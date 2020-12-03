<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    public function test_parse_row()
    {
        $result = parse_row('1-3 a: abcde');
        self::assertEquals(1, $result[1]);
        self::assertEquals(3, $result[2]);
        self::assertEquals('a', $result[3]);
        self::assertEquals('abcde', $result[4]);
    }

    public function test_is_valid_password_part_1()
    {
        self::assertTrue(is_valid_password_part_1('1-3 a: abcde'));
        self::assertTrue(is_valid_password_part_1('2-9 c: ccccccccc'));

        self::assertFalse(is_valid_password_part_1('1-3 b: cdefg'));
    }

    public function test_is_valid_password_part_2()
    {
        self::assertTrue(is_valid_password_part_2('1-3 a: abcde'));

        self::assertFalse(is_valid_password_part_2('1-3 b: cdefg'));
        self::assertFalse(is_valid_password_part_2('2-9 c: ccccccccc'));
    }
}
