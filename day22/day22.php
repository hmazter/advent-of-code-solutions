<?php
spl_autoload_register(function ($class) {
    require_once $class . '.php';
});

$spells = [
    'MagicMissile',
    'Drain',
    'Poison',
    'Shield',
    'Recharge',
];


$leastSpent = null;
$count = 0;
$combinations = [];

while (true) {
    $count++;
    if ($count % 100000 == 0) {
        echo 'Iteration ' . number_format($count, 0, '.', ' ') .
            ", used combinations " . number_format(count($combinations), 0, '.', ' ') . PHP_EOL;
    }

    $boss = new Boss(71, 10);
    $player = new Player(50, 500);
    $playersTurn = true;
    $usedSpells = [];
    $spentMana = 0;


    // spells
    $poison = false;
    $poisonTimer = 0;
    $shield = false;
    $shieldTimer = 0;
    $recharge = false;
    $rechargeTimer = 0;

    while ($boss->isAlive() && $player->isAlive()) {
        // hard mode (part 2)
        if ($playersTurn) {
            $player->decreaseHitpoints(1);
            if (!$player->isAlive()) {
                continue;
            }
        }

        // tick active effects
        if ($poison) {
            $poisonTimer--;
            $boss->decreaseHitpoints(3);
            if ($poisonTimer == 0) {
                $poison = false;
            }
        }
        if ($shield) {
            $shieldTimer--;
            $player->setArmor(7);
            if ($shieldTimer == 0) {
                $shield = false;
            }
        }
        if ($recharge) {
            $rechargeTimer--;
            $player->increaseMana(101);
            if ($rechargeTimer == 0) {
                $recharge = false;
            }
        }

        if ($playersTurn) {

            // select spell for this round (random. non-in use)
            $spell = '';
            $currentSelects = $spells;
            while (count($currentSelects) > 0) {
                $spellIndex = array_rand($currentSelects, 1);
                $spell = $spells[$spellIndex];

                if ($spell == 'Poison' && !$poison && $player->getMana() >= 173) {
                    $player->decreaseMana(173);
                    $spentMana += 173;

                    $poison = true;
                    $poisonTimer = 6;
                    break;
                }
                if ($spell == 'Shield' && !$shield && $player->getMana() >= 113) {
                    $player->decreaseMana(113);
                    $spentMana += 113;

                    $shield = true;
                    $shieldTimer = 6;
                    break;
                }
                if ($spell == 'Recharge' && !$recharge && $player->getMana() >= 229) {
                    $player->decreaseMana(229);
                    $spentMana += 229;

                    $recharge = true;
                    $rechargeTimer = 5;
                    break;
                }
                if ($spell == 'MagicMissile' && $player->getMana() >= 53) {
                    $player->decreaseMana(53);
                    $spentMana += 53;
                    $boss->decreaseHitpoints(4);
                    break;
                }
                if ($spell == 'Drain' && $player->getMana() >= 73) {
                    $player->decreaseMana(73);
                    $spentMana += 73;
                    $player->increaseHitpoints(2);
                    $boss->decreaseHitpoints(2);
                    break;
                }
                unset($currentSelects[$spellIndex]);
            }
            if ($spell == '') {
                // player dies
                $player->setHitpoints(0);
                continue;
            }

            $usedSpells[] = $spell;

            $playersTurn = false;
        } else {
            if ($boss->isAlive()) {
                $boss->attack($player);
            }

            $playersTurn = true;
        }

        if (!$shield) {
            // reset armor after a depleted shield
            $player->setArmor(0);
        }
    }

    $combinations[implode(':', $usedSpells)] = true;

    if ($player->isAlive()) {
        if (!isset($leastSpent) || $spentMana < $leastSpent) {
            $leastSpent = $spentMana;
        }

        echo "Player Wins! Spent $spentMana mana (" . implode(', ', $usedSpells) .
            "), least spent so far: $leastSpent\n";

    }
}
