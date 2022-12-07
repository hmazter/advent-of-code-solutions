<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    /**
     * @test
     * @dataProvider packet_markers
     */
    public function find_start_of_packet_marker(string $input, int $expectedPosition)
    {
        self::assertEquals($expectedPosition, find_start_marker($input, MARKER_PACKET));
    }

    public function packet_markers()
    {
        return [
            ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 7],
            ['bvwbjplbgvbhsrlpgdmjqwftvncz', 5],
            ['nppdvjthqldpwncqszvftbrmjlhg', 6],
            ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 10],
            ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 11],
        ];
    }

    /**
     * @find
     * @dataProvider message_markers
     */
    public function find_start_of_message_marker(string $input, int $expectedPosition)
    {
        self::assertEquals($expectedPosition, find_start_marker($input, MARKER_MESSAGE));
    }

    public function message_markers()
    {
        return [
            ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 19],
            ['bvwbjplbgvbhsrlpgdmjqwftvncz', 23],
            ['nppdvjthqldpwncqszvftbrmjlhg', 23],
            ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 29],
            ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 26],
        ];
    }
}
