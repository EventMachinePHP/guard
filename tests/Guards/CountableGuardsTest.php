<?php

declare(strict_types=1);

use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;
use EventMachinePHP\Guard\Tests\GuardTestCase;

/**
 * This block contains tests for the {@see Guard::isCountable()} method.
 */
describe(description: 'isCountable()', tests: function (): void {
    $passingCases = [
        GuardTestCase::A001_ARRAY_EMPTY,
        GuardTestCase::A002_ARRAY_INTEGER_INDEXED,
        GuardTestCase::A003_ARRAY_INGEGER_NEGATIVE_INDEXED,
        GuardTestCase::A004_ARRAY_FLOAT_INDEXED,
        GuardTestCase::A005_ARRAY_FLOAT_NEGATIVE_INDEXED,
        GuardTestCase::A006_ARRAY_BOOLEAN_TRUE_INDEXED,
        GuardTestCase::A007_ARRAY_BOOLEAN_FALSE_INDEXED,
        GuardTestCase::A008_ARRAY_ASSOCIATIVE_NULL_WITH_EMPTY_KEY,
        GuardTestCase::A009_ARRAY_ASSOCIATIVE_EMPTY_WITH_EMPTY_KEY,
        GuardTestCase::A010_ARRAY_ASSOCIATIVE_EMPTY,
        GuardTestCase::A011_ARRAY_NULL_VALUE,
        GuardTestCase::A012_ARRAY_ASSOCIATIVE_NULL_VALUE,
        GuardTestCase::A013_ARRAY_FALSE_VALUE,
        GuardTestCase::A014_ARRAY_ASSOCIATIVE_FALSE_VALUE,
        GuardTestCase::A015_ARRAY_TRUE_AND_FALSE,
        GuardTestCase::A016_ARRAY_ASSOCIATIVE_TRUE_AND_FALSE,
        GuardTestCase::A017_ARRAY_NULL_TRUE_FALSE,
        GuardTestCase::A018_ARRAY_ASSOCIATIVE_NULL_TRUE_FALSE,
        GuardTestCase::A019_ARRAY_ZERO,
        GuardTestCase::A020_ARRAY_ASSOCIATIVE_ZERO,
        GuardTestCase::A021_ARRAY_NEGATIVE_ZERO,
        GuardTestCase::A022_ARRAY_FLOAT_ZER0,
        GuardTestCase::A023_ARRAY_FLOAT_ZER0_NEGATIVE,
        GuardTestCase::A024_ARRAY_POSITIVE_INTEGERS,
        GuardTestCase::A025_ARRAY_NEGATIVE_INTEGERS,
        GuardTestCase::A026_ARRAY_NEGATIVE_FLOATS,
        GuardTestCase::A027_ARRAY_STRINGS,
        GuardTestCase::A028_ARRAY_STRINGS_AND_INTEGERS,
        GuardTestCase::A029_ARRAY_STRING_AND_NUMERIC_ONE,
        GuardTestCase::A030_ARRAY_BOOLEAN_AND_STRING_ONE,
        GuardTestCase::A031_ARRAY_NULL_AND_FALSE,
        GuardTestCase::A032_ARRAY_REPEATED_STRINGS,
        GuardTestCase::A033_ARRAY_REPEATED_INTEGERS,
        GuardTestCase::A034_ARRAY_REPEATED_FLOATS,
        GuardTestCase::A035_ARRAY_REPEATED_BOOLEANS,
        GuardTestCase::A036_ARRAY_REPEATED_OBJECTS,
        GuardTestCase::A037_ARRAY_OBJECTS,
        GuardTestCase::O011_OBJECT_ANONYMOUS_COUNTABLE_CLASS,
    ];

    test(description: 'pass', closure: function (mixed $value): void {
        $result = Guard::isCountable(value: $value);

        expect($result)->toBe($value);
    })->with(testCases($passingCases));

    test(description: 'fail', closure: function (mixed $value): void {
        expect(fn () => Guard::isCountable(value: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::IsCountable->value
            );
    })->with(allCases(except: $passingCases));

    test(description: 'msg', closure: function (mixed $value): void {
        expect(fn () => Guard::isCountable(value: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: $passingCases));
});
