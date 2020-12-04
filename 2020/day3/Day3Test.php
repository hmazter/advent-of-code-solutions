<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    public function test_count_trees(): void
    {
        $input = readRows(__DIR__ . '/test.txt');
        $map = parse_input($input);
        self::assertEquals(7, count_trees($map, 1, 3));
    }

    public function test_sum_paths(): void
    {
        $input = readRows(__DIR__ . '/test.txt');
        $map = parse_input($input);
        self::assertEquals(336, sum_paths($map));
    }
}
