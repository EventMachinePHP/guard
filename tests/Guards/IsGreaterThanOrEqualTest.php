<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $limit) => (
        Guard::isGreaterThanOrEqual(
            value: $value,
            limit: $limit
        )
    ))
    ->toHaveValue(fn ($value, $limit) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
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
