<?php

class Spell
{
    protected $name;
    protected $cost;

    /**
     * Spell constructor.
     * @param $name
     * @param $cost
     */
    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }
}