<?php
declare(strict_types=1);

function part1(array $reports): int
{
    $safe_reports = 0;
    foreach ($reports as $report) {
        $report = explode(' ', trim($report));
        if (is_safe_report($report)) {
            $safe_reports++;
        }
    }

    return $safe_reports;
}

function part2(array $reports): int
{
    $safe_reports = 0;
    foreach ($reports as $report) {
        $report = explode(' ', trim($report));
        if (is_safe_report($report)) {
            // report is safe as is
            $safe_reports++;
        } else {
            // is is safe with the "The Problem Dampener" i.e if we remove one of the levels
            $level_count = count($report);
            for ($i = 0; $i < $level_count; $i++) {
                $modified_report = $report;
                unset($modified_report[$i]);
                if (is_safe_report(array_values($modified_report))) {
                    $safe_reports++;
                    break;
                }
            }
        }
    }

    return $safe_reports;
}

function is_safe_report(array $report): bool
{
    $increase = false;
    $decrease = false;

    for ($i = 1, $size = count($report); $i < $size; $i++) {
        $diff = $report[$i] - $report[$i - 1];
        $abs_diff = abs($diff);
        if ($abs_diff < 1 || $abs_diff > 3) {
            // not safe diff => unsafe report
            return false;
        }

        if ($diff > 0) {
            $increase = true;
        } elseif ($diff < 0) {
            $decrease = true;
        }
    }

    if ($increase && $decrease) {
        // both increase and decrease => unsafe report
        return false;
    }

    return true;
}