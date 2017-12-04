<?php

$a = 0; // part 1
//$a = 1; // part 2
$b = 0;

$instructions = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

for ($i = 0; $i < count($instructions); ) {
    $instruction = $instructions[$i];

    if (preg_match('/(\w+) (.*), (.*)/', $instruction, $match) == 1) {
        $inst = $match[1];
        $register = $match[2];
        $offset = $match[3];

        switch ($inst) {
            case 'jie':
                if ($$register % 2 == 0) {
                    $i += $offset;
                    continue 2;
                }
                break;

            case 'jio':
                if ($$register == 1) {
                    $i += $offset;
                    continue 2;
                }
                break;
        }

    } elseif (preg_match('/(\w+) (.*)/', $instruction, $match) == 1) {
        $inst = $match[1];
        $register = $offset = $match[2];

        switch ($inst) {
            case 'inc':
                $$register++;
                break;

            case 'tpl':
                $$register = $$register * 3;
                break;

            case 'hlf':
                $$register = (int) $$register / 2;
                break;

            case 'jmp':
                $i += $offset;
                continue 2;
        }
    }

    $i++;
}

echo "A: $a\n";
echo "B: $b\n";