<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

enum ExceptionMessage: string
{
    case ValueMessage = 'Got: %s (%s).';

    // region StringGuards
    case IsString     = 'Expected a string.';
    case IsStringNonEmpty = 'Expected a non-empty-string.';
    case IsStringContains = 'Expected a string containing "%s".';
    case IsStringStartsWith = 'Expected a string starting with "%s".';
    case IsStringEndsWith = 'Expected a string ending with "%s".';
    case IsStringStartsWithLetter = 'Expected a string starting with a letter.';
    // endregion

    case IsAlphabetic = 'Expected alphabetic characters only.';
}
