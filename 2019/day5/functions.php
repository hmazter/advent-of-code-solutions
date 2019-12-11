<?php
declare(strict_types=1);

function parse_code($code): array
{
    $DE = $code % 100;
    $C = $code / 100 % 10;
    $B = $code / 1000 % 10;
    $A = $code / 10000 % 10;

    return [$DE, $C, $B, $A];
}

function execute(array $program, int $input): int
{
    $output = 0;
    for ($i = 0; $i < count($program);) {
        $opcode = parse_code($program[$i]);

        switch ($opcode[0]) {
            case 99:
                // returning output
                return $output;

            // addition
            // multiplication
            case 1:
            case 2:
                $parameter1 = $opcode[1] === 0 ? $program[$program[$i + 1]] : $program[$i + 1];
                $parameter2 = $opcode[2] === 0 ? $program[$program[$i + 2]] : $program[$i + 2];
                $result_address = $program[$i + 3];
                if ($opcode[0] === 1) {
                    $program[$result_address] = $parameter1 + $parameter2;
                } else {
                    $program[$result_address] = $parameter1 * $parameter2;
                }
                $i += 4;
                break;

            // store input
            case 3:
                $result_address = $program[$i + 1];
                $program[$result_address] = $input;
                $i += 2;
                break;


            // output
            case 4:
                $output = $opcode[1] === 0 ? $program[$program[$i + 1]] : $program[$i + 1];
                $i += 2;
                break;

            // jump if true
            // jump if false
            case 5:
            case 6:
                $parameter1 = $opcode[1] === 0 ? $program[$program[$i + 1]] : $program[$i + 1];
                $parameter2 = $opcode[2] === 0 ? $program[$program[$i + 2]] : $program[$i + 2];
                if ($opcode[0] === 5 && $parameter1 !== 0) {
                    $i = $parameter2;
                } elseif ($opcode[0] === 6 && $parameter1 === 0) {
                    $i = $parameter2;
                } else {
                    $i += 3;
                }
                break;

            // less than
            case 7:
                $parameter1 = $opcode[1] === 0 ? $program[$program[$i + 1]] : $program[$i + 1];
                $parameter2 = $opcode[2] === 0 ? $program[$program[$i + 2]] : $program[$i + 2];
                $result_address = $program[$i + 3];
                if ($parameter1 < $parameter2) {
                    $program[$result_address] = 1;
                } else {
                    $program[$result_address] = 0;
                }
                $i += 4;
                break;

            // equals
            case 8:
                $parameter1 = $opcode[1] === 0 ? $program[$program[$i + 1]] : $program[$i + 1];
                $parameter2 = $opcode[2] === 0 ? $program[$program[$i + 2]] : $program[$i + 2];
                $result_address = $program[$i + 3];
                if ($parameter1 === $parameter2) {
                    $program[$result_address] = 1;
                } else {
                    $program[$result_address] = 0;
                }
                $i += 4;
                break;
        }
    }
}