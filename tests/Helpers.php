<?php

declare(strict_types=1);

const PASSING_CASES  = '(pass)';
const FAILING_CASES  = '(fail)';
const ERROR_MESSAGES = '(message)';

function guardNameFromFile(string $filePath): string
{
    $parts    = explode('/', $filePath);
    $fileName = array_pop($parts);

    return lcfirst(str_replace(['Test.php', 'Dataset.php', '.php'], '', (string) $fileName));
}

function passDesc(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).PASSING_CASES;
}

function failDesc(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).FAILING_CASES;
}

function errMesgDesc(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).ERROR_MESSAGES;
}
