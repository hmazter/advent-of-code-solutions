<?php
declare(strict_types=1);


function calculate_module_fuel_requirements(int $mass): int
{
    return (int)floor($mass / 3) - 2;
}

function calculate_module_fuel_requirements_including_fuel(int $mass): int
{
    $fuel = (int)floor($mass / 3) - 2;

    if ($fuel <= 0) {
        return 0;
    }

    return $fuel + calculate_module_fuel_requirements_including_fuel($fuel);
}

function calculate_total_fuel_requirements(array $modules, bool $includeFuelItself): int
{
    $total = 0;
    foreach ($modules as $module) {
        if ($includeFuelItself) {
            $total += calculate_module_fuel_requirements_including_fuel($module);
        } else {
            $total += calculate_module_fuel_requirements($module);
        }
    }

    return $total;
}