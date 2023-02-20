<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $type) => (
        Guard::isResource(
            value: $value,
            type: $type
        )
    ))
    ->toBeResource()
    ->toHaveValue(fn ($value, $type) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
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
