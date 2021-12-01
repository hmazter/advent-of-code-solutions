<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    private array $input = [199,
        200,
        208,
        210,
        200,
        207,
        240,
        269,
        260,
        263
    ];

    public function test_count_number_of_depth_increases()
    {
        self::assertEquals(7, count_number_of_depth_increases($this->input));
    }

    public function test_count_number_of_depth_increases_sliding_window()
    {
        self::assertEquals(5, count_number_of_depth_increases_sliding_window($this->input));
    }
}
