<?php
declare(strict_types=1);

require_once __DIR__ . '/day2_functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    public function testCountCharactersInString()
    {
        $result = countCharactersInString('bababc');

        self::assertEquals(3, $result['b']);
        self::assertEquals(2, $result['a']);
    }

    public function testHasCharacterOccurExactlyTwice()
    {
        self::assertFalse(hasCharacterOccurExactlyTwice('abcdef'));
        self::assertTrue(hasCharacterOccurExactlyTwice('bababc'));
        self::assertTrue(hasCharacterOccurExactlyTwice('abbcde'));
        self::assertFalse(hasCharacterOccurExactlyTwice('abcccd'));
        self::assertTrue(hasCharacterOccurExactlyTwice('abcdee'));
        self::assertFalse(hasCharacterOccurExactlyTwice('ababab'));
    }

    public function testHasCharacterOccurExactlyThreeTimes()
    {
        self::assertFalse(hasCharacterOccurExactlyThreeTimes('abcdef'));
        self::assertTrue(hasCharacterOccurExactlyThreeTimes('bababc'));
        self::assertFalse(hasCharacterOccurExactlyThreeTimes('abbcde'));
        self::assertTrue(hasCharacterOccurExactlyThreeTimes('abcccd'));
        self::assertFalse(hasCharacterOccurExactlyThreeTimes('abcdee'));
        self::assertTrue(hasCharacterOccurExactlyThreeTimes('ababab'));
    }

    public function testChecksum()
    {
        self::assertEquals(12, checksum([
            'abcdef',
            'bababc',
            'abbcde',
            'abcccd',
            'aabcdd',
            'abcdee',
            'ababab',
        ]));
    }

    public function testFindTwoMostSimilarWordsInAArray()
    {
        self::assertEquals(['fghij', 'fguij'], findTwoMostSimilarStringsInAArray([
            'abcde',
            'fghij',
            'klmno',
            'pqrst',
            'fguij',
            'axcye',
            'wvxyz',
        ]));
    }

    public function testFindEqualCharactersInTwoWords()
    {
        self::assertEquals('fgij', findEqualCharactersInTwoWords('fghij', 'fguij'));
    }
}
