<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;
use EventMachinePHP\Guard\Tests\GuardTestCase;

const PASSING_CASES = [
    GuardTestCase::O001_OBJECT_CLOSURE,
    GuardTestCase::O002_OBJECT_CLOSURE_RETURNS_CLOSURE,
    GuardTestCase::O008_OBJECT_ANONYMOUS_INVOKABLE_CLASS,
];

/**
 * This test file contains tests for the {@see Guard::isCallable()} method.
 */
test('isCallable(passing)', function (mixed $value): void {
    $result = Guard::isCallable(value: $value);

    expect($result)
        ->toBeCallable()
        ->toBe($value);
})->with([
    ...testCases(PASSING_CASES),
    ...[
        '(strlen)'      => 'strlen',
        '(strtoupper)'  => 'strtoupper',
    ],
]);

test('isCallable(failing)', function (mixed $value): void {
    expect(fn () => Guard::isCallable(value: $value))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: ExceptionMessage::IsCallable->value
        );
})->with(allCases(except: PASSING_CASES));

test('isCallable(message)', function (mixed $value): void {
    expect(fn () => Guard::isCallable(value: $value, message: CUSTOM_ERROR_MESSAGE))
        ->toThrow(
            exception: InvalidGuardArgumentException::class,
            exceptionMessage: CUSTOM_ERROR_MESSAGE
        );
})->with(randomCase(except: PASSING_CASES));
