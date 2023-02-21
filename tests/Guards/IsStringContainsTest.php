<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isStringContains()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $subString) => (
        Guard::isStringContains(
            value: $value,
            subString: $subString
        )
    ))
    ->toBeString()
    ->toHaveValue(fn ($value) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $subString, $message) => $message)
    ->expect(fn ($value, $subString, $message) => (
        Guard::isStringContains(
            value: $value,
            subString: $subString
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $subString, $message) => (
        Guard::isStringContains(
            value: $value,
            subString: $subString,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
