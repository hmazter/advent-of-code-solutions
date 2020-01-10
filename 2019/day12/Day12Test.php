<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    /** @var array|Moon[] */
    private array $moons = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->moons = [
            new Moon(-1, 0, 2),
            new Moon(2, -10, -7),
            new Moon(4, -8, 8),
            new Moon(3, 5, -1),
        ];
    }

    public function test_get_energy()
    {
        $moon = new Moon(2, -3, 5);
        self::assertEquals(10, $moon->getPotentialEnergy());

        $moon->vel_x = 1;
        $moon->vel_y = -1;
        $moon->vel_z = 2;
        self::assertEquals(4, $moon->getKineticEnergy());

        self::assertEquals(40, $moon->getTotalEnergy());
    }

    public function test_calculate_velocity()
    {
        foreach ($this->moons as $moon) {
            $moon->calculateVelocity($this->moons);
            //echo (string)$moon . PHP_EOL;
        }

        self::assertEquals(3, $this->moons[0]->vel_x);
        self::assertEquals(-1, $this->moons[0]->vel_y);
        self::assertEquals(-1, $this->moons[0]->vel_z);

        self::assertEquals(1, $this->moons[1]->vel_x);
        self::assertEquals(3, $this->moons[1]->vel_y);
        self::assertEquals(3, $this->moons[1]->vel_z);

        self::assertEquals(-3, $this->moons[2]->vel_x);
        self::assertEquals(1, $this->moons[2]->vel_y);
        self::assertEquals(-3, $this->moons[2]->vel_z);

        self::assertEquals(-1, $this->moons[3]->vel_x);
        self::assertEquals(-3, $this->moons[3]->vel_y);
        self::assertEquals(1, $this->moons[3]->vel_z);
    }

    public function test_move()
    {
        foreach ($this->moons as $moon) {
            $moon->calculateVelocity($this->moons);
        }

        foreach ($this->moons as $moon) {
            $moon->move();
        }

        self::assertEquals('pos=<x=2, y=-1, z=1>, vel=<x=3, y=-1, z=-1>', (string)$this->moons[0]);
        self::assertEquals('pos=<x=3, y=-7, z=-4>, vel=<x=1, y=3, z=3>', (string)$this->moons[1]);
        self::assertEquals('pos=<x=1, y=-7, z=5>, vel=<x=-3, y=1, z=-3>', (string)$this->moons[2]);
        self::assertEquals('pos=<x=2, y=2, z=0>, vel=<x=-1, y=-3, z=1>', (string)$this->moons[3]);
    }

    public function test_solve_part1()
    {
        $energy = solve_part1($this->moons, 10);

        self::assertEquals(179, $energy);
    }

    public function test_solve_part2()
    {
        $steps = solve_part2($this->moons);

        self::assertEquals(2772, $steps);
    }
}
