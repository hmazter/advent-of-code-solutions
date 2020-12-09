<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day9Test extends TestCase
{
    public function test_find_invalid_number(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example.txt'));

        self::assertSame(127, find_invalid_number($input, 5));
    }

    public function test_find_sum_of_min_and_max_in_a_contiguous_set(): void
    {
        $input = toIntArray(readRows(__DIR__ . '/example.txt'));
        self::assertSame(62, find_sum_of_min_and_max_in_a_contiguous_set($input, 5));
    }

    public function test_is_valid(): void
    {
        $preamble = [20, ...range(1, 19), ...range(21, 25)];

        self::assertTrue(is_valid(26, $preamble));
        self::assertTrue(is_valid(49, $preamble));

        self::assertFalse(is_valid(50, $preamble));
        self::assertFalse(is_valid(100, $preamble));
    }
}
