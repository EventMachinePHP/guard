<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isPositiveFloat()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value) => (
        Guard::isPositiveFloat(
            value: $value
        )
    ))
    ->toBeFloat()
    ->toHaveValue(fn ($value) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $message) => $message)
    ->expect(fn ($value, $message) => (
        Guard::isPositiveFloat(
            value: $value
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $message) => (
        Guard::isPositiveFloat(
            value: $value,
            message: CUSTOM_ERROR_MESSAGE,
        )
    ));
