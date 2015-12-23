<?php

class Recharge extends EffectSpell
{
    private $mana = 101;

    public function __construct()
    {
        parent::__construct('Recharge', 229, 5);
    }

    public function tick(Character $target)
    {
        if ($this->timer == 0) {
            return false;
        }

        $this->timer--;
        $target->setMana($target->getMana() + $this->mana);

//        echo "Recharge provides {$this->mana} mana, raising players mana to {$target->getMana()}; its timer is now {$this->timer}.\n";

        if ($this->timer == 0) {
//            echo "Recharge wears off.\n";
        }

        return true;
    }
}
