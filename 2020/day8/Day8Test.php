<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day8Test extends TestCase
{
    public function test_parse_instruction(): void
    {
        self::assertSame(['jmp', -3], parse_instruction('jmp -3'));
        self::assertSame(['acc', 99], parse_instruction('acc +99'));
    }

    public function test_run_instructions(): void
    {
        $instructions = readRows(__DIR__ . '/example.txt');
        self::assertEquals(5, run_instructions($instructions));
    }

    public function test_run_instructions_throws_exception_for_infinite_loop(): void
    {
        $instructions = readRows(__DIR__ . '/example.txt');
        $this->expectException(InfiniteLoopException::class);
        run_instructions($instructions, true);
    }

    public function test_modify_to_exit_and_run_instructions(): void
    {
        $instructions = readRows(__DIR__ . '/example.txt');
        self::assertEquals(8, modify_to_exit_and_run_instructions($instructions));
    }
}
