<?php

class Player extends Character
{
    private $mana = 0;

    /**
     * Player constructor.
     * @param $mana
     */
    public function __construct($hitpoints, $mana)
    {
        parent::__construct($hitpoints, 0);

        $this->mana = $mana;
    }

    /**
     * @return int
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     */
    public function setMana($mana)
    {
        $this->mana = $mana;
    }

    public function increaseMana($mana)
    {
        $this->mana += $mana;
    }

    public function decreaseMana($mana)
    {
        $this->mana -= $mana;
    }
}
