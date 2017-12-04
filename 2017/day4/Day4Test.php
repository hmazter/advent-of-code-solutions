<?php
declare(strict_types=1);

require_once './functions.php';

class Day4Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider isValidPassPhrasePart1Provider
     * @param array $input
     * @param bool $valid
     */
    public function isValidPassPhrasePart1(array $input, bool $valid)
    {
        self::assertEquals($valid, isValidPassPhrasePart1($input));
    }

    public function isValidPassPhrasePart1Provider()
    {
        return [
            [['aa', 'bb', 'cc', 'dd', 'ee'], true],
            [['aa', 'bb', 'cc', 'dd', 'aa'], false],
            [['aa', 'bb', 'cc', 'dd', 'aaa'], true],
        ];
    }
}