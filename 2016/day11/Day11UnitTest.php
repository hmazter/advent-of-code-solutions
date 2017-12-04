<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/functions.php';

class Day11UnitTest extends TestCase
{
    public function testParseInput()
    {
        $rows = [
            'The first floor contains a hydrogen-compatible microchip and a lithium-compatible microchip.',
            'The second floor contains a hydrogen generator. An elerium-compatible microchip.'
        ];
        $state = parseInput($rows);

        self::assertEquals(['E', 'HYM', 'LIM'], $state[1]);
        self::assertEquals(['HYG', 'ELM'], $state[2]);
    }

    public function testHashState()
    {
        $state1 = [1 => ['HG', 'LG'], 2 => ['HM']];
        $state2 = [1 => ['LG', 'HG'], 2 => ['HM']];

        self::assertEquals('1:HG,LG|2:HM', hashState($state1));
        self::assertEquals(hashState($state1), hashState($state2));
    }

    public function testIsStateDone()
    {
        $notFinishedState = [1 => ['HG', 'LG'], 2 => ['HM'], 3 => [], 4 => []];
        $finishedState = [1 => [], 2 => [], 3 => [], 4 => ['HG', 'LG', 'HM']];

        self::assertFalse(isStateDone($notFinishedState));
        self::assertTrue(isStateDone($finishedState));
    }

    public function testIsSafeState()
    {
        self::assertTrue(isSafeState([1 => ['HG']]));
        self::assertTrue(isSafeState([1 => ['LM']]));
        self::assertTrue(isSafeState([1 => ['HG', 'HM']]));
        self::assertTrue(isSafeState([1 => ['HG', 'LG']]));
        self::assertTrue(isSafeState([1 => ['LM', 'HM']]));
        self::assertTrue(isSafeState([1 => ['HG', 'HM', 'LG']]));
        self::assertTrue(isSafeState([1 => ['HG', 'HM', 'LG', 'LM']]));

        self::assertFalse(isSafeState([1 => ['HG', 'LM']]));
    }

    public function testPowerSet()
    {
        $result = powerSet(['A', 'B', 'C']);
        self::assertCount(8, $result);
    }

    public function testPowerSetOfLength()
    {
        $result = powerSetOfLengthWithoutElevator(['HG', 'HM', 'LG'], 1, 2);
        self::assertCount(6, $result);
        foreach ($result as $set) {
            self::assertGreaterThanOrEqual(1, count($set));
            self::assertLessThanOrEqual(2, count($set));
        }

        $result = powerSetOfLengthWithoutElevator(['E', 'HG', 'HM', 'LG'], 1, 2);
        self::assertCount(6, $result);
    }

    public function testCalculateNewStates()
    {
        $emptyState = [1 => [], 2 => [], 3 => [], 4 => [],];

        $state = $emptyState;
        $state[1] = ['E', 'HG'];
        $newStates = calculateNewValidStates($state);
        self::assertCount(1, $newStates);

        $state = $emptyState;
        $state[1] = ['E', 'HG', 'HM'];
        $newStates = calculateNewValidStates($state);
        self::assertCount(3, $newStates); // one at a time or both

        $state = $emptyState;
        $state[1] = ['E', 'HG', 'HM'];
        $state[2] = ['LG'];
        $newStates = calculateNewValidStates($state);
        self::assertCount(2, $newStates); // move both or move only the generator
    }
}
