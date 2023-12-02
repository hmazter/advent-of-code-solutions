<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    public function test_parse_game()
    {
        $result = parse_game('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        self::assertEquals(1, $result['game']);
        self::assertEquals(4, $result['red']);
        self::assertEquals(2, $result['green']);
        self::assertEquals(6, $result['blue']);
    }

    /**
     * @dataProvider cube_count_provider
     */
    public function test_get_cube_count(string $input, string $color, int $expected)
    {
        self::assertEquals($expected, get_cube_count($input, $color));
    }

    public static function cube_count_provider()
    {
        return [
            ['3 blue, 4 red', 'blue', 3],
            ['3 blue, 4 red', 'red', 4],
            ['1 red, 2 green, 6 blue', 'red', 1],
            ['1 red, 2 green, 6 blue', 'green', 2],
            ['1 red, 2 green, 6 blue', 'blue', 6],
            ['2 green', 'green', 2],
        ];
    }

    public function test_part1()
    {
        $input = [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
        ];

        self::assertEquals(8, part1($input));
    }

    public function test_part2()
    {
        $input = [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
        ];

        self::assertEquals(2286, part2($input));
    }

    public function test_count_power_of_cubes()
    {
        self::assertEquals(48, count_power_of_cubes(['red' => 4, 'green' => 2, 'blue' => 6]));
        self::assertEquals(12, count_power_of_cubes(['red' => 1, 'green' => 3, 'blue' => 4]));
        self::assertEquals(1560, count_power_of_cubes(['red' => 20, 'green' => 13, 'blue' => 6]));
    }
}
