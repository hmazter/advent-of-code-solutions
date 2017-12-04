<?php
require_once 'Character.php';
require_once 'Boss.php';
require_once 'Player.php';
require_once 'Item.php';

/*
 * Create shop
 */
$weapons = [
    new Item('Dagger', 8, 4, 0),
    new Item('Shortsword', 10, 5, 0),
    new Item('Warhammer', 25, 6, 0),
    new Item('Longsword', 40, 7, 0),
    new Item('Greataxe', 74, 8, 0),
];

$armors = [
    new Item('Leather', 13, 0, 1),
    new Item('Chainmail', 31, 0, 2),
    new Item('Splintmail', 53, 0, 3),
    new Item('Bandedmail', 75, 0, 4),
    new Item('Platemail', 102, 0, 5),
];

$rings = [
    new Item('Damage +1', 25, 1, 0),
    new Item('Damage +2', 50, 2, 0),
    new Item('Damage +3', 100, 3, 0),
    new Item('Defense +1', 20, 0, 1),
    new Item('Defense +2', 40, 0, 2),
    new Item('Defense +3', 80, 0, 3),
];

$leastSpent = null;
$mostSpent = null;

while (true) {
    $boss = new Boss(100, 8, 2);
    $player = new Player(100, 0, 0);

    // buy equipment for player
    // buy 1 weapon
    $weaponIndex = array_rand($weapons, 1);
    $player->buy($weapons[$weaponIndex]);

    // buy 0 or 1 armor
    $numArmors = rand(0, 1);
    if ($numArmors == 1) {
        $armorIndex = array_rand($armors, 1);
        $player->buy($armors[$armorIndex]);
    }

    // buy 0, 1 or 2 rings
    $numRings = rand(0, 2);
    for ($i = 0; $i < $numRings; $i++) {
        $ringIndex = array_rand($rings, 1);
        $player->buy($rings[$ringIndex]);
    }

    $playerWins = false;
    while ($boss->getHitpoints() > 0 && $player->getHitpoints() > 0) {
        $player->attack($boss);

        // boss can only attack back if he is alive
        if ($boss->isAlive()) {
            $boss->attack($player);
        }
    }

    if ($player->isAlive()) {
        if (!isset($leastSpent) || $player->getSpentCash() < $leastSpent) {
            $leastSpent = $player->getSpentCash();
            echo 'least spent: ' . $leastSpent . ' for a victory (part 1)' . PHP_EOL;
        }
    } else {
        if (!isset($mostSpent) || $player->getSpentCash() > $mostSpent) {
            $mostSpent = $player->getSpentCash();
            echo 'most spent: ' . $mostSpent . ' for a defeat (part 2)' . PHP_EOL;
        }
    }
}
