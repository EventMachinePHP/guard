<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isAOf()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $class) => (
        Guard::isAOf(
            value: $value,
            class: $class
        )
    ))
    ->toHaveValue(fn ($value, $class) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $class, $message) => $message)
    ->expect(fn ($value, $class, $message) => (
        Guard::isAOf(
            value: $value,
            class: $class
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $class, $message) => (
        Guard::isAOf(
            value: $value,
            class: $class,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
