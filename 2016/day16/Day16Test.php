<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day16Test extends TestCase
{
    public function testDragonCurve()
    {
        self::assertEquals('100', dragonCurve('1'));
        self::assertEquals('001', dragonCurve('0'));
        self::assertEquals('11111000000', dragonCurve('11111'));
        self::assertEquals('1111000010100101011110000', dragonCurve('111100001010'));
    }

    public function testGetData()
    {
        self::assertEquals('10000011110010000111', getData('10000', 20));
    }

    public function testCalculateChecksum()
    {
        self::assertEquals('100', calculateChecksum('110010110100'));
        self::assertEquals('01100', calculateChecksum('10000011110010000111'));
    }
}
