<?php

class Poison extends EffectSpell implements DamageSpell
{
    private $damage = 3;

    public function __construct()
    {
        parent::__construct('Poison', 173, 6);
    }

    public function tick(Character $target)
    {
        if ($this->timer == 0) {
            return false;
        }

        $this->timer--;
        $target->decreaseHitpoints($this->damage);

//        echo "Poison deals {$this->damage} damage; its timer is now {$this->timer}.\n";

        if ($this->timer == 0) {
//            echo "Poison wears off.\n";
        }

        return true;
    }
}
