<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day7Test extends TestCase
{
    public function test_parse_rules(): void
    {
        $input = readRows(__DIR__ . '/example.txt');

        $rules = parse_rules($input);

        self::assertArrayHasKey('light red', $rules);
        self::assertEquals(['bright white' => 1, 'muted yellow' => 2], $rules['light red']);

        self::assertArrayHasKey('bright white', $rules);
        self::assertEquals(['shiny gold' => 1], $rules['bright white']);

        self::assertArrayHasKey('faded blue', $rules);
        self::assertNull($rules['faded blue']);
    }

    public function test_can_contain(): void
    {
        $input = readRows(__DIR__ . '/example.txt');

        $rules = parse_rules($input);

        self::assertTrue(can_contain($rules, 'bright white', 'shiny gold'));
        self::assertTrue(can_contain($rules, 'muted yellow', 'shiny gold'));
        self::assertTrue(can_contain($rules, 'dark orange', 'shiny gold'));
        self::assertTrue(can_contain($rules, 'light red', 'shiny gold'));

        self::assertFalse(can_contain($rules, 'dark olive', 'shiny gold'));
        self::assertFalse(can_contain($rules, 'vibrant plum', 'shiny gold'));
        self::assertFalse(can_contain($rules, 'faded blue', 'shiny gold'));
        self::assertFalse(can_contain($rules, 'dotted black', 'shiny gold'));
        self::assertFalse(can_contain($rules, 'shiny gold', 'shiny gold'));
    }

    public function test_count_bags_that_eventually_can_contain_shiny_gold(): void
    {
        $input = readRows(__DIR__ . '/example.txt');
        $rules = parse_rules($input);

        self::assertEquals(4, count_bags_that_eventually_can_contain_shiny_gold($rules));
    }

    public function test_count_bags_inside(): void
    {
        $input = readRows(__DIR__ . '/example.txt');
        $rules = parse_rules($input);

        self::assertEquals(0, count_bags_inside($rules, 'faded blue'));
        self::assertEquals(0, count_bags_inside($rules, 'dotted black'));
        self::assertEquals(11, count_bags_inside($rules, 'vibrant plum'));
        self::assertEquals(7, count_bags_inside($rules, 'dark olive'));
        self::assertEquals(32, count_bags_inside($rules, 'shiny gold'));
    }

    public function test_count_bags_inside_2(): void
    {
        $input = readRows(__DIR__ . '/example2.txt');
        $rules = parse_rules($input);

        self::assertEquals(126, count_bags_inside($rules, 'shiny gold'));
    }

    public function test_count_bags_inside_shiny_gold_bag()
    {
        $input = readRows(__DIR__ . '/example.txt');
        $rules = parse_rules($input);

        self::assertEquals(32, count_bags_inside_shiny_gold_bag($rules));
    }
}
