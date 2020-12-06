<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    public function test_get_chunks(): void
    {
        $chunks = get_chunks(readFileContent(__DIR__ . '/example.txt'));

        self::assertEquals(['abc'], $chunks[0]);
        self::assertEquals(['a', 'b', 'c'], $chunks[1]);
        self::assertEquals(['ab', 'ac'], $chunks[2]);
        self::assertEquals(['a', 'a', 'a', 'a'], $chunks[3]);
        self::assertEquals(['b'], $chunks[4]);
    }

    public function test_sum_unique_in_chunks(): void
    {
        self::assertEquals(11, sum_unique_in_chunks(readFileContent(__DIR__ . '/example.txt')));
    }

    public function test_sum_intersection_in_chunks(): void
    {
        self::assertEquals(6, sum_intersection_in_chunks(readFileContent(__DIR__ . '/example.txt')));
    }
}
