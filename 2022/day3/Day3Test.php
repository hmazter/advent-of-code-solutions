<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    private array $input = [
        'vJrwpWtwJgWrhcsFMMfFFhFp',
        'jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL',
        'PmmdzqPrVvPwwTWBwg',
        'wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn',
        'ttgJtRGJQctTZtZT',
        'CrZsJsPPZsGzwwsLwLmpwMDw',
    ];

    /** @test */
    public function part1()
    {
        self::assertEquals(157, part1($this->input));
    }

    /** @test */
    public function part2()
    {
        self::assertEquals(70, part2($this->input));
    }

    /**
     * @test
     * @dataProvider rucksack_provider
     */
    public function get_priority_for_rucksack(string $rucksack, int $expectedPriority)
    {
        self::assertEquals($expectedPriority, get_priority_for_rucksack($rucksack));
    }

    public function rucksack_provider()
    {
        return [
            ['vJrwpWtwJgWrhcsFMMfFFhFp', 16],
            ['jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL', 38],
            ['PmmdzqPrVvPwwTWBwg', 42],
            ['wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn', 22],
            ['ttgJtRGJQctTZtZT', 20],
            ['CrZsJsPPZsGzwwsLwLmpwMDw', 19],
        ];
    }

    /** @test */
    public function get_priority_for_group()
    {
        $group = [
            'vJrwpWtwJgWrhcsFMMfFFhFp',
            'jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL',
            'PmmdzqPrVvPwwTWBwg',
        ];

        self::assertEquals(18, get_priority_for_group($group));
    }
}
