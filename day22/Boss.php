<?php

class Boss extends Character
{
    public function attack(Player $player)
    {
        $damage = $this->getDamage() - $player->getArmor();
        if ($damage < 1) {
            $damage = 1;
        }

        $player->decreaseHitpoints($damage);
    }
}
