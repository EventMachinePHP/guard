<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value) => (
        Guard::isString(
            value: $value
        )
    ))
    ->toBeString()
    ->toHaveValue(fn ($value) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $message) => $message)
    ->expect(fn ($value, $message) => (
        Guard::isString(
            value: $value
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $message) => (
        Guard::isString(
            value: $value,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
