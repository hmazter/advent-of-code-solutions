<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day8Test extends TestCase
{
    private $input = '123456789012';

    public function test_create_layers()
    {
        $layers = create_layers(3, 2, $this->input);

        self::assertCount(2, $layers);
        self::assertEquals(1, $layers[0][0]);
        self::assertEquals(2, $layers[1][5]);
    }

    public function test_find_layer_with_least_amount_of_zeroes()
    {
        $layers = create_layers(3, 2, $this->input);

        $layer = find_layer_with_least_amount_of_zeroes($layers);
        self::assertEquals([1, 2, 3, 4, 5, 6], $layer);
    }

    public function test_multiply_ones_and_twos()
    {
        self::assertEquals(1, multiply_ones_and_twos([1, 2]));
        self::assertEquals(4, multiply_ones_and_twos([1, 1, 2, 2]));
        self::assertEquals(4, multiply_ones_and_twos([0, 0, 1, 1, 2, 2, 3, 4]));
    }

    public function test_solve_part_1()
    {
        self::assertEquals(1, solve_part_1(3, 2, $this->input));
    }

    public function test_find_color_for_each_pixel_in_layers()
    {
        $layers = create_layers(2, 2, '0222112222120000');

        $combined_layer = find_color_for_each_pixel_in_layers($layers);

        self::assertEquals([0, 1, 1, 0], $combined_layer);
    }
}
