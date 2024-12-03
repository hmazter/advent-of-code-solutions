<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    public function test_solve_instruction()
    {
        self::assertEquals(2024, solve_instruction('mul(44,46)'));
        self::assertEquals(492, solve_instruction('mul(123,4)'));
    }

    public function test_part1()
    {
        $input = 'xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))';

        self::assertEquals(161, part1($input));
    }

    public function test_part2()
    {
        $input = "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))";

        self::assertEquals(48, part2($input));
    }
}
