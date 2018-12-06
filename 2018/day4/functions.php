<?php
declare(strict_types=1);

function solvePart1(array $input)
{
    $sleep = parseInput($input);
    $totalSleep = countTotalSleepPerGuard($sleep);
    $guard = getGuardWithMostSleep($totalSleep);
    $minute = getMostSleptMinuteForGuard($sleep, $guard);

    return $guard * $minute;
}

function solvePart2(array $input)
{
    $sleep = parseInput($input);

    $result = getGuardAndMinuteSleptMost($sleep);
    return $result['guard'] * $result['minute'];
}

function parseInput(array $rows)
{
    $sleep = [];
    $guard = null;
    $sleepStart = null;

    foreach ($rows as $row) {
        if (preg_match('/.*Guard #(\d+).*/', $row, $output)) {
            $guard = (int)$output[1];

            // create a empty sleep array for new guards
            if (isset($sleep[$guard]) === false) {
                for ($i = 0; $i <= 59; $i++) {
                    $sleep[$guard][$i] = 0;
                }
            }
        } elseif (preg_match('/.*:(\d{2})\] falls asleep/', $row, $output)) {
            $sleepStart = (int)$output[1];
        } elseif (preg_match('/.*:(\d{2})\] wakes up/', $row, $output)) {
            $sleepEnd = (int)$output[1];

            // mark all minutes between start (inclusive) an end (exclusive) as slept
            for ($i = $sleepStart; $i < $sleepEnd; $i++) {
                $sleep[$guard][$i]++;
            }
        } else {
            throw new \RuntimeException("Unknown input row: $row");
        }
    }

    return $sleep;
}

function countTotalSleepPerGuard(array $sleep)
{
    $totalSleep = [];

    foreach ($sleep as $guard => $minutes) {
        $totalSleep[$guard] = array_sum($minutes);
    }

    return $totalSleep;
}

function getGuardWithMostSleep(array $totalSleep)
{
    arsort($totalSleep, SORT_NUMERIC);

    $keys = array_keys($totalSleep);
    return reset($keys);
}

function getMostSleptMinuteForGuard(array $sleep, int $guard)
{
    $minutes = $sleep[$guard];

    arsort($minutes, SORT_NUMERIC);

    $keys = array_keys($minutes);
    return reset($keys);
}

function getGuardAndMinuteSleptMost(array $sleep): array
{
    $guard = null;
    $mostSleptMinute = null;
    $mostSleepOnMinute = 0;

    foreach ($sleep as $g => $minutes) {
        arsort($minutes, SORT_NUMERIC);
        $keys = array_keys($minutes);
        $minute = reset($keys);
        $sleepOnMinute = reset($minutes);

        if ($sleepOnMinute > $mostSleepOnMinute) {
            $mostSleepOnMinute = $sleepOnMinute;
            $mostSleptMinute = $minute;
            $guard = $g;
        }
    }

    return [
        'guard' => $guard,
        'minute' => $mostSleptMinute,
    ];
}
