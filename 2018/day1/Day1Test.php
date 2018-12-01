<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    /** @test */
    public function it_can_replace_newline_and_comma_in_the_inputs()
    {
        self::assertEquals('+1+1-2', replaceNewlineAndComma('+1, +1, -2'));

        self::assertEquals('+1+1-2', replaceNewlineAndComma("+1\n+1\n-2"));
    }

    /**
     * @test
     * @dataProvider examplePart1Provider
     * @param int $answer
     * @param string $string
     */
    public function count_the_total_in_example_cases(int $answer, string $string)
    {
        self::assertEquals($answer, countTotal($string));
    }

    public function examplePart1Provider()
    {
        return [
            [3, '+1, -2, +3, +1'],
            [3, '+1, +1, +1'],
            [0, '+1, +1, -2'],
            [-6, '-1, -2, -3'],
        ];
    }

    /**
     * @test
     * @dataProvider examplePart2Provider
     * @param int $answer
     * @param string $input
     */
    public function it_can_find_the_first_frequency_repeated_twice(int $answer, string $input)
    {
        self::assertEquals($answer, firstFrequencyTwice($input));
    }

    public function examplePart2Provider()
    {
        return [
            [0, "+1\n-1"],
            [10, "+3\n+3\n+4\n-2\n-4"],
            [5, "-6\n+3\n+8\n+5\n-6"],
            [14, "+7\n+7\n-2\n-7\n-4"],
        ];
    }
}
