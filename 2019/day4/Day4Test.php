<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    /**
     * @dataProvider double_digits_provider
     */
    public function test_has_double_digits(bool $expected, int $number)
    {
        self::assertEquals($expected, has_double_digits($number));
    }

    public function double_digits_provider()
    {
        yield [true, 111111];
        yield [true, 223450];
        yield [false, 123789];
    }

    /**
     * @dataProvider never_decreases_provider
     */
    public function test_never_decreases(bool $expected, int $number)
    {
        self::assertEquals($expected, never_decreases($number));
    }

    public function never_decreases_provider()
    {
        yield [true, 111111];
        yield [false, 223450];
        yield [true, 123789];
    }

    /**
     * @dataProvider is_valid_password_provider
     */
    public function test_is_valid_password(bool $expected, int $number)
    {
        self::assertEquals($expected, is_valid_password($number, false));
    }

    public function is_valid_password_provider()
    {
        yield [true, 111111];
        yield [false, 223450];
        yield [false, 123789];
    }

    /**
     * @dataProvider is_valid_password_part2_provider
     */
    public function test_is_valid_password_part_2(bool $expected, int $number)
    {
        self::assertEquals($expected, is_valid_password($number, true));
    }

    public function is_valid_password_part2_provider()
    {
        yield [true, 112233];
        yield [false, 123444];
        yield [true, 111122];
    }

    /**
     * @dataProvider has_double_digits_but_not_in_larger_group_provider
     */
    public function test_has_double_digits_but_not_in_larger_group(bool $expected, int $number)
    {
        self::assertEquals($expected, has_double_digits_but_not_in_larger_group($number));
    }

    public function has_double_digits_but_not_in_larger_group_provider()
    {
        yield [true, 112233];
        yield [false, 123444];
        yield [true, 111122];
        yield [true, 112222];
        yield [false, 111222];
    }
}
