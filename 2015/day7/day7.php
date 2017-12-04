<?php
require_once dirname(__FILE__) . '/helpers.php';

$wires = [];
$queue = [];
$lines = file(dirname(__FILE__) . '/input.txt');
foreach ($lines as $line) {
    $queue[] = trim($line);
}

// while there is still lines in the queue that needs processing
while (count($queue) > 0) {
    $line = array_shift($queue);
    list ($a, $op, $b, $out) = parseLine($line);

    if (in_array($op, ['AND', 'OR', 'LSHIFT', 'RSHIFT'])) {
        $num = getNum($a);
        if ($num === false) {
            $queue[] = $line;
            continue;
        }
        $num2 = getNum($b);
        if ($num2 === false) {
            $queue[] = $line;
            continue;
        }

        switch ($op) {
            case 'AND':
                $wires[$out] = $num & $num2;
                break;

            case 'OR':
                $wires[$out] = $num | $num2;
                break;

            case 'LSHIFT':
                $wires[$out] = $num << $num2;
                break;

            case 'RSHIFT':
                $wires[$out] = $num >> $num2;
                break;
        }
    } elseif ($op == 'NOT') {
        $num = getNum($a);
        if ($num === false) {
            $queue[] = $line;
            continue;
        }

        $wires[$out] = ~$num & 0xFFFF;
    } elseif ($op == 'ASSIGN') {
        $num = getNum($a);
        if ($num === false) {
            $queue[] = $line;
            continue;
        }

        // part 2: override value of b from input file with result from wire a in part 1
        if ($out == 'b') {
            $num = 956;
        }

        $wires[$out] = $num;
    }
}

echo "wire a: " . $wires['a'] . "\n";
