<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isEqualTo()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $expect) => (
        Guard::isEqualTo(
            value: $value,
            expect: $expect
        )
    ))
    ->toHaveValue(fn ($value, $expect) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $expect, $message) => $message)
    ->expect(fn ($value, $expect, $message) => (
        Guard::isEqualTo(
            value: $value,
            expect: $expect
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $expect, $message) => (
        Guard::isEqualTo(
            value: $value,
            expect: $expect,
            message: CUSTOM_ERROR_MESSAGE,
        )
    ));
