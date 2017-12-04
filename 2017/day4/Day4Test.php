<?php
declare(strict_types=1);

require_once './functions.php';

class Day4Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider isValidPassPhrasePart1Provider
     * @param array $input
     * @param bool $valid
     */
    public function isValidPassPhrasePart1(array $input, bool $valid)
    {
        self::assertEquals($valid, isValidPassPhrasePart1($input));
    }

    public function isValidPassPhrasePart1Provider()
    {
        return [
            [['aa', 'bb', 'cc', 'dd', 'ee'], true],
            [['aa', 'bb', 'cc', 'dd', 'aa'], false],
            [['aa', 'bb', 'cc', 'dd', 'aaa'], true],
        ];
    }

    /**
     * @test
     * @dataProvider isAnagramProvider
     * @param string $word1
     * @param string $word2
     * @param bool $isAnagram
     */
    public function isAnagram(string $word1, string $word2, bool $isAnagram)
    {
        self::assertEquals($isAnagram, isAnagram($word1, $word2));
    }

    public function isAnagramProvider()
    {
        return [
            ['abcde', 'fghij', false],
            ['abcde', 'ecdab', true],
            ['iiii', 'oiii', false],
        ];
    }

    /**
     * @test
     * @dataProvider isValidPassPhrasePart2Provider
     * @param array $input
     * @param bool $valid
     */
    public function isValidPassPhrasePart2(array $input, bool $valid)
    {
        self::assertEquals($valid, isValidPassPhrasePart2($input));
    }

    public function isValidPassPhrasePart2Provider()
    {
        return [
            [['abcde', 'fghij'], true],
            [['abcde', 'xyz', 'ecdab'], false],
            [['a', 'ab', 'abc', 'abd', 'abf', 'abj'], true],
            [['iiii', 'oiii', 'ooii', 'oooi', 'oooo'], true],
            [['oiii', 'ioii', 'iioi', 'iiio'], false],
        ];
    }
}