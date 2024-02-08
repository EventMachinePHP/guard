<?php

use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Tests\GuardTestCase;

/**
 * This test file contains tests for the {@see Guard::isArrayAccessible()} method.
 */

const IS_ARRAY_ACCESSIBLE_PASSING_CASES = [
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
    GuardTestCase::A027_ARRAY_OBJECTS,
    GuardTestCase::O010_OBJECT_ANONYMOUS_ARRAY_ACCESS_CLASS,
];

test('isArrayAccessible(passing)', function (mixed $value): void {
    $result = Guard::isArrayAccessible(value: $value);
    $isArrayOrArrayAccessible = is_array($result) || $result instanceof ArrayAccess;

    expect($isArrayOrArrayAccessible)->toBeTrue()
        ->and($value)->toBe($result);
})->with(testCases(IS_ARRAY_ACCESSIBLE_PASSING_CASES));

test('isArrayAccessible(failing)', function (mixed $value): void {
    expect(fn() => Guard::isArrayAccessible(value: $value))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: ExceptionMessage::IsArrayAccessible->value
        );
})->with(allCases(except: IS_ARRAY_ACCESSIBLE_PASSING_CASES));

test('isArrayAccessible(message)', function (mixed $value): void {
    expect(fn() => Guard::isArrayAccessible(value: $value, message: CUSTOM_ERROR_MESSAGE))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: CUSTOM_ERROR_MESSAGE
        );
})->with(randomCase(except: IS_ARRAY_ACCESSIBLE_PASSING_CASES));
