<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isWhiteSpace()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value) => (
        Guard::isWhiteSpace(
            value: $value
        )
    ))
    ->toHaveValue(fn ($value) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $message) => $message)
    ->expect(fn ($value, $message) => (
        Guard::isWhiteSpace(
            value: $value
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $message) => (
        Guard::isWhiteSpace(
            value: $value,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
