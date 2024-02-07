<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

const PASSING_CASES = [
    GuardTestCase::B001_BOOLEAN_TRUE,
];

/**
 * This test file contains tests for the {@see Guard::isTrue()} method.
 */
test('isTrue(passing)', function (mixed $value): void {
    $result = Guard::isTrue(value: $value);

    expect($result)
        ->toBeBool()
        ->toBe($value);
})->with(testCases(PASSING_CASES));

test('isTrue(failing)', function (mixed $value): void {
    expect(fn() => Guard::isTrue(value: $value))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: ExceptionMessage::IsTrue->value
        );
})->with(allCases(except: PASSING_CASES));

test('isTrue(message)', function (mixed $value): void {
    expect(fn() => Guard::isTrue(value: $value, message: CUSTOM_ERROR_MESSAGE))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: CUSTOM_ERROR_MESSAGE
        );
})->with(randomCase(except: PASSING_CASES));
