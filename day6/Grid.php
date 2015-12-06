<?php

class Grid
{
    private $size;
    private $grid;

    /**
     * Grid constructor.
     */
    public function __construct($size)
    {
        $this->size = $size;
        $this->grid = [[]];

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $this->grid[$x][$y] = new Light(Light::OFF);
            }
        }
    }

    public function count()
    {
        $count = 0;
        for ($x = 0; $x < $this->size; $x++) {
            for ($y = 0; $y < $this->size; $y++) {
                /** @var Light $light */
                $light = $this->grid[$x][$y];
                if ($light->isOn()) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function turnOn($lowerX, $lowerY, $topX, $topY)
    {
        for ($x = $lowerX; $x <= $topX; $x++) {
            for ($y = $lowerY; $y <= $topY; $y++) {
                /** @var Light $light */
                $light = $this->grid[$x][$y];
                $light->turnOn();
            }
        }
    }

    public function turnOff($lowerX, $lowerY, $topX, $topY)
    {
        for ($x = $lowerX; $x <= $topX; $x++) {
            for ($y = $lowerY; $y <= $topY; $y++) {
                /** @var Light $light */
                $light = $this->grid[$x][$y];
                $light->turnOff();
            }
        }
    }

    public function toggle($lowerX, $lowerY, $topX, $topY)
    {
        for ($x = $lowerX; $x <= $topX; $x++) {
            for ($y = $lowerY; $y <= $topY; $y++) {
                /** @var Light $light */
                $light = $this->grid[$x][$y];
                $light->toggle();
            }
        }
    }
}