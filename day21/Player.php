<?php

class Player extends Character
{
    private $spentCash = 0;

    public function buy(Item $item)
    {
        $this->setArmor($this->getArmor() + $item->getArmor());
        $this->setDamage($this->getDamage() + $item->getDamage());
        $this->spentCash += $item->getCost();
    }

    /**
     * @return int
     */
    public function getSpentCash()
    {
        return $this->spentCash;
    }
}