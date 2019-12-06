<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    private array $input = [
        'COM)B',
        'C)D',
        'B)C',
        'D)E',
        'E)F',
        'B)G',
        'G)H',
        'D)I',
        'E)J',
        'J)K',
        'K)L',
    ];

    public function test_get_orbit_count()
    {
        $galaxy = build_galaxy($this->input);

        self::assertEquals(3, $galaxy->getBody('D')->getOrbitCount());
        self::assertEquals(7, $galaxy->getBody('L')->getOrbitCount());
        self::assertEquals(0, $galaxy->getBody('COM')->getOrbitCount());
    }

    public function test_get_total_orbit_count()
    {
        $galaxy = build_galaxy($this->input);

        self::assertEquals(42, $galaxy->getTotalOrbitCount());
    }
}
