<?php
declare(strict_types = 1);

$file = __DIR__ . '/input.txt';
//$file = __DIR__ . '/example.txt';
$rows = file($file);

$pattern = '/(\D*)-(\d+)\[(.*)\]/';
$roomIdSum = 0;


foreach ($rows as $row) {
    $row = trim($row);
    preg_match($pattern, $row, $match);

    list(, $name, $roomId, $checksum) = $match;
    $strippedName = str_replace('-', '', $name);
    $nameArray = str_split($strippedName);
    $charFreq = array_count_values($nameArray);

    array_walk($charFreq, function (&$freq, $char) {
        $freq = [
            'freq' => $freq,
            'char' => $char
        ];
    });

    usort($charFreq, function ($a, $b) {
        if ($a['freq'] === $b['freq']) {
            return $a['char'] <=> $b['char'];
        }

        return $b['freq'] <=> $a['freq'];
    });

    $charFreq = array_map(function ($a) {
        return $a['char'];
    }, $charFreq);

    $calculatedChecksum = implode('', array_slice($charFreq, 0, 5));
    if ($calculatedChecksum === $checksum) {
        $roomIdSum += (int)$roomId;
        $realName = '';
        $chars = str_split($name);

        foreach ($chars as $char) {
            if ($char === '-') {
                $realName .= ' ';
            } else {
                for ($i = 0; $i < $roomId; $i++) {
                    if ($char === 'z') {
                        $char = 'a';
                    } else {
                        $char++;
                    }
                }
                $realName .= $char;
            }
        }
        if ($realName === 'northpole object storage') {
            echo 'northpole object storage (part 2): ' . $roomId . PHP_EOL;
        }
    }
}

echo 'Valid room sum (part 1): ' . $roomIdSum . PHP_EOL;
