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
$mostSpent = null;
$count = 0;
$combinations = [];

while (true) {
    $usedSpells = [];
    $count++;
    if ($count % 100000 == 0) {
        echo 'Iteration ' . number_format($count, 0, '.', ' ') .
            ", used combinations " . number_format(count($combinations), 0, '.', ' ') . PHP_EOL;
    }
    $boss = new Boss(71, 10);
    $player = new Player(50, 500);
    $playersTurn = true;

//    echo "------------------------------------\n";
//    echo "-- Start --\n";
//    $player->printInfo();
//    $boss->printInfo();
//    echo PHP_EOL;

    while ($boss->isAlive() && $player->isAlive()) {
        if ($playersTurn) {
//        echo '-- Player turn --' . PHP_EOL;
//        $player->printInfo();

            $player->tickActiveSpells();
            $boss->tickActiveSpells();

            if (!$player->selectSpell($spells, $boss)) {
                break;
            }
            $usedSpells[] = $player->cast($boss);

//        echo PHP_EOL;
            $playersTurn = false;
        } else {

//        echo '-- Boss turn --' . PHP_EOL;
//        $boss->printInfo();

            $player->tickActiveSpells();
            $boss->tickActiveSpells();

            // boss can only attack back if he is alive
            if ($boss->isAlive()) {
                $boss->attack($player);
//            echo PHP_EOL;
            }

            $playersTurn = true;
        }
    }

    $combinations[implode(':', $usedSpells)] = true;

    if ($player->isAlive()) {
//        echo "Player Wins\n";
        if (!isset($leastSpent) || $player->getSpentMana() < $leastSpent) {
            $leastSpent = $player->getSpentMana();
            file_put_contents('leastspent.txt', $leastSpent);
            echo 'least spent: ' . $leastSpent . ' for a victory (part 1)' . PHP_EOL;
        }
    }/* else {
//        echo "Boss Wins\n";
        if (!isset($mostSpent) || $player->getSpentMana() > $mostSpent) {
            $mostSpent = $player->getSpentMana();
//            file_put_contents('mostspent.txt', $mostSpent);
//            echo 'most spent: ' . $mostSpent . ' for a defeat (part 2)' . PHP_EOL;
        }
    }*/
}
