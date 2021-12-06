<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    public function test_count_lanternfish_18_days()
    {
        self::assertEquals(
            26,
            count_lanternfish([3, 4, 3, 1, 2], 18)
        );
    }

    public function test_count_lanternfish_80_days()
    {
        self::assertEquals(
            5934,
            count_lanternfish([3, 4, 3, 1, 2], 80)
        );
    }

    public function test_count_lanternfish_256_days()
    {
        self::assertEquals(
            26984457539,
            count_lanternfish([3, 4, 3, 1, 2], 256)
        );
    }
}
