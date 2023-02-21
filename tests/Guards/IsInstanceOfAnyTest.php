<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isInstanceOfAny()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $classes) => (
        Guard::isInstanceOfAny(
            value: $value,
            classes: $classes
        )
    ))
    ->toHaveValue(fn ($value, $classes) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $classes, $message) => $message)
    ->expect(fn ($value, $classes, $message) => (
        Guard::isInstanceOfAny(
            value: $value,
            classes: $classes,
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $classes, $message) => (
        Guard::isInstanceOfAny(
            value: $value,
            classes: $classes,
            message: CUSTOM_ERROR_MESSAGE,
        )
    ));
