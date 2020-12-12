<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    public function test_part1(): void
    {
        $input = readRows(__DIR__ . '/example.txt');

        self::assertEquals(25, day12_part1($input));
    }

    public function test_part2(): void
    {
        $input = readRows(__DIR__ . '/example.txt');

        self::assertEquals(286, day12_part2($input));
    }

    public function test_parse_instruction(): void
    {
        self::assertEquals(['F', 7], parse_instruction('F7'));
        self::assertEquals(['R', 90], parse_instruction('R90'));
    }
}
