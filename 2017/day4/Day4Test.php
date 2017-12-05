<?php
declare(strict_types=1);

require_once './functions.php';

class Day4Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider isValidPassPhrase_part1
     * @param array $input
     * @param bool $valid
     */
    public function isValidPassPhrase_part1(array $input, bool $valid)
    {
        self::assertEquals($valid, isValidPassPhrase($input, false));
    }

    public function isValidPassPhrase_part1Provider()
    {
        return [
            [['aa', 'bb', 'cc', 'dd', 'ee'], true],
            [['aa', 'bb', 'cc', 'dd', 'aa'], false],
            [['aa', 'bb', 'cc', 'dd', 'aaa'], true],
        ];
    }

    /**
     * @test
     * @dataProvider isValidPassPhrase_part2Provider
     * @param array $input
     * @param bool $valid
     */
    public function isValidPassPhrase_part2(array $input, bool $valid)
    {
        self::assertEquals($valid, isValidPassPhrase($input, true));
    }

    public function isValidPassPhrase_part2Provider()
    {
        return [
            [['abcde', 'fghij'], true],
            [['abcde', 'xyz', 'ecdab'], false],
            [['a', 'ab', 'abc', 'abd', 'abf', 'abj'], true],
            [['iiii', 'oiii', 'ooii', 'oooi', 'oooo'], true],
            [['oiii', 'ioii', 'iioi', 'iiio'], false],
        ];
    }

    /**
     * @test
     * @dataProvider str_sortProvider
     * @param string $expected
     * @param string $input
     */
    public function str_sort(string $expected, string $input)
    {
        self::assertEquals($expected, str_sort($input));
    }

    public function str_sortProvider()
    {
        return [
            ['abc', 'acb'],
            ['aaa', 'aaa'],
            ['abc', 'cba'],
        ];
    }
}
