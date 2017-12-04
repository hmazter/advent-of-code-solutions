<?php

class Character
{
    protected $hitpoints;
    protected $damage;
    protected $armor;

    /**
     * Character constructor.
     * @param int $hitpoints
     * @param int $damage
     * @param int $armor
     */
    public function __construct($hitpoints, $damage, $armor)
    {
        $this->hitpoints = $hitpoints;
        $this->damage = $damage;
        $this->armor = $armor;
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

    public function takeDamage($damage)
    {
        $damage -= $this->getArmor();
        if ($damage < 1) {
            $damage = 1;
        }

        //echo $this->getName() . ' takes ' . $damage . ' damage ';
        $this->decreaseHitpoints($damage);
        //echo 'to ' . $this->getHitpoints() . ' hitpoints' . PHP_EOL;
    }

    public function attack(Character $character)
    {
        //echo $this->getName() . ' attacks with ' . $this->getDamage() . ' damage' . PHP_EOL;
        $character->takeDamage($this->getDamage());
    }
}
