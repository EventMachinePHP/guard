<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isResource()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $type) => (
        Guard::isResource(
            value: $value,
            type: $type
        )
    ))
    ->toBeResource()
    ->toHaveValue(fn ($value, $type) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $type, $message) => $message)
    ->expect(fn ($value, $type, $message) => (
        Guard::isResource(
            value: $value,
            type: $type
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $type, $message) => (
        Guard::isResource(
            value: $value,
            type: $type,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
