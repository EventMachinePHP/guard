<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

const PASSING_CASES = [
    GuardTestCase::B002_BOOLEAN_FALSE,
];

/**
 * This test file contains tests for the {@see Guard::isFalse()} method.
 */
test('isFalse(passing)', function (mixed $value): void {
    $result = Guard::isFalse(value: $value);

    expect($result)
        ->toBeBool()
        ->toBe($value);
})->with(testCases(PASSING_CASES));

test('isFalse(failing)', function (mixed $value): void {
    expect(fn() => Guard::isFalse(value: $value))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: ExceptionMessage::IsFalse->value
        );
})->with(allCases(except: PASSING_CASES));

test('isFalse(message)', function (mixed $value): void {
    expect(fn() => Guard::isFalse(value: $value, message: CUSTOM_ERROR_MESSAGE))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: CUSTOM_ERROR_MESSAGE
        );
})->with(randomCase(except: PASSING_CASES));
