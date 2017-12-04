<?php
declare(strict_types = 1);

function parseInput(array $inputRows)
{
    // Add elevator to floor 1, and empty floor 2, 3, 4
    $state = [1 => ['E'], 2 => [], 3 => [], 4 => []];
    $floor = 1;
    foreach ($inputRows as $row) {
        $parts = preg_split('/and|,|\./', $row);
        foreach ($parts as $part) {
            if (preg_match('/(\w*) generator/', $part, $output)) {
                $state[$floor][] = strtoupper(substr($output[1], 0, 2)) . 'G';
            }

            if (preg_match('/(\w*)-compatible microchip/', $part, $output)) {
                $state[$floor][] = strtoupper(substr($output[1], 0, 2)) . 'M';
            }
        }

        $floor++;
    }

    return $state;
}

function printState($state)
{
    $stateCopy = $state;
    krsort($stateCopy);
    foreach ($stateCopy as $floor => $floorContent) {
        sort($floorContent);
        echo $floor . ':  ' . implode('   ', $floorContent) . PHP_EOL;
    }
}

function hashState($state)
{
    $floors = [];
    foreach ($state as $floor => $floorContent) {
        sort($floorContent);
        $floors[] = $floor . ':' . implode(',', $floorContent);
    }

    return implode('|', $floors);
}

function calculateNewValidStates(array $state): array
{
    $newValidStates = [];
    foreach ($state as $floorNumber => $floorContent) {
        if (in_array('E', $floorContent)) {
            $elevatorCombinations = powerSetOfLengthWithoutElevator($floorContent, 1, 2);

            foreach ($elevatorCombinations as $elevatorCombination) {
                if ($floorNumber < 4) {
                    $newState = moveItems($state, $elevatorCombination, $floorNumber, $floorNumber + 1);
                    if (isSafeState($newState)) {
                        $newValidStates[] = $newState;
                    }
                }

                if ($floorNumber > 1) {
                    $newState = moveItems($state, $elevatorCombination, $floorNumber, $floorNumber - 1);
                    if (isSafeState($newState)) {
                        $newValidStates[] = $newState;
                    }
                }
            }
        }
    }

    return $newValidStates;
}

function moveItems(array $state, array $itemsToMove, int $fromFloor, int $toFloor):array
{
    $newState = $state;
    // add the elevator and combination to a floor up
    $newState[$toFloor] = array_merge($newState[$toFloor], $itemsToMove, ['E']);

    // remove from current floor
    $newState[$fromFloor] = array_filter($newState[$fromFloor], function ($var) use ($itemsToMove) {
        if ($var === 'E') {
            return false;
        }
        return ! in_array($var, $itemsToMove);
    });

    return $newState;
}

function isSafeState(array $state): bool
{
    foreach ($state as $floorContents) {
        $generators = [];
        $microchips = [];
        foreach ($floorContents as $item) {
            if ($item[strlen($item) - 1] === 'G') {
                $generators[] = substr($item, 0, -1);
            } elseif ($item[strlen($item) - 1] === 'M') {
                $microchips[] = substr($item, 0, -1);
            }
        }

        // A microchip is safe is there is a matching generator, or no generator at all ==>
        // if there are generators and no match for this chip, we have a fired state
        foreach ($microchips as $microchip) {
            if (count($generators) > 0 && in_array($microchip, $generators) === false) {
                return false;
            }
        }
    }

    return true;
}

function isStateDone($state): bool
{
    return count($state[4]) > 0 && count($state[1]) === 0 && count($state[2]) === 0 && count($state[3]) === 0;
}

function bfsPath($startState)
{
    $queue = new SplQueue();
    # Enqueue the start state
    $queue->enqueue([$startState]);
    $visited[hashState($startState)] = true;

    while ($queue->count() > 0) {
        $path = $queue->dequeue();
        # Get the last node on the path
        # so we can check if we're at the end
        $state = $path[count($path) - 1];

        if (isStateDone($state)) {
            return $path;
        }

        $newStates = calculateNewValidStates($state);
        foreach ($newStates as $nextState) {
            if (isset($visited[hashState($nextState)]) === false) {
                $visited[hashState($nextState)] = true;

                # Build new path appending the neighbour then and enqueue it
                $newPath = $path;
                $newPath[] = $nextState;
                $queue->enqueue($newPath);
            }
        }
    }
    return false;
}

function powerSetOfLengthWithoutElevator(array $elements, int $min, int $max): array
{
    $elevatorKey = array_search('E', $elements, true);
    if ($elevatorKey !== false) {
        unset($elements[$elevatorKey]);
    }

    $result = powerSet($elements);
    foreach ($result as $key => $set) {
        $size = count($set);
        if ($size < $min || $size > $max) {
            unset($result[$key]);
        }
    }

    return $result;
}

/**
 * http://docstore.mik.ua/orelly/webprog/pcook/ch04_25.htm
 *
 * @param array $elements
 * @return array
 */
function powerSet(array $elements): array
{
    // initialize by adding the empty set
    $results = [[]];

    foreach ($elements as $element) {
        foreach ($results as $combination) {
            array_push($results, array_merge(array($element), $combination));
        }
    }

    return $results;
}
