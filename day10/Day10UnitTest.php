<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/functions.php';

class Day10UnitTest extends TestCase
{
    public function testParseValue()
    {
        $return = parseValue('value 5 goes to bot 2');
        self::assertInternalType('integer', $return['bot']);
        self::assertEquals(2, $return['bot']);
        self::assertInternalType('integer', $return['value']);
        self::assertEquals(5, $return['value']);
    }

    public function TestParseBotAction()
    {
        $result = parseBotAction('bot 2 gives low to bot 1 and high to bot 0');
        self::assertInternalType('integer', $result['bot']);
        self::assertEquals(2, $result['bot']);

        self::assertInternalType('integer', $result['low']['id']);
        self::assertEquals(1, $result['low']['id']);
        self::assertEquals('bot', $result['low']['type']);

        self::assertInternalType('integer', $result['high']['id']);
        self::assertEquals(0, $result['high']['id']);
        self::assertEquals('output', $result['high']['type']);
    }

    public function testCreateEmptyBotIfNotExists()
    {
        $bots = [];
        createEmptyBotIfNotExists(1, $bots);

        self::assertCount(1, $bots);
        self::assertNotNull($bots[1]);
        self::assertCount(0, $bots[1]['inventory']);

        $bots[1]['inventory'][] = 2;

        createEmptyBotIfNotExists(1, $bots);
        self::assertCount(1, $bots);
        self::assertCount(1, $bots[1]['inventory']);
    }

    public function testGiveChipToBot_withOneChip()
    {
        $bots = [];
        createEmptyBotIfNotExists(1, $bots);
        giveChipToBot(1, 5, $bots);

        self::assertCount(1, $bots[1]['inventory']);
        self::assertEquals(5, $bots[1]['inventory'][0]);
    }

    public function testGiveChipToBot_withTwoChips()
    {
        $bots = [];
        createEmptyBotIfNotExists(1, $bots);
        $bots[1]['low'] = [
            'type' => 'bot',
            'id' => 2,
        ];
        $bots[1]['high'] = [
            'type' => 'bot',
            'id' => 3,
        ];
        giveChipToBot(1, 5, $bots);
        giveChipToBot(1, 10, $bots);

        self::assertCount(0, $bots[1]['inventory']);

        self::assertCount(1, $bots[2]['inventory']);
        self::assertEquals(5, $bots[2]['inventory'][0]);

        self::assertCount(1, $bots[3]['inventory']);
        self::assertEquals(10, $bots[3]['inventory'][0]);
    }

    public function testPutChipInOutput()
    {
        $outputs = [];
        putChipInOutput(1, 5, $outputs);

        self::assertNotNull($outputs[1]);
        self::assertCount(1, $outputs[1]);
    }
}
