<?php

class Boss extends Character
{
    public function printInfo()
    {
        echo "- Boss has {$this->getHitpoints()} hit points, {$this->getDamage()} damage\n";
    }

    public function attack(Player $player)
    {
        $damage = $this->getDamage() - $player->getArmor();
        if ($damage < 1) {
            $damage = 1;
        }
        $player->decreaseHitpoints($damage);

//        echo $this->getName() . ' attacks with ' .
//            $this->getDamage() . ' - ' . $player->getArmor() . ' = ' .
//            $damage . ' damage' . PHP_EOL;
    }
}
