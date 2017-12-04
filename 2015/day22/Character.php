<?php

abstract class Character
{
    protected $hitpoints = 0;
    protected $damage = 0;
    protected $armor = 0;

    /**
     * Character constructor.
     * @param int $hitpoints
     * @param int $damage
     */
    public function __construct($hitpoints, $damage)
    {
        $this->hitpoints = $hitpoints;
        $this->damage = $damage;
    }

    public function isAlive()
    {
        return $this->getHitpoints() > 0;
    }

    public function getName()
    {
        return get_class($this);
    }

    /**
     * @return int
     */
    public function getHitpoints()
    {
        return $this->hitpoints;
    }

    /**
     * @param int $hitpoints
     */
    public function setHitpoints($hitpoints)
    {
        $this->hitpoints = $hitpoints;
    }

    public function decreaseHitpoints($hitpoints)
    {
        $this->setHitpoints($this->getHitpoints() - $hitpoints);
    }

    public function increaseHitpoints($hitpoints)
    {
        $this->setHitpoints($this->getHitpoints() + $hitpoints);
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    /**
     * @return int
     */
    public function getArmor()
    {
        return $this->armor;
    }

    /**
     * @param int $armor
     */
    public function setArmor($armor)
    {
        $this->armor = $armor;
    }
}
