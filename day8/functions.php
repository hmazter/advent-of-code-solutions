<?php
declare(strict_types = 1);

function createScreen(int $width = 50, int $height = 6)
{
    $screen = [];
    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $screen[$i][$j] = 0;
        }
    }

    return $screen;
}

function turnOn(array &$screen, int $columns, int $rows)
{
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $columns; $j++) {
            $screen[$i][$j] = 1;
        }
    }
}

function rotateColumn(array &$screen, int $column, int $amount)
{
    $oldScreen = $screen;
    $rowCount = count($oldScreen);
    for ($row = 0; $row < $rowCount; $row++) {
        $value = $oldScreen[$row][$column];
        $newRowIndex = ($row + $amount) % $rowCount;
        $screen[$newRowIndex][$column] = $value;
    }
}

function rotateRow(array &$screen, int $row, int $amount)
{
    $oldScreen = $screen;
    $columnCount = count($oldScreen[$row]);
    for ($column = 0; $column < $columnCount; $column++) {
        $value = $oldScreen[$row][$column];
        $newColumnIndex = ($column + $amount) % $columnCount;
        $screen[$row][$newColumnIndex] = $value;
    }
}

function countLitPixels(array $screen)
{
    $litPixels = 0;
    foreach ($screen as $rows) {
        $litPixels += array_sum($rows);
    }
    return $litPixels;
}

function printScreen(array $screen)
{
    foreach ($screen as $row) {
        foreach ($row as $pixel) {
            echo $pixel === 1 ? '#' : ' ';
        }
        echo PHP_EOL;
    }
}
