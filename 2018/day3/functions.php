<?php
declare(strict_types=1);

function createFabric(int $width, int $height)
{
    $fabric = [];
    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $fabric[$i][$j] = [];
        }
    }

    return $fabric;
}

function parseInputRow(string $input)
{
    preg_match('/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/', $input, $output);
    return new Claim(
        (int)$output[1],
        (int)$output[2],
        (int)$output[3],
        (int)$output[4],
        (int)$output[5]
    );
}

function addClaimToFabric(array &$fabric, array & $wholeClaims, Claim $claim)
{
    $overlappingInchesCount = 0;
    $overlapsWithClaims = [];

    for ($i = $claim->top; $i < $claim->top + $claim->height; $i++) {
        for ($j = $claim->left; $j < $claim->left + $claim->width; $j++) {
            $claimCount = count($fabric[$i][$j]);

            if ($claimCount === 0) {
                // untouched square
                $fabric[$i][$j][] = $claim->id;
            } else {
                $overlapsWithClaims = array_merge($overlapsWithClaims, $fabric[$i][$j]);

                $fabric[$i][$j][] = $claim->id;

                if ($claimCount === 1) {
                    // only count overlaps first time there is a overlap for a square
                    $overlappingInchesCount++;
                }
            }
        }
    }

    $overlapsWithClaims = array_unique($overlapsWithClaims);
    if (count($overlapsWithClaims) === 0) {
        // this claim did not overlap => add it to the array of claims that up to this point does not overlap
        $wholeClaims[] = $claim->id;
    } else {
        // it did overlap => remove all claims it overlaps with from the array of claims that does not overlaps
        $wholeClaims = array_diff($wholeClaims, $overlapsWithClaims);
    }


    return $overlappingInchesCount;
}

function printFabric(array $fabric)
{
    foreach ($fabric as $row) {
        foreach ($row as $column) {
            if (count($column) === 0) {
                echo '.';
            } elseif (count($column) === 1) {
                echo $column[0];
            } else {
                echo 'X';
            }
        }
        echo PHP_EOL;
    }
}

function solve_day3(array $input, int $width, int $height, bool $printFabric = false)
{
    $fabric = createFabric($width, $height);
    $collisions = 0;
    $wholeClaims = [];
    foreach ($input as $line) {
        $claim = parseInputRow($line);
        $collisions += addClaimToFabric($fabric, $wholeClaims, $claim);
    }
    $wholeClaim = reset($wholeClaims);

    if ($printFabric) {
        printFabric($fabric);
    }

    return [$collisions, $wholeClaim];
}

class Claim
{
    public $id;
    public $left;
    public $top;
    public $width;
    public $height;

    public function __construct(int $id, int $left, int $top, int $width, int $height)
    {
        $this->id = $id;
        $this->left = $left;
        $this->top = $top;
        $this->width = $width;
        $this->height = $height;
    }
}
