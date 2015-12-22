<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$medicineMolecule = array_pop($lines);
$replacements = [];
foreach ($lines as $line) {
    $replacements[] = explode(' => ', $line);
}

$molecules = [];
foreach ($replacements as $replacement) {
    echo $replacement[0] . ' => ' . $replacement[1] . PHP_EOL;
    $pos = 0;
    while (($pos = strpos($medicineMolecule, $replacement[0], $pos)) !== false) {
        echo "Pos: $pos\n";

        $string = substr($medicineMolecule, 0, $pos) .//' '.
            $replacement[1] .//' '.
            substr($medicineMolecule, $pos + strlen($replacement[0]));

        echo "string: " . $string . PHP_EOL;
        $molecules[$string] = true;

        $pos++;
    };
}

echo "Distinct molecules " . count($molecules) . PHP_EOL;
