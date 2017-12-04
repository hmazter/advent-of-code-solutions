<?php
declare(strict_types = 1);

function hasABBA(string $text)
{
    $length = strlen($text) - 3;
    for ($i = 0; $i < $length; $i++) {
        // abba => a == a && b == b && a != b
        if ($text[$i] === $text[$i + 3] && $text[$i + 1] === $text[$i + 2] && $text[$i] !== $text[$i + 1]
        ) {
            return true;
        }
    }

    return false;
}

function hasABA(string $text)
{
    $BABs = [];
    $length = strlen($text) - 2;
    for ($i = 0; $i < $length; $i++) {
        // aba => a == a && a != b
        if ($text[$i] === $text[$i + 2] && $text[$i] !== $text[$i + 1]) {
            // append bab
            $BABs[] = $text[$i + 1] . $text[$i] . $text[$i + 1];
        }
    }

    return count($BABs) > 0 ? $BABs : false;
}

function anyHasABBA(array $texts)
{
    foreach ($texts as $text) {
        if (hasABBA($text)) {
            return true;
        }
    }

    return false;
}

function anyHasABA(array $texts)
{
    $allBABs = [];
    foreach ($texts as $text) {
        $BABs = hasABA($text);
        if ($BABs) {
            $allBABs = array_merge($allBABs, $BABs);
        }
    }

    return count($allBABs) > 0 ? $allBABs : false;
}

function BABSExistsInHypernet(array $BABs, array $hypernets)
{
    foreach ($BABs as $BAB) {
        foreach ($hypernets as $hypernet) {
            if (strpos($hypernet, $BAB) !== false) {
                return true;
            }
        }
    }

    return false;
}

$rows = file('input.txt');
$tlsAddresses = 0;
$sslAddresses = 0;
foreach ($rows as $row) {
    $row = trim($row);
    $matches = preg_split('/[\[]|[\]]/', $row);

    $supernets = [];
    $hypernets = [];
    foreach ($matches as $key => $match) {
        if ($key % 2 === 0) {
            $supernets[] = $match;
        } else {
            $hypernets[] = $match;
        }
    }

    if (anyHasABBA($supernets) === true && anyHasABBA($hypernets) === false) {
        $tlsAddresses++;
    }

    $BABs = anyHasABA($supernets);
    if ($BABs && BABSExistsInHypernet($BABs, $hypernets)) {
        $sslAddresses++;
    }
}

echo 'IP addresses support TLS: ' . $tlsAddresses . PHP_EOL;
echo 'IP addresses support SSL: ' . $sslAddresses . PHP_EOL;
