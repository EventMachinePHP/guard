<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $expect) => (
        Guard::isIdenticalTo(
            value: $value,
            expect: $expect
        )
    ))
    ->toHaveValue(fn ($value, $expect) => $value);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $expect, $message) => $message)
    ->expect(fn ($value, $expect, $message) => (
        Guard::isIdenticalTo(
            value: $value,
            expect: $expect
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $expect, $message) => (
        Guard::isIdenticalTo(
            value: $value,
            expect: $expect,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
