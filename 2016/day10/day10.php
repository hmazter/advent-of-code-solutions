<?php
declare(strict_types = 1);

require_once __DIR__ . '/functions.php';

$rows = file(__DIR__ . '/input.txt');
$matchLow = 17;
$matchHigh = 61;

//$rows = file(__DIR__ . '/example.txt');
//$matchLow = 2;
//$matchHigh = 5;

$rows = array_map('trim', $rows);
$bots = [];
$outputs = [];

// Set up the giving structure
foreach ($rows as $row) {
    if ($row[0] === 'b') {
        $response = parseBotAction($row);
        createEmptyBotIfNotExists($response['bot'], $bots);

        if ($response['high']['type'] === 'bot') {
            createEmptyBotIfNotExists($response['high']['id'], $bots);
        }
        if ($response['low']['type'] === 'bot') {
            createEmptyBotIfNotExists($response['low']['id'], $bots);
        }

        $bots[$response['bot']]['low'] = $response['low'];
        $bots[$response['bot']]['high'] = $response['high'];
    }
}

// assign chips to robots
foreach ($rows as $row) {
    if ($row[0] === 'v') {
        $response = parseValue($row);
        createEmptyBotIfNotExists($response['bot'], $bots);
        giveChipToBot($response['bot'], $response['value'], $bots, $outputs);
    }
}

echo 'multiply ' . reset($outputs[0]) * reset($outputs[1]) * reset($outputs[2]) . PHP_EOL;
