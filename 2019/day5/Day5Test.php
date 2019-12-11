<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    /**
     * @dataProvider code_provider
     */
    public function test_parse_code($code, $result)
    {
        $opcode = parse_code($code);

        self::assertEquals($result, $opcode);
    }

    public function code_provider()
    {
        yield [1002, [2, 0, 1, 0]];
        yield [1001, [1, 0, 1, 0]];
        yield [11001, [1, 0, 1, 1]];
        yield [2, [2, 0, 0, 0]];
    }

    public function test_execute()
    {
        $program = [1002,4,3,4,33];

        $diagnostic = execute($program, 1);

        self::assertEquals(0, $diagnostic);
    }

    public function test_execute_part_2()
    {
        $program = [3,21,1008,21,8,20,1005,20,22,107,8,21,20,1006,20,31,
            1106,0,36,98,0,0,1002,21,125,20,4,20,1105,1,46,104,
            999,1105,1,46,1101,1000,1,20,4,20,1105,1,46,98,99];

        self::assertEquals(999, execute($program, 7));
        self::assertEquals(1000, execute($program, 8));
        self::assertEquals(1001, execute($program, 9));
    }
}
