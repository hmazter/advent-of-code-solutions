<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    public function test_get_difference_distribution_example(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example.txt'));

        $diff = get_difference_distribution($input);
        self::assertEquals([1 => 7, 3 => 5], $diff);
    }

    public function test_get_difference_distribution_example2(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example2.txt'));

        $diff = get_difference_distribution($input);
        self::assertEquals([1 => 22, 3 => 10], $diff);
    }

    public function test_part1_example(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example.txt'));
        self::assertEquals(35, part1($input));
    }

    public function test_part1_example2(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example2.txt'));
        self::assertEquals(220, part1($input));
    }
}
