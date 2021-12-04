<?php
declare(strict_types=1);

#[\JetBrains\PhpStorm\ArrayShape([0 => 'int[]', 1 => 'Board[]'])]
function parse_input(string $input): array
{
    // parse first line as numbers, rest as boards
    [$n, $b] = explode("\n\n", $input, 2);

    $numbers = toIntArray(explode(',', $n));

    $boards = collect(explode("\n\n", $b))
        ->map(function ($board) {
            return new Board($board);
        });

    return [$numbers, $boards];
}

function solve_part1(string $input): int
{
    [$numbers, $boards] = parse_input($input);

    foreach ($numbers as $number) {
        foreach ($boards as $board) {
            $board->markNumber($number);
            if ($board->hasBingo()) {
                return $number * $board->getUnmarkedSum();
            }
        }
    }

    throw new RuntimeException('no winning board found');
}

function solve_part2(string $input): int
{
    [$numbers, $boards] = parse_input($input);

    foreach ($numbers as $number) {
        foreach ($boards as $i => $board) {
            $board->markNumber($number);
            if ($board->hasBingo() && count($boards) === 1) {
                // if this is bingo on the last board still in play => calculate sum and return
                return $number * $board->getUnmarkedSum();
            }
            if ($board->hasBingo()) {
                // remove the board from play
                unset($boards[$i]);
            }
        }
    }

    throw new RuntimeException('no winning board found');
}


class Board
{
    private array $board;
    private array $marked;

    private int $row_count;
    private int $col_count;

    public function __construct(string $board)
    {
        $this->board = collect(explode("\n", $board))
            ->map(function ($row) {
                return toIntArray(preg_split('/\s+/', trim($row)));
            })
            ->all();

        $this->row_count = count($this->board);
        $this->col_count = count($this->board[0]);

        $this->marked = $this->create_empty_grid();
    }

    public function markNumber(int $number): void
    {
        for ($row = 0; $row < $this->row_count; $row++) {
            for ($col = 0; $col < $this->col_count; $col++) {
                if ($this->board[$row][$col] === $number) {
                    $this->marked[$row][$col] = true;
                }
            }
        }
    }

    public function hasBingo(): bool
    {
        for ($row = 0; $row < $this->row_count; $row++) {
            if (count(array_filter($this->marked[$row])) === $this->col_count) {
                return true;
            }
        }

        $marked = transpose($this->marked);
        for ($col = 0; $col < $this->col_count; $col++) {
            if (count(array_filter($marked[$col])) === $this->col_count) {
                return true;
            }
        }

        return false;
    }

    public function getUnmarkedSum(): int
    {
        $sum = 0;

        for ($row = 0; $row < $this->row_count; $row++) {
            for ($col = 0; $col < $this->col_count; $col++) {
                if ($this->marked[$row][$col] === false) {
                    $sum += $this->board[$row][$col];
                }
            }
        }

        return $sum;
    }

    /**
     * @return array<int[]>
     */
    private function create_empty_grid(): array
    {
        $grid = [];
        for ($row = 0; $row < $this->row_count; $row++) {
            for ($col = 0; $col < $this->col_count; $col++) {
                $grid[$row][$col] = false;
            }
        }

        return $grid;
    }
}