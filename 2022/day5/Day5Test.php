<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    private array $stacks = [
        1 => ['Z', 'N'],
        2 => ['M', 'C', 'D'],
        3 => ['P'],
    ];

    private array $instructions = [
        'move 1 from 2 to 1',
        'move 3 from 1 to 3',
        'move 2 from 2 to 1',
        'move 1 from 1 to 2',
    ];

    public function test_part1()
    {
        self::assertEquals('CMZ', part1($this->stacks, $this->instructions));
    }

    public function test_part2()
    {
        self::assertEquals('MCD', part2($this->stacks, $this->instructions));
    }
}
