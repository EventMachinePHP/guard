<?php

declare(strict_types=1);

use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isBoolean()} method.
 */
test('isBoolean(passing)', function (mixed $value): void {
    $result = Guard::isBoolean(value: $value);

    expect($result)
        ->toBeBool()
        ->toBe($value);
})->with(testCases([
    GuardTestCase::B001_BOOLEAN_TRUE,
    GuardTestCase::B002_BOOLEAN_FALSE,
]));

test('isBoolean(failing)', function (mixed $value): void {
    expect(fn () => Guard::isBoolean(value: $value))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: ExceptionMessage::IsBoolean->value
        );
})->with(allCases(except: [
    GuardTestCase::B001_BOOLEAN_TRUE,
    GuardTestCase::B002_BOOLEAN_FALSE,
]));

test('isBoolean(message)', function (mixed $value): void {
    expect(fn () => Guard::isBoolean(value: $value, message: CUSTOM_ERROR_MESSAGE))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: CUSTOM_ERROR_MESSAGE
        );
})->with(randomCase(except: [
    GuardTestCase::B001_BOOLEAN_TRUE,
    GuardTestCase::B002_BOOLEAN_FALSE,
]));
