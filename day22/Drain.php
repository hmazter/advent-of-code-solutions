<?php

class Drain extends InstantSpell
{
    private $damage = 2;

    private $healing = 2;

    /**
     * MagicMissile constructor.
     */
    public function __construct()
    {
        parent::__construct('Drain', 73);
    }

    public function cast(Character $caster, Character $target)
    {
//        echo "Player casts {$this->getName()} dealing {$this->damage} damage, and healing {$this->healing} hit points\n";
        $target->decreaseHitpoints($this->damage);
        $caster->increaseHitpoints($this->healing);
    }
}
