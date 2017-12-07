<?php
declare(strict_types=1);

/**
 * Reallocate memory blocks until a loop in the configurations is found
 * @param array $memory
 * @return array
 */
function reallocateMemory(array &$memory): array
{
    $cycles = 0;
    $usedConfigurations = [];

    while (true) {
        redistributeLargest($memory);
        $memoryConfiguration = join('|', $memory);
        $cycles++;

        if (isset($usedConfigurations[$memoryConfiguration])) {
            // configuration has been used before, a loop is found, break
            return [
                'total' => $cycles,
                'loop' => $cycles - $usedConfigurations[$memoryConfiguration]
            ];
        }

        $usedConfigurations[$memoryConfiguration] = $cycles;
    }

    return [];
}

/**
 * Redistribute largest memory block to the rest of the blocks
 *
 * @param array $memory
 */
function redistributeLargest(array &$memory)
{
    $memorySize = count($memory);
    $leftToDistribute = $largest = max($memory);
    $pos = array_search($largest, $memory);

    $memory[$pos] = 0;

    while ($leftToDistribute > 0) {
        $pos++;
        $memory[$pos % $memorySize]++;
        $leftToDistribute--;
    }
}
