<?php

class Shield extends EffectSpell
{
    private $armor = 7;

    public function __construct()
    {
        parent::__construct('Shield', 113, 6);
    }

    public function tick(Character $target)
    {
        if ($this->timer == 0) {
            $target->setArmor(0);
            return false;
        }

        $this->timer--;
        $target->setArmor($this->armor);

//        echo "Shield's timer is now {$this->timer}.\n";

        if ($this->timer == 0) {
//            echo "Shield wears off, decreasing armor by 7.\n";
        }

        return true;
    }
}
