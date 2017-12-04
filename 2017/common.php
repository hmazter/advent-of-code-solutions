<?php
declare(strict_types=1);

function readRows($file)
{
    return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function readFileContent($file)
{
    return trim(file_get_contents($file));
}
