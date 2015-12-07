<?php

//$lines = file(dirname(__FILE__) . '/input.txt');
$lines = [
    '123 -> x',
    '456 -> y',
    'x AND y -> d',
    'x OR y -> e',
    'x LSHIFT 2 -> f',
    'y RSHIFT 2 -> g',
    'NOT x -> h',
    'NOT y -> i',
];

$variables = [];
foreach ($lines as $line) {
    list ($a, $op, $b, $out) = parseLine($line);

    if (!isset($variables[$a]) && !is_numeric($a) && $a != null) {
        $variables[$a] = 0;
    }
    if (!isset($variables[$b]) && !is_numeric($b) && $b != null) {
        $variables[$b] = 0;
    }

    if ($op == 'AND') {
        echo "$out = $a & $b\n";
        $variables[$out] = $variables[$a] & $variables[$b];
    } elseif ($op == 'OR') {
        echo "$out = $a | $b\n";
        $variables[$out] = $variables[$a] | $variables[$b];
    } elseif ($op == 'LSHIFT') {
        echo "$out = $a << $b\n";
        $variables[$out] = $variables[$a] << $b;
    } elseif ($op == 'RSHIFT') {
        echo "$out = $a >> $b\n";
        $variables[$out] = $variables[$a] >> $b;
    } elseif ($op == 'NOT') {
        echo "$out = ~ $variables[$a]\n";
        $variables[$out] = ~$variables[$a];
        $variables[$out] = $variables[$out] & 65535;
    } elseif ($op == 'ASSIGN') {
        echo "$out = $a\n";
        if (is_numeric($a)) {
            $variables[$out] = (int)$a;
        } else {
            $variables[$out] = $variables[$a];
        }
    }
}

echo "\n\nResult:\n";
ksort($variables);
foreach ($variables as $variable => $value) {
    echo "$variable: $value\n";
}


function parseLine($line)
{
    $pattern = '/(((\S+) ?)(\S*) ?)(\S*) -> (\S*)/';
    preg_match($pattern, $line, $match);
    if (empty($match[4]) && empty($match[5])) {
        $a = $match[1];
        $out = $match[6];
        $b = null;
        $op = 'ASSIGN';
    } elseif (empty($match[5])) {
        $op = $match[3];
        $a = $match[4];
        $out = $match[6];
        $b = null;
    } else {
        $a = $match[3];
        $op = $match[4];
        $b = $match[5];
        $out = $match[6];
    }

    return [$a, $op, $b, $out];
}