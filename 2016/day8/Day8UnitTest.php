<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/functions.php';

class Day8UnitTest extends TestCase
{
    public function testCreateScreen()
    {
        $screen = createScreen(7, 3);
        self::assertCount(3, $screen);
        self::assertCount(7, $screen[0]);
        self::assertEquals(0, $screen[0][0]);
    }

    /**
     * ###....
     * ###....
     * .......
     */
    public function testTurnOn()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);

        self::assertEquals(1, $screen[0][0]);
        self::assertEquals(1, $screen[0][1]);
        self::assertEquals(1, $screen[0][2]);
        self::assertEquals(0, $screen[0][3]);

        self::assertEquals(1, $screen[1][0]);
        self::assertEquals(1, $screen[1][1]);
        self::assertEquals(1, $screen[1][2]);
        self::assertEquals(0, $screen[1][3]);

        self::assertEquals(0, $screen[2][0]);
        self::assertEquals(0, $screen[2][1]);
        self::assertEquals(0, $screen[2][2]);
        self::assertEquals(0, $screen[2][3]);
    }

    /**
     * #.#....
     * ###....
     * .#.....
     */
    public function testRotateColumn()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);
        rotateColumn($screen, 1, 1);

        self::assertEquals(1, $screen[0][0]);
        self::assertEquals(0, $screen[0][1]);
        self::assertEquals(1, $screen[0][2]);
        self::assertEquals(0, $screen[0][3]);

        self::assertEquals(1, $screen[1][0]);
        self::assertEquals(1, $screen[1][1]);
        self::assertEquals(1, $screen[1][2]);
        self::assertEquals(0, $screen[1][3]);

        self::assertEquals(0, $screen[2][0]);
        self::assertEquals(1, $screen[2][1]);
        self::assertEquals(0, $screen[2][2]);
        self::assertEquals(0, $screen[2][3]);
    }

    /**
     * ###....
     * #.#....
     * .#.....
     */
    public function testRotateColumnWrapAround()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);
        rotateColumn($screen, 1, 2);

        self::assertEquals(1, $screen[0][0]);
        self::assertEquals(1, $screen[0][1]);
        self::assertEquals(1, $screen[0][2]);
        self::assertEquals(0, $screen[0][3]);

        self::assertEquals(1, $screen[1][0]);
        self::assertEquals(0, $screen[1][1]);
        self::assertEquals(1, $screen[1][2]);
        self::assertEquals(0, $screen[1][3]);

        self::assertEquals(0, $screen[2][0]);
        self::assertEquals(1, $screen[2][1]);
        self::assertEquals(0, $screen[2][2]);
        self::assertEquals(0, $screen[2][3]);
    }

    /**
     * ....###
     * ###....
     * .......
     */
    public function testRotateRow()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);
        rotateRow($screen, 0, 4);

        self::assertEquals(0, $screen[0][0]);
        self::assertEquals(0, $screen[0][1]);
        self::assertEquals(0, $screen[0][2]);
        self::assertEquals(0, $screen[0][3]);
        self::assertEquals(1, $screen[0][4]);
        self::assertEquals(1, $screen[0][5]);
        self::assertEquals(1, $screen[0][6]);

        self::assertEquals(1, $screen[1][0]);
        self::assertEquals(1, $screen[1][1]);
        self::assertEquals(1, $screen[1][2]);
        self::assertEquals(0, $screen[1][3]);

        self::assertEquals(0, $screen[2][0]);
        self::assertEquals(0, $screen[2][1]);
        self::assertEquals(0, $screen[2][2]);
        self::assertEquals(0, $screen[2][3]);
    }

    /**
     * #....##
     * ###....
     * .......
     */
    public function testRotateRowWrapAround()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);
        rotateRow($screen, 0, 5);

        self::assertEquals(1, $screen[0][0]);
        self::assertEquals(0, $screen[0][1]);
        self::assertEquals(0, $screen[0][2]);
        self::assertEquals(0, $screen[0][3]);
        self::assertEquals(0, $screen[0][4]);
        self::assertEquals(1, $screen[0][5]);
        self::assertEquals(1, $screen[0][6]);

        self::assertEquals(1, $screen[1][0]);
        self::assertEquals(1, $screen[1][1]);
        self::assertEquals(1, $screen[1][2]);
        self::assertEquals(0, $screen[1][3]);

        self::assertEquals(0, $screen[2][0]);
        self::assertEquals(0, $screen[2][1]);
        self::assertEquals(0, $screen[2][2]);
        self::assertEquals(0, $screen[2][3]);
    }

    public function testCountLitPixels()
    {
        $screen = createScreen(7, 3);
        turnOn($screen, 3, 2);

        self::assertEquals(6, countLitPixels($screen));
    }
}
