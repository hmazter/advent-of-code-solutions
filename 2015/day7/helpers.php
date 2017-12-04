<?php
function parseLine($line)
{
    if (preg_match('/^([\w]+) -> ([\w]+)$/', $line, $match) === 1) {
        $a = $match[1];
        $out = $match[2];
        $op = 'ASSIGN';
        $b = null;
    } elseif (preg_match('/^([\w]+) (AND|OR|LSHIFT|RSHIFT) ([\w]+) -> ([\w]+)$/', $line, $match) === 1) {
        $a = $match[1];
        $op = $match[2];
        $b = $match[3];
        $out = $match[4];
    } elseif (preg_match('/^(NOT) ([\w]+) -> ([\w]+)$/i', $line, $match) === 1) {
        $op = $match[1];
        $a = $match[2];
        $out = $match[3];
        $b = null;
    } else {
        throw new Exception("parse error");
    }

    return [$a, $op, $b, $out];
}

function getNum($var)
{
    global $wires;
    if (is_numeric($var)) {
        return $var & 0xFFFF;
    }

    if (isset($wires[$var])) {
        return $wires[$var];
    }

    return false;
}
