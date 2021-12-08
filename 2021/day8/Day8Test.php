<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day8Test extends TestCase
{
    public function test_solve_part1()
    {
        $input = readRows(__DIR__ . '/example');
        self::assertEquals(26, solve_part1($input));
    }

    public function test_solve_part2()
    {
        $input = readRows(__DIR__ . '/example');
        self::assertEquals(61229, solve_part2($input));
    }

    public function test_parse_input_row_output_values()
    {
        $row = parse_input_row('be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe');
        self::assertEquals(['fdgacbe', 'cefdb', 'cefbgd', 'gcbe'], $row['output']);
    }

    public function test_parse_input_row_patterns()
    {
        $row = parse_input_row('be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe');
        self::assertEquals(
            ['be', 'cfbegad', 'cbdgef', 'fgaecd', 'cgeb', 'fdcge', 'agebfd', 'fecdb', 'fabcd', 'edb'],
            $row['patterns']);
    }

    public function test_create_lookup_table()
    {
        $patterns = ['acedgfb', 'cdfbe', 'gcdfa', 'fbcad', 'dab', 'cefabd', 'cdfgeb', 'eafb', 'cagedb', 'ab'];
        $expected = [
            1 => 'ab',
            4 => 'eafb',
            '4-1' => 'ef',
        ];

        self::assertEquals($expected, create_lookup_table($patterns));
    }

    public function test_contains()
    {
        self::assertTrue(contains('cefabd', 'eafb'));
    }

    /**
     * @dataProvider get_number_from_pattern_provider
     */
    public function test_get_number_from_pattern($pattern, $expected)
    {
        $lookup = [
            1 => 'ab',
            4 => 'eafb',
            '4-1' => 'ef',
        ];

        self::assertEquals($expected, get_number_from_pattern($lookup, $pattern));
    }

    public function get_number_from_pattern_provider()
    {
        return [
            ['acedgfb', 8],
            ['cdfbe', 5],
            ['gcdfa', 2],
            ['fbcad', 3],
            ['dab', 7],
            ['cefabd', 9],
            ['cdfgeb', 6],
            ['eafb', 4],
            ['cagedb', 0],
            ['ab', 1],
        ];
    }
}
