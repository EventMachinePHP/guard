<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $parentClass) => (
        Guard::isSubClassOf(
            value: $value,
            parentClass: $parentClass,
        )
    ))->not()->toThrow(Exception::class);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $parentClass, $message) => $message)
    ->expect(fn ($value, $parentClass, $message) => (
        Guard::isSubClassOf(
            value: $value,
            parentClass: $parentClass,
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $parentClass, $message) => (
        Guard::isSubClassOf(
            value: $value,
            parentClass: $parentClass,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
