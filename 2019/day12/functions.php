<?php
declare(strict_types=1);

/**
 * @param array|Moon[] $moons
 * @param int $steps
 * @return int
 */
function solve_part1(array $moons, int $steps): int
{
    //print_step($moons, 0);
    for ($i = 0; $i < $steps; $i++) {
        foreach ($moons as $moon) {
            $moon->calculateVelocity($moons);
        }

        foreach ($moons as $moon) {
            $moon->move();
        }

        //print_step($moons, $i + 1);
    }

    $energy = 0;
    foreach ($moons as $moon) {
        $energy += $moon->getTotalEnergy();
    }

    return $energy;
}

/**
 * @param array|Moon[] $moons
 * @return int
 */
function solve_part2(array $moons): int
{
    //print_step($moons, 0);
    $history = [];
    $history[generate_hash($moons)] = true;

    $i = 0;
    while (true) {
        $i++;

//        if ($i % 1_000_000 === 0) {
//            echo 'step ' . ($i / 1_000_000) . ' M' . PHP_EOL;
//        }
        if ($i === 1_000_000) {
            return $i;
        }

        foreach ($moons as $moon) {
            $moon->calculateVelocity($moons);
        }

        foreach ($moons as $moon) {
            $moon->move();
        }

        // calculate the new history hash and see if we have had it before
        // in that case return the number of steps it took
        $hash = generate_hash($moons);
        if (isset($history[$hash])) {
            return $i;
        }

        $history[$hash] = true;
    }

    return 0;
}

function print_step(array $moons, int $step)
{
    echo "After $step steps:" . PHP_EOL;
    foreach ($moons as $moon) {
        echo ($moon) . PHP_EOL;
    }
    echo PHP_EOL;
}

function generate_hash(array $moons)
{
    return md5($moons[0].$moons[1].$moons[2].$moons[3]);
}

class Moon
{
    public int $pos_x;
    public int $pos_y;
    public int $pos_z;

    public int $vel_x = 0;
    public int $vel_y = 0;
    public int $vel_z = 0;

    public function __construct(int $x, int $y, int $z)
    {
        $this->pos_x = $x;
        $this->pos_y = $y;
        $this->pos_z = $z;
    }

    /**
     * @param array|Moon[] $moons
     */
    public function calculateVelocity(array &$moons)
    {
        foreach ($moons as $moon) {
            if ($this == $moon) {
                // don't compare to itself
                continue;
            }

            $this->vel_x = $this->vel_x + ($moon->pos_x <=> $this->pos_x);
            $this->vel_y = $this->vel_y + ($moon->pos_y <=> $this->pos_y);
            $this->vel_z = $this->vel_z + ($moon->pos_z <=> $this->pos_z);
        }
        // foreach moon
        // if not this
        // compare pos values and inc/dec velocity on each x, y, z
    }

    public function move()
    {
        // update pos x, y, z according to vel x, y, z
        $this->pos_x += $this->vel_x;
        $this->pos_y += $this->vel_y;
        $this->pos_z += $this->vel_z;
    }

    public function getPotentialEnergy(): int
    {
        return abs($this->pos_x) + abs($this->pos_y) + abs($this->pos_z);
    }

    public function getKineticEnergy(): int
    {
        return abs($this->vel_x) + abs($this->vel_y) + abs($this->vel_z);
    }

    public function getTotalEnergy(): int
    {
        return $this->getPotentialEnergy() * $this->getKineticEnergy();
    }

    public function getKey(): string
    {
        return "$this->pos_x,$this->pos_y,$this->pos_z,$this->vel_x,$this->vel_y,$this->vel_z";
    }

    public function __toString()
    {
//        return "$this->pos_x,$this->pos_y,$this->pos_z,$this->vel_x,$this->vel_y,$this->vel_z";
        return "pos=<x=$this->pos_x, y=$this->pos_y, z=$this->pos_z>, vel=<x=$this->vel_x, y=$this->vel_y, z=$this->vel_z>";
    }
}