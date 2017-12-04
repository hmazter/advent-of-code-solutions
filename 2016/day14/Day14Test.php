<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day14Test extends TestCase
{
    public function testHasTriplet()
    {
        self::assertEquals('8', hasTriplet(md5('abc18')));
    }

    public function testHasFive()
    {
        self::assertTrue(hasFive('abc77777cba', '7'));
        self::assertTrue(hasFive('77777cba', '7'));
        self::assertTrue(hasFive('abc77777', '7'));
    }

    public function testHashTimes()
    {
        self::assertContains('a107ff', hashTimes('abc0', 2016));
    }

    public function testFillHashes()
    {
        $salt = 'abc';
        $hashes = [];

        fillHashes($hashes, $salt, 0, 1);
        self::assertCount(1, $hashes);
        self::assertEquals(md5($salt . '0'), $hashes[0]);

        fillHashes($hashes, $salt, 1, 2);
        self::assertCount(2, $hashes);
        self::assertEquals(md5($salt . '1'), $hashes[1]);

        fillHashes($hashes, $salt, 2, 2);
        self::assertCount(4, $hashes);
        self::assertEquals(md5($salt . '2'), $hashes[2]);
        self::assertEquals(md5($salt . '3'), $hashes[3]);
    }

    public function testFillHashesWithStretching()
    {
        $salt = 'abc';
        $hashes = [];

        fillHashes($hashes, $salt, 0, 1, true);
        self::assertCount(1, $hashes);
        self::assertEquals(hashTimes($salt . '0', 2016), $hashes[0]);
    }
}
