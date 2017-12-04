<?php
declare(strict_types = 1);

function parseValue($string)
{
    preg_match('/value (\d*) goes to bot (\d*)/', $string, $match);

    return [
        'value' => (int)$match[1],
        'bot' => (int)$match[2],
    ];
}

function parseBotAction($string)
{
    preg_match('/bot (\d*) gives low to (\w*) (\d*) and high to (\w*) (\d*)/', $string, $match);

    return [
        'bot' => (int)$match[1],
        'low' => [
            'type' => $match[2],
            'id' => (int)$match[3],
        ],
        'high' => [
            'type' => $match[4],
            'id' => (int)$match[5],
        ],
    ];
}

function createEmptyBotIfNotExists(int $bot, &$bots)
{
    if (isset($bots[$bot]) === false) {
        $bots[$bot] = [
            'inventory' => []
        ];
    }
}

function giveChipToBot(int $bot, int $chip, array &$bots, array &$outputs)
{
    global $matchLow, $matchHigh;

    //echo "giveChipToBot(int $bot, int $chip)" . PHP_EOL;
    $bots[$bot]['inventory'][] = $chip;
    if (count($bots[$bot]['inventory']) === 2) {
        sort($bots[$bot]['inventory']);
        $low = array_shift($bots[$bot]['inventory']);
        $high = array_shift($bots[$bot]['inventory']);

        if ($low === $matchLow && $high === $matchHigh) {
            echo sprintf('bot %d is comparing %d and %d', $bot, $low, $high) . PHP_EOL;
        }

        if ($bots[$bot]['low']['type'] === 'bot') {
            giveChipToBot($bots[$bot]['low']['id'], $low, $bots, $outputs);
        } elseif ($bots[$bot]['low']['type'] === 'output') {
            putChipInOutput($bots[$bot]['low']['id'], $low, $outputs);
        }


        if ($bots[$bot]['high']['type'] === 'bot') {
            giveChipToBot($bots[$bot]['high']['id'], $high, $bots, $outputs);
        } elseif ($bots[$bot]['high']['type'] === 'output') {
            putChipInOutput($bots[$bot]['high']['id'], $high, $outputs);
        }
    }
}

function putChipInOutput(int $output, int $chip, array &$outputs)
{
    if (isset($outputs[$output]) === false) {
        $outputs[$output] = [];
    }

    $outputs[$output][] = $chip;
}
