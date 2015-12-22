<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES);
$readingReplacements = true;

$replacements = [];
$medicineMolecule = '';
foreach ($lines as $line) {
    if ($line == '') {
        $readingReplacements = false;
        continue;
    }

    if ($readingReplacements) {
        $replacements[] = explode(' => ', $line);
    } else {
        $medicineMolecule = trim($line);
    }
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
