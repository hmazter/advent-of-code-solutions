<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    /**
     * @dataProvider polymersProvider
     */
    public function testReactPolymers(string $polymer, int $lenght)
    {
        $result = reactPolymers($polymer);
        self::assertEquals($lenght, strlen($result));
    }

    public function polymersProvider()
    {
        return [
            ['aA', 0],
            ['abBA', 0],
            ['abAB', 4],
            ['aabAAB', 6],
            ['aabAAB', 6],
            ['dabAcCaCBAcCcaDA', 10],
        ];
    }

    public function testRemoveAndReact()
    {
        self::assertEquals(4, removeAndReact('dabAcCaCBAcCcaDA'));
    }
}
