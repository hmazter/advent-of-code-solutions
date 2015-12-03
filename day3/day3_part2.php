<?php

$file = __DIR__ . '/input.txt';
$moves = str_split(file_get_contents($file), 2);

$santa = new Position(0, 0);
$robo = new Position(0, 0);
$houses[$santa->toString()] = 1;
$houses[$robo->toString()] = 1;

foreach ($moves as $move) {
    list($santaMove, $roboMove) = str_split($move);

    $santa->move($santaMove);
    $robo->move($roboMove);

    $houses[$santa->toString()] = 1;
    $houses[$robo->toString()] = 1;
}

echo "Houses: " . count($houses) . "\n";


class Position
{
    private $x;
    private $y;

    /**
     * Position constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->x = (int)$x;
        $this->y = (int)$y;
    }

    public function move($char)
    {
        switch ($char) {
            case '^':
                $this->y++;
                return;
            case 'v':
                $this->y--;
                return;
            case '>':
                $this->x++;
                return;
            case '<':
                $this->x--;
                break;
        }
    }

    public function toString()
    {
        return "{$this->x}:{$this->y}";
    }
}