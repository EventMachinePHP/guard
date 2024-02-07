<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

enum ExceptionMessage: string
{
    case ValueMessage = 'Got: %s (%s).';

    // region Array Guards
    case IsArray               = 'Expected an array.';
    case IsArrayAccessible     = 'Expected an array or an object implementing ArrayAccess.';
    case HasUniqueStrictValues = 'Expected strict unique values. Got duplicate values.';
    case HasUniqueLooseValues  = 'Expected loose unique values. Got duplicate values.';
    // endregion

    // region Boolean Guards
    case IsBoolean = 'Expected a boolean value.';
    case IsTrue    = 'Expected a value to be true.';
    case IsFalse   = 'Expected a value to be false.';
    // endregion

    // region Callable Guards
    case IsCallable = 'Expected a callable.';
    // endregion

    // region StringGuards
    case IsString                 = 'Expected a string.';
    case IsStringNonEmpty         = 'Expected a non-empty-string.';
    case IsStringContains         = 'Expected a string containing "%s".';
    case IsStringStartsWith       = 'Expected a string starting with "%s".';
    case IsStringEndsWith         = 'Expected a string ending with "%s".';
    case IsStringStartsWithLetter = 'Expected a string starting with a letter.';
    // endregion

    case IsAlphabetic = 'Expected alphabetic characters only.';
}
