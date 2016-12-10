<?php
declare(strict_types = 1);

function getMarkerStart($string)
{
    return strpos($string, '(');
}

function processMarker($string)
{
    preg_match('/\((\d+)x(\d+)\)(.+)/', $string, $match);
    return [
        'repeat_times' => (int)$match[2],
        'repeat_text' => substr($match[3], 0, (int)$match[1]),
        'remaining' => substr($match[3], (int)$match[1]),
    ];
}

function decompress(string $string, bool $recursivly)
{
    $length = 0;
    while (true) {
        $start = getMarkerStart($string);
        if ($start === false) {
            // previous calculated length and the last part of the string
            return $length + strlen($string);
        }

        // add length up to the marker start
        $length += $start;
        $response = processMarker($string);
        if ($recursivly) {
            $length += $response['repeat_times'] * decompress($response['repeat_text'], true);
        } else {
            $length += $response['repeat_times'] * strlen($response['repeat_text']);
        }

        $string = $response['remaining'];
    }

    return $length;
}
