<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::hasUniqueStrictValues()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($values) => (
        Guard::hasUniqueStrictValues(
            values: $values
        )
    ))
    ->toHaveValue(fn ($values) => $values);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($values, $message) => $message)
    ->expect(fn ($values, $message) => (
        Guard::hasUniqueStrictValues(
            values: $values
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($values, $message) => (
        Guard::hasUniqueStrictValues(
            values: $values,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
