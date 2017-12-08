<?php
declare(strict_types=1);

function solveDay8(array $input, &$endMax = null, &$runningMax = null)
{
    $register = [];
    foreach ($input as $instruction) {
        runInstruction($instruction, $register);

        if (count($register) > 0) {
            $loopMax = (int)max($register);
            $runningMax = (int)max($loopMax, $runningMax);
        }
    }

    $endMax = (int)max($register);
}

function runInstruction(string $instruction, array &$register)
{
    $parsed = parseInstruction($instruction);
    $condition = $parsed['condition'];

    if (evaluateCondition($condition, $register)) {
        if (isset($register[$parsed['register']]) === false) {
            $register[$parsed['register']] = 0;
        }

        switch ($parsed['operation']) {
            case 'inc':
                $register[$parsed['register']] += $parsed['value'];
                break;

            case 'dec':
                $register[$parsed['register']] -= $parsed['value'];
                break;

            default:
                throw new \RuntimeException('unhandled operation: ' . $condition['operator']);
        }
    }
}

function parseInstruction(string $instruction): array
{
    preg_match("/(\w*) (\w*) (-?\d*) if (\w*) ([!><=]*) (-?\d*)/", $instruction, $output);

    return [
        'register' => $output[1],
        'operation' => $output[2],
        'value' => (int)$output[3],
        'condition' => [
            'register' => $output[4],
            'operator' => $output[5],
            'value' => (int)$output[6],
        ],
    ];
}

function evaluateCondition(array $condition, array $register): bool
{
    switch ($condition['operator']) {
        case '==':
            return ($register[$condition['register']] ?? 0) == $condition['value'];
        case '!=':
            return ($register[$condition['register']] ?? 0) != $condition['value'];
        case '>':
            return ($register[$condition['register']] ?? 0) > $condition['value'];
        case '>=':
            return ($register[$condition['register']] ?? 0) >= $condition['value'];
        case '<':
            return ($register[$condition['register']] ?? 0) < $condition['value'];
        case '<=':
            return ($register[$condition['register']] ?? 0) <= $condition['value'];
        default:
            throw new \RuntimeException('unhandled condition operation: ' . $condition['operator']);
    }
}
