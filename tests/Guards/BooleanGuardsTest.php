<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This block contains tests for the {@see Guard::isBoolean()} method.
 */
describe(description: 'isBoolean()', tests: function (): void {
    $passingCases = [
        GuardTestCase::B001_BOOLEAN_TRUE,
        GuardTestCase::B002_BOOLEAN_FALSE,
    ];

    test(description: 'pass', closure: function (mixed $value): void {
        $result = Guard::isBoolean(value: $value);

        expect($result)
            ->toBeBool()
            ->toBe($value);
    })->with(testCases($passingCases));

    test(description: 'fail', closure: function (mixed $value): void {
        expect(fn () => Guard::isBoolean(value: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::IsBoolean->value
            );
    })->with(allCases(except: $passingCases));

    test(description: 'msg', closure: function (mixed $value): void {
        expect(fn () => Guard::isBoolean(value: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: $passingCases));
});

/**
 * This block contains tests for the {@see Guard::isTrue()} method.
 */
describe(description: 'isTrue()', tests: function (): void {
    $passingCases = [
        GuardTestCase::B001_BOOLEAN_TRUE,
    ];

    test(description: 'pass', closure: function (mixed $value): void {
        $result = Guard::isTrue(value: $value);

        expect($result)
            ->toBeBool()
            ->toBe($value);
    })->with(testCases($passingCases));

    test(description: 'fail', closure: function (mixed $value): void {
        expect(fn () => Guard::isTrue(value: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::IsTrue->value
            );
    })->with(allCases(except: $passingCases));

    test(description: 'msg', closure: function (mixed $value): void {
        expect(fn () => Guard::isTrue(value: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: $passingCases));
});

/**
 * This block contains tests for the {@see Guard::isFalse()} method.
 */
describe(description: 'isFalse()', tests: function (): void {
    $passingCases = [
        GuardTestCase::B002_BOOLEAN_FALSE,
    ];

    test(description: 'pass', closure: function (mixed $value): void {
        $result = Guard::isFalse(value: $value);

        expect($result)
            ->toBeBool()
            ->toBe($value);
    })->with(testCases($passingCases));

    test(description: 'fail', closure: function (mixed $value): void {
        expect(fn () => Guard::isFalse(value: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::IsFalse->value
            );
    })->with(allCases(except: $passingCases));

    test(description: 'msg', closure: function (mixed $value): void {
        expect(fn () => Guard::isFalse(value: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: $passingCases));
});
