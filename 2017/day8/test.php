<?php
declare(strict_types=1);

require_once './functions.php';

class Day8Test extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function parseInstruction()
    {
        $result = parseInstruction('b inc 5 if a > 1');

        self::assertEquals('b', $result['register']);
        self::assertEquals('inc', $result['operation']);
        self::assertEquals('5', $result['value']);
        self::assertEquals('a', $result['condition']['register']);
        self::assertEquals('>', $result['condition']['operator']);
        self::assertEquals('1', $result['condition']['value']);
    }

    /**
     * @test
     * @dataProvider evaluateConditionProvider
     * @param bool $expected
     * @param array $register
     * @param array $condition
     */
    public function evaluateCondition(bool $expected, array $register, array $condition)
    {
        self::assertEquals($expected, evaluateCondition($condition, $register));
    }

    public function evaluateConditionProvider()
    {
        return [
            [false, [], ['register' => 'a', 'operator' => '>', 'value' => '5']],
            [false, ['a' => 0], ['register' => 'a', 'operator' => '>', 'value' => '5']],

            [true, [], ['register' => 'b', 'operator' => '<', 'value' => '5']],
            [true, ['a' => 0], ['register' => 'b', 'operator' => '<', 'value' => '5']],

            [true, ['a' => 1], ['register' => 'a', 'operator' => '>=', 'value' => '1']],
        ];
    }

    /**
     * @test
     */
    public function runInstruction_set1()
    {
        $register = [];

        runInstruction('b inc 5 if a > 1', $register);

        self::assertEmpty($register);
    }

    /**
     * @test
     */
    public function runInstruction_set2()
    {
        $register = [];

        runInstruction('a inc 1 if b < 5', $register);

        self::assertArrayHasKey('a', $register);
        self::assertEquals(1, $register['a']);
    }

    /**
     * @test
     */
    public function runInstruction_set3()
    {
        $register = ['a' => 1];

        runInstruction('c dec -10 if a >= 1', $register);

        self::assertArrayHasKey('a', $register);
        self::assertEquals(1, $register['a']);

        self::assertArrayHasKey('c', $register);
        self::assertEquals(10, $register['c']);
    }

    /**
     * @test
     */
    public function solveDay8()
    {
        $input = [
            'b inc 5 if a > 1',
            'a inc 1 if b < 5',
            'c dec -10 if a >= 1',
            'c inc -20 if c == 10',
        ];

        solveDay8($input, $endMax, $runningMax);
        self::assertEquals(1, $endMax);
        self::assertEquals(10, $runningMax);
    }
}
