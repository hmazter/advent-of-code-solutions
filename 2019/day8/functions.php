<?php
declare(strict_types=1);

use Intervention\Image\ImageManager;

function parse_input(string $string): array
{
    return toIntArray(str_split($string));
}

function create_layers(int $width, int $height, string $input): array
{
    $pixels = parse_input($input);

    return array_chunk($pixels, $width * $height);
}

function find_layer_with_least_amount_of_zeroes(array $layers): array
{
    return collect($layers)
        ->sortBy(function (array $layer) {
            $count = array_count_values($layer);
            return $count[0] ?? 0;
        })
        ->first();
}

function multiply_ones_and_twos(array $layer): int
{
    $count = array_count_values($layer);
    return $count[1] * $count[2];
}

function find_color_for_each_pixel_in_layers(array $layers): array
{
    $length = count($layers[0]);
    $combined = [];

    for ($i = 0; $i < $length; $i++) {
        foreach ($layers as $layer) {
            $pixel = $layer[$i];
            if ($pixel === 0 || $pixel === 1) {
                // if its black (0) or white (1)
                // record that pixel color in the result
                $combined[$i] = $pixel;

                //  and move to next position
                break;
            }

            // if its transparent (2)
            // we check the next layer for this position
        }
    }

    return $combined;
}

function draw_layer($width, $height, $layer): void
{
    $manager = new ImageManager(array('driver' => 'gd'));
    $img = $manager->canvas($width, $height, '#000000');

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            // create png image
            $pixel = $layer[$y * $width + $x];
            $color = $pixel === 0 ? '#000000' : '#ffffff';
            $img->pixel($color, $x, $y);

            // output to terminal
            echo $pixel === 0 ? '███' : '   ';
        }
        echo PHP_EOL;
    }

    $img->save(__DIR__ . '/image.png');
}

function solve_part_1(int $width, int $height, string $input)
{
    $layers = create_layers($width, $height, $input);
    $layer = find_layer_with_least_amount_of_zeroes($layers);
    return multiply_ones_and_twos($layer);
}

function solve_part_2(int $width, int $height, string $input): void
{
    $layers = create_layers($width, $height, $input);
    $combined = find_color_for_each_pixel_in_layers($layers);
    draw_layer($width, $height, $combined);
}