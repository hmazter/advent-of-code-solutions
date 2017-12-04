<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/functions.php';

class UnitTest extends TestCase
{
    /**
     * @test
     */
    public function getMarkerStart()
    {
        self::assertFalse(getMarkerStart('stringwithnomarker'));
        self::assertEquals(0, getMarkerStart('(test'));
        self::assertEquals(1, getMarkerStart('a(test'));
    }

    /**
     * @test
     */
    public function processMarker()
    {
        $response = processMarker('(3x3)XYZ');
        self::assertEquals(3, $response['repeat_times']);
        self::assertEquals('XYZ', $response['repeat_text']);
        self::assertEquals('', $response['remaining']);

        $response = processMarker('X(8x2)(3x3)ABCY');
        self::assertEquals(2, $response['repeat_times']);
        self::assertEquals('(3x3)ABC', $response['repeat_text']);
        self::assertEquals('Y', $response['remaining']);
    }

    /**
     * @test
     */
    public function decompressLength()
    {
        self::assertEquals(strlen('ABBBBBC'), decompress('A(1x5)BC', false));
        self::assertEquals(strlen('XYZXYZXYZ'), decompress('(3x3)XYZ', false));
        self::assertEquals(strlen('ABCBCDEFEFG'), decompress('A(2x2)BCD(2x2)EFG', false));
        self::assertEquals(strlen('(1x3)A'), decompress('(6x1)(1x3)A', false));
        self::assertEquals(strlen('X(3x3)ABC(3x3)ABCY'), decompress('X(8x2)(3x3)ABCY', false));

        self::assertEquals(9, decompress('(3x3)XYZ', true));
        self::assertEquals(strlen('XABCABCABCABCABCABCY'), decompress('X(8x2)(3x3)ABCY', true));
        self::assertEquals(241920, decompress('(27x12)(20x12)(13x14)(7x10)(1x12)A', true));
        self::assertEquals(445, decompress('(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', true));
    }
}
