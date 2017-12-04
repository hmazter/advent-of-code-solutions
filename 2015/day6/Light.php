<?php

/**
 * Created by PhpStorm.
 * User: kristoffer
 * Date: 2015-12-06
 * Time: 15:15
 */
class Light
{
    const OFF = 0;

    private $state;

    /**
     * Light constructor.
     * @param $state
     */
    public function __construct($state)
    {
        $this->state = $state;
    }

    public function isOn()
    {
        return ($this->state == self::ON);
    }

    public function getBrightness()
    {
        return $this->state;
    }

    public function turnOn()
    {
        $this->state++;
    }

    public function turnOff()
    {
        $this->state--;
        if ($this->state < 0) {
            $this->state = 0;
        }
    }

    public function toggle()
    {
        $this->state += 2;
    }
}