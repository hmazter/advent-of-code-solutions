<?php
declare(strict_types=1);

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    /** @test */
    public function testParseInput()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $sleep = parseInput($input);

        self::assertArrayHasKey(10, $sleep);
        self::assertArrayHasKey(99, $sleep);

        // guard 10 has slept 2 times on minute 24
        self::assertEquals(2, $sleep[10][24]);
    }

    /** @test */
    public function testCountTotalSleepPerGuard()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $sleep = parseInput($input);

        $totalSleep = countTotalSleepPerGuard($sleep);

        self::assertEquals(50, $totalSleep[10]);
        self::assertEquals(30, $totalSleep[99]);
    }

    /** @test */
    public function testGetGuardWithMostSleep()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $sleep = parseInput($input);

        $totalSleep = countTotalSleepPerGuard($sleep);

        self::assertEquals(10, getGuardWithMostSleep($totalSleep));
    }

    /** @test */
    public function testMostSleptMinuteForGuard()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $sleep = parseInput($input);

        self::assertEquals(24, getMostSleptMinuteForGuard($sleep, 10));
    }

    /** @test */
    public function testGetGuardAndMinuteSleptMost()
    {
        $input = readRows(__DIR__ . '/example.txt');

        $sleep = parseInput($input);

        $result = getGuardAndMinuteSleptMost($sleep);

        self::assertEquals(99, $result['guard']);
        self::assertEquals(45, $result['minute']);
    }

    /** @test */
    public function testSolvePart1()
    {
        $input = readRows(__DIR__ . '/example.txt');
        self::assertEquals(240, solvePart1($input));
    }
}
