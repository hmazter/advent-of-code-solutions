<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    /**
     * @dataProvider report_provider
     */
    public function test_is_safe_report(array $report, bool $safe)
    {
        self::assertEquals(
            $safe,
            is_safe_report($report)
        );
    }

    public static function report_provider()
    {
        return [
            [[7, 6, 4, 2, 1], true],
            [[1, 2, 7, 8, 9], false],
            [[9, 7, 6, 2, 1], false],
            [[1, 3, 2, 4, 5], false],
            [[8, 6, 4, 4, 1], false],
            [[1, 3, 6, 7, 9], true],
        ];
    }
}
