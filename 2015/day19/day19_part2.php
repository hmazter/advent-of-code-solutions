<?php

$lines = file(dirname(__FILE__) . '/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$medicineMolecule = array_pop($lines);
$replacements = [];
foreach ($lines as $line) {
    $replacement = explode(' => ', $line);
    $replacements[$replacement[1]] = $replacement[0];
}

$steps = 0;
while ($medicineMolecule != 'e') {
    foreach ($replacements as $with => $replace) {
        $pos = strpos($medicineMolecule, $with);
        if ($pos !== false) {
            $medicineMolecule = substr_replace($medicineMolecule, $replace, $pos, strlen($with));
            $steps++;
            echo $medicineMolecule.PHP_EOL;
        }
    }
}

echo "$steps step to go from medicine to 'e'\n";
