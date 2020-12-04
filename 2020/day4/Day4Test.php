<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    private array $passports;

    protected function setUp(): void
    {
        parent::setUp();

        $this->passports = get_passports(file(__DIR__ . '/test.txt', FILE_IGNORE_NEW_LINES));
    }

    public function test_get_passports(): void
    {
        $passports = $this->passports;

        self::assertCount(4, $passports);

        self::assertEquals('1937', $passports[0]['byr']);
        self::assertEquals('183cm', $passports[0]['hgt']);
        self::assertEquals('gry', $passports[0]['ecl']);

        self::assertEquals('1929', $passports[1]['byr']);
        self::assertEquals('amb', $passports[1]['ecl']);
        self::assertEquals('028048884', $passports[1]['pid']);
        self::assertArrayNotHasKey('hgt', $passports[1]);

        self::assertEquals('59in', $passports[3]['hgt']);
        self::assertArrayNotHasKey('cid', $passports[3]);
        self::assertArrayNotHasKey('byr', $passports[3]);
    }

    public function test_is_valid_passport_without_validate(): void
    {
        self::assertTrue(is_valid_passport($this->passports[0], false));
        self::assertTrue(is_valid_passport($this->passports[2], false));

        self::assertFalse(is_valid_passport($this->passports[1], false));
        self::assertFalse(is_valid_passport($this->passports[3], false));
    }

    public function test_is_valid_passport_with_valudate(): void
    {
        self::assertFalse(is_valid_passport([
            'eyr' => '1972',
            'cid' => '100',
            'hcl' => '#18171d',
            'ecl' => 'amb',
            'hgt' => '170',
            'pid' => '186cm',
            'iyr' => '2018',
            'byr' => '1926'
        ], true));

        self::assertTrue(is_valid_passport([
            'pid' => '087499704',
            'hgt' => '74in',
            'ecl' => 'grn',
            'iyr' => '2012',
            'eyr' => '2030',
            'byr' => '1980',
            'hcl' => '#623a2f',
        ], true));
    }

    public function test_is_valid_byr(): void
    {
        self::assertTrue(is_valid_byr(2002));
        self::assertFalse(is_valid_byr(2003));
    }

    public function test_is_valid_iyr(): void
    {
        self::assertTrue(is_valid_iyr(2020));
        self::assertFalse(is_valid_iyr(2003));
    }

    public function test_is_valid_hcl(): void
    {
        self::assertTrue(is_valid_hcl('#123abc'));

        self::assertFalse(is_valid_hcl('#123abz'));
        self::assertFalse(is_valid_hcl('123abc'));
    }

    public function test_is_valid_ecl(): void
    {
        self::assertTrue(is_valid_ecl('brn'));
        self::assertFalse(is_valid_ecl('wat'));
    }

    public function test_is_valid_pid(): void
    {
        self::assertTrue(is_valid_pid('000000001'));
        self::assertFalse(is_valid_pid('0123456789'));
    }

    public function test_is_valid_hgt(): void
    {
        self::assertTrue(is_valid_hgt('60in'));
        self::assertTrue(is_valid_hgt('190cm'));

        self::assertFalse(is_valid_hgt('190in'));
        self::assertFalse(is_valid_hgt('190'));
    }
}
