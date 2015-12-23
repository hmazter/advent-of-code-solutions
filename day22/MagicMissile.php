<?php

class MagicMissile extends InstantSpell
{
    private $damage = 4;

    /**
     * MagicMissile constructor.
     */
    public function __construct()
    {
        parent::__construct('Magic Missile', 53);
    }

    public function cast(Character $caster, Character $target)
    {
//        echo "Player casts {$this->getName()} dealing {$this->damage} damage.\n";
        $target->decreaseHitpoints($this->damage);
    }
}
