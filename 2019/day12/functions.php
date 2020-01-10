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
    $steps = [];
    foreach (['x', 'y', 'z'] as $dimension) {
        $steps[] = calculate_steps_for_dimension($moons, $dimension);
    }

    return math_lcmm($steps);
}

/**
 * @param array|Moon[] $moons
 * @param string $dimension
 * @return int
 */
function calculate_steps_for_dimension(array $moons, string $dimension)
{
    $history = [];
    $history[generate_hash($moons, $dimension)] = true;

    $i = 0;
    while (true) {
        $i++;

        foreach ($moons as $moon) {
            $moon->calculateVelocity($moons);
        }

        foreach ($moons as $moon) {
            $moon->move();
        }

        // calculate the new history hash and see if we have had it before
        // in that case return the number of steps it took
        $hash = generate_hash($moons, $dimension);
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

/**
 * @param array|Moon[] $moons
 * @param string $dimension
 * @return string
 */
function generate_hash(array $moons, string $dimension)
{
    return $moons[0]->getKey($dimension) . $moons[1]->getKey($dimension) . $moons[2]->getKey($dimension) . $moons[3]->getKey($dimension);
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

    public function getKey(string $dimension)
    {
        switch ($dimension) {
            case 'x':
                return "$this->pos_x,$this->vel_x";
            case 'y':
                return "$this->pos_y,$this->vel_y";
            case 'z':
                return "$this->pos_z,$this->vel_z";
        }

        throw new RuntimeException("Invalid dimension: $dimension");
    }

    public function __toString()
    {
        return "pos=<x=$this->pos_x, y=$this->pos_y, z=$this->pos_z>, vel=<x=$this->vel_x, y=$this->vel_y, z=$this->vel_z>";
    }
}

// https://stackoverflow.com/q/12412782/1066234
function math_gcd(int $a, int $b)
{
    $a = abs($a);
    $b = abs($b);
    if ($a < $b) {
        [$b, $a] = [$a, $b];
    }
    if ($b == 0) {
        return $a;
    }
    $r = $a % $b;
    while ($r > 0) {
        $a = $b;
        $b = $r;
        $r = $a % $b;
    }
    return $b;
}

function math_lcm($a, $b)
{
    return ($a * $b / math_gcd($a, $b));
}

// https://stackoverflow.com/a/2641293/1066234
function math_lcmm($args)
{
    // Recursively iterate through pairs of arguments
    // i.e. lcm(args[0], lcm(args[1], lcm(args[2], args[3])))

    if (count($args) == 2) {
        return math_lcm($args[0], $args[1]);
    } else {
        $arg0 = array_shift($args);
        return math_lcm($arg0, math_lcmm($args));
    }
}
