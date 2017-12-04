<?php
declare(strict_types = 1);

const COPY_INSTRUCTION = '/cpy (.*) (\w)/';
const INC_INSTRUCTION = '/inc (\w)/';
const DEC_INSTRUCTION = '/dec (\w)/';
const JUMP_INSTRUCTION = '/jnz (\w) (-?\d+)/';

function read($value)
{
    global $registers;

    if (is_numeric($value)) {
        // instruction includes the number
        return $value;
    } else {
        // instructions contains the register to copy to register
        return $registers[$value];
    }
}

$instructions = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//$instructions = file(__DIR__ . '/example.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$registers = [
    'a' => 0,
    'b' => 0,
    //'c' => 0, // part 1
    'c' => 1, // part 2
    'd' => 0,
];

$instructionCount = count($instructions);
$i = 0;
while ($i < $instructionCount) {
    $instruction = $instructions[$i];

    if (preg_match(COPY_INSTRUCTION, $instruction, $match)) {
        $value = read($match[1]);
        $targetRegister = $match[2];
        $registers[$targetRegister] = (int)$value;

    } elseif (preg_match(INC_INSTRUCTION, $instruction, $match)) {
        list(, $register) = $match;
        $registers[$register]++;

    } elseif (preg_match(DEC_INSTRUCTION, $instruction, $match)) {
        list(, $register) = $match;
        $registers[$register]--;

    } elseif (preg_match(JUMP_INSTRUCTION, $instruction, $match)) {
        list(, $register, $distance) = $match;

        $registerValue = read($register);
        if ($registerValue !== 0) {
            $i += (int)$distance;
            continue;
        }
    } else {
        throw new \RuntimeException('No action matched instuction: ' . $instruction);
    }

    $i++;
}

echo 'value in register a: ' . $registers['a'] . PHP_EOL;
