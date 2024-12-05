<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    public function test_part1()
    {
        $input = parse_input(__DIR__ . '/example');

        self::assertEquals(18, part1($input));
    }

    public function test_part2()
    {
        $input = parse_input(__DIR__ . '/example');

        self::assertEquals(9, part2($input));
    }
}
