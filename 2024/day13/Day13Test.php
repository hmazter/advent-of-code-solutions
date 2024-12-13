<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day13Test extends TestCase
{
    public function test_example_1()
    {
        $button_a = [94, 34];
        $button_b = [22, 67];
        $prize = [8400, 5400];

        self::assertEquals(280, calculate_cost_for_prize($button_a, $button_b, $prize));
    }

    public function test_example_2()
    {
        $button_a = [26, 66];
        $button_b = [67, 21];
        $prize = [12748, 12176];

        self::assertEquals(0, calculate_cost_for_prize($button_a, $button_b, $prize));
    }

    public function test_example_3()
    {
        $button_a = [17, 86];
        $button_b = [84, 37];
        $prize = [7870, 6450];

        self::assertEquals(200, calculate_cost_for_prize($button_a, $button_b, $prize));
    }

    public function test_example_1_part2()
    {
        $button_a = [94, 34];
        $button_b = [22, 67];
        $prize = [10000000008400, 10000000005400];

        self::assertEquals(280, calculate_cost_for_prize($button_a, $button_b, $prize));
    }
}
