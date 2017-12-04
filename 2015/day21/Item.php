<?php

class Item
{
    private $name;
    private $cost;
    private $damage;
    private $armor;

    /**
     * Item constructor.
     * @param $name
     * @param $cost
     * @param $damage
     * @param $armor
     */
    public function __construct($name, $cost, $damage, $armor)
    {
        $this->name = $name;
        $this->cost = $cost;
        $this->damage = $damage;
        $this->armor = $armor;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param mixed $damage
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    /**
     * @return mixed
     */
    public function getArmor()
    {
        return $this->armor;
    }

    /**
     * @param mixed $armor
     */
    public function setArmor($armor)
    {
        $this->armor = $armor;
    }
}