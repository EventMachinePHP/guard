<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

describe('hasUniqueStrictValues', function () {
    /**
     * This test file contains tests for the {@see Guard::hasUniqueStrictValues()} method.
     */

    define('HAS_UNIQUE_STRICT_VALUES_PASSING_CASES', [
        GuardTestCase::A001_ARRAY_EMPTY,
    ]);

    test('hasUniqueStrictValues(passing)', function (mixed $value): void {
        $result = Guard::hasUniqueStrictValues(values: $value);

        $isArrayOrArrayAccessible = is_array($result) || $result instanceof ArrayAccess;

        expect($isArrayOrArrayAccessible)->toBeTrue();
    })->with(testCases(HAS_UNIQUE_STRICT_VALUES_PASSING_CASES));

    test('hasUniqueStrictValues(failing)', function (mixed $value): void {
        expect(fn() => Guard::hasUniqueStrictValues(values: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::HasUniqueStrictValues->value
            );
    })->with(allCases(except: HAS_UNIQUE_STRICT_VALUES_PASSING_CASES));

    test('hasUniqueStrictValues(message)', function (mixed $value): void {
        expect(fn() => Guard::hasUniqueStrictValues(values: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: HAS_UNIQUE_STRICT_VALUES_PASSING_CASES));
});

