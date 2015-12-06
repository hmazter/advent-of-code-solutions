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
    const ON = 1;

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

    public function turnOn()
    {
        $this->state = self::ON;
    }

    public function turnOff()
    {
        $this->state = self::OFF;
    }

    public function toggle()
    {
        if ($this->isOn()) {
            $this->turnOff();
        } else {
            $this->turnOn();
        }
    }
}