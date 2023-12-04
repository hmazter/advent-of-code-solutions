<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    /**
     * @dataProvider calibration_value_provider
     */
    public function test_get_calibration_value($input, $expeccted)
    {
        $value = get_calibration_value($input);

        self::assertEquals($expeccted, $value);
    }

    public static function calibration_value_provider() {
        yield ['1abc2', 12];
        yield ['pqr3stu8vwx', 38];
        yield ['a1b2c3d4e5f', 15];
        yield ['treb7uchet', 77];
    }

    /**
     * @dataProvider calibration_value_spelled_out_provider
     */
    public function test_get_calibration_value_spelled_out($input, $expeccted)
    {
        $value = get_calibration_value_spelled_out($input, true);

        self::assertEquals($expeccted, $value);
    }

    public static function calibration_value_spelled_out_provider() {
        yield ['two1nine', 29];
        yield ['eightwothree', 83];
        yield ['abcone2threexyz', 13];
        yield ['xtwone3four', 24];
        yield ['4nineeightseven2', 42];
        yield ['zoneight234', 14];
        yield ['7pqrstsixteen', 76];

        yield ['2911threeninesdvxvheightwobm', 22];
        yield ['klpksqsggbrffive1tdsfptnvs72', 52];
        yield ['dhfbhone4fourlgzftg', 14];
    }
}
