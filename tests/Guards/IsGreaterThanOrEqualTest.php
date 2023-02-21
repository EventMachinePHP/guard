<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isGreaterThanOrEqual()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDataset(__FILE__))
    ->expect(fn ($value, $limit) => (
        Guard::isGreaterThanOrEqual(
            value: $value,
            limit: $limit
        )
    ))
    ->toHaveValue(fn ($value, $limit) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDataset(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $limit, $message) => $message)
    ->expect(fn ($value, $limit, $message) => (
        Guard::isGreaterThanOrEqual(
            value: $value,
            limit: $limit
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $limit, $message) => (
        Guard::isGreaterThanOrEqual(
            value: $value,
            limit: $limit,
            message: CUSTOM_ERROR_MESSAGE,
        )
    ));
